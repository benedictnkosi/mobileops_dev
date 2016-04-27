<?php

require_once(__DIR__.'/../../../bootstrap.php');
require_once(__DIR__.'/../../../app/application.php');
require_once(__DIR__.'/../Logic/Email_template.php');
require_once (__DIR__."/../Logic/Mail.php");

/*required entities*/
require_once(__DIR__.'/../Entity/LuFee.php');
require_once(__DIR__.'/../Entity/Booking.php');
require_once(__DIR__.'/../Entity/BookingBookingStatus.php');
require_once(__DIR__.'/../Entity/BookingAddress.php');
require_once(__DIR__.'/../Entity/BookingTime.php');
require_once(__DIR__.'/../Entity/User.php');
require_once(__DIR__.'/../Entity/UserProfile.php');
require_once(__DIR__.'/../Entity/LuAccountStatus.php');
require_once(__DIR__.'/../Entity/LuBookingStatus.php');
require_once(__DIR__.'/../Entity/LuUserRole.php');
require_once(__DIR__.'/../Entity/Address.php');
require_once(__DIR__.'/../Entity/UserUserService.php');
require_once(__DIR__.'/../Entity/LuService.php');
require_once(__DIR__.'/../Entity/LuServiceType.php');
require_once(__DIR__.'/../Entity/BookingSummaryView.php');
require_once(__DIR__.'/../Entity/BookingComments.php');
require_once(__DIR__.'/../Entity/BookingServiceRegion.php');
require_once(__DIR__.'/../Entity/RegionService.php');
require_once(__DIR__.'/../Entity/BookingUserProfile.php');
require_once(__DIR__.'/../Entity/PartnerRating.php');
require_once(__DIR__.'/../Entity/BookingPartner.php');



require_once('controller_lookup.php');
require_once('controller_booking_services.php');

//Logger
//require_once('../logger/php/Logger.php');




if (isset ( $_GET ['getBestPartners'] )) {
	if ($_GET ['getBestPartners']) :
	
	try {
		session_start ();
	} catch (Exception $e) {
	}

	getBestPartners($entityManager);
	endif;
}


if (isset ( $_GET ['getServicePrices'] )) {
	if ($_GET ['getServicePrices']) :
	try {
		session_start ();
	} catch (Exception $e) {
	}
	
	getServicePrices($entityManager);
	endif;
}


if (isset ( $_GET ['getBookingsInCalender'] )) {
	if ($_GET ['getBookingsInCalender']) :
	try {
		session_start ();
	} catch (Exception $e) {
	}
	//initializeSession();
	getBookingsInCalender($entityManager);
	endif;
}

if (isset ( $_GET ['completeBooking'] )) {
	if ($_GET ['completeBooking']) :
	try {
		session_start ();
	} catch (Exception $e) {
	}
	
	completeBooking($entityManager);
	endif;
}


if (isset ( $_POST ['cancelBooking'] )) {
	if ($_POST ['cancelBooking']) :
	
	cancelBooking($entityManager);
	endif;
}


if (isset ( $_GET ['getBookingDetails'] )) {
	if ($_GET ['getBookingDetails']) :
	getBookingDetails($entityManager);

	endif;
}


if (isset ( $_POST ['updateBooking'] )) {
	if ($_POST ['updateBooking']) :
	updateBooking($entityManager);
	endif;
}


function getBookingRegionServiceByBooking($entityManager,$booking){

	if($booking==NULL){
		echo 'booking is NULL';
		return NULL;
	}
	try {

		$bookingServiceRegion     = $entityManager->getRepository('BookingServiceRegion')->findBy(array('booking' => $booking,'active' => TRUE));
		$bookingServiceRegionArray = array ();

		foreach ($bookingServiceRegion as $value) {
			array_push($bookingServiceRegionArray,$value);
		}

		return $bookingServiceRegionArray;

	} catch (Exception $e) {
		echo $e->getTraceAsString();
	}

	return NULL;
}


function changeBookingRegionServiceStatus($entityManager,$bookingRegionServiceStatus,$newBoolStatus){
	try {

		$bookingRegionServiceStatus->setActive($newBoolStatus);

		$entityManager->persist($bookingRegionServiceStatus);
		$entityManager->flush();

	} catch (Exception $e) {
		echo $e->getTraceAsString();
	}
}


/*comments can be null, rating can be null - cant remember why these two were part of this table*/

function addBookingRegionServiceRegionService($entityManager,$regionServicePriceDTO,$bookingObject,$comments,$rating){

	try{
		$bookingServiceRegion = regionServiceDTOtoBookingServiceRegionService($regionServicePriceDTO,$bookingObject,$comments,$rating);

		$entityManager->persist($bookingServiceRegion);
		$entityManager->flush();

		return $bookingServiceRegion;

	}catch (Exception $e){
		echo $e->getTraceAsString();
	}

	return NULL;

}


function regionServiceDTOtoBookingServiceRegionService($regionServicePriceDTO,$bookingObject,$comments,$rating){

	$bookingServiceRegion = new BookingServiceRegion();

	$bookingServiceRegion->setActive(1);
	$bookingServiceRegion->setBooking($bookingObject);
	$bookingServiceRegion->setComments($comments);
	$bookingServiceRegion->setDiscountPercentagediscountPercentage($regionServicePriceDTO->getDiscountPercentage());
	$bookingServiceRegion->setRating($rating);
	$bookingServiceRegion->setActualAmountToPay($regionServicePriceDTO->getAmountToPay());
	$bookingServiceRegion->setServiceAmount($regionServicePriceDTO->getServiceAmount());
	$bookingServiceRegion->setDateCreated(new DateTime());
	$bookingServiceRegion->setRegionServiceId($regionServicePriceDTO->getRegionServiceId());
	$bookingServiceRegion->setServiceName($regionServicePriceDTO->getServiceName());
	
	

	return $bookingServiceRegion;

}


function getBookingsByUserId($entityManager,$userObject){
	$booking_object     = $entityManager->getRepository('Booking')->findBy(array('active' => TRUE,'user' => $userObject));
	$activeBookingsArray = array ();

	foreach ($booking_object as &$value) {
		array_push($activeBookingsArray,$value);
	}
	$_SESSION['user_bookings'] = $activeBookingsArray;
	
	return $activeBookingsArray;
}



