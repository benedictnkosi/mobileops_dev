<?php
require_once(__DIR__.'/../../../bootstrap.php');
require_once(__DIR__.'/../../../app/application.php');


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
require_once(__DIR__.'/../../../src/AppBundle/Entity/RegionService.php');
require_once(__DIR__.'/../../../src/AppBundle/Entity/RegionServicePrice.php');
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



$lookupsArray  = getAllActiveLookupsByClass($entityManager,'LuRegion');
$region          = getActiveLookupByName($entityManager,'LuRegion','GAUTENG');
echo $region->getName()." \n";

$date = new DateTime();
echo "Start: ".$date->format('Y-m-d\TH:i:s');

$regionService      = getRegionService($entityManager,"GAUTENG","Relax With Organic");
echo $regionService->getRegionServiceId()." \n";
     $regionService->setActive(0);
     $entityManager->persist($regionService);
     $entityManager->flush();

$regionServicePrice = getRegionServicePrice($entityManager,326);
echo $regionServicePrice->getAmount()." \n";

addRegionServicePrice($entityManager,$regionService,10000,"Mugabe");

for ($i =0; $i < 100; $i++){

    //getAllLookupsByClass($entityManager, 'RegionService');
    //getAllLookupsByClass($entityManager, 'RegionServicePrice');
}

$date = new DateTime();
echo "End: ".$date->format('Y-m-d\TH:i:s');

$luService = getActiveLookupByName($entityManager,'LuService',"Back Massage");
$luRegion  = getActiveLookupByName($entityManager,'LuRegion',"Gauteng");

/*if(!$luService){
    $response['status'] = 2;
    $response['message'] = 'Service Not Found';
    echo json_encode($response);
    //return;
}

if(!$luRegion){
    $response['status'] = 2;
    $response['message'] = 'Region Not Found';
    echo json_encode($response);
    //return;
}

echo $luRegion->getName();
echo $luService->getName();


$regionService = getRegionService($entityManager,"Gauteng","Back Massage");

if(!$regionService){
    $response['status'] = 2;
    $response['message'] = 'Region Service Not Found';
    echo json_encode($response);
    //return;
}

if($regionService){
    echo "removing " . $regionService->getService()->getName();
    $regionService.setActive(0);
    $entityManager->persist($regionService);
    $entityManager->flush();
}else{
    echo 'region service not found for delte';
}*/