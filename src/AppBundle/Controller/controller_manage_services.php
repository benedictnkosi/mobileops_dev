<?php
require_once (__DIR__ . '/../../../bootstrap.php');
require_once (__DIR__ . '/../../../app/application.php');

require_once (__DIR__ . '/../Entity/LuService.php');
require_once (__DIR__ . '/../Entity/LuServiceType.php');
require_once (__DIR__ . '/../Entity/UserProfile.php');
require_once (__DIR__ . '/../Entity/User.php');
require_once (__DIR__ . '/../Entity/UserUserService.php');
require_once (__DIR__ . '/../Entity/LuUserRole.php');
require_once (__DIR__ . '/../Entity/LuAccountStatus.php');
require_once (__DIR__ . '/../Entity/RegionService.php');
require_once (__DIR__ . '/../Entity/LuRegion.php');
require_once (__DIR__ . '/../Entity/Address.php');
require_once (__DIR__ . '/../Controller/controller_lookup.php');
require_once (__DIR__ . '/../Entity/RegionServicePrice.php');



if (isset ( $_GET ['getAllServicePricesForRegion'] )) {
	if ($_GET ['getAllServicePricesForRegion']) :
	getAllServicePricesForRegion ( $entityManager );
	endif;
}

if (isset ( $_POST ['saveRegionServices'] )) {
	if ($_POST ['saveRegionServices']) :
		saveRegionServices ( $entityManager );
	
	
	endif;
}


if (isset ( $_POST ['addnewServicePrice'] )) {
	if ($_POST ['addnewServicePrice']) :
	addnewServicePrice ( $entityManager );


	endif;
}

if (isset ( $_POST ['updateRegionServicePrice'] )) {
	if ($_POST ['updateRegionServicePrice']) :
	updateRegionServicePrice ( $entityManager );


	endif;
}


if (isset ( $_POST ['deleteRegionServicePrice'] )) {
	if ($_POST ['deleteRegionServicePrice']) :
	deleteRegionServicePrice ( $entityManager );

	endif;
}


if (isset ( $_GET ['getAllServicesForRegion'] )) {
	if ($_GET ['getAllServicesForRegion']) :
		getAllServicesForRegion ( $entityManager );
	endif;
}




if (isset ( $_GET ['getAllActiveServicesForRegion'] )) {
	if ($_GET ['getAllActiveServicesForRegion']) :
	getAllActiveServicesForRegion ( $entityManager );
	endif;
}


if (isset ( $_GET ['getAllServiceTypes'] )) {
	if ($_GET ['getAllServiceTypes']) :
		getAllServiceTypes ( $entityManager );
	
	
	endif;
}

if (isset ( $_GET ['getAllActiveServiceTypes'] )) {
	if ($_GET ['getAllActiveServiceTypes']) :
		getAllActiveServiceTypes ( $entityManager );
	
	
	endif;
}

if (isset ( $_GET ['getActiveServices'] )) {
	if ($_GET ['getActiveServices']) :
		getActiveServices ( $entityManager );
	
	
	endif;
}

if (isset ( $_GET ['getAllActiveRegions'] )) {
	if ($_GET ['getAllActiveRegions']) :
		getAllActiveRegions ( $entityManager );
	
	
	endif;
}

if (isset ( $_GET ['getAllServices'] )) {
	if ($_GET ['getAllServices']) :
		getAllServices ( $entityManager );
	
	
	endif;
}
function getAllServices($entityManager) {
	try {
		session_start ();
	} catch ( Exception $e ) {
	}
	
	try {
		$luAllService = getAllLookupsByClass ( $entityManager, 'LuService' );
		$ServicesArray = array ();
		foreach ( $luAllService as &$value ) {
			$tempArray = array ();
			array_push ( $tempArray, $value->getServiceTypeName ()->getName () );
			array_push ( $tempArray, $value->getName () );
			array_push ( $tempArray, $value->getActive () );
			
			// multi dimensional array with service name and service type
			array_push ( $ServicesArray, $tempArray );
		}
		// sort by service type name
		array_multisort ( $ServicesArray, SORT_ASC );
		
		$response ['status'] = 1;
		$response ['message'] = $ServicesArray;
		echo json_encode ( $response );
	} catch ( Exception $e ) {
		$response ['status'] = 2;
		$response ['message'] = $e->getMessage ();
		echo json_encode ( $response );
	}
}

