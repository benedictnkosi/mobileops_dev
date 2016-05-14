<?php
/**
 * Created by PhpStorm.
 * User: sibusiso87rn
 * Date: 2016/05/11
 * Time: 6:49 PM
 */

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
require_once(__DIR__.'/../../../src/AppBundle/Entity/RegionService.php');
require_once(__DIR__.'/../../../src/AppBundle/Entity/LuServiceType.php');
require_once(__DIR__.'/../../../src/AppBundle/Entity/BookingSummaryView.php');
require_once(__DIR__.'/../../../src/AppBundle/Entity/BookingComments.php');
require_once(__DIR__.'/../../../src/AppBundle/Entity/BookingServiceRegion.php');
require_once(__DIR__.'/../../../src/AppBundle/Entity/BookingUserProfile.php');
require_once(__DIR__.'/../../../src/AppBundle/Entity/RegionServicePrice.php');
require_once(__DIR__.'/../../../src/AppBundle/Controller/controller_booking.php');
require_once(__DIR__.'/../../../src/AppBundle/Controller/controller_faq.php');
require_once(__DIR__.'/../../../src/AppBundle/Controller/controller_booking_services.php');
require_once(__DIR__.'/../../../src/AppBundle/Controller/controller_lookup.php');

/*$gauteng_region = getActiveLookupByName($entityManager,'LuRegion','Gauteng');
$activeLookups  = getAllActiveLookupsByClass($entityManager,'LuService');

foreach ($activeLookups as &$value) {

    $regionService = new RegionService();
    $regionService->setDateAdded(new DateTime());
    $regionService->setActive(1);
    $regionService->setRegion($gauteng_region);
    $regionService->setService($value);

    $entityManager->persist($regionService );
    $entityManager->flush();
}*/

$activeLookups  = getAllActiveLookupsByClass($entityManager,'RegionService');

foreach ($activeLookups as &$value) {
    $amount        = 0 + rand(150,1000);

    $regionService = new RegionServicePrice();
    $regionService->setDateAdded(new DateTime());
    $regionService->setActive(1);
    $regionService->setAmount($amount);
    $regionService->setDiscountPercentage(0.0);
    $regionService->setRegionService($value);
    $entityManager->persist($regionService );
    $entityManager->flush();

}

