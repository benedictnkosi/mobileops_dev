<?php
require_once (__DIR__ . '/../../../bootstrap.php');
require_once (__DIR__ . '/../../../app/application.php');

require_once (__DIR__ . '/../Entity/User.php');
require_once (__DIR__ . '/../Entity/LuAccountStatus.php');
require_once (__DIR__ . '/../Entity/UserMobility.php');
require_once (__DIR__ . '/../Entity/LuMobility.php');
require_once (__DIR__ . '/../Entity/LuUserRole.php');
require_once (__DIR__ . '/../Entity/UserProfile.php');
require_once (__DIR__ . '/../Entity/Address.php');
require_once (__DIR__ . '/../Entity/UserUserService.php');
require_once (__DIR__ . '/../Entity/LuService.php');
require_once (__DIR__ . '/../Entity/LuServiceType.php');
require_once (__DIR__ . '/../Entity/PartnerImages.php');
require_once ('controller_partner_services.php');

require_once ('controller_lookup.php');
require_once (__DIR__ . '/../Logic/Login.php');

$login = new Login ($entityManager);
$login->isUserLoggedIn ($entityManager);

if (isset ( $_POST ['savePartnerPersonalDetails'] )) {
	if ($_POST ['savePartnerPersonalDetails']) :
		savePartnerPersonalDetails ( $entityManager );
	
   endif;
}

if (isset ( $_POST ['saveServices'] )) {
	if ($_POST ['saveServices']) :
	saveServices ( $entityManager );

	endif;
}


if (isset ( $_POST ['saveServicesPrices'] )) {
	if ($_POST ['saveServicesPrices']) :

	saveServicesPrices ( $entityManager );
	endif;
}






if (isset ( $_GET ['getServicesWithPrices'] )) {
	if ($_GET ['getServicesWithPrices']) :

	getServicesWithPrices ( $entityManager );
	endif;
}


if (isset ( $_GET ['getPartnerAddress'] )) {
	if ($_GET ['getPartnerAddress']) :
	getPartnerAddress ( $entityManager );

	endif;
}


if (isset ( $_GET ['getPartnerServices'] )) {
	if ($_GET ['getPartnerServices']) :
	
		getActivePartnerServices ( $entityManager );
	
   endif;
}

if (isset ( $_GET ['getPartnerProfile'] )) {
	if ($_GET ['getPartnerProfile']) :
		getPartnerProfile ( $entityManager );
	
   endif;
}

if (isset ( $_GET ['getPartnerPersonalNote'] )) {
	if ($_GET ['getPartnerPersonalNote']) :
		getPartnerPersonalNote ( $entityManager );
	
   endif;
}

if (isset ( $_GET ['deleteimage'] )) {
	if ($_GET ['deleteimage']) :
		deleteImages ( $entityManager );
	

   endif;
}

if (isset ( $_GET ['getPartnerImages'] )) {
	if ($_GET ['getPartnerImages']) :
		getPartnerImages ( $entityManager );
	

   endif;
}
function deleteImages($entityManager) {
	try {
		$userDir = __DIR__ . '/../../../web/images/partner_gallery/';
		$image = $userDir . $_GET ['deleteimage'];
		if (! unlink ( str_replace ( "thumb_", "", $image ) )) {
			$response ['status'] = 2;
			$response ['message'] = 'delete file failed';
			echo json_encode ( $response );
			return;
		}
		
		$image = $userDir . $_GET ['deleteimage'];
		if (! unlink ( $image )) {
			$response ['status'] = 2;
			$response ['message'] = 'delete file failed';
			echo json_encode ( $response );
			return;
		}
		
		// delete from db
		$dbImageName = str_replace ( "thumb_", "", $_GET ['deleteimage'] );
		echo $dbImageName;
		$partnerImage = $entityManager->getRepository ( 'PartnerImages' )->findOneBy ( array (
				'imageName' => $dbImageName 
		) );
		if ($partnerImage) {
			$partnerImage->setActive ( 0 );
			$entityManager->persist ( $partnerImage );
			$entityManager->flush ();
			
			$response ['status'] = 1;
			$response ['message'] = "delete file successfully";
			echo json_encode ( $response );
		} else {
			$response ['status'] = 2;
			$response ['message'] = 'delete file failed';
			echo json_encode ( $response );
		}
	} catch ( Exception $e ) {
		$response ['status'] = 2;
		$response ['message'] = $e->getMessage ();
		echo json_encode ( $response );
	}
}


