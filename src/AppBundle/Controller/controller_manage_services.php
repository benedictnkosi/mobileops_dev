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
require_once(__DIR__.'/../Entity/RegionService.php');
require_once(__DIR__.'/../Entity/Address.php');
require_once(__DIR__.'/../Controller/controller_lookup.php');




if (isset ( $_POST ['saveRegionServices'] )) {
	if ($_POST ['saveRegionServices']) :
	saveRegionServices($entityManager);
	endif;
}


if (isset ( $_GET ['getAllServicesForRegion'] )) {
	if ($_GET ['getAllServicesForRegion']) :
	getAllServicesForRegion($entityManager);
	endif;
}

if (isset ( $_GET ['getAllServiceTypes'] )) {
	if ($_GET ['getAllServiceTypes']) :
	getAllServiceTypes($entityManager);
	endif;
}


if (isset ( $_GET ['getAllActiveServiceTypes'] )) {
	if ($_GET ['getAllActiveServiceTypes']) :
	getAllActiveServiceTypes($entityManager);
	endif;
}

if (isset ( $_GET ['getActiveServices'] )) {
	if ($_GET ['getActiveServices']) :
	getActiveServices($entityManager);
	endif;
}
if (isset ( $_GET ['getAllActiveRegions'] )) {
	if ($_GET ['getAllActiveRegions']) :
	getAllActiveRegions($entityManager);
	endif;
}


function getActiveServices($entityManager){
	try {
		session_start ();
	} catch (Exception $e) {
	}

	try {
		$luAllService = getAllLookupsByClass ( $entityManager, 'LuService' );
		$ServicesArray = array ();
		foreach ($luAllService as &$value) {
			$tempArray = array ();
			array_push ( $tempArray, $value->getServiceTypeName()->getName());
			array_push ( $tempArray, $value->getName());
			array_push ( $tempArray, $value->getActive());
			
			//multi dimensional array with service name and service type
			array_push($ServicesArray, $tempArray);
		}
		//sort by service type name
		array_multisort($ServicesArray, SORT_ASC);
		
		$response['status'] = 1;
		$response['message'] = $ServicesArray;
		echo json_encode($response);
	} catch (Exception $e) {
		$response['status'] = 2;
		$response['message'] = $e->getMessage();
		echo json_encode($response);
	}

}



//get all services ordered by service type
function getAllServiceTypes($entityManager){
	try{
		$luAllServiceTypes = getAllLookupsByClass ( $entityManager, 'LuServiceType' );
		
		$ServicesArray = array ();
		foreach ($luAllServiceTypes as &$value) {
			$tempArray = array ();
			array_push ( $tempArray, $value->getName());
			array_push ( $tempArray, $value->getActive());
			//multi dimensional array with service name and service type
			array_push($ServicesArray, $tempArray);
		}
		
		
		$response['status'] = 1;
		$response['message'] = $ServicesArray;
		echo json_encode($response);
	}catch (Exception $e) {
		$response['status'] = 2;
		$response['message'] = $e->getMessage();
		echo json_encode($response);
	}
}


function getAllActiveServiceTypes($entityManager){
	try{
		$luActiveServiceTypes = getAllActiveLookupsNamesByClass ( $entityManager, 'LuServiceType' );

		$response['status'] = 1;
		$response['activeServiceTypes'] = $luActiveServiceTypes;
		echo json_encode($response);
	}catch (Exception $e) {
		$response['status'] = 2;
		$response['message'] = $e->getMessage();
		echo json_encode($response);
	}
}


function getAllActiveRegions($entityManager){
	try{
		$luActiveRegions = getAllActiveLookupsNamesByClass ( $entityManager, 'LuRegion' );

		$response['status'] = 1;
		$response['activeRegions'] = $luActiveRegions;
		echo json_encode($response);
	}catch (Exception $e) {
		$response['status'] = 2;
		$response['message'] = $e->getMessage();
		echo json_encode($response);
	}
}

//get all services ordered by service type
function getAllServicesForRegion($entityManager){
	try {
		session_start ();
	} catch (Exception $e) {
	}
	
	try{
		$region = $entityManager->getRepository('LuRegion')->findOneBy(array('name' => $_GET ['getAllServicesForRegion']));
		$regionServices  = $entityManager->getRepository('RegionService')->findBy(array('region' => $region));
		
		$ServicesArray = array ();
		$Session_ServicesArray = array ();
		foreach ($regionServices as &$value) {
			$tempArray = array ();
			array_push ( $tempArray, $value->getService()->getServiceTypeName()->getName());
			array_push ( $tempArray, $value->getService()->getName());
			array_push ( $tempArray, $value->getActive());
			//multi dimensional array with service name and service type
			
			if($value->getActive() == true){
				array_push ( $Session_ServicesArray, $value->getService()->getName());
			}
			array_push($ServicesArray, $tempArray);
		}

		$_SESSION['ServicesArray'] = $Session_ServicesArray;
		array_multisort($ServicesArray, SORT_ASC);
		
		$response['status'] = 1;
		$response['message'] = $ServicesArray;
		echo json_encode($response);
	}catch (Exception $e) {
		$response['status'] = 2;
		$response['message'] = $e->getMessage();
		echo json_encode($response);
	}
}



function saveRegionServices($entityManager){
	try{
		$date = new DateTime();
		session_start ();
		$newServicesArray = json_decode(stripslashes($_POST['saveRegionServices']));
		$servicesArray = $_SESSION['ServicesArray'];

		$AddedServicesArray=array_diff($newServicesArray,$servicesArray);
		$RemovedServicesArray=array_diff($servicesArray,$newServicesArray);


		if(count($AddedServicesArray) > 0){
			foreach ($AddedServicesArray as &$value) {
				//$LuService = $entityManager->getRepository('LuService')->findOneBy(array('name' =>$value ));
				echo "Added : " . $value;

			}
		}

		if(count($RemovedServicesArray) > 0){
			foreach ($RemovedServicesArray as &$value) {
				echo "removed : " . $value;
			}

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



?>