function getBookingsByPartnerId($entityManager,$userObject){
	$bookingPartner = $entityManager->getRepository('BookingPartner')->findBy(array('user' => $userObject));
	$activeBookingsArray = array ();

	foreach ($bookingPartner as &$value) {
		$booking_object = $value->getBooking();
		array_push($activeBookingsArray,$booking_object);
	}
	$_SESSION['user_bookings'] = $activeBookingsArray;

	
	return $activeBookingsArray;
}


function updateBooking($entityManager){
	try {
		$booking =  $entityManager->getRepository('Booking')->findOneBy(array('bookingId' => $_POST ['updateBooking']));
		if($booking){
			
			$BookingUserProfile =  $entityManager->getRepository('BookingUserProfile')->findOneBy(array('booking' => $booking));
			if($BookingUserProfile){
				$date = new DateTime();
				$BookingUserProfile->setEmailAddress($_POST ['client_email_address']);
				$BookingUserProfile->setFirstName($_POST ['client_name']);
				$BookingUserProfile->setPhoneNumber($_POST ['client_mobile_number']);
				$BookingUserProfile->setSurname($_POST ['client_surname']);
				$BookingUserProfile->setDateCreated($date);
				$entityManager->persist($BookingUserProfile);
			}
			
			$BookingSummaryView =  $entityManager->getRepository('BookingSummaryView')->findOneBy(array('bookingId' => $_POST ['updateBooking']));
			if($BookingSummaryView){
				$format = 'Y/m/d H:i';
				$dateStartTime = DateTime::createFromFormat($format, $_POST ['seletedBookingDate'] . ' ' . $_POST ['seletedBookingTime'] );
				$dateEndTime = DateTime::createFromFormat($format, $_POST ['seletedBookingDate'] . ' ' . $_POST ['seletedBookingTime'] );
				
				$BookingSummaryView->setBookingStartTime($dateStartTime);
				$BookingSummaryView->setBookingEndTime($dateEndTime);
				$BookingSummaryView->setMobileNumber($_POST ['client_mobile_number']);
				$BookingSummaryView->setFirstName($_POST ['client_name']);
				$BookingSummaryView->setSurname($_POST ['client_surname']);
				$BookingSummaryView->setUserEmailAddress($_POST ['client_email_address']);
				
				$entityManager->persist($BookingSummaryView);
				$entityManager->flush();
				
				$response['status'] = 1;
				$response['message'] = 'Successfully Updated Booking Details';
				echo json_encode($response);
				return;
			}
			
		}
		$response['status'] = 2;
		$response['message'] = 'Failed To Update Booking Details';
		echo json_encode($response);
	} catch (Exception $e) {
		$response['status'] = 2;
		$response['message'] = 'Failed To Update Booking Details';
		echo json_encode($response);
	}
}


function getBookingDetails($entityManager){
	try {
		$bookingServiceRegionArray = array ();
		$bookingDetailsArray = array ();
	
		$BookingSummaryView =  $entityManager->getRepository('BookingSummaryView')->findOneBy(array('bookingId' => $_GET ['getBookingDetails']));
	
		if(!$BookingSummaryView){
			$response['status'] = 2;
			$response['message'] = 'Failed To Retrieve Booking Details';
			echo json_encode($response);
			return;
		}
		
		$booking 	 = getBookingByID($entityManager,$_GET ['getBookingDetails']);
		$bookingComments = getBookingCommentsForBooking($entityManager,$booking);
		$BookingAddress = $entityManager->getRepository('Address')->findOneBy(array('addressId' => $BookingSummaryView->getAddressId()));

	
		$bookingDetailsArray['client_name'] = $BookingSummaryView->getFirstName();
		$bookingDetailsArray['client_surname'] = $BookingSummaryView->getSurname();
		$bookingDetailsArray['client_email_address'] = $BookingSummaryView->getUserEmailAddress();
		$bookingDetailsArray['client_mobile_number'] = $BookingSummaryView->getMobileNumber();
	
	
		$bookingDetailsArray['booking_complex'] = $BookingAddress->getComplexName();
		$bookingDetailsArray['booking_address'] = $BookingAddress->getStreetNumber() . ' ' . $BookingAddress->getStreetName() . ', ' .  $BookingAddress->getSuburbName(). ', ' .  $BookingAddress->getCityName();
		$bookingDetailsArray['lat'] = $BookingAddress->getLatitude();
		$bookingDetailsArray['lng'] = $BookingAddress->getLongitude();
		$bookingDetailsArray['administrative_area_level_1'] = $BookingAddress->getProvinceName();
		$bookingDetailsArray['input_street_name'] = $BookingAddress->getStreetNumber();
		$bookingDetailsArray['sublocality'] = $BookingAddress->getSuburbName();
		$bookingDetailsArray['locality'] = $BookingAddress->getCityName();
		$bookingDetailsArray['booking_date'] =  $BookingSummaryView->getBookingStartTime()->format('Y-m-d H:i');
		$bookingDetailsArray['booking_notes'] = $bookingComments->getBookingComments();
		
		$bookingDetailsArray['provider_id'] = '2';
		$bookingDetailsArray['booking_ref'] = 'sln' . $booking->getBookingId();
		
		//booking status
		$bookingStatus = getActiveBookingStatus($entityManager,$booking);
		$bookingDetailsArray['booking_status'] = $bookingStatus->getBookingBookingStatus()->getName();
		
		//booking services
		$bookingRegionServices = getBookingRegionServiceByBooking($entityManager,$booking);
		
		foreach ($bookingRegionServices as $bookingRegionService) {
			$serviceArray = array ();
			array_push ( $serviceArray, $bookingRegionService->getServiceName() );
			array_push ( $serviceArray, $bookingRegionService->getServiceAmount() );
			array_push($bookingServiceRegionArray,$serviceArray);
		}
		
		$bookingDetailsArray['booking_services'] = $bookingServiceRegionArray;
		
		
		//booking Partner
		$BookingPartner =  $entityManager->getRepository('BookingPartner')->findOneBy(array('booking' => $booking));
		if($BookingPartner){
			$bookingDetailsArray['provider_name'] = $BookingPartner->getUser()->getUserProfile()->getFirstName() . " " . $BookingPartner->getUser()->getUserProfile()->getSurname();
		}
		
		
		print json_encode ( $bookingDetailsArray );
	} catch (Exception $e) {
		$response['status'] = 2;
		$response['message'] = 'Failed To Retrieve Booking Details';
		echo json_encode($response);
	}
}



