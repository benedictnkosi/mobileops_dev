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
require_once(__DIR__.'/../../../src/AppBundle/Entity/LuRegion.php');
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
	$_SESSION['email_address'] 	= 'partner@mobileops.co.za';
	$_SESSION['gender']			= 'MALE';
	$_SESSION['phone_number']	= '0733534567';

	$_SESSION['address_id'] 	    = 10;
	$_SESSION['booking_user']		= 'Sibusiso Radebe'; //Used to update the booking creation user, can be null if not provided
	$_SESSION['booking_comments']	= 'Booking comments';
	$_SESSION ['user_id'] = 7;

}

initializeSession();
//echo getFaq($entityManager);

$bookingUserProfile = new BookingUserProfile();

$bookingUserProfile->setActive(1);
$bookingUserProfile->setFirstName($_SESSION['firstname']);
$bookingUserProfile->setSurname($_SESSION['surname']);
$bookingUserProfile->setEmailAddress($_SESSION['email_address']);
$bookingUserProfile->setPhoneNumber($_SESSION['phone_number']);
$bookingUserProfile->setGender($_SESSION['gender']);

$_SESSION['booking_user_profile'] = $bookingUserProfile;

$user = $entityManager->getRepository('User')->findOneBy(array('userId' => '7'));
echo  $user->getUserUserRole();
echo  "\n";

$_SESSION['user'] = $user;
$_SESSION['booking_user_profile'] = $bookingUserProfile;

echo $bookingUserProfile->getFirstName();
echo  "\n";

$booking 			  = getBookingByBookingId($entityManager,134);

$booking 			  = createMasterBooking($entityManager);
$bookingBookingStatus = createBookingBookingStatus($entityManager,$booking,'BOOKING_ACTIVE');
echo $booking->getBookingGuid();

//$booking 			  = getBookingByIDAndUUID($entityManager,$booking->getBookingId(),$booking->getBookingGuid());

$clientBookingAddress = $entityManager->getRepository('Address')->findOneBy(array('addressId' => '87'));
echo  '$clientBookingAddress->getStreetName()' + $clientBookingAddress->getStreetName();
echo  "\n";

$bookingAddress			= createBookingAddress($entityManager,$booking,$clientBookingAddress);
echo '$bookingAddress->getActive()' + $bookingAddress->getActive();
echo  "\n";

$bookingUserProfile = createBookingUserProfile($entityManager,$booking,$_SESSION['phone_number'],$_SESSION['gender'],$_SESSION['surname'],$_SESSION['firstname'],$_SESSION['email_address']);
$bookingUserProfile = getBookingUserProfile($entityManager,$booking);
echo $bookingUserProfile->getSurname();
echo  "\n";

$bookingUserProfile = updateBookingUserProfile($entityManager,$bookingUserProfile,$_SESSION['phone_number'],$_SESSION['gender'],$_SESSION['surname'],$_SESSION['firstname'],$_SESSION['email_address']);
echo $bookingUserProfile->getSurname();

//$activeBookingAddress	= getActiveBookingAddress($entityManager,$booking);
//echo json_encode(addressToString($activeBookingAddress->getClientAddress()));

$newBookingAddress = changeBookingAddress($entityManager,$booking,$clientBookingAddress);
$newBookingAddress = changeBookingAddress($entityManager,$booking,$clientBookingAddress);

$TMPbooking 	     = getBookingByID($entityManager,134);

$newBookingTime		 = changeBookingTime($entityManager,$booking,new DateTime(),new DateTime());
//$newBookingTime	 = changeBookingTime($entityManager,$booking,new DateTime(),new DateTime());
//echo $newBookingTime->getActive();

$bookingBookingStatus	= getActiveBookingStatus($entityManager,$booking);

$bookingView = createOrUpdateBookingSummary($entityManager,$booking,$newBookingTime,$clientBookingAddress,$_SESSION['email_address'],$_SESSION['phone_number'],'BOOKING_ACTIVE',$bookingUserProfile);
//changeBookingStatus($entityManager,$booking,'BOOKING_CANCELED');
//createOrUpdateBookingSummary($entityManager,$booking,$newBookingTime,$clientBookingAddress,$_SESSION['email_address'],'BOOKING_NOT_ACTIVE',$bookingUserProfile);

