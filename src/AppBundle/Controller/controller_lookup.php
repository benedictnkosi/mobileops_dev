<?php

require_once(__DIR__.'/../../../bootstrap.php');

require_once(__DIR__.'/../../../app/application.php');

require_once(__DIR__.'/../Entity/LuFee.php');

require_once(__DIR__.'/../Entity/LuAccountStatus.php');

require_once(__DIR__.'/../Entity/LuBookingStatus.php');

require_once(__DIR__.'/../Entity/LuFee.php');

require_once(__DIR__.'/../Entity/LuRegion.php');

require_once(__DIR__.'/../Entity/LuRemark.php');

require_once(__DIR__.'/../Entity/LuUserRole.php');

require_once(__DIR__.'/../Entity/LuService.php');

require_once(__DIR__.'/../Entity/LuServiceType.php');

require_once(__DIR__.'/../Entity/LuUserRight.php');

require_once(__DIR__.'/../Entity/LuUserRole.php');

require_once(__DIR__.'/../Entity/RegionService.php');

require_once(__DIR__.'/../Entity/LuDatechangeReasons.php');

require_once(__DIR__.'/../Entity/RegionServicePrice.php');







function getAllLookupsByClass($entityManager,$lookupClass){

	try {


		$activeLookups = $entityManager->getRepository($lookupClass)->findAll();

		$activeLookupsArray = array ();


		foreach ($activeLookups as &$value) {
			

			array_push($activeLookupsArray,$value);

		}

		

		return $activeLookupsArray;

		

	} catch (Exception $e) {

		echo 'Failed to load lookups ' + $lookupClass;

	}

	return NULL;

}

function getAllActiveLookupsByClass($entityManager,$lookupClass){

	try {

		$activeLookups = $entityManager->getRepository($lookupClass)->findBy(array('active' => TRUE));

		

		$activeLookupsArray = array ();

		foreach ($activeLookups as &$value) {

			

			array_push($activeLookupsArray,$value);

		}

		

		return $activeLookupsArray;

	} catch (Exception $e) {

		echo 'Failed to load lookups ' + $lookupClass;

	}

	return NULL;

}

function getActiveLookupByName($entityManager,$lookupClass,$lookupName){

	try {

		return $entityManager->getRepository($lookupClass)->findOneBy(array('active' => TRUE,'name' => $lookupName));

	} catch (Exception $e) {

		echo 'Failed to load lookups ' + $lookupClass;

	}

}

// Cant use this because doctrine doesnt allow to set primary keys, we will need to disable them

function addLookupBasic($entityManager,$lookupClassName,$lookupValue){

    $lookup      = NULL;

    $user_id     = NULL;

	try{

        if (isset ( $_SESSION ['user_id'] )){

            $user_id = $_SESSION ['user_id'];

        }

        switch ($lookupClassName) {

            case "LuAccountStatus":

                $lookup = new LuAccountStatus();

				break;

			case "LuBookingStatus":

                $lookup = new LuBookingStatus();

				break;

			case "LuUserRole":

				$lookup = new LuUserRole();

				break;

			case "LuServiceType":

                $lookup = new LuServiceType();

				break;

			case "LuUserRight":

                $lookup = new LuUserRight();

				break;

			default:

				echo "Your favorite lookup is not here!";

		}

        if($lookup!=NULL){

            $lookup->setDateCreated(new DateTime());

            $lookup->setActive(true);

            $lookup->setAddedBy($user_id);

            $entityManager->persist($lookup);

            $entityManager->flush();

        }

	}

	catch (Exception $e){

		echo "Failed to add lookup ".$lookupName." ".$e->getTraceAsString();

		return 'FAIL';

	}

    return $lookup;

}





function getAllLookupsNamesByClass($entityManager,$lookupClass){

	try {

		$activeLookups      = $entityManager->getRepository($lookupClass)->findAll();

		$activeLookupsArray = array ();



		foreach ($activeLookups as &$value) {

			array_push($activeLookupsArray,$value->getName());

		}



		return $activeLookupsArray;



	} catch (Exception $e) {

		echo 'Failed to load lookups ' + $lookupClass;

	}

	return NULL;

}



function getAllActiveLookupsNamesByClass($entityManager,$lookupClass){



	try {



		$activeLookups = $entityManager->getRepository($lookupClass)->findBy(array('active' => TRUE));



		$activeLookupsArray = array ();

		foreach ($activeLookups as &$value) {


			array_push($activeLookupsArray,$value->getName());

		}



		return $activeLookupsArray;



	} catch (Exception $e) {

		echo 'Failed to load lookups ' + $lookupClass;

	}



	return NULL;

}