function cancelBooking($entityManager){
	try {
		
		$booking = $entityManager->getRepository('Booking')->findOneBy(array('bookingId' => $_POST ['cancelBooking']));
		if($booking){
			$bookingBookingStatus 	= changeBookingStatus($entityManager,$booking,'BOOKING_CANCELLED');
			if($bookingBookingStatus){
				$response['status'] = 1;
				$response['message'] = 'Successfully Cancelled Your Booking :(';
				echo json_encode($response);
				return;
			}else{
				$response['status'] = 2;
				$response['message'] = 'Failed To Cancel Your Booking2';
				echo json_encode($response);
			}
		}else{
			$response['status'] = 2;
			$response['message'] = 'Booking Not Found';
			echo json_encode($response);
		}
		
		
		
	} catch (Exception $e) {
		$response['status'] = 2;
		$response['message'] = 'Failed To Cancel Your Booking';
		echo json_encode($response);
	}
}


function completeBooking($entityManager){
	try {

		$complex = $_POST['complex'];
		$latitude = $_POST['lat'];
		$longitude = $_POST['lng'];
		$province = $_POST['administrative_area_level_1'];
		$street_name = $_POST['route'];
		$street_number = $_POST['street_number'];
		$suburb = $_POST['sublocality'];
		$city = $_POST['locality'];

		$_SESSION['booking_user'] = $_POST ['name'];

		$date = new DateTime();

		$Address = new Address();
		$Address->setStreetName($street_name);
		$Address->setStreetNumber($street_number);
		$Address->setCityName ($city);
		$Address->setSuburbName ($suburb);
		$Address->setProvinceName ($province);
		$Address->setLatitude($latitude);
		$Address->setLongitude($longitude);
		$Address->setComplexName($complex);
		$Address->setDateAdded($date);

		
		$entityManager->persist($Address);

		$entityManager->flush();

		if (isset ( $_SESSION ['user_id'] )) {
			$user_object = $entityManager->getRepository('User')->findOneBy(array('active' => TRUE,'userId' => $_SESSION['user_id']));
			if($user_object){
				$user_object = $entityManager->getRepository('User')->findOneBy(array('active' => TRUE,'userId' => $_SESSION['user_id']));
				$booking = createMasterBooking($entityManager,$user_object);
			}
		}else{
			$booking = createMasterBookingNoUser($entityManager);
		}
		
		
		if(!$booking){
			$response['status'] = 2;
			$response['message'] = 'Failed To Submit Your Booking1';
			echo json_encode($response);
			return;
		}
		
		$booking_user_profile  = new BookingUserProfile();
		$booking_user_profile->setEmailAddress($_POST ['email']);
		$booking_user_profile->setFirstName($_POST ['name']);
		$booking_user_profile->setPhoneNumber($_POST ['mobile_number']);
		$booking_user_profile->setSurname($_POST ['surname']);
		$booking_user_profile->setDateCreated($date);
		$booking_user_profile->setBooking($booking);
		
		$entityManager->persist($booking_user_profile);
		$entityManager->flush();
		
		$bookingBookingStatus 	= createBookingBookingStatus($entityManager,$booking,'BOOKING_ACTIVE');
		
		if(!$bookingBookingStatus){
			$response['status'] = 2;
			$response['message'] = 'Failed To Submit Your Booking2';
			echo json_encode($response);
			return;
		}
		
		$bookingAddress	= createBookingAddress($entityManager,$booking,$Address);
		if(!$bookingAddress){
			$response['status'] = 2;
			$response['message'] = 'Failed To Submit Your Booking3';
			echo json_encode($response);
			return;
		}

		$format = 'Y/m/d H:i';
		$dateStartTime = DateTime::createFromFormat($format, $_POST ['booking_date'] . ' ' . $_POST ['booking_time'] );
		$dateEndTime = DateTime::createFromFormat($format, $_POST ['booking_date'] . ' ' . $_POST ['booking_time'] );

		$dateEndTime->add(new DateInterval('PT3H'));
		$newBookingTime		= changeBookingTime($entityManager,$booking,$dateStartTime,$dateEndTime);

		if(!$newBookingTime){
			$response['status'] = 2;
			$response['message'] = 'Failed To Submit Your Booking';

			echo json_encode($response);
			return;
		}
		
		
		$BookingSummary = createOrUpdateBookingSummary($entityManager,$booking,$newBookingTime,$Address,$_POST['email'], $_POST['mobile_number'], 'BOOKING_ACTIVE',$booking_user_profile);

		if(!$BookingSummary){
			$response['status'] = 2;
			$response['message'] = 'Failed To Submit Your Booking';
			echo json_encode($response);
			return;
		}

		$bookingComments = addBookingComments($entityManager,$booking,$_POST['bookingNotes'],$_POST ['name']);

		
		if(!$bookingComments){
			$response['status'] = 2;
			$response['message'] = 'Failed To Submit Your Booking';
			echo json_encode($response);
			return;
		}
		
		
		$bookingPartner = addBookingPartner($entityManager,$booking,$_GET['partner_id']);
		
		if(!$bookingPartner){
			$response['status'] = 2;
			$response['message'] = 'Failed To Submit Your Booking';
			echo json_encode($response);
			return;
		}
		
		//write all services to the booking_service_region table
		writeServicesToDB($entityManager, $booking);
		
		//update user booking in the session for the calendar view
		if (isset ( $_SESSION ['user_id'] )) {
			$user_object = $entityManager->getRepository('User')->findOneBy(array('active' => TRUE,'userId' => $_SESSION['user_id']));
			if($user_object){
				$user_bookings = getBookingsByUserId($entityManager,$user_object);
			}
		}
	
		//send booking confirmation email to client
		if(send_booking_confirmation_message($entityManager, $booking->getBookingId())){
			$response['status'] = 1;
			$response['message'] = 'Your Booking Was Successful';
			$response['bookingid'] = $booking->getBookingId();
			echo json_encode($response);
		}else{
			$response['status'] = 1;
			$response['message'] = 'Your Booking Was Successful. Confirmation email failed to send, please contact aministrator';
			$response['bookingid'] = $booking->getBookingId();
			echo json_encode($response);
		}
		
	} catch (Exception $e) {
		$response['status'] = 2;
		$response['message'] = $e->getMessage();
		echo json_encode($response);
	}

}