function savePartnerPersonalDetails($entityManager) {
	try {
		//session_start ();
	} catch ( Exception $e ) {
	}
	try {
		
		$name = $_POST ['firstname'];
		$surname = $_POST ['surname'];
		$email = $_SESSION ['email_address'];
		$phone_number = $_POST ['mobile_number'];
		$complex = $_POST ['complex'];
		$latitude = $_POST ['lat'];
		$longitude = $_POST ['lng'];
		$province = $_POST ['administrative_area_level_1'];
		$street_name = $_POST ['route'];
		$street_number = $_POST ['street_number'];
		$suburb = $_POST ['sublocality'];
		$city = $_POST ['locality'];
		
		$bookingNotes = $_POST ['personalNote'];
		
		$user = $entityManager->getRepository ( 'User' )->findOneBy ( array (
				'emailAddress' => $_SESSION ['email_address'] 
		) );
		if ($user) {
			$date = new DateTime ();
			$UserProfile = $user->getUserProfile ();
			
			$Address = $UserProfile->getAddress ();
			$Address->setStreetName ( $street_name );
			$Address->setStreetNumber ( $street_number );
			$Address->setCityName ( $city );
			$Address->setSuburbName ( $suburb );
			$Address->setProvinceName ( $province );
			$Address->setLatitude ( $latitude );
			$Address->setLongitude ( $longitude );
			$Address->setComplexName ( $complex );
			$Address->setDateAdded ( $date );
			
			$UserProfile->setAddress ( $Address );
			$UserProfile->setFirstName ( $name );
			$UserProfile->setSurname ( $surname );
			$UserProfile->setPhoneNumber ( $phone_number );
			
			$UserProfile->setDateCreated ( $date );
			$UserProfile->setPersonalNote ( $bookingNotes );
			
			$user->setUserProfile ( $UserProfile );
			
			
			$mobility = getPartnerMobility ( $entityManager, $user->getEmailAddress () );
			
			if (! $mobility) {
				
				createPartnerMobilityStatus ( $entityManager, $user->getEmailAddress (), $_POST ['mobility'] );
			} else {
				
				updateMobilityStatus ( $entityManager, $mobility->getUserMobilityId (), false );
				createPartnerMobilityStatus ( $entityManager, $user->getEmailAddress (), $_POST ['mobility'] );
			}
			$entityManager->persist ( $Address );
			$entityManager->persist ( $UserProfile );
			$entityManager->persist ( $user );
			
			$entityManager->flush ();
			
			$response ['status'] = 1;
			$response ['message'] = "Successfully updated personal details";
			echo json_encode ( $response );
		} else {
			$response ['status'] = 2;
			$response ['message'] = "User with email " . $_SESSION ['email_address'] . " not found. Please email administrator @ " . SYSTEM_EMAIL_ADDRESS;
			echo json_encode ( $response );
		}
	} catch ( Exception $e ) {
		$response ['status'] = 2;
		$response ['message'] = $e->getMessage ();
		echo json_encode ( $response );
	}
}