// get all services ordered by service type
function getAllServiceTypes($entityManager) {
	try {
		$luAllServiceTypes = getAllLookupsByClass( $entityManager, 'LuServiceType' );
		
		$ServicesArray = array ();
		foreach ( $luAllServiceTypes as &$value ) {
			$tempArray = array ();
			array_push ( $tempArray, $value->getName () );
			array_push ( $tempArray, $value->getActive () );
			// multi dimensional array with service name and service type
			array_push ( $ServicesArray, $tempArray );
		}
		
		$response ['status'] = 1;
		$response ['message'] = $ServicesArray;
		echo json_encode ( $response );
	} catch ( Exception $e ) {
		$response ['status'] = 2;
		$response ['message'] = $e->getMessage ();
		echo json_encode ( $response );
	}
}


function getAllActiveServiceTypes($entityManager) {
	try {
		$luActiveServiceTypes = getAllActiveLookupsNamesByClass ( $entityManager, 'LuServiceType' );
		
		$response ['status'] = 1;
		$response ['activeServiceTypes'] = $luActiveServiceTypes;
		echo json_encode ( $response );
	} catch ( Exception $e ) {
		$response ['status'] = 2;
		$response ['message'] = $e->getMessage ();
		echo json_encode ( $response );
	}
}
function getAllActiveRegions($entityManager) {
	try {
		$luActiveRegions = getAllActiveLookupsNamesByClass ( $entityManager, 'LuRegion' );
		
		$response ['status'] = 1;
		$response ['activeRegions'] = $luActiveRegions;
		echo json_encode ( $response );
	} catch ( Exception $e ) {
		$response ['status'] = 2;
		$response ['message'] = $e->getMessage ();
		echo json_encode ( $response );
	}
}