function writeServicesToDB($entityManager, $bookingObject){
	try {
		
	
	$bookingServices = json_decode($_GET ['completeBooking']);
	
	foreach ($bookingServices as $bookingServiceArray) {
		
		$LuRegion = $entityManager->getRepository('LuRegion')->findOneBy(array('active' => TRUE, 'name' => $_POST ['locality']));

		$LuService = $entityManager->getRepository('LuService')->findOneBy(array('active' => TRUE, 'name' => $bookingServiceArray[0]));

		if($LuRegion && $LuService){
			$RegionService = $entityManager->getRepository('RegionService')->findOneBy(array('active' => TRUE, 'service' => $LuService, 'region' => $LuRegion));
			if($RegionService){
				$regionServicePrice = $entityManager->getRepository('RegionServicePrice')->findOneBy(array('active' => TRUE,'regionService' => $RegionService));
				if($regionServicePrice){
					$regionServicePriceDTO = new RegionServicePriceDTO();
					
					$regionServicePriceDTO->setDiscountPercentage($regionServicePrice->getDiscountPercentage());
					$regionServicePriceDTO->setServiceAmount($regionServicePrice->getAmount());
					
					$regionServicePriceDTO->setRegion($RegionService->getRegion()->getName());
					$regionServicePriceDTO->setServiceName($RegionService->getService()->getName());
					
					$regionServicePriceDTO->setRegionServiceId($RegionService->getRegionServiceId());
					$regionServicePriceDTO->setRegionServicePriceId($regionServicePrice->getRegionServicePriceId());
						
					addBookingRegionServiceRegionService($entityManager,$regionServicePriceDTO,$bookingObject, null, null);
				}
			}
		}
		
	}
	}
	catch (Exception $e) {
		$response['status'] = 2;
		$response['message'] = $e->getMessage();
		echo $e->getMessage();
		echo json_encode($response);
	}
}

/*
 * No error checking yet, I am yet to learn. I will put more controlls later.
 *
 * I will also add logging later.
 *
 */


function getServicePrices($entityManager){

	try {
		$selectedServicesArray = json_decode(stripslashes($_GET['services']));

		// Loads Regions to session // This should be done at the view but anyway
		loadRegionsToSession($entityManager);
		//(Array) Loads all the regions together with its prices check DTO/RegionServicePriceDTO
		$servicePriceArray = loadRegionServicePrices($entityManager);
		loadFeesToSession($entityManager);
		$_SESSION['service_prices_array'] = $servicePriceArray;

		$ServicesPriceArray = array ();
		foreach ($selectedServicesArray as &$service) {
			$priceItemDTO = getServiceDTOfromArray($entityManager,$_GET['region'],$service,$_SESSION['service_prices_array']);
			$TempServicesPriceArray = array ();
			array_push ( $TempServicesPriceArray, $service);
			array_push ( $TempServicesPriceArray, $priceItemDTO->getServiceAmount());
			array_push ( $ServicesPriceArray, $TempServicesPriceArray);
		}

		$std_Fee =  getSBS_STD_FEE();

		//print_r($std_Fee);
		$TempServicesPriceArray = array ();
		array_push ( $TempServicesPriceArray,$std_Fee->getName());
		array_push ( $TempServicesPriceArray, $std_Fee->getFeeAmount());
		array_push ( $ServicesPriceArray, $TempServicesPriceArray);
			

		//Once all the services and prices are loaded to the session, you can always query  the array **getServiceDTOfromArray** for any item


		$response['status'] = 1;
		$response['message'] = $ServicesPriceArray;
		echo json_encode($response);
	}catch (Exception $e) {
		$response['status'] = 2;
		$response['message'] = $e->getMessage();
		echo json_encode($response);
	}
}

function getBookingsInCalender($entityManager){
	$user_bookings = null;
	if (isset($_SESSION['user_bookings']))
	{
		//$user_bookings = $_SESSION['user_bookings'];
	}

	if($user_bookings==null){
		$user_object = $entityManager->getRepository('User')->findOneBy(array('active' => TRUE,'userId' => $_SESSION['user_id']));
		if($user_object && strcmp($_GET['getBookingsInCalender'], "CLIENT") == 0 ){
			$user_bookings = getBookingsByUserId($entityManager,$user_object);
		}elseif ($user_object && strcmp($_GET['getBookingsInCalender'], "PARTNER") == 0 ){
			$user_bookings = getBookingsByPartnerId($entityManager,$user_object);
		}
	}
	$bookings_times_array = array ();

	foreach ($user_bookings as &$value) {

		$booking_time 	= $entityManager->getRepository('BookingTime')->findOneBy(array('booking' => $value, 'active' => TRUE));
			
		$bookingRegionServices = getBookingRegionServiceByBooking($entityManager,$value);
		$servicesString = "";
		
		foreach ($bookingRegionServices as $bookingRegionService) {
			$servicesString .= $bookingRegionService->getServiceName() . ", ";
		}
		
		array_push ($bookings_times_array, array(
         'id' 		=> $value->getBookingId(), 
         'title' 	=> "Booking Ref: ". $value->getBookingId() . "\n Services: " . substr($servicesString,0,strlen($servicesString) - 2), 
         'start' 	=> $booking_time->getBookingStartTime()->format('Y-m-d\TH:i:s'),
         'end'      => $booking_time->getBookingEndTime()->format('Y-m-d\TH:i:s'), 
         'url' 		=> "/index.php?bookingdetails=" . $value->getBookingId() 
         ));
	}
	echo json_encode($bookings_times_array);
}




function getAllUserBookings($entityManager){
	$user = $_SESSION ['user_object'];

	//echo "getAllUserBookings";
	if($user){
	
		//echo "user found";
		$user_bookings  = $entityManager->getRepository('Booking')->findBy(array('user' => $user));
		$bookings_array = array ();

		foreach ($user_bookings as &$value) {
			//echo "booking found";
			array_push ($bookings_array, $value);
		}

		$_SESSION['user_bookings'] = $bookings_array;

		$response['status'] = 1;
		$response['message'] = $bookings_array;
	}else{
		$response['status'] = 2;
		$response['message'] = 'NO BOOKINGS FOUND';
	}

}

function getAllUserBookingsFromUserSession($entityManager){

	$user = $_SESSION['user'];

	if($user!=null){

		$user_bookings  = $entityManager->getRepository('Booking')->findBy(array('user' => $user));
		$bookings_array = array ();

		foreach ($user_bookings as &$value) {
			array_push ($bookings_array, $value);
		}

		$_SESSION['user_bookings'] = $bookings_array;

		$response['status'] = 1;
		$response['message'] = $bookings_array;

		echo json_encode($response);

	}else{
		$response['status'] = 2;
		$response['message'] = 'NO BOOKINGS FOUND';
	}

}