function getServicesWithPrices($entityManager) {


	try {
		$user = $entityManager->getRepository ( 'User' )->findOneBy ( array (
				'emailAddress' => $_SESSION ['email_address'] 
		) );
		$UserProfile = $user->getUserProfile ();
		$UserProfileID = $UserProfile->getUserProfileId ();
		
		$PartnerServices = getPartnerServicesOrderByServiceType($entityManager,$UserProfileID);
		
		$ServicesArray = array ();
		$allServicesArray = array ();
		// partner services will be stored on the session as a single dimensional array
		$ServicesNameArray = array ();
		$serviceTypeName = "";
		$i = 0;
		$j = 0;
		
		
		foreach ( $PartnerServices as &$value ) {
			$tempArray = array ();
			$LuService = $entityManager->getRepository ( 'LuService' )->findOneBy ( array (
					'name' => $value->getService ()->getName () 
			) );
			
			
			if ((strcmp ( $serviceTypeName, $LuService->getServiceTypeName ()->getName () ) !== 0) && $i !== 0) {
				array_push ( $allServicesArray, $ServicesArray );
				$ServicesArray = array ();
				$j = 0;
			}
			
			$serviceTypeName = $LuService->getServiceTypeName ()->getName ();
			array_push ( $tempArray, $LuService->getServiceTypeName ()->getName () );
			array_push ( $tempArray, $value->getService ()->getName () );
			
			//get service price
			$partnerServicePrice = getPartnerServicePriceByPartnerServiceId($entityManager,$value->getPartnerServiceId());
			if($partnerServicePrice){
				array_push ( $tempArray, 'R' . number_format ( $partnerServicePrice->getAmount(), 2 ) );
				
			}else{
				array_push ( $tempArray, 'R0.00');
				
			}
			array_push ( $tempArray, $value->getPartnerServiceId() );
			
			// multi dimensional array with service name and service type
			array_push ( $ServicesArray, $tempArray );
			$i ++;
			$j ++;
		}
		
		array_push ( $allServicesArray, $ServicesArray );
			
		// sort by service type name
		//array_multisort ( $allServicesArray, SORT_ASC );
		// print json_encode ( $ServicesArray );
		
		$response ['status'] = 1;
		$response ['message'] = $allServicesArray;
		echo json_encode ( $response );
	} catch ( Exception $e ) {
		$response ['status'] = 2;
		$response ['message'] = $e->getMessage ();
		echo json_encode ( $response );
	}
}

function getActivePartnerServices($entityManager) {
	
	try {
		$user = $entityManager->getRepository ( 'User' )->findOneBy ( array (
				'emailAddress' => $_SESSION ['email_address'] 
		) );
		$UserProfile = $user->getUserProfile ();
		$UserProfileID = $UserProfile->getUserProfileId ();
		
		$PartnerServices = getPartnerServices($entityManager,$UserProfileID);
		
		$ServicesArray = array ();
		// partner services will be stored on the session as a single dimensional array
		$ServicesNameArray = array ();
		
		foreach ( $PartnerServices as &$value ) {
			$tempArray = array ();
			$LuService = $entityManager->getRepository ( 'LuService' )->findOneBy ( array (
					'name' => $value->getService ()->getName () 
			) );
			
			array_push ( $tempArray, $LuService->getServiceTypeName ()->getName () );
			array_push ( $tempArray, $value->getService ()->getName () );
			array_push ( $ServicesNameArray, $value->getService ()->getName () );
			// multi dimensional array with service name and service type
			array_push ( $ServicesArray, $tempArray );
		}
		// sort by service type name
		array_multisort ( $ServicesArray, SORT_ASC );
		$_SESSION ['partner_services'] = $ServicesNameArray;
		// print json_encode ( $ServicesArray );
		
		$response ['status'] = 1;
		$response ['message'] = $ServicesArray;
		echo json_encode ( $response );
	} catch ( Exception $e ) {
		$response ['status'] = 2;
		$response ['message'] = $e->getMessage ();
		echo json_encode ( $response );
	}
}


