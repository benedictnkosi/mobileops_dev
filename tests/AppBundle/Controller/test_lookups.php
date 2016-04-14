<?php
require_once(__DIR__.'/../../../bootstrap.php');
require_once(__DIR__.'/../../config/application.php');

/*required entities*/
require_once(__DIR__.'/../../../src/AppBundle/Entity/LuFee.php');
require_once(__DIR__.'/../../src/AppBundle/Entity/Booking.php');
require_once(__DIR__.'/../../src/AppBundle/Entity/BookingFees.php');
require_once(__DIR__.'/../../src/AppBundle/Entity/BookingBookingStatus.php');
require_once(__DIR__.'/../../src/AppBundle/Entity/BookingAddress.php');
require_once(__DIR__.'/../../src/AppBundle/Entity/BookingTime.php');
require_once(__DIR__.'/../../src/AppBundle/Entity/User.php');
require_once(__DIR__.'/../../src/AppBundle/Entity/UserProfile.php');
require_once(__DIR__.'/../../src/AppBundle/Entity/LuAccountStatus.php');
require_once(__DIR__.'/../../src/AppBundle/Entity/LuBookingStatus.php');
require_once(__DIR__.'/../../src/AppBundle/Entity/LuUserRole.php');
require_once(__DIR__.'/../../src/AppBundle/Entity/Address.php');
require_once(__DIR__.'/../../src/AppBundle/Entity/UserUserService.php');
require_once(__DIR__.'/../../src/AppBundle/Entity/LuService.php');
require_once(__DIR__.'/../../src/AppBundle/Entity/LuServiceType.php');
require_once(__DIR__.'/../../src/AppBundle/Entity/BookingSummaryView.php');
require_once(__DIR__.'/../../src/AppBundle/Entity/BookingComments.php');
require_once(__DIR__.'/../../src/AppBundle/Entity/BookingServiceRegion.php');
require_once(__DIR__.'/../../src/AppBundle/Entity/BookingUserProfile.php');

require_once(__DIR__.'/../../src/AppBundle/Controller/controller_booking.php');
require_once(__DIR__.'/../../src/AppBundle/Controller/controller_booking_services.php');
require_once(__DIR__.'/../../src/AppBundle/Controller/controller_lookup.php');

$lookupsArray = getAllActiveLookupsByClass($entityManager,'LuRegion');
$region		  = getActiveLookupByName($entityManager,'LuRegion','Boksburg');
echo $region->getName();