function getBookingTimeDetails($entityManager){

	$booking_object = $_SESSION ['selected_booking_object'];
	$booking_time 	= $entityManager->getRepository('BookingTime')->findBy(array('booking' => $booking_object, 'active' => TRUE));

	if($booking_time!=null){
		$response['status']  = 1;
		$response['message'] = $booking_time;
	}else{
		$response['status']  = 2;
		$response['message'] = 'NO TIME SET FOR BOOKING'; // Need to replace with proper errors and exceptions
	}

}

function getBookingFromSessionByID($booking_id){

	$user_bookings_in_session = $_SESSION['user_bookings'];
	$booking = null;

	if($user_bookings_in_session!=null){
		foreach ($user_bookings_in_session as &$value) {
			if($value->getBookingId()==$booking_id){
				$response['status']  = 1;
				$response['message'] = $value;
				saveBookingObjectToSession($value); //We can remove this
				break;
			}
		}
	}else{
		$response['status']  = 2;
		$response['message'] = 'BOOKING NOT FOUND';
	}



	echo json_encode($response);
}

function getBookingFromDBbyID($entityManager){

	$booking_id   = $_SESSION ['selected_booking_id'];

	if($booking_id > 0){
		$booking  = $entityManager->getRepository('Booking')->findBy(array('bookingId' => $booking_id));

		if($booking!=null){
			$response['status']  = 1;
			$response['message'] = $booking;
		}

	}else{
		$response['status']  = 2;
		$response['message'] = 'BOOKING NOT FOUND';
	}
}

function getBookingByID($entityManager,$bookingId){

	try {

		return $entityManager->getRepository('Booking')->findOneBy(array('bookingId' => $bookingId));

	} catch (Exception $e) {
	}

	return NULL;

}

//I know
function saveBookingObjectToSession($booking_object){
	if($booking_object!=null){
		$_SESSION ['selected_booking_object'] = $booking_object;
	}else{
		$response['status']  = 2;
		$response['message'] = 'BOOKING NOT SAVED';
	}
}

function saveBookingItemToSession($booking_id){

	if($booking_id!=null&&$booking_id > 0){
		$_SESSION ['selected_booking_id'] = $booking_id;
	}else{
		$response['status']  = 2;
		$response['message'] = 'BOOKING NOT SAVED';
	}
}

function bookingsInSession(){
	if($_SESSION['user_bookings']!=null){
		$response['status']  = 1;
		$response['message'] = 'TRUE';
	}else{
		$response['status']  = 2;
		$response['message'] = 'FALSE';
	}
	echo json_encode($response);
}


function getBestPartners($entityManager){
	$lowLatitude = floatval($_GET ["lat"]) - RADIUS;
	$lowLongitude = floatval($_GET ["lng"]) - RADIUS;

	$highLatitude = floatval($_GET ["lat"]) + RADIUS;
	$highLongitude = floatval($_GET ["lng"]) + RADIUS;

	$selectedServicesArray = $_GET["skills_checkbox_item"];

	$dql = "SELECT u, p, a, ur FROM User u JOIN u.userProfile p JOIN p.address a JOIN u.userUserRole ur
	where ur.name = 'PARTNER'
	and (a.latitude BETWEEN $lowLatitude AND $highLatitude) 
	and (a.longitude BETWEEN $lowLongitude AND  $highLongitude)";

	//echo $dql;
	$query = $entityManager->createQuery($dql);
	$query->setMaxResults(10);
	$partners = $query->getResult();
	$partnerFound = false;

	if($partners){
		foreach ($partners as $partner) {
			$ServiceFoundOnPartner = true;
			$services = $entityManager->getRepository('UserUserService')->findBy(array('userUserServiceProfile' => $partner->getUserProfile()));
			
			if(!$services){
				break;
			}
			
			foreach ($selectedServicesArray as $selectedService) {
				foreach ($services as $partnerService) {
					if (strcmp($selectedService, $partnerService->getUserUserServiceName()->getName()) !== 0) {
						$ServiceFoundOnPartner = false;
					}else{
						$ServiceFoundOnPartner = true;
						break;
					}
				}

				if($ServiceFoundOnPartner == false){
					break;
				}
			}
			
			if($ServiceFoundOnPartner == true){
				$partnerFound = true;
				//get partner rating

				$dql = "SELECT pr FROM PartnerRating pr JOIN pr.user u
				where u.userId = " . $partner->getUserId();

				$query = $entityManager->createQuery($dql);
				$query->setMaxResults(1000);
				$partnerRatings = $query->getResult();
				$ratingAvg = 3;

				if($partnerRatings){
					$ratingAvg = 0;
					foreach ($partnerRatings as $partnerRating) {
						$ratingAvg = $ratingAvg + $partnerRating->getRating();

					}
					$ratingAvg = $ratingAvg / sizeof($partnerRatings);
				}

				//output to screen
				outputPartnerToBrowser($partner, $ratingAvg);
			}
		}
		if(!$partnerFound){
			if(sizeof($selectedServicesArray) > 1 ){
				echo 'No partners providing the services requested found near the provided address. Please select fewer services';
			}
			else{
				echo 'No partners providing the services requested found near the provided address.';
			}
		}
	}else{
		echo 'No partners found near the provided address.';
	}
}

function outputPartnerToBrowser($partner, $ratingAvg){
	echo '<div class="partner_preview">';
	//echo '<img src="images/partner' . $partner->getUserId() . '.jpg" class="partner_thumb_image">';
	echo '<div class="container" style="width: 100%;"> <h3 style="margin-top: 5px;" id="lblpartner' . $partner->getUserId() . '">' . $partner->getUserProfile()->getFirstName() . ' ' . $partner->getUserProfile()->getSurname() . '</h3>';
	echo '<p>' . distance($_GET ["lat"], $_GET ["lng"], $partner->getUserProfile()->getAddress()->getLatitude(), $partner->getUserProfile()->getAddress()->getLongitude(), "K") . ' KM away from you </p>' ;
	echo '<p>' .  $partner->getUserProfile()->getPersonalNote() . '</p>' ;
	echo '<input id="partner_rating" class="rating"
	value="' . $ratingAvg .'" data-min="0" data-max="5" data-disabled="true" data-size="xs">';

	echo '<a href="index.php?partnergallery=' . $partner->getUserId(). '" target="_blank" class="button">View Gallery</a>';
	echo '<a href="#" class="button selectPartner" name ="' . $partner->getUserProfile()->getFirstName() . ' ' . $partner->getUserProfile()->getSurname() . '" id="partner' . $partner->getUserId().  '">Select</a>';
	echo ' </div>';
	echo '</div>';
}