function updatepartnerServiceOnSession($entityManager) {

	try {
		$user = $entityManager->getRepository ( 'User' )->findOneBy ( array (
				'emailAddress' => $_SESSION ['email_address']
		) );
		$UserProfile = $user->getUserProfile ();
		$UserProfileID = $UserProfile->getUserProfileId ();

		$PartnerServices = getPartnerServices($entityManager,$UserProfileID);

		$ServicesArray = array ();
		// partner services will be stored on the session as a single dimensional array
		$ServicesNameArray = array ();

		foreach ( $PartnerServices as &$value ) {
			$tempArray = array ();
			$LuService = $entityManager->getRepository ( 'LuService' )->findOneBy ( array (
					'name' => $value->getService ()->getName ()
			) );
				
			array_push ( $tempArray, $LuService->getServiceTypeName ()->getName () );
			array_push ( $tempArray, $value->getService ()->getName () );
			array_push ( $ServicesNameArray, $value->getService ()->getName () );
			// multi dimensional array with service name and service type
			array_push ( $ServicesArray, $tempArray );
		}
		// sort by service type name
		array_multisort ( $ServicesArray, SORT_ASC );
		$_SESSION ['partner_services'] = $ServicesNameArray;
		// print json_encode ( $ServicesArray );

		return $ServicesArray;
	} catch ( Exception $e ) {
		$response ['status'] = 2;
		$response ['message'] = $e->getMessage ();
		echo json_encode ( $response );
	}
}

