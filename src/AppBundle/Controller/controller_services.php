<?php
require_once (__DIR__ . '/../../../bootstrap.php');
require_once (__DIR__ . '/../../../app/application.php');

require_once (__DIR__ . '/../Logic/email_template.php');
require_once (__DIR__ . "/../Logic/mail.php");

require_once (__DIR__ . '/../Entity/LuService.php');
require_once (__DIR__ . '/../Entity/LuServiceType.php');
require_once (__DIR__ . '/../Entity/UserProfile.php');
require_once (__DIR__ . '/../Entity/User.php');
require_once (__DIR__ . '/../Entity/UserUserService.php');
require_once (__DIR__ . '/../Entity/LuUserRole.php');
require_once (__DIR__ . '/../Entity/LuAccountStatus.php');
require_once (__DIR__ . '/../Entity/Address.php');
require_once (__DIR__ . '/../Entity/RequestedService.php');
require_once (__DIR__ . '/../Controller/controller_lookup.php');

if (isset ( $_POST ['request_service'] )) {
	if ($_POST ['request_service']) :
		requestNewService ( $entityManager );
	
	endif;
}


if (isset ( $_GET ['getServicesByServiceType'] )) {
	if ($_GET ['getServicesByServiceType']) :
	getServicesByServiceType ( $entityManager );

	endif;
}



if (isset ( $_GET ['rejectServiceRequest'] )) {
	if ($_GET ['rejectServiceRequest']) :
	rejectServiceRequest ( $entityManager );

	endif;
}


if (isset ( $_GET ['acceptServiceRequest'] )) {
	if ($_GET ['acceptServiceRequest']) :
	acceptServiceRequest ( $entityManager );

	endif;
}


if (isset ( $_GET ['getServiceRequests'] )) {
	if ($_GET ['getServiceRequests']) :
		getServiceRequests ( $entityManager );
	
	endif;
}

if (isset ( $_GET ['getAllServices'] )) {
	if ($_GET ['getAllServices']) :
		getAllServices ( $entityManager );
	
	endif;
}

if (isset ( $_POST ['saveServices'] )) {
	if ($_POST ['saveServices']) :
		saveServices ( $entityManager );
	

	endif;
}