function addRegionServicePrice($entityManager,$regionServiceObject,$amount,$addingUser){



	try{



		$regionServicePrice =  new RegionServicePrice();



		$regionServicePrice->setActive(1);

		$regionServicePrice->setRegionService($regionServiceObject);

		$regionServicePrice->setAmount($amount);

		$regionServicePrice->setDateAdded(new DateTime());

		$regionServicePrice->setUserAdded($addingUser);



		$entityManager->persist($regionServicePrice);

		$entityManager->flush();



		return $regionServicePrice;



	}catch (Exception $e) {

		echo 'Failed to load Region Service Price';

		return 'FAIL';

	}



}



function getRegionServicePrice($entityManager,$intRegionServiceId){



	try{

		return $entityManager->getRepository('RegionServicePrice')->findOneBy(array('regionServicePriceId' => $intRegionServiceId));

	}catch (Exception $e) {

		echo 'Failed to load Region Service Price';

		return 'FAIL';

	}

}



function updateRegionServicePriceStatus($entityManager,$intRegionServiceId,$newBooleanStatus){



    $regionServicePrice = getRegionServicePrice($entityManager, $intRegionServiceId);



    if(!$regionServicePrice) {

        echo 'Failed to load Region Service Price';



        return 'FAIL';

    } else {



        

        $regionServicePrice->setActive($newBooleanStatus);





        $entityManager->persist($regionServicePrice);

        $entityManager->flush();



        return $regionServicePrice;

    }



}



function getRegionService($entityManager,$regionString,$serviceString){



	try{



		return $entityManager->getRepository('RegionService')->findOneBy(array('region' => $regionString,'service' => $serviceString));

	}catch (Exception $e) {

		echo 'Failed to load Region Service Price';

		return 'FAIL';

	}



}



/*

 * Expecting an array of RegionServiceDTO

 *

 * e.g $regionServiceDTO = new RegionServiceDTO();

 *     $regionServiceDTO->setCreatedBy($createdBy);

 *     $regionServiceDTO->setRegionString($region);

 *     $regionServiceDTO->getServiceString($service);

 *

 *     push into some array as many as you like..

 * */

function addRegionServicesFromArrayString($entityManager,$regionServiceArray){



	$resultsArray = array ();



	foreach($regionServiceArray as &$value){



		$results = addRegionServiceString($entityManager,$value->getRegionString(),$value->getServiceString(),$value->getCreatedBy());



		if('FAIL'===$results){

			array_push($resultsArray,$value->getRegionString()." - ".$value->getServiceString()." - FAIL");

		}else{

			array_push($resultsArray,$value->getRegionString()." - ".$value->getServiceString()." - PASS");

		}

	}



	return $resultsArray;

}





function addRegionServiceString($entityManager,$regionString,$serviceString,$addedBy){



	$region  = getActiveLookupByName($entityManager,'LuRegion',$regionString);

	$service = getActiveLookupByName($entityManager,'LuService',$serviceString);



	if($region!=NULL && $service !=NULL){



		return addRegionServiceObjects($entityManager,$region,$service,$addedBy);

	}else{

		return 'FAIL';

	}



}



function addRegionServiceObjects($entityManager,$regionObject,$serviceObject,$addedBy){



	try{





		$regionService = new RegionService();



		$regionService->setActive(1);

		$regionService->setDateAdded(new DateTime());

		$regionService->setRegion($regionObject);

		$regionService->setService($serviceObject);

		$regionService->setAddedBy($addedBy);



		$entityManager->persist($regionService);

		$entityManager->flush();



		return $regionService;



	}catch (Exception $e){



		echo 'Failed to load Region Service';

		return 'FAIL';

	}

}



//function



// Cant use this because doctrine doesnt allow to set primary keys, we will need to disable them

/*

 * function addLookupBasic($entityManager,$lookupClassName,$lookupValue){



 $lookup      = NULL;

 $user_id     = NULL;



 try{



 if (isset ( $_SESSION ['user_id'] )){

 $user_id = $_SESSION ['user_id'];

 }



 switch ($lookupClassName) {



 case "LuAccountStatus":

 $lookup = new LuAccountStatus();

 break;

 case "LuBookingStatus":

 $lookup = new LuBookingStatus();

 break;

 case "LuUserRole":

 $lookup = new LuUserRole();

 break;

 case "LuServiceType":

 $lookup = new LuServiceType();

 break;

 case "LuUserRight":

 $lookup = new LuUserRight();

 break;

 default:

 echo "Your favorite lookup is not here!";

 }



 if($lookup!=NULL){



 $lookup->setDateCreated(new DateTime());

 $lookup->setActive(true);

 $lookup->setAddedBy($user_id);



 $entityManager->persist($lookup);

 $entityManager->flush();

 }

 }

 catch (Exception $e){

 echo "Failed to add lookup ".$lookupName." ".$e->getTraceAsString();

 return 'FAIL';

 }



 return $lookup;



 }*/