//$bookingComments = addBookingComments($entityManager,$booking,'TEST','TEST');
//$bookingComments = getBookingCommentsForBooking($entityManager,$booking);
//$bookingComments = updateBookingCommentsStatus($entityManager,$booking,'TEST 2','TEST 2');


$bookingSerives  = getBookingService($entityManager,134);

loadFeesToSession($entityManager);
$std_Fee =  getSBS_STD_FEE();

$arrayFeesArray = array ();
array_push($arrayFeesArray,$std_Fee);
addBookingFees($entityManager,$booking,$arrayFeesArray);

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

$bookingServiceRegion = addBookingRegionServiceRegionService($entityManager,$priceItemDTO,$booking,$_SESSION['booking_comments'],'4');
$bookingServiceRegion = addBookingRegionServiceRegionService($entityManager,$priceItemDTO,$booking,$_SESSION['booking_comments'],'5');

$serviceRegionPrice = getServiceRegionPriceByID($entityManager,$priceItemDTO->getRegionServicePriceId());
echo "\n".$serviceRegionPrice->getAmount();

//changeBookingRegionServiceStatus($entityManager,$bookingServiceRegion,FALSE);

//updateBookingView($entityManager,$booking,$priceItemDTO);
//removeBookingFees($entityManager,$booking);
//getBookingRegionServiceByBooking($entityManager,$booking);

$bookingsResultsList = getBookingByDate($entityManager, new DateTime());

foreach ($bookingsResultsList as &$value){
	echo "Time is: ".$value->getTimeBooked()->format('Y-m-d\TH:i:s');
	echo "\n";
}

$bookingsResultsList = getBookingByDateAndUser($entityManager, new DateTime(),$user);

foreach ($bookingsResultsList as &$value){
	echo "Time is: ".$value->getTimeBooked()->format('Y-m-d\TH:i:s');
	echo "\n";
}


$bookingsResultsList = getBookingListByBookingStatus($entityManager,"BOOKING_ACTIVE");

foreach ($bookingsResultsList as &$value){
	echo "User is: ".$value->getUser()->getEmailAddress()."\t ";
	echo "\n";
}


$bookingsResultsList = getBookingSummaryListByBookingStatus($entityManager,'BOOKING_ACTIVE');

foreach ($bookingsResultsList as &$value){
	echo "User is: ".$value->getFirstName()."\t ";
	echo "\n";
}


/*$activeRegions      		= $entityManager->getRepository('LuRegion')->findBy(array('active' => TRUE));

foreach ($activeRegions as &$region) {

	$amount = 100;

	$activeServices     	= $entityManager->getRepository('LuService')->findBy(array('active' => TRUE));

		foreach ($activeServices as &$service) {

			$regionService 	= new RegionService();

			$regionService->setActive(1);
			$regionService->setDateAdded(new DateTime());
			$regionService->setRegion($region);
			$regionService->setService($service);

			$entityManager->persist($regionService);
			$entityManager->flush();

			$regionServicePrice = new RegionServicePrice();
			$regionServicePrice->setDateAdded(new DateTime());
			$regionServicePrice->setRegionService($regionService);
			$regionServicePrice->setActive(1);
			$regionServicePrice->setAmount($amount++);

			$entityManager->persist($regionServicePrice);
			$entityManager->flush();
		}
    }

*/

/*$partnerUserList   	  		= $entityManager->getRepository('User')->findBy(array('active' => TRUE,'userUserRole' => 'PARTNER'));
foreach ($partnerUserList as &$region) {

	$activeServices     	= $entityManager->getRepository('LuService')->findBy(array('active' => TRUE));

	foreach ($activeServices as &$service) {
		$userUserService  = new UserUserService();

		$userUserService->setActive(1);
		$userUserService->setDateAdded(new DateTime());
		$userUserService->setUserUserServiceName($service);

		$entityManager->persist($userUserService);
		$entityManager->flush();
	}

}

*/

//createBookingAddress($entityManager,$booking,$clientBookingAddress);

/*$address = new Address();
$address->setAddedBy('Sibusiso Radebe');
$address->setCityName('Midrand');
$address->setComplexName('44 Shana Park');
$address->setDateAdded(new DateTime());
$address->setLatitude('1');
$address->setLongitude('1');
$address->setProvinceName('GP');*/
$bookingSummaryView = new BookingSummaryView();
$bookingSummaryView->setBookingId($booking->getBookingId());