if (isset ( $_GET ['getServiceCategories'] )) {
	if ($_GET ['getServiceCategories']) :
		getServiceCategories ( $entityManager );
	

	endif;
}
function saveServices($entityManager) {
	try {
		$ServicesArray = array ();
		$date = new DateTime ();
		session_start ();
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
				$LuService = $entityManager->getRepository ( 'LuService' )->findOneBy ( array (
						'name' => $value 
				) );
				
				$UserUserService = $entityManager->getRepository ( 'UserUserService' )->findOneBy ( array (
						'userUserServiceName' => $LuService,
						'userUserServiceProfile' => $UserProfile 
				) );
				if ($UserUserService) {
					$UserUserService->setActive ( true );
					$entityManager->persist ( $UserUserService );
				} else {
					$UserUserService = new UserUserService ();
					$UserUserService->setDateAdded ( $date );
					$UserUserService->setUserUserServiceName ( $LuService );
					$UserUserService->setUserUserServiceProfile ( $UserProfile );
					$entityManager->persist ( $UserUserService );
				}
			}
			$entityManager->flush ();
			$ServicesArray = getPartnerServices ( $entityManager );
		}
		
		if (count ( $RemovedServicesArray ) > 0) {
			foreach ( $RemovedServicesArray as &$value ) {
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
			$ServicesArray = getPartnerServices ( $entityManager );
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


// get all services ordered by service type
function getAllServices($entityManager) {
	try {
		$LuService = new LuService ();
		$LuServices = $entityManager->getRepository ( 'LuService' )->findBy ( array (
				'active' => 1 
		), array (
				'serviceTypeName' => 'ASC' 
		) );
		
		$serviceTypeName = "";
		$allServicesArray = array ();
		$ServicesArray = array ();
		$i = 0;
		$j = 0;
		
		foreach ( $LuServices as &$value ) {
			// if service type name has changed add array to $allServicesArray and reset $ServicesArray
			if ((strcmp ( $serviceTypeName, $value->getServiceTypeName ()->getName () ) !== 0) && $i !== 0) {
				array_push ( $allServicesArray, $ServicesArray );
				$ServicesArray = array ();
				$j = 0;
			}
			
			$serviceTypeName = $value->getServiceTypeName ()->getName ();
			// make the first element of the array the service type name
			if ($j == 0) {
				array_push ( $ServicesArray, $serviceTypeName );
			}
			
			array_push ( $ServicesArray, $value->getName () );
			$i ++;
			$j ++;
		}
		
		array_push ( $allServicesArray, $ServicesArray );
		
		$response ['status'] = 1;
		$response ['message'] = $allServicesArray;
		echo json_encode ( $response );
	} catch ( Exception $e ) {
		$response ['status'] = 2;
		$response ['message'] = $e->getMessage ();
		echo json_encode ( $response );
	}
}


function getServicesByServiceType($entityManager) {
	try {
		
		
		$LuServiceType = $entityManager->getRepository ( 'LuServiceType' )->findOneBy ( array (
				'active' => 1, 'name' => $_GET ['getServicesByServiceType']
		));
		
		$LuServices = $entityManager->getRepository ( 'LuService' )->findBy ( array (
				'active' => 1, 'serviceTypeName' => $LuServiceType
		), array (
				'name' => 'ASC'
		) );

		$ServicesArray = array ();

		foreach ( $LuServices as &$value ) {
			array_push ( $ServicesArray, $value->getName () );
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


// get all services ordered by service type
function requestNewService($entityManager) {
	try {
		session_start ();
	} catch ( Exception $e ) {
	}
	
	try {
		// get partner user
		$user = $entityManager->getRepository ( 'User' )->findOneBy ( array (
				'userId' => $_SESSION ['user_id'] 
		) );
		
		$RequestedService = new RequestedService ();
		$RequestedService->setActive (1);
		$RequestedService->setDateRequested ( new DateTime () );
		$RequestedService->setRequestedServiceCategory ( $_POST ['service_category'] );
		$RequestedService->setRequestedServiceDescription ( $_POST ['service_description'] );
		$RequestedService->setRequestedServiceName ( $_POST ['service_name'] );
		$RequestedService->setUserRequested ( $user->getUserProfile () );
		
		$entityManager->persist ( $RequestedService );
		$entityManager->flush ();
		
		if (SendServiceRequestEmail ( $entityManager )) {
			$response ['status'] = 1;
			$response ['message'] = 'Successfully requested new service. We will contact you soon.';
			echo json_encode ( $response );
			return;
		}
		
		$response ['status'] = 2;
		$response ['message'] = 'Failed to request a new service, please try again.';
		echo json_encode ( $response );
	} catch ( Exception $e ) {
		$response ['status'] = 2;
		$response ['message'] = $e->getMessage ();
		echo json_encode ( $response );
	}
}


function acceptServiceRequest($entityManager) {
	try {
		session_start ();
	} catch ( Exception $e ) {
	}

	try {
		// get partner user
		$user = $entityManager->getRepository ( 'User' )->findOneBy ( array (
				'userId' => $_SESSION ['user_id']
		) );
		
		//get the service request
		$RequestedService = $entityManager->getRepository ( 'RequestedService' )->findOneBy ( array (
				'requestedServiceId' => $_GET ['acceptServiceRequest']
		) );
		
		if($RequestedService){
			$RequestedService->setApprovedBy($user->getUserProfile()->getFirstName() . ' ' . $user->getUserProfile()->getSurname());
			$RequestedService->setApprovedStatus(1);
			$RequestedService->setActive(0);
			$entityManager->persist ( $RequestedService );
			$entityManager->flush ();
			
			//get email for partner who requested the service
			$UserRequested = $entityManager->getRepository ( 'User' )->findOneBy ( array (
					'userProfile' => $RequestedService->getUserRequested()
			) );
			
			if($UserRequested){
				if (SendServiceRequestAcceptedEmail ( $entityManager , $RequestedService, $UserRequested->getEmailAddress())) {
					$response ['status'] = 1;
					$response ['message'] = 'Successfully accepted requested service.';
					echo json_encode ( $response );
					return;
				}else{
					$response ['status'] = 2;
					$response ['message'] = 'Failed to accept the service request, please try again.';
					echo json_encode ( $response );
					return;
				}
			}
			
				
			
		}

		$response ['status'] = 2;
		$response ['message'] = 'Failed to accept the service request, please try again.';
		echo json_encode ( $response );
	} catch ( Exception $e ) {
		$response ['status'] = 2;
		$response ['message'] = $e->getMessage ();
		echo json_encode ( $response );
	}
}


function rejectServiceRequest($entityManager) {
	try {
		session_start ();
	} catch ( Exception $e ) {
	}

	try {
		// get partner user
		$user = $entityManager->getRepository ( 'User' )->findOneBy ( array (
				'userId' => $_SESSION ['user_id']
		) );

		//get the service request
		$RequestedService = $entityManager->getRepository ( 'RequestedService' )->findOneBy ( array (
				'requestedServiceId' => $_GET ['rejectServiceRequest']
		) );

		if($RequestedService){
			$RequestedService->setApprovedBy($user->getUserProfile()->getFirstName() . ' ' . $user->getUserProfile()->getSurname());
			$RequestedService->setActive(0);
			$entityManager->persist ( $RequestedService );
			$entityManager->flush ();
				
			//get email for partner who requested the service
			$UserRequested = $entityManager->getRepository ( 'User' )->findOneBy ( array (
					'userProfile' => $RequestedService->getUserRequested()
			) );
				
			if($UserRequested){
				if (SendServiceRequestRejectedEmail ( $entityManager , $RequestedService, $UserRequested->getEmailAddress())) {
					$response ['status'] = 1;
					$response ['message'] = 'Successfully rejected requested service.';
					echo json_encode ( $response );
					return;
				}
			}
				

				
		}

		$response ['status'] = 2;
		$response ['message'] = 'Failed to reject the service request, please try again.';
		echo json_encode ( $response );
	} catch ( Exception $e ) {
		$response ['status'] = 2;
		$response ['message'] = $e->getMessage ();
		echo json_encode ( $response );
	}
}


// send email to user for password with link/url
function SendServiceRequestEmail($entityManager) {
	try {
		
		$Parameters = array (
				"service_name" => $_POST ['service_name'],
				"service_category" => $_POST ['service_category'] 
		);
		
		$body = generate_email_body ( "new_service_requested", $Parameters );
		
		$body = wordwrap ( $body, 70 );
		
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: ' . SYSTEM_EMAIL_ADDRESS . "\r\n";
		
		$headers .= 'X-Mailer: PHP/' . phpversion () . "\r\n";
		
		if (mail ( SYSTEM_EMAIL_ADDRESS, "MobileOps - New Service Requested", $body, $headers )) {
			return true;
		} else {
			return false;
		}
	} catch ( Exception $e ) {
		return false;
	}
}


// send email to user for password with link/url
function SendServiceRequestAcceptedEmail($entityManager, $RequestedService, $PartnerEmail) {
	try {
		

		$Parameters = array (
				"service_name" => $RequestedService->getRequestedServiceName(),
				"service_category" => $RequestedService->getRequestedServiceCategory(),
				"partner_name" => $RequestedService->getUserRequested()->getFirstName(),
				"partner_surname" => $RequestedService->getUserRequested()->getSurname()
		);

		$body = generate_email_body ( "new_service_accepted", $Parameters );

		$body = wordwrap ( $body, 70 );

		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: ' . SYSTEM_EMAIL_ADDRESS . "\r\n";

		$headers .= 'X-Mailer: PHP/' . phpversion () . "\r\n";

		if (mail ( $PartnerEmail, "MobileOps - New Service Requested", $body, $headers )) {
			return true;
		} else {
			return false;
		}
	} catch ( Exception $e ) {
		return false;
	}
}


function SendServiceRequestRejectedEmail($entityManager, $RequestedService, $PartnerEmail) {
	try {


		$Parameters = array (
				"service_name" => $RequestedService->getRequestedServiceName(),
				"service_category" => $RequestedService->getRequestedServiceCategory(),
				"partner_name" => $RequestedService->getUserRequested()->getFirstName(),
				"partner_surname" => $RequestedService->getUserRequested()->getSurname(),
				"existing_service_category" => $_GET['service_category'] ,
				"existing_service_name" => $_GET['service_name']
		);

		$body = generate_email_body ( "new_service_rejected", $Parameters );

		$body = wordwrap ( $body, 70 );

		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: ' . SYSTEM_EMAIL_ADDRESS . "\r\n";

		$headers .= 'X-Mailer: PHP/' . phpversion () . "\r\n";

		if (mail ( $PartnerEmail, "MobileOps - New Service Requested", $body, $headers )) {
			return true;
		} else {
			return false;
		}
	} catch ( Exception $e ) {
		return false;
	}
}


function getServiceCategories($entityManager) {
	try {
		
		$ServiceTypes = getAllLookupsByClass ( $entityManager, 'LuServiceType' );
		
		$CategoryArray = array ();
		
		if ($ServiceTypes) {
			
			foreach ( $ServiceTypes as $ServiceType ) {
				array_push ( $CategoryArray, $ServiceType->getName () );
			}
			
			$response ['status'] = 1;
			
			$response ['message'] = $CategoryArray;
			
			echo json_encode ( $response );
		} else {
			
			$response ['status'] = 2;
			
			$response ['message'] = "No service categories found, please contact administrator @ " . SYSTEM_EMAIL_ADDRESS;
			
			echo json_encode ( $response );
			
			return;
		}
	} catch ( Exception $e ) {
		
		$response ['status'] = 2;
		
		$response ['message'] = $e->getMessage ();
		
		echo json_encode ( $response );
	}
}

function getServiceRequests($entityManager) {
	try {
		
		$RequestedService = $entityManager->getRepository ( 'RequestedService' )->findBy ( array (
				'approvedStatus' => 0, 'active' => 1
		), array (
				'dateRequested' => 'ASC' 
		) );
		
		$RequestedServicesArray = array ();
		
		foreach ( $RequestedService as &$value ) {
			$tempArray = array ();
			array_push ( $tempArray, $value->getDateRequested()->format ( 'Y-m-d H:i' ));
			array_push ( $tempArray, $value->getRequestedServiceCategory() );
			array_push ( $tempArray, $value->getRequestedServiceName() );
			array_push ( $tempArray, $value->getRequestedServiceId() );
			array_push ( $RequestedServicesArray, $tempArray );
		}
		

		$response ['status'] = 1;
		$response ['serviceRequests'] = $RequestedServicesArray;
		echo json_encode ( $response );
	} catch ( Exception $e ) {
		$response ['status'] = 2;
		$response ['message'] = $e->getMessage ();
		echo json_encode ( $response );
	}
}

?>