// get all services ordered by service type
function getAllServicesForRegion($entityManager) {
	try {
		session_start ();
	} catch ( Exception $e ) {
	}
	
	try {
		$region = $entityManager->getRepository ( 'LuRegion' )->findOneBy ( array (
				'name' => $_GET ['getAllServicesForRegion'] 
		) );
		$luService = $entityManager->getRepository ( 'LuService' )->findBy ( array (
				'active' => 1 
		) );
		
		$ServicesArray = array ();
		$Session_ServicesArray = array ();
		foreach ( $luService as &$value ) {
			$regionService = $entityManager->getRepository ( 'RegionService' )->findBy ( array (
					'region' => $region,
					'service' => $value,
					'active' => 1 
			) );
			$tempArray = array ();
			array_push ( $tempArray, $value->getServiceTypeName ()->getName () );
			array_push ( $tempArray, $value->getName () );
			
			if ($regionService) {
				array_push ( $tempArray, true );
				array_push ( $Session_ServicesArray, $value->getName () );
			} else {
				array_push ( $tempArray, false );
			}
			
			array_push ( $ServicesArray, $tempArray );
		}
		
		$_SESSION ['ServicesArray'] = $Session_ServicesArray;
		array_multisort ( $ServicesArray, SORT_ASC );
		
		$response ['status'] = 1;
		$response ['message'] = $ServicesArray;
		echo json_encode ( $response );
	} catch ( Exception $e ) {
		$response ['status'] = 2;
		$response ['message'] = $e->getMessage ();
		echo json_encode ( $response );
	}
}
function saveRegionServices($entityManager) {
	try {
		$date = new DateTime ();
		session_start ();
		$newServicesArray = json_decode ( stripslashes ( $_POST ['saveRegionServices'] ) );
		$servicesArray = $_SESSION ['ServicesArray'];
		
		$AddedServicesArray = array_diff ( $newServicesArray, $servicesArray );
		$RemovedServicesArray = array_diff ( $servicesArray, $newServicesArray );
		
		if (count ( $AddedServicesArray ) > 0) {
			foreach ( $AddedServicesArray as &$value ) {
				$LuService = $entityManager->getRepository ( 'LuService' )->findOneBy ( array (
						'name' => $value 
				) );
				$LuRegion = $entityManager->getRepository ( 'LuRegion' )->findOneBy ( array (
						'name' => $_POST ['region'] 
				) );
				addRegionServiceObjects ( $entityManager, $LuRegion, $LuService, $_SESSION ['firstname'] );
			}
		}
		
		// print_r($RemovedServicesArray);
		if (count ( $RemovedServicesArray ) > 0) {
			foreach ( $RemovedServicesArray as &$value ) {
				$lookupsArray = getAllActiveLookupsByClass ( $entityManager, 'LuRegion' );
				$region = getActiveLookupByName ( $entityManager, 'LuRegion', $_POST ['region'] );
				$date = new DateTime ();
				
				$regionService = getRegionService ( $entityManager, $_POST ['region'], $value );
				$regionService->setActive ( 0 );
				$entityManager->persist ( $regionService );
				$entityManager->flush ();
			}
		}
		
		updateCachedServicesForRegion ( $entityManager, $_POST ['region'] );
		
		$response ['status'] = 1;
		$response ['message'] = "Services updated successfuliy";
		echo json_encode ( $response );
	} catch ( Exception $e ) {
		$response ['status'] = 2;
		$response ['message'] = $e->getMessage ();
		echo json_encode ( $response );
	}
}

// get all services ordered by service type
function updateCachedServicesForRegion($entityManager, $region) {
	try {
		
		$luService = $entityManager->getRepository ( 'LuService' )->findBy ( array (
				'active' => 1 
		) );
		
		$Session_ServicesArray = array ();
		foreach ( $luService as &$value ) {
			$regionService = $entityManager->getRepository ( 'RegionService' )->findBy ( array (
					'region' => $region,
					'service' => $value,
					'active' => 1 
			) );
			if ($regionService) {
				array_push ( $Session_ServicesArray, $value->getName () );
			}
		}
		
		$_SESSION ['ServicesArray'] = $Session_ServicesArray;
	} catch ( Exception $e ) {
		$response ['status'] = 2;
		$response ['message'] = $e->getMessage ();
		echo json_encode ( $response );
	}
}
function getAllServicePricesForRegion($entityManager) {
	try {
		session_start ();
	} catch ( Exception $e ) {
	}
	
	try {
		$ServicesArray = array ();
		$region = getActiveLookupByName ( $entityManager, 'LuRegion', $_GET ['getAllServicePricesForRegion']);
		$regionServices = $entityManager->getRepository ( 'RegionService' )->findBy ( array (
				'region' => $region,
				'active' => 1
		) );
		
		if($regionServices){
			foreach ( $regionServices as &$value ) {
				$tempArray = array ();
				
				$regionServicePrice = $entityManager->getRepository('RegionServicePrice')->findOneBy(array('regionService' => $value, 'active' => 1));
				
				if($regionServicePrice){
					array_push ( $tempArray, $regionServicePrice->getRegionService()->getService()->getServiceTypeName()->getName());
					array_push ( $tempArray, $regionServicePrice->getRegionService()->getService()->getName() );
					array_push ( $tempArray, $regionServicePrice->getAmount());
					array_push ( $tempArray, $regionServicePrice->getRegionServicePriceId());
					array_push ( $ServicesArray, $tempArray );
				}else{
					
				}
				
			}
		}else{
			$response ['status'] = 2;
			$response ['message'] = "No service prices for region found";
			echo json_encode ( $response );
		}
		array_multisort ( $ServicesArray, SORT_ASC );
		
		$response ['status'] = 1;
		$response ['message'] = $ServicesArray;
		echo json_encode ( $response );
	} catch ( Exception $e ) {
		$response ['status'] = 2;
		$response ['message'] = $e->getMessage ();
		echo json_encode ( $response );
	}
}