function distance($lat1, $lon1, $lat2, $lon2, $unit) {

	$theta = $lon1 - $lon2;
	$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
	$dist = acos($dist);
	$dist = rad2deg($dist);
	$miles = $dist * 60 * 1.1515;
	$unit = strtoupper($unit);

	if ($unit == "K") {
		return round($miles * 1.609344, 2);
	} else if ($unit == "N") {
		return ($miles * 0.8684);
	} else {
		return $miles;
	}
}


function getBookingSummary($entityManager,$booking_id){

	if($booking_id > 0){
		$booking_view  = $entityManager->getRepository('BookingSummaryView')->findOneBy(array('bookingId' => $booking_id));

		if($booking_view!=null){
			$response['status']  = 1;
			$response['message'] = $booking_view;

			$_SESSION['$current_booking_view'] = $booking_view;
		}
		return $booking_view;
	}else{
		$response['status']  = 2;
		$response['message'] = 'BOOKING NOT FOUND';
		return NULL;
	}
}

function getBookingSummaryByBooking($entityManager,$booking){

	try {
		return $entityManager->getRepository('BookingSummaryView')->findOneBy(array('bookingId' => $booking->getBookingId()));
	} catch (Exception $e) {
	}
	return NULL;
}


function getBookingAllBookingDetails($entityManager,$booking_id){
	getBookingByBookingId($entityManager,$booking_id);
	$bookingSummaryView = getBookingSummary($entityManager,$booking_id);

	//Get Address
	$booking_object    = $_SESSION ['selected_booking_object'];
	$booking_address   = $entityManager->getRepository('BookingAddress')->findOneBy(array('booking' => $booking_object,'active' => TRUE));
	$addressArray      = addressToString($booking_address->getClientAddress());

	$servicesArray 	   = array ();

	$bookingDetailsArray['client_name'] 	= $bookingSummaryView->getFirstName();
	$bookingDetailsArray['client_surname'] 	= $bookingSummaryView->getSurname();
	$bookingDetailsArray['booking_complex'] = $addressArray[0];
	$bookingDetailsArray['booking_address'] = $addressArray[1];
	$bookingDetailsArray['booking_date'] 	= $booking_object->getTimeBooked();
}


function createOrUpdateBookingSummary($entityManager,$booking,$bookingTime,$address,$emailAdress,$mobileNumber,$bookingStatus,$userProfile){

	$bookingId  = $booking->getBookingId();
	$addressId  = $address->getAddressId();
	//$userProfile = $booking->getUser();

	$bookingView = $entityManager->getRepository('BookingSummaryView')->findOneBy(array('active' => TRUE,'bookingId' => $bookingId));

	if($bookingView==null){
		$bookingView   = new BookingSummaryView();
	}

	$bookingView->setActive(true);
	
	if (isset ( $_SESSION ['user_id'] )) {
		$bookingView->setUserId($_SESSION ['user_id']);
	}
	

	$firstname = $userProfile->getFirstName();
	$surname   = $userProfile->getSurname();
	$email    = $emailAdress;

	$bookingView->setFirstName($firstname);
	$bookingView->setSurname($surname);
	$bookingView->setUserEmailAddress($email);
	$bookingView->setMobileNumber($mobileNumber);

	$bookingView->setBookingId($bookingId);
	$bookingView->setAddressId($addressId);

	$bookingView->setTimeBooked($booking->getTimeBooked());
	$bookingView->setBookingStartTime($bookingTime->getBookingStartTime());
	$bookingView->setBookingEndTime($bookingTime->getBookingEndTime());
	$bookingView->setLastUpdated(new DateTime());
	$bookingView->setLatestBookingStatus($bookingStatus);

	$entityManager->persist($bookingView);
	$entityManager->flush();

	return $bookingView;

}



function getBookingAddress($entityManager,$booking_object){
	$booking_address = $entityManager->getRepository('BookingAddress')->findBy(array('booking' => $booking_object));
	return $booking_address;
}

function getBookingByBookingId($entityManager,$bookingId){

	$booking_object = $entityManager->getRepository('Booking')->findOneBy(array('bookingId' => $bookingId));

	if($booking_object!=null){
		saveBookingObjectToSession($booking_object);
	}
}

function addressToString($address){

	$addressSummaryArray = array ();
	if($address==NULL){
		return $addressSummaryArray;
	}else{
		array_push($addressSummaryArray,$address->getComplexName());
		array_push($addressSummaryArray,$address->getStreetNumber().' , '.$address->getStreetName()+' , '. $address->getCityName() .' , South Africa'); //
	}
	return $addressSummaryArray;
}

/**
 * @param $entityManager
 * @param $booking_user_profile
 * @return Booking|null
 */
function createMasterBooking($entityManager, $booking_user){

	try {
		
		
		$booking = new Booking();

		$booking->setActive(1);
		$booking->setUser($booking_user);
		$booking->setUserBooked($_SESSION['booking_user']);
		$booking->setTimeBooked(new DateTime());

		$entityManager->persist($booking);
		$entityManager->flush(); // I'll remove this later

		return $booking;
	} catch (Exception $e) {
		echo $e->getTraceAsString();
		return NULL;
	}

}

function createMasterBookingNoUser($entityManager){

	try {


		$booking = new Booking();

		$booking->setActive(1);
		$booking->setUserBooked($_SESSION['booking_user']);
		$booking->setTimeBooked(new DateTime());

		$entityManager->persist($booking);
		$entityManager->flush(); // I'll remove this later

		return $booking;
	} catch (Exception $e) {
		echo $e->getTraceAsString();
		return NULL;
	}

}


function createBookingBookingStatus($entityManager,$booking,$status){

	if($booking==NULL){
		echo 'Booking is NULL';
		return NULL;
	}

	try {

		$bookingBookingStatus = new BookingBookingStatus();

		$booking_status = $entityManager->getRepository('LuBookingStatus')->findOneBy(array('name' => $status));

		$bookingBookingStatus->setActive(1);
		$bookingBookingStatus->setBooking($booking);
		$bookingBookingStatus->setBookingBookingStatus($booking_status);
		$date = new DateTime();
		$bookingBookingStatus->setTimestamp($date);

		$entityManager->persist($bookingBookingStatus);
		$entityManager->flush(); // I'll remove this later

		return $booking;
	} catch (Exception $e) {
		echo 'Could not create Booking Status';
		return NULL;
	}
}
function getActiveBookingStatus($entityManager,$booking){

	if($booking==NULL){
		echo 'booking is NULL';
		return NULL;
	}
	try {
		return $entityManager->getRepository('BookingBookingStatus')->findOneBy(array('booking' => $booking,'active' => TRUE));
	} catch (Exception $e) {
		return NULL;
	}
}