function getPartnerProfile($entityManager) {
	try {
		//session_start ();
	} catch ( Exception $e ) {
	}
	
	try {
		$profileArray = array ();
		
		$user = $entityManager->getRepository ( 'User' )->findOneBy ( array (
				'emailAddress' => $_SESSION ['email_address'] 
		) );
		
		if ($user) {
			$UserProfile = $user->getUserProfile ();
			
			$profileArray ['name'] = $UserProfile->getFirstName ();
			$profileArray ['surname'] = $UserProfile->getSurname ();
			
			$profileArray ['personalNote'] = $UserProfile->getPersonalNote ();
			$profileArray ['email'] = $user->getEmailAddress ();
			$profileArray ['mobile_number'] = $UserProfile->getPhoneNumber ();
			
			$userMobility = getPartnerMobility ( $entityManager, $user->getEmailAddress () );
			
			if ($userMobility) {
				$profileArray ['mobility'] = $userMobility->getUserMobility ();
			}
			
			$Adresss = $UserProfile->getAddress ();
			if ($Adresss) {
				$profileArray ['address'] = $Adresss->getStreetNumber () . " " . $Adresss->getStreetName () . ", " . $Adresss->getCityName () . ", " . COUNTRY;
				$profileArray ['complex'] = $Adresss->getComplexName ();
				$profileArray ['latitude'] = $Adresss->getLatitude ();
				$profileArray ['longitude'] = $Adresss->getLongitude ();
				$profileArray ['province'] = $Adresss->getProvinceName ();
				$profileArray ['street_name'] = $Adresss->getStreetName ();
				$profileArray ['street_number'] = $Adresss->getStreetNumber ();
				$profileArray ['city'] = $Adresss->getCityName ();
				$profileArray ['suburb'] = $Adresss->getSuburbName ();
			} else {
				$profileArray ['address'] = "";
				$profileArray ['complex'] = "";
				$profileArray ['latitude'] = "";
				$profileArray ['longitude'] = "";
				$profileArray ['province'] = "";
				$profileArray ['street_name'] = "";
				$profileArray ['street_number'] = "";
				$profileArray ['city'] = "";
				$profileArray ['suburb'] = "";
			}
		}
		
		// print json_encode ( $profileArray );
		$response ['status'] = 1;
		$response ['message'] = $profileArray;
		
		echo json_encode ( $response );
	} catch ( Exception $e ) {
		$response ['status'] = 2;
		$response ['message'] = $e->getMessage ();
		echo json_encode ( $response );
	}
}
function getPartnerAddress($entityManager) {
	try {
		//session_start ();
	} catch ( Exception $e ) {
	}
	
	try {
		$profileArray = array ();
		
		$user = $entityManager->getRepository ( 'User' )->findOneBy ( array (
				'userId' => $_GET ['getPartnerAddress'] 
		) );
		
		if ($user) {
			$Address = $user->getUserProfile ()->getAddress ();
			
			
			if ($Address) {
				$AddressString = $Address->getComplexName () . ', ' . $Address->getStreetNumber () . " " . $Address->getStreetName () . ", " .  $Address->getCityName ();
				$response ['status'] = 1;
				$response ['message'] = $AddressString;
				
				echo json_encode ( $response );
			} else {
				$response ['status'] = 2;
				$response ['message'] = $e->getMessage ();
				echo json_encode ( $response );
			}
		}
		
		// print json_encode ( $profileArray );
	} catch ( Exception $e ) {
		$response ['status'] = 2;
		$response ['message'] = $e->getMessage ();
		echo json_encode ( $response );
	}
}
function getPartnerPersonalNote($entityManager) {
	try {
		//session_start ();
	} catch ( Exception $e ) {
	}
	
	try {
		$profileArray = array ();
		
		$user = $entityManager->getRepository ( 'User' )->findOneBy ( array (
				'userId' => $_GET ['getPartnerPersonalNote'] 
		) );
		if ($user) {
			$UserProfile = $user->getUserProfile ();
			
			$profileArray ['name'] = $UserProfile->getFirstName ();
			$profileArray ['surname'] = $UserProfile->getSurname ();
			
			$profileArray ['personalNote'] = $UserProfile->getPersonalNote ();
		}
		
		// print json_encode ( $profileArray );
		$response ['status'] = 1;
		$response ['message'] = $profileArray;
		echo json_encode ( $response );
	} catch ( Exception $e ) {
		$response ['status'] = 2;
		$response ['message'] = $e->getMessage ();
		echo json_encode ( $response );
	}
}
function getPartnerImages($entityManager) {
	try {
		//session_start ();
	} catch ( Exception $e ) {
	}
	
	try {
		$result = array ();
		$user = $entityManager->getRepository ( 'User' )->findOneBy ( array (
				'userId' => $_GET ['getPartnerImages'] 
		) );
		$partnerImages = $entityManager->getRepository ( 'PartnerImages' )->findBy ( array (
				'user' => $user,
				'active' => 1 
		) );
		if ($partnerImages) {
			foreach ( $partnerImages as &$file ) {
				$obj ['name'] = $file->getImageName ();
				echo '<div class="slide1"><img src="web/images/partner_gallery/' . $file->getImageName () . '" alt="" /></div>';
			}
		} else {
			echo "failed to get images";
		}
	} catch ( Exception $e ) {
		$response ['status'] = 2;
		$response ['message'] = $e->getMessage ();
		echo json_encode ( $response );
	}
}
function getPartnerProfileByEmail($entityManager, $emailAddress) {
	try {
		
		$user = $entityManager->getRepository ( 'User' )->findOneBy ( array (
				'emailAddress' => $emailAddress 
		) );
		$userProfile = $user->getUserProfile ();
		
		return $userProfile;
	} catch ( Exception $e ) {
		echo "" . $e->getTraceAsString ();
	}
	
	return NULL;
}
function getPartnerMobility($entityManager, $emailAddress) {
	try {
		
		$userProfile = getPartnerProfileByEmail ( $entityManager, $emailAddress );
		
		if ($userProfile != NULL)
			$userMobility = $entityManager->getRepository ( 'UserMobility' )->findOneBy ( array (
					'userProfile' => $userProfile,
					'active' => true 
			) );
		
		return $userMobility;
	} catch ( Exception $e ) {
		echo "" . $e->getTraceAsString ();
	}
	
	return NULL;
}

function getPartnerMobilityById($entityManager, $userMobilityId) {
	try {
		return $entityManager->getRepository ( 'UserMobility' )->findOneBy ( array (
				'userMobilityId' => $userMobilityId 
		) );
	} catch ( Exception $e ) {
		echo "" . $e->getTraceAsString ();
	}
	return NULL;
}

