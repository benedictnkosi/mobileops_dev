<?php
require_once(__DIR__.'/../../../bootstrap.php');

/*required entities*/
require_once(__DIR__.'/../../../src/AppBundle/Entity/LuFee.php');
require_once(__DIR__.'/../../../src/AppBundle/Entity/Booking.php');
require_once(__DIR__.'/../../../src/AppBundle/Entity/BookingFees.php');
require_once(__DIR__.'/../../../src/AppBundle/Entity/BookingBookingStatus.php');
require_once(__DIR__.'/../../../src/AppBundle/Entity/BookingAddress.php');
require_once(__DIR__.'/../../../src/AppBundle/Entity/BookingTime.php');
require_once(__DIR__.'/../../../src/AppBundle/Entity/User.php');
require_once(__DIR__.'/../../../src/AppBundle/Entity/UserProfile.php');
require_once(__DIR__.'/../../../src/AppBundle/Entity/LuAccountStatus.php');
require_once(__DIR__.'/../../../src/AppBundle/Entity/LuBookingStatus.php');
require_once(__DIR__.'/../../../src/AppBundle/Entity/LuUserRole.php');
require_once(__DIR__.'/../../../src/AppBundle/Entity/Address.php');
require_once(__DIR__.'/../../../src/AppBundle/Entity/UserUserService.php');
require_once(__DIR__.'/../../../src/AppBundle/Entity/LuService.php');
require_once(__DIR__.'/../../../src/AppBundle/Entity/LuServiceType.php');
require_once(__DIR__.'/../../../src/AppBundle/Entity/BookingSummaryView.php');
require_once(__DIR__.'/../../../src/AppBundle/Entity/BookingComments.php');
require_once(__DIR__.'/../../../src/AppBundle/Entity/BookingServiceRegion.php');
require_once(__DIR__.'/../../../src/AppBundle/Entity/BookingUserProfile.php');

require_once(__DIR__.'/../../../src/AppBundle/Controller/controller_booking.php');
require_once(__DIR__.'/../../../src/AppBundle/Controller/controller_faq.php');
require_once(__DIR__.'/../../../src/AppBundle/Controller/controller_booking_services.php');
require_once(__DIR__.'/../../../src/AppBundle/Controller/controller_lookup.php');

//Testing purposes
function initializeSession(){
	session_start ();
	$_SESSION ['user_id'] 			  = '1';
	$_SESSION ['selected_booking_id'] = '1';

	$_SESSION['firstname'] 		= 'Sbu';
	$_SESSION['surname']   		= 'Radebe';
	$_SESSION['email_address'] 	= 's2sradebe@fnb.xo.za';
	$_SESSION['gender']			= 'MALE';
	$_SESSION['phone_number']	= '0733534567';

	$_SESSION['address_id'] 	    = 10;
	$_SESSION['booking_user']		= 'Sibusiso Radebe'; //Used to update the booking creation user, can be null if not provided
	$_SESSION['booking_comments']	= 'Booking comments';
	
}

initializeSession($entityManager);
echo getFaq($entityManager);
		
$booking_user_profile             = $entityManager->getRepository('UserProfile')->findOneBy(array('userProfileId' => '1'));
$_SESSION['booking_user_profile'] = $booking_user_profile;

echo $booking_user_profile->getFirstName();

getBookingByBookingID($entityManager,1);
//getBookingAllBookingDetails($entityManager,1);

$booking 				= createMasterBooking($entityManager,$_SESSION['booking_user_profile']);
$bookingBookingStatus 	= createBookingBookingStatus($entityManager,$booking,'BOOKING_ACTIVE');

$clientBookingAddress   = $entityManager->getRepository('Address')->findOneBy(array('addressId' => '1'));
echo  '$clientBookingAddress->getStreetName()' + $clientBookingAddress->getStreetName();
echo  "\n";

$bookingAddress			= createBookingAddress($entityManager,$booking,$clientBookingAddress);
echo '$bookingAddress->getActive()' + $bookingAddress->getActive();
echo  "\n";