function changeBookingStatus($entityManager,$booking,$newStatus){

	if($booking==NULL){
		echo 'no Booking is null';
		return 'FAIL';
	}else{
			
		$currentBookingStatus = getActiveBookingStatus($entityManager,$booking);
			
		if($currentBookingStatus!=NULL){
			
			$currentBookingStatus->setActive(0);
			
			$date = new DateTime();
			$currentBookingStatus->setTimestamp($date);
			
			$entityManager->persist($currentBookingStatus);
			$entityManager->flush();
		}
		//Now add the new status
		$newBookingStatus = createBookingBookingStatus($entityManager,$booking,$newStatus);

		if($newBookingStatus!=NULL)
		return 'SUCCESS';
	}

	return 'FAIL';
}

function createBookingAddress($entityManager,$booking,$clientBookingAddress){

	if($booking==NULL){
		echo 'booking is NULL';
		return NULL;
	}

	if($clientBookingAddress==NULL){
		echo 'bookingAddress is NULL';
		return NULL;
	}

	try {

		$bookingAddress = new BookingAddress();
		$bookingAddress->setActive(1);
		$bookingAddress->setBooking($booking);
		$bookingAddress->setClientAddress($clientBookingAddress);

		$entityManager->persist($bookingAddress);
		$entityManager->flush(); // I'll remove this later

		return $bookingAddress;
	} catch (Exception $e) {
		return NULL;
	}
}

function getActiveBookingAddress($entityManager,$booking){
	if($booking==NULL){
		echo 'booking is NULL';
		return NULL;
	}
	try {
		return $entityManager->getRepository('BookingAddress')->findOneBy(array('booking' => $booking,'active' => TRUE));
	} catch (Exception $e) {
		echo 'Something went wrong';
		return NULL;
	}
}

function changeBookingAddress($entityManager,$booking,$newClientBookingAddress){

	if($newClientBookingAddress==NULL){
		echo 'bookingAddress is NULL'; // There is nothing to change to. Why bother?
		return NULL;
	}

	//Check if we have an old booking address
	$activeBookingAddress   = getActiveBookingAddress($entityManager,$booking);

	//If there is no booking address just create a new one.
	if($activeBookingAddress==NULL){
		//echo 'creating new booking address';
		return createBookingAddress($entityManager,$booking,$newClientBookingAddress);
	}else{

		//If there is an existing - deactivate the old one and create a new one.
		$activeBookingAddress->setActive(0);
		$entityManager->persist($activeBookingAddress);
		$entityManager->flush();

		//echo 'Changing booking address';
		return createBookingAddress($entityManager,$booking,$newClientBookingAddress);
	}

	return NULL;
}



function getBookingBookingServices($entityManager,$booking){

	try {

		$bookings_fees_array = array ();

		$entityManager->getRepository('BookingServiceRegion')->findBy(array('booking' => $booking,'active' => TRUE));

		foreach ($user_bookings as &$value) {
			array_push($bookings_fees_array, $value);
		}

		return $bookings_fees_array;

	} catch (Exception $e) {
		echo $e->getTrace();
	}
}

function listBookingServicesAndFees($entityManager,$booking){

	$booking_services_array = getBookingBookingServices($entityManager,$booking);
	$bookings_fees_array    = getBookingFees($entityManager,$booking);

	$booking_summary_fees   = array ();

	foreach ($booking_services_array as &$value) {

		$booking_service_name = $value->getRegionService()->getService()->getName().";".$value->getRegionService()->getService()->
		array_push($booking_summary_fees, $value);
	}
}

function getActiveBookingTime($entityManager,$booking){

	if($booking==NULL){
		echo 'booking is NULL';
		return NULL;
	}
	try {
		return $entityManager->getRepository('BookingTime')->findOneBy(array('booking' => $booking,'active' => TRUE));
	} catch (Exception $e) {
		return NULL;
	}
}

function createNewBookingTime($entityManager,$booking,$bookingStartTime,$bookingEndTime){

	if($booking==NULL){
		echo 'booking is NULL';
		return NULL;
	}

	try {
		$bookingReference = "OPS-".$booking->getBookingId();
		$bookingTime 	  = new BookingTime();

		$bookingTime->setActive(1);
		$bookingTime->setBooking($booking);
		$bookingTime->setBookingStartTime($bookingStartTime);
		$bookingTime->setBookingEndTime($bookingEndTime);
		//$bookingTime->setBookingReference(uniqid());
		$bookingTime->setBookingReference($bookingReference);

		$entityManager->persist($bookingTime);
		$entityManager->flush();

		//echo 'booking is Active' . $bookingTime->getBookingReference();

		return $bookingTime;

	} catch (Exception $e) {
		echo 'Failed to create booking time';
		return NULL;
	}

	return NULL;
}

function changeBookingTime($entityManager,$booking,$bookingStartTime,$bookingEndTime){

	$activeBookingTime = getActiveBookingTime($entityManager,$booking);

	if($activeBookingTime==NULL){
		//echo 'creating new BookingTime';
		return createNewBookingTime($entityManager,$booking,$bookingStartTime,$bookingEndTime);

	}else{
		//echo 'found existing BookingTime';

		$activeBookingTime->setActive(0);
		$entityManager->persist($activeBookingTime);
		$entityManager->flush();

		return createNewBookingTime($entityManager,$booking,$bookingStartTime,$bookingEndTime);
	}
}



function addBookingPartner($entityManager,$booking,$user_id){

	if($booking==NULL || $user_id ==NULL){
		echo 'booking or user is NULL';
		return NULL;
	}

	try {
		$user = $entityManager->getRepository('User')->findOneBy(array('userId' => $user_id));
		if($user){
			$bookingPartner = new BookingPartner();
			$bookingPartner->setUser($user);
			$bookingPartner->setBooking($booking);
			
			$entityManager->persist($bookingPartner);
			$entityManager->flush();
			return $bookingPartner;
		}
		
	} catch (Exception $e) {
		echo $e->getMessage();
	}
	return NULL;
}


