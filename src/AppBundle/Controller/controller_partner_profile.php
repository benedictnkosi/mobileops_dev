<?php
require_once(__DIR__.'/../../../bootstrap.php');
require_once(__DIR__.'/../../../app/application.php');

require_once(__DIR__.'/../Entity/User.php');
require_once(__DIR__.'/../Entity/LuAccountStatus.php');
require_once(__DIR__.'/../Entity/LuUserRole.php');
require_once(__DIR__.'/../Entity/UserProfile.php');
require_once(__DIR__.'/../Entity/Address.php');
require_once(__DIR__.'/../Entity/UserUserService.php');
require_once(__DIR__.'/../Entity/LuService.php');
require_once(__DIR__.'/../Entity/LuServiceType.php');
require_once(__DIR__.'/../Entity/PartnerImages.php');


if (isset ( $_POST ['savePersonalDetails'] )) {
	if ($_POST ['savePersonalDetails']) :
	savePersonalDetails($entityManager);
	endif;
}

if (isset ( $_GET ['getPartnerServices'] )) {
	if ($_GET ['getPartnerServices']) :
	getPartnerServices($entityManager);
	endif;
}


if (isset ( $_GET ['getPartnerProfile'] )) {
	if ($_GET ['getPartnerProfile']) :
	getPartnerProfile($entityManager);
	endif;
}


if (isset ( $_GET ['deleteimage'] )) {
	if ($_GET ['deleteimage']) :
	deleteImages($entityManager);

	endif;
}


if (isset ( $_GET ['getPartnerImages'] )) {
	if ($_GET ['getPartnerImages']) :
	getPartnerImages($entityManager);

	endif;
}



function deleteImages($entityManager){
	try {
		$userDir = '../../images/products/';
		$image = $userDir . $_GET ['deleteimage'];
		if(!unlink ( str_replace("thumb_","",$image)  )){
			$response['status'] = 2;
			$response['message'] = 'delete file failed';
			echo json_encode($response);
			return;
		}

		$image = $userDir . $_GET ['deleteimage'];
		if(!unlink ( $image )){
			$response['status'] = 2;
			$response['message'] = 'delete file failed';
			echo json_encode($response);
			return;
		}

		//delete from db
		$dbImageName = str_replace("thumb_","",$_GET ['deleteimage']);
		echo $dbImageName;
		$partnerImage = $entityManager->getRepository('PartnerImages')->findOneBy(array('imageName' => $dbImageName));
		if($partnerImage){
			$partnerImage->setActive(0);
			$entityManager->persist($partnerImage);
			$entityManager->flush();

			$response['status'] = 1;
			$response['message'] = "delete file successfully";
			echo json_encode($response);
		}else{
			$response['status'] = 2;
			$response['message'] = 'delete file failed';
			echo json_encode($response);
		}


	}catch (Exception $e) {
		$response['status'] = 2;
		$response['message'] = $e->getMessage();
		echo json_encode($response);
	}

}


function savePersonalDetails($entityManager){
	try {
		session_start ();
	} catch (Exception $e) {
	}
	try {
		$name = $_POST['firstname'];
		$surname = $_POST['surname'];
		$email = $_SESSION ['email_address'];
		$phone_number = $_POST['mobile_number'];
		$complex = $_POST['complex'];
		$latitude = $_POST['lat'];
		$longitude = $_POST['lng'];
		$province = $_POST['administrative_area_level_1'];
		$street_name = $_POST['route'];
		$street_number = $_POST['street_number'];
		$suburb = $_POST['sublocality'];
		$city = $_POST['locality'];
		$gender = $_POST['gender'];
		$idnumber = $_POST['idnumber'];
		$bookingNotes = $_POST['personalNote'];

		$user = $entityManager->getRepository('User')->findOneBy(array('emailAddress' => $_SESSION ['email_address']));
		if($user){
			$date = new DateTime();
			$UserProfile = $user->getUserProfile();

			$Address = $UserProfile->getAddress();
			$Address->setStreetName($street_name);
			$Address->setStreetNumber($street_number);
			$Address->setCityName ($city);
			$Address->setSuburbName ($suburb);
			$Address->setProvinceName ($province);
			$Address->setLatitude($latitude);
			$Address->setLongitude($longitude);
			$Address->setComplexName($complex);
			$Address->setDateAdded($date);

			$UserProfile->setAddress ($Address);
			$UserProfile->setFirstName($name);
			$UserProfile->setSurname($surname);
			$UserProfile->setPhoneNumber($phone_number);
			$UserProfile->setGender($gender);
			$UserProfile->setIdnumberOrPassport($idnumber);
			$UserProfile->setDateCreated($date);
			$UserProfile->setPersonalNote($bookingNotes);

			$user->setUserProfile ($UserProfile);

			$entityManager->persist($Address);
			$entityManager->persist($UserProfile);
			$entityManager->persist($user);

			$entityManager->flush();

			$response['status'] = 1;
			$response['message'] = "Successfully updated personal details";
			echo json_encode($response);
		} else{
			$response['status'] = 2;
			$response['message'] = "User with email " . $_SESSION ['email_address'] . " not found. Please email administrator @ " . SYSTEM_EMAIL_ADDRESS;
			echo json_encode($response);
		}

	}catch (Exception $e) {
		$response['status'] = 2;
		$response['message'] = $e->getMessage();
		echo json_encode($response);
	}
}