function updateRegionServicePrice($entityManager) {
	try {
		session_start ();
	} catch ( Exception $e ) {
	}
	
	try {
		//disable existing region service price
		
		updateRegionServicePriceStatus($entityManager,$_POST ['updateRegionServicePrice'],0);
		
		//add new region service price
		$regionServicePrice = getRegionServicePrice($entityManager, $_POST ['updateRegionServicePrice']);
		$regionService      = $regionServicePrice->getRegionService();
		addRegionServicePrice($entityManager,$regionService,$_POST ['price'],$_SESSION ['firstname']);
		
		$response ['status'] = 1;
		$response ['message'] = "Services updated successfuliy";
		echo json_encode ( $response );
	} catch ( Exception $e ) {
		$response ['status'] = 2;
		$response ['message'] = $e->getMessage ();
		echo json_encode ( $response );
	}
}


function deleteRegionServicePrice($entityManager) {
	try {
		session_start ();
	} catch ( Exception $e ) {
	}

	try {
		updateRegionServicePriceStatus($entityManager,$_POST ['deleteRegionServicePrice'],0);
		$response ['status'] = 1;
		$response ['message'] = "Region service price deleted successfuliy";
		echo json_encode ( $response );
	} catch ( Exception $e ) {
		$response ['status'] = 2;
		$response ['message'] = $e->getMessage ();
		echo json_encode ( $response );
	}
}

// get all services ordered by service type
function getAllActiveServicesForRegion($entityManager) {
	try {
		session_start ();
	} catch ( Exception $e ) {
	}

	try {
		$region = $entityManager->getRepository ( 'LuRegion' )->findOneBy ( array (
				'name' => $_GET ['getAllActiveServicesForRegion']
		) );
		
		$regionServices = $entityManager->getRepository('RegionService')->findBy(array('region' => $region,'active' => 1));

		$ServicesArray = array ();
		
		foreach ( $regionServices as &$value ) {
			$tempArray = array ();
			array_push ( $tempArray, $value->getService()->getName ());
			array_push ( $tempArray, $value->getRegionServiceId());
			array_push ( $ServicesArray, $tempArray);
		}

		$response ['status'] = 1;
		$response ['activeServices'] = $ServicesArray;
		echo json_encode ( $response );
	} catch ( Exception $e ) {
		$response ['status'] = 2;
		$response ['message'] = $e->getMessage ();
		echo json_encode ( $response );
	}
}



function addnewServicePrice($entityManager) {
	try {
		session_start ();
	} catch ( Exception $e ) {
	}

	try {
		//add new region service price
		$regionService      = $entityManager->getRepository('RegionService')->findOneBy(array('regionServiceId' => $_POST ['addnewServicePrice'],'active' => 1));
		IF($regionService){
			//check if region service price exist
			$regionServicePrice = $entityManager->getRepository('RegionServicePrice')->findOneBy(array('regionService' => $regionService,'active' => 1));
			if($regionServicePrice){
				$response ['status'] = 2;
				$response ['message'] = "Price already added for this service, please use the update";
				echo json_encode ( $response );
				return;
			}else{
				addRegionServicePrice($entityManager,$regionService,$_POST ['price'],$_SESSION ['firstname']);
			}
			
		}else{
			$response ['status'] = 2;
			$response ['message'] = "Region service not found";
			echo json_encode ( $response );
		}
		

		$response ['status'] = 1;
		$response ['message'] = "Services updated successfuliy";
		echo json_encode ( $response );
	} catch ( Exception $e ) {
		$response ['status'] = 2;
		$response ['message'] = $e->getMessage ();
		echo json_encode ( $response );
	}
}



?>