function updateMobilityStatus($entityManager, $userMobilityId, $boolStatus) {
	try {
		
		$userMobility = getPartnerMobilityById ( $entityManager, $userMobilityId );
		
		if ($userMobility != NULL) {
			
			$userMobility->setActive ( $boolStatus );
			$userMobility->setDateAdded ( new DateTime () );
			$entityManager->persist ( $userMobility );
			$entityManager->flush ();
		}
		
		return "SUCCESS";
	} catch ( Exception $e ) {
		echo "" . $e->getTraceAsString ();
	}
	
	return "FAIL";
}
function createPartnerMobilityStatus($entityManager, $emailAddress, $userMobility) {
	$userMobilityLookup = getActiveLookupByName ( $entityManager, "LuMobility", $userMobility );
	$userProfile = getPartnerProfileByEmail ( $entityManager, $emailAddress );
	
	if ($userMobilityLookup != NULL && $userProfile != NULL) {
		
		$userMobility = new UserMobility ();
		
		$userMobility->setDateAdded ( new DateTime () );
		$userMobility->setActive ( true );
		$userMobility->setUserMobility ( $userMobilityLookup->getName () );
		$userMobility->setUserProfile ( $userProfile );
		
		$entityManager->persist ( $userMobility );
		$entityManager->flush ();
		
		return $userMobility;
	} else {
		return NULL;
	}
}


function saveServices($entityManager) {
	try {
		$ServicesArray = array ();
		$date = new DateTime ();
		//session_start ();
		$newServicesArray = json_decode ( stripslashes ( $_POST ['saveServices'] ) );
		$partner_services = $_SESSION ['partner_services'];

		$AddedServicesArray = array_diff ( $newServicesArray, $partner_services );
		$RemovedServicesArray = array_diff ( $partner_services, $newServicesArray );

		$user = $entityManager->getRepository ( 'User' )->findOneBy ( array (
				'emailAddress' => $_SESSION ['email_address']
		) );
		$UserProfile = $user->getUserProfile ();

		if (count ( $AddedServicesArray ) > 0) {
			foreach ( $AddedServicesArray as &$value ) {
				addPartnerService($entityManager,$value,$UserProfile->getUserProfileId ());
			}
			$entityManager->flush ();
			$ServicesArray = updatepartnerServiceOnSession ( $entityManager );
		}

		if (count ( $RemovedServicesArray ) > 0) {
			foreach ( $RemovedServicesArray as &$value ) {
				changePartnerServiceStatus($entityManager,$partnerServiceId,$newBoolStatus);
				$LuService = $entityManager->getRepository ( 'LuService' )->findOneBy ( array (
						'name' => $value
				) );
				$UserUserService = $entityManager->getRepository ( 'UserUserService' )->findOneBy ( array (
						'userUserServiceName' => $LuService
				) );
				$UserUserService->setActive ( false );
				$entityManager->persist ( $UserUserService );
			}
			$entityManager->flush ();
			$ServicesArray = updatepartnerServiceOnSession ( $entityManager );
		}

		if (count ( $ServicesArray ) < 1) {
			$response ['status'] = 2;
			$response ['services'] = $ServicesArray;
			$response ['message'] = "No changes detected";
		} else {
			$response ['status'] = 1;
			$response ['services'] = $ServicesArray;
			$response ['message'] = "Services updated successfuliy";
		}

		echo json_encode ( $response );
	} catch ( Exception $e ) {
		$response ['status'] = 2;
		$response ['message'] = $e->getMessage ();
		echo json_encode ( $response );
	}
}


function saveServicesPrices($entityManager) {
	try {
		$ServicesPriceArray = $_POST ['saveServicesPrices'];
		foreach ( $ServicesPriceArray as &$ServicesPrice ) {
			
			addPartnerServicePriceByPartnerServiceId($entityManager,$ServicesPrice["price"],$ServicesPrice["id"]);
		}

		$response ['status'] = 1;
		$response ['message'] = "Successfully updated service prices";
		echo json_encode ( $response );
	} catch ( Exception $e ) {
		$response ['status'] = 2;
		$response ['message'] = $e->getMessage ();
		echo json_encode ( $response );
	}
}


?>