function getPartnerServices($entityManager){
	try {
		session_start ();
	} catch (Exception $e) {
	}

	try {
		$user = $entityManager->getRepository('User')->findOneBy(array('emailAddress' => $_SESSION ['email_address']));
		$UserProfile = $user->getUserProfile();
		$UserProfileID = $UserProfile->getUserProfileId();

		$PartnerServices = $entityManager->getRepository('UserUserService')->findBy(array('userUserServiceProfile' => $UserProfile, 'active' => TRUE));

		$ServicesArray = array ();
		//partner services will be stored on the session as a single dimensional array
		$ServicesNameArray = array ();

		foreach ($PartnerServices as &$value) {
			$tempArray = array ();
			$LuService = $entityManager->getRepository('LuService')->findOneBy(array('name' => $value->getUserUserServiceName()->getName()));

			array_push ( $tempArray, $LuService->getServiceTypeName()->getName());
			array_push ( $tempArray, $value->getUserUserServiceName()->getName());
			array_push ( $ServicesNameArray, $value->getUserUserServiceName()->getName());
			//multi dimensional array with service name and service type
			array_push($ServicesArray, $tempArray);
		}
		//sort by service type name
		array_multisort($ServicesArray, SORT_ASC);
		$_SESSION['partner_services'] = $ServicesNameArray;
		//print json_encode ( $ServicesArray );

		$response['status'] = 1;
		$response['message'] = $ServicesArray;
		echo json_encode($response);

	} catch (Exception $e) {
		$response['status'] = 2;
		$response['message'] = $e->getMessage();
		echo json_encode($response);
	}

}


function getPartnerProfile($entityManager){
	try {
		session_start ();
	} catch (Exception $e) {
	}

	try {
		$profileArray = array ();

		$user = $entityManager->getRepository('User')->findOneBy(array('emailAddress' => $_SESSION ['email_address']));
		if($user){
			$UserProfile = $user->getUserProfile();

			$profileArray['name'] = $UserProfile->getFirstName();
			$profileArray['surname'] = $UserProfile->getSurname();
			$profileArray['idnumber'] = $UserProfile->getIdnumberOrPassport();
			$profileArray['personalNote'] = $UserProfile->getPersonalNote();
			$profileArray['email'] = $user->getEmailAddress();
			$profileArray['mobile_number'] = $UserProfile->getPhoneNumber();
			$profileArray['gender'] = $UserProfile->getGender();
			$Adresss = $UserProfile->getAddress();
			if($Adresss){
				$profileArray['address'] =  $Adresss->getStreetNumber() . " " .$Adresss->getStreetName() .", " . $Adresss->getCityName() . ", " . COUNTRY;
				$profileArray['complex'] = $Adresss->getComplexName();
				$profileArray['latitude'] = $Adresss->getLatitude();
				$profileArray['longitude'] = $Adresss->getLongitude();
				$profileArray['province'] = $Adresss->getProvinceName();
				$profileArray['street_name'] = $Adresss->getStreetName();
				$profileArray['street_number'] = $Adresss->getStreetNumber();
				$profileArray['city'] = $Adresss->getCityName();
				$profileArray['suburb'] = $Adresss->getSuburbName();
			}else{
				$profileArray['address'] =  "";
				$profileArray['complex'] = "";
				$profileArray['latitude'] = "";
				$profileArray['longitude'] = "";
				$profileArray['province'] = "";
				$profileArray['street_name'] = "";
				$profileArray['street_number'] = "";
				$profileArray['city'] = "";
				$profileArray['suburb'] = "";
			}
				
		}

		//print json_encode ( $profileArray );
		$response['status'] = 1;
		$response['message'] = $profileArray;
		echo json_encode($response);
	} catch (Exception $e) {
		$response['status'] = 2;
		$response['message'] = $e->getMessage();
		echo json_encode($response);
	}

}



function getPartnerImages($entityManager){
	try {
		session_start ();
	} catch (Exception $e) {
	}

	try {
		$result  = array();
		$user = $entityManager->getRepository('User')->findOneBy(array('userId' => $_GET ['getPartnerImages']));
		$partnerImages = $entityManager->getRepository('PartnerImages')->findBy(array('user' => $user,'active'=>1));
		if($partnerImages){
			foreach ($partnerImages as &$file) {
				$obj['name'] = $file->getImageName();
				echo '<div class="slide1"><img src="images/partner_gallery/' . $file->getImageName() . '" alt="" /></div>';
			}
		}else{
			echo "failed to get images";
		}

	} catch (Exception $e) {
		$response['status'] = 2;
		$response['message'] = $e->getMessage();
		echo json_encode($response);
	}

}




?>