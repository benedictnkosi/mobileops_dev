<?php
require_once(__DIR__.'/../../bootstrap.php');
require_once(__DIR__.'/../../config/application.php');
/*required entities*/

/*required entities*/
require_once(__DIR__.'/../appbundle/Entity/LuFee.php');
require_once(__DIR__.'/../appbundle/Entity/Booking.php');
require_once(__DIR__.'/../appbundle/Entity/BookingFees.php');
require_once(__DIR__.'/../appbundle/Entity/BookingBookingStatus.php');
require_once(__DIR__.'/../appbundle/Entity/BookingAddress.php');
require_once(__DIR__.'/../appbundle/Entity/BookingTime.php');
require_once(__DIR__.'/../appbundle/Entity/User.php');
require_once(__DIR__.'/../appbundle/Entity/UserProfile.php');
require_once(__DIR__.'/../appbundle/Entity/LuAccountStatus.php');
require_once(__DIR__.'/../appbundle/Entity/LuBookingStatus.php');
require_once(__DIR__.'/../appbundle/Entity/LuUserRole.php');
require_once(__DIR__.'/../appbundle/Entity/Address.php');
require_once(__DIR__.'/../appbundle/Entity/UserUserService.php');
require_once(__DIR__.'/../appbundle/Entity/LuService.php');
require_once(__DIR__.'/../appbundle/Entity/LuServiceType.php');
require_once(__DIR__.'/../appbundle/Entity/BookingSummaryView.php');
require_once(__DIR__.'/../appbundle/Entity/BookingComments.php');
require_once(__DIR__.'/../appbundle/Entity/BookingServiceRegion.php');
require_once(__DIR__.'/../appbundle/Entity/BookingUserProfile.php');

require_once('controller_booking.php');
require_once('controller_booking_services.php');
require_once('controller_lookup.php');

session_start ();

// Loads Regions to session // This should be done at the view but anyway
loadRegionsToSession($entityManager);

//(Array) Loads all the regions together with its prices check DTO/RegionServicePriceDTO
$servicePriceArray = loadRegionServicePrices($entityManager);

$_SESSION['service_prices_array'] = $servicePriceArray;

//Once all the services and prices are loaded to the session, you can always query  the array **getServiceDTOfromArray** for any item
$priceItemDTO = getServiceDTOfromArray($entityManager,'Randburg','Treatment',$_SESSION['service_prices_array']);
echo "\n".$priceItemDTO->getPriceString();