$bookingUserProfile = createBookingUserProfile($entityManager,$booking,$_SESSION['phone_number'],$_SESSION['gender'],$_SESSION['surname'],$_SESSION['firstname'],$_SESSION['email_address']);
$bookingUserProfile = getBookingUserProfile($entityManager,$booking);
echo $bookingUserProfile->getSurname();

$bookingUserProfile = updateBookingUserProfile($entityManager,$bookingUserProfile,$_SESSION['phone_number'],$_SESSION['gender'],$_SESSION['surname'],$_SESSION['firstname'],$_SESSION['email_address']);
echo $bookingUserProfile->getSurname();

//$activeBookingAddress	= getActiveBookingAddress($entityManager,$booking);
//echo json_encode(addressToString($activeBookingAddress->getClientAddress()));

//$newBookingAddress = changeBookingAddress($entityManager,$booking,$clientBookingAddress);
//$newBookingAddress = changeBookingAddress($entityManager,$booking,$clientBookingAddress);
$newBookingTime		 = changeBookingTime($entityManager,$booking,new DateTime(),new DateTime());
$newBookingTime		 = changeBookingTime($entityManager,$booking,new DateTime(),new DateTime());
echo $newBookingTime->getActive();

//$bookingBookingStatus	= getActiveBookingStatus($entityManager,$booking);

createOrUpdateBookingSummary($entityManager,$booking,$newBookingTime,$clientBookingAddress,$_SESSION['email_address'],'BOOKING_ACTIVE',$bookingUserProfile);
createOrUpdateBookingSummary($entityManager,$booking,$newBookingTime,$clientBookingAddress,$_SESSION['email_address'],'BOOKING_NOT_ACTIVE',$bookingUserProfile);

$bookingComments = addBookingComments($entityManager,$booking,'TEST','TEST');
$bookingComments = getBookingCommentsForBooking($entityManager,$booking);
$bookingComments = updateBookingCommentsStatus($entityManager,$booking,'TEST 2','TEST 2');

$TMPbooking 	 = getBookingByID($entityManager,1); 
$bookingSerives  = getBookingService($entityManager,1);

loadFeesToSession($entityManager);
$std_Fee =  getSBS_STD_FEE();

$arrayFeesArray = array (); 
array_push($arrayFeesArray,$std_Fee);
addBookingFees($entityManager,$booking,$arrayFeesArray);


// Loads Regions to session // This should be done at the view but anyway
loadRegionsToSession($entityManager);

//(Array) Loads all the regions together with its prices check DTO/RegionServicePriceDTO
$servicePriceArray = loadRegionServicePrices($entityManager);

foreach ($servicePriceArray as &$priceItemDTO){	
	if($priceItemDTO!=NULL)
	 	echo "\n".$priceItemDTO->toString();
}

$_SESSION['service_prices_array'] = $servicePriceArray;

//Once all the services and prices are loaded to the session, you can always query  the array **getServiceDTOfromArray** for any item
$priceItemDTO = getServiceDTOfromArray($entityManager,'Randburg','S-Curl',$_SESSION['service_prices_array']);
echo "\n".$priceItemDTO->getPriceString();

//The $priceItemDTO has reference id to the Service Region id that you can use if you want the action abject
$serviceRegion = getServiceRegionByID($entityManager,$priceItemDTO->getRegionServiceId());
echo "\n".$serviceRegion->getRegionServiceId();

$serviceRegionPrice = getServiceRegionPriceByID($entityManager,$priceItemDTO->getRegionServicePriceId());
echo "\n".$serviceRegionPrice->getAmount();

updateBookingView($entityManager,$booking,$priceItemDTO);
removeBookingFees($entityManager,$booking);

//createBookingAddress($entityManager,$booking,$clientBookingAddress);

/*$address = new Address();
$address->setAddedBy('Sibusiso Radebe');
$address->setCityName('Midrand');
$address->setComplexName('44 Shana Park');
$address->setDateAdded(new DateTime());
$address->setLatitude('1');
$address->setLongitude('1');
$address->setProvinceName('GP');*/