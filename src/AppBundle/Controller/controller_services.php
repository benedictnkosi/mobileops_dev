<?php

require_once(__DIR__.'/../../../bootstrap.php');
require_once(__DIR__.'/../../../app/application.php');

require_once(__DIR__.'/../Entity/LuService.php');
require_once(__DIR__.'/../Entity/LuServiceType.php');
require_once(__DIR__.'/../Entity/UserProfile.php');
require_once(__DIR__.'/../Entity/User.php');
require_once(__DIR__.'/../Entity/UserUserService.php');
require_once(__DIR__.'/../Entity/LuUserRole.php');
require_once(__DIR__.'/../Entity/LuAccountStatus.php');
require_once(__DIR__.'/../Entity/Address.php');

if (isset ( $_GET ['getAllServices'] )) {
	if ($_GET ['getAllServices']) :
	getAllServices($entityManager);
	endif;
}

if (isset ( $_POST ['saveServices'] )) {
	if ($_POST ['saveServices']) :
	saveServices($entityManager);

	endif;
}


function saveServices($entityManager){
	try{
		$date = new DateTime();
		session_start ();
		$newServicesArray = json_decode(stripslashes($_POST['saveServices']));
		$partner_services = $_SESSION['partner_services'];

		$AddedServicesArray=array_diff($newServicesArray,$partner_services);
		$RemovedServicesArray=array_diff($partner_services,$newServicesArray);

		$user = $entityManager->getRepository('User')->findOneBy(array('emailAddress' => $_SESSION ['email_address']));
		$UserProfile = $user->getUserProfile();

		if(count($AddedServicesArray) > 0){
			foreach ($AddedServicesArray as &$value) {
				$LuService = $entityManager->getRepository('LuService')->findOneBy(array('name' =>$value ));

				$UserUserService = $entityManager->getRepository('UserUserService')->findOneBy(array('userUserServiceName' =>$LuService, 'userUserServiceProfile' => $UserProfile));
				if($UserUserService){
					$UserUserService->setActive(true);
					$entityManager->persist($UserUserService);
				}else{
					$UserUserService =  new UserUserService();
					$UserUserService->setDateAdded($date);
					$UserUserService->setUserUserServiceName($LuService);
					$UserUserService->setUserUserServiceProfile($UserProfile);
					$entityManager->persist($UserUserService);
				}
			}
			$entityManager->flush();
			getPartnerServices($entityManager);

		}
		
		if(count($RemovedServicesArray) > 0){
			foreach ($RemovedServicesArray as &$value) {
				$LuService = $entityManager->getRepository('LuService')->findOneBy(array('name' =>$value ));
				$UserUserService = $entityManager->getRepository('UserUserService')->findOneBy(array('userUserServiceName' =>$LuService ));
				$UserUserService->setActive(false);
				$entityManager->persist($UserUserService);
			}
			$entityManager->flush();
			getPartnerServices($entityManager);
		}
			
		$response['status'] = 1;
			$response['message'] = "Services updated successfuliy";
			echo json_encode($response);
		
	}catch (Exception $e) {
		$response['status'] = 2;
		$response['message'] = $e->getMessage();
		echo json_encode($response);
	}

}

function getPartnerServices($entityManager){
	try{
		$user        = $entityManager->getRepository('User')->findOneBy(array('emailAddress' => $_SESSION ['email_address']));
		$UserProfile = $user->getUserProfile();
		//$UserProfileID = $UserProfile->getUserProfileId();

		$PartnerServices = $entityManager->getRepository('UserUserService')->findBy(array('userUserServiceProfile' => $UserProfile, 'active' => TRUE));

		$ServicesArray = array ();
		foreach ($PartnerServices as &$value) {
			array_push ( $ServicesArray, $value->getUserUserServiceName()->getName());
		}
		$_SESSION['partner_services'] = $ServicesArray;
		//print json_encode ( $ServicesArray );

		$response['status'] = 1;
		$response['message'] = $ServicesArray;
		echo json_encode($response);
	}catch (Exception $e) {
		$response['status'] = 2;
		$response['message'] = $e->getMessage();
		echo json_encode($response);
	}
}


//get all services ordered by service type
function getAllServices($entityManager){
	try{
		$LuService = new LuService();
		$LuServices = $entityManager->getRepository('LuService')->findBy(array(), array('serviceTypeName' => 'ASC'));

		$serviceTypeName = "";
		$allServicesArray = array ();
		$ServicesArray = array ();
		$i = 0;
		$j = 0;

		foreach ($LuServices as &$value) {
			//if service type name has changed add array to $allServicesArray and reset  $ServicesArray
			if ( (strcmp($serviceTypeName,$value->getServiceTypeName()->getName()) !== 0) && $i !== 0) {
				array_push ( $allServicesArray, $ServicesArray);
				$ServicesArray = array ();
				$j = 0;
			}

			$serviceTypeName = $value->getServiceTypeName()->getName();
			// make the first element of the array the service type name
			if($j == 0){
				array_push ( $ServicesArray, $serviceTypeName);
			}

			array_push ( $ServicesArray, $value->getName());
			$i++;
			$j++;
		}

		array_push ( $allServicesArray, $ServicesArray);

		$response['status'] = 1;
		$response['message'] = $allServicesArray;
		echo json_encode($response);
	}catch (Exception $e) {
		$response['status'] = 2;
		$response['message'] = $e->getMessage();
		echo json_encode($response);
	}
}



?>