<?php

require_once(__DIR__.'/../../../bootstrap.php');
require_once(__DIR__.'/../../../app/application.php');

/*required entities*/
require_once(__DIR__.'/../Entity/LuFee.php');
require_once(__DIR__.'/../Entity/Booking.php');
require_once(__DIR__.'/../Entity/BookingFees.php');
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
require_once(__DIR__.'/../Entity/RegionServicePrice.php');
require_once(__DIR__.'/../DTO/RegionServicePriceDTO.php');
//require_once(__DIR__.'/../Entity/BookingService.php');


require_once('controller_lookup.php');

function loadFeesToSession($entityManager){
	$activeLookups = getAllActiveLookupsByClass($entityManager,'LuFee');
	foreach ($activeLookups as $value) {
		$_SESSION[$value->getName()] = $value;
	}
}

function loadRegionsToSession($entityManager){
	$_SESSION['active_regions_array'] = getAllActiveLookupsByClass($entityManager,'LuRegion');
}

function getSBS_STD_FEE(){
	return ($_SESSION['SBS_STD_FEE']);
}

function feeToString($fee){
	return "FEE;".$fee->getName().";".$fee->getFeeAmount();
}

function loadRegionServicePrices($entityManager){

	$regionServicePriceDTOArray = array ();

	try {
		$activeRegionServices            = $entityManager->getRepository('RegionService')->findBy(array('active' => TRUE));

		foreach ($activeRegionServices as &$value) {
				
			try {

				$regionServicePrice        = $entityManager->getRepository('RegionServicePrice')->findOneBy(array('active' => TRUE,'regionService' => $value));

				if($regionServicePrice!=NULL){
						
					$regionServicePriceDTO = new RegionServicePriceDTO();
						
					$regionServicePriceDTO->setDiscountPercentage($regionServicePrice->getDiscountPercentage());
					$regionServicePriceDTO->setServiceAmount($regionServicePrice->getAmount());
						
					$regionServicePriceDTO->setRegion($value->getRegion()->getName());
					$regionServicePriceDTO->setServiceName($value->getService()->getName());
						
					$regionServicePriceDTO->setRegionServiceId($value->getRegionServiceId());
					$regionServicePriceDTO->setRegionServicePriceId($regionServicePrice->getRegionServicePriceId());

					array_push($regionServicePriceDTOArray, $regionServicePriceDTO);
				}
					
			} catch (Exception $e) {
				echo "\n".$e->getTraceAsString();
			}

		}

		return $regionServicePriceDTOArray;

	} catch (Exception $e) {
		echo "Failed to load lookups ".$e->getTraceAsString();
	}

	return NULL;
}


function addBookingFees($entityManager,$booking,$feesArrays){

	if($feesArrays==NULL){
		echo 'no Fees to add';
		return NULL;
	}
	if($booking==NULL){
		echo 'no Booking is null';
		return NULL;
	}

	foreach ($feesArrays  as &$value) {

		$bookingFees = new BookingFees();

		$bookingFees->setActive(1);
		$bookingFees->setBooking($booking);
		$bookingFees->setDateAdded(new DateTime());
		$bookingFees->setFee($value);

		$entityManager->persist($bookingFees);
		$entityManager->flush(); // I'll remove this later
	}
}

function getBookingFees($entityManager,$booking){

	try {

		$bookings_fees_array = array ();
		$entityManager->getRepository('BookingFees')->findBy(array('booking' => $booking,'active' => TRUE));

		foreach ($user_bookings as &$value) {
			array_push($bookings_fees_array, $value);
		}

		return $bookings_fees_array;

	} catch (Exception $e) {
		echo $e->getTrace();
	}
}

function getBookingServices($entityManager,$booking){

	try {
		$activeBookingServices      = $entityManager->getRepository('BookingServiceRegion')->findBy(array('booking' =>$booking,'active' => TRUE));
		$activeBookingServicesArray = array ();

		foreach ($activeBookingServices as $value) {
			array_push($activeBookingServicesArray,$value);
		}

		return $activeBookingServicesArray;

	} catch (Exception $e) {
		echo 'Failed to load active services for booking ';
	}

	return NULL;
}

function getBookingService($entityManager,$bookingServiceRegionId){

	try {
		return $entityManager->getRepository('BookingServiceRegion')->findOneBy(array('active' => TRUE,'bookingServiceRegionId' => $bookingServiceRegionId));
	} catch (Exception $e) {
		echo $e->getMessage();
		echo 'Failed to load active service for booking ';
	}

	return NULL;
}

function updateBookingServiceStatus($entityManager,$bookingServiceRegionObject,$newStatus){

	try {
		$bookingServiceRegion->setActive($newStatus);
		$entityManager->persist($bookingServiceRegionObject);
		$entityManager->flush();

	} catch (Exception $e) {
	}
}

function updateBookingServiceRating($entityManager,$bookingServiceRegionObject,$newRating){

	try {

		$bookingServiceRegion->setRating($newRating);

		$entityManager->persist($bookingServiceRegionObject);
		$entityManager->flush();

		return $bookingServiceRegionObject;

	} catch (Exception $e) {
		echo $e->getTrace();
	}

	return NULL;
}

function getServiceDTOfromArray($entityManager,$regionName,$serviceName,$servicePriceDTOArray){

	try {
		foreach ($servicePriceDTOArray as &$priceItemDTO){
			
			if($priceItemDTO!=NULL){
				if($priceItemDTO->equals($regionName,$serviceName)){
					return $priceItemDTO;
				}
			}
		}
				
		return NULL;
		
	} catch (Exception $e) {
		echo $e->getTrace();
	}
	
	return NULL;
}

function getServiceRegionByID($entityManager,$regionServiceId){
	try {
		return $entityManager->getRepository('RegionService')->findOneBy(array('active' => TRUE,'regionServiceId' => $regionServiceId));
	} catch (Exception $e) {
		echo $e->getTrace();		
	}
	return NULL;	
}

function getServiceRegionPriceByID($entityManager,$regionServicePriceId){
	try {
		return $entityManager->getRepository('RegionServicePrice')->findOneBy(array('active' => TRUE,'regionServicePriceId' => $regionServicePriceId));
	} catch (Exception $e) {
		echo $e->getTrace();		
	}
	return NULL;	
}

function removeBookingFees($entityManager,$booking){
	$bookingFees = $entityManager->getRepository('BookingFees')->findBy(array('booking' => $booking,'active' => TRUE));
 	 foreach ($bookingFees as &$value) {
		$value->setActive(0);
		$entityManager->persist($value);
	  }
	$entityManager->flush();		
}

function updateBookingView($entityManager,$booking,$regionServicePriceDTO){
	
	$bookingSummaryView = getBookingSummaryByBooking($entityManager,$booking);
	
	return updateBookingViewFromBookingSummaryView($entityManager,$bookingSummaryView,$regionServicePriceDTO);
}

function updateBookingViewFromBookingSummaryView($entityManager,$bookingSummaryView,$regionServicePriceDTO){
	
	try {		

	  $bookingSummaryView->setServiceName($regionServicePriceDTO->getServiceName());
	  $bookingSummaryView->setServiceAmount($regionServicePriceDTO->getServiceAmount());
	  $bookingSummaryView->setDiscountPercentage($regionServicePriceDTO->getDiscountPercentage());
	  $bookingSummaryView->setRegionServiceId($regionServicePriceDTO->getRegionServiceId());
	  $bookingSummaryView->setRegionServicePriceId($regionServicePriceDTO->getRegionServicePriceId());
	  $bookingSummaryView->setRegion($regionServicePriceDTO->getRegion());
	  
	  $entityManager->persist($bookingSummaryView);
	  $entityManager->flush();	  
	  
	} catch (Exception $e) {
	  echo $e->getTrace();		
	}
	
	return $bookingSummaryView;
}
 