//Max 500, validation will happen at UI level
function addBookingComments($entityManager,$booking,$comments,$addedBy){

	if($booking==NULL){
		echo 'booking is NULL';
		return NULL;
	}

	try {

		$bookingComments = new BookingComments();

		$bookingComments->setBooking($booking);
		$bookingComments->setBookingComments($comments);
		$bookingComments->setAddedBy($addedBy);
		$bookingComments->setDateAdded(new DateTime());

		$entityManager->persist($bookingComments);
		$entityManager->flush();

		return $bookingComments;

	} catch (Exception $e) {
	}
	return NULL;
}

function getBookingCommentsForBooking($entityManager,$booking){
	if($booking==NULL){
		echo 'booking is NULL';
		return NULL;
	}

	try {
		return $entityManager->getRepository('BookingComments')->findOneBy(array('booking' => $booking,'active' => TRUE));
	} catch (Exception $e) {
	}
	return NULL;
}

function updateBookingCommentsStatus($entityManager,$booking,$newComments,$updatedBy){

	if($booking==NULL){
		echo 'booking is NULL';
		return NULL;
	}

	try {

		$currentBookingComments = getBookingCommentsForBooking($entityManager,$booking);
		$currentBookingComments->setActive(0);

		$entityManager->persist($currentBookingComments);
		$entityManager->flush();

		return addBookingComments($entityManager,$booking,$newComments,$updatedBy);

	} catch (Exception $e) {
	}
	return NULL;
}

function createBookingService($entityManager,$booking,$regionService,$rating){

	$bookingServiceRegion = new BookingServiceRegion();

	try {

		$bookingServiceRegion->setActive(1);
		$bookingServiceRegion->setBooking($booking);
		$bookingServiceRegion->setRegionService($regionService);

		$entityManager->persist($bookingServiceRegion);
		$entityManager->flush();

		return $bookingServiceRegion;

	} catch (Exception $e) {
	}

	return NULL;
}

function createBookingUserProfile($entityManager,$booking,$phoneNumber,$gender,$surname,$firstName,$emailAddress){

	try {

		$bookingUserProfile = new BookingUserProfile();

		$bookingUserProfile->setBooking($booking);
		$bookingUserProfile->setFirstName($firstName);
		$bookingUserProfile->setGender($gender);
		$bookingUserProfile->setPhoneNumber($phoneNumber);
		$bookingUserProfile->setSurname($surname);
		$bookingUserProfile->setEmailAddress($emailAddress);
		$bookingUserProfile->setDateCreated(new DateTime());

		$entityManager->persist($bookingUserProfile);
		$entityManager->flush();

		return $bookingUserProfile;

	} catch (Exception $e) {
		echo $e->getTrace();
	}

	return NULL;
}

function getBookingUserProfile($entityManager,$booking){
	try {
		return $entityManager->getRepository('BookingUserProfile')->findOneBy(array('booking' =>$booking,'active' => TRUE));
	} catch (Exception $e) {
		echo $e->getTrace();
	}
}

//We will deactivate the currentBookingProfile and add a new one
function updateBookingUserProfile($entityManager,$currentBookingUserProfile,$phoneNumber,$gender,$surname,$firstName,$emailAddress){

	$newBookingUserProfile = NULL;
	try {

		$updateResults = changeBookingUserProfileStatus($entityManager,$currentBookingUserProfile,FALSE);

		if('SUCCESS' == $updateResults){
			$newBookingUserProfile =  createBookingUserProfile($entityManager,$currentBookingUserProfile->getBooking(),$phoneNumber,$gender,$surname,$firstName,$emailAddress);
		}

	} catch (Exception $e) {
		echo $e->getTrace();
	}

	return $newBookingUserProfile;
}

function changeBookingUserProfileStatus($entityManager,$currentBookingUserProfile,$newStatus){
	try {

		$currentBookingUserProfile->setActive($newStatus);

		$entityManager->persist($currentBookingUserProfile);
		$entityManager->flush();

	} catch (Exception $e) {
		echo $e->getTrace();
		return 'FAIL';
	}

	return 'SUCCESS';
}




function send_booking_confirmation_message($entityManager, $booking_id){
	try {
		$name = $_POST ['name'];
		$surname = $_POST ['surname'];
		$email = $_POST ['email'];
		$phone_number = $_POST ['mobile_number'];
		$message_type = "booking_confirmation";
		$message = "test";

		$personalDetails = $_POST['name'] . " " . $_POST['surname'] . "<br/>" 
		.  $_POST ['email'] . "<br/>" . 
		$_POST ['mobile_number']. "<br/>
		<h4>APPOINTMENT ADDRESS</h4>". "<p>"
		. $_POST['complex'] . "<br/>"
		. $_POST['street_number']. "<br/>"
		.$_POST['route']. "<br/>"
		. $_POST['sublocality'] . "<br/>"
		. $_POST['locality'];
		
		$Parameters = array(
				"first_name" => $_POST['name'],
				"last_name" => $_POST['surname'],
				"mobile_number" => $_POST['mobile_number'],
				"personal_details" => $personalDetails,
				"provider_name" => $_POST['provider_name'],
				"booking_notes" => $_POST['bookingNotes'],
				"appointment_date" => $_POST['booking_date'],
				"appointment_time" => $_POST['booking_time'],
				"booking_reference" => $booking_id,
				"booking_status" => 'Active',
				"tr_service_price" => '<tr class="serviceRow"><td>Bonding</td><td>R200.00</td></tr>
				<tr class="serviceRow"><td>Face Wash</td><td>R550.00</td></tr>
				<tr class="serviceRow"><td></td><td>Total: R550.00</td></tr>'
		);
		
		if(emailMessage($entityManager,$Parameters,$message_type)){
			$messages[] = "Successfully sent message to MobileOps" ;
		}else{
			$errors[] = "Failed to send message to MobileOps, please try again" ;
		}

		return true;
	}catch (Exception $e) {
		return false;
	}
}


//send email to user for password with link/url
function emailMessage($entityManager, $Parameters, $messageType){
	try{
		$errors = array ();
		$messages = array ();


		$body = generate_email_body($messageType, $Parameters);
			
		$body = wordwrap($body,70);

		//echo $body;

		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: ' .SYSTEM_EMAIL_ADDRESS. "\r\n";
		$headers .= 'Reply-To: ' .$_POST['email']. "\r\n";

		$headers .= 'X-Mailer: PHP/' . phpversion () . "\r\n";


		if (mail ( SYSTEM_EMAIL_ADDRESS , "MobileOps - " . $messageType, $body, $headers )) {
			return true;
		} else {
			return false;
		}

	}catch (Exception $e) {
		return false;
	}
}

