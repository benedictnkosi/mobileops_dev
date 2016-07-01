<?php
/**
 * Created by PhpStorm.
 * User: sibusiso87rn
 * Date: 2016/06/16
 * Time: 11:11 AM
 */


require_once(__DIR__.'/../Entity/LuService.php');
require_once(__DIR__.'/../Entity/LuServiceType.php');
require_once(__DIR__.'/../Entity/PartnerServicePrice.php');
require_once(__DIR__.'/../Entity/PartnerService.php');
require_once(__DIR__.'/../Dto/PartnerServicePriceDTO.php');

require_once(__DIR__.'/../../../bootstrap.php');
require_once(__DIR__.'/../../../app/application.php');

require_once(__DIR__.'/../Controller/controller_lookup.php');
require_once(__DIR__.'/../Controller/controller_client_profile.php');

function addPartnerService($entityManager,$stringServiceName,$partnerProfileId){

    try{

        $serviceToAdd   = getActiveLookupByName($entityManager,'LuService',$stringServiceName);

        if($serviceToAdd==NULL){
            echo "Service not found ".$stringServiceName." \n";
            return NULL;
        }

        $partnerProfile = getClientProfileById($entityManager,$partnerProfileId);

        if($partnerProfile==NULL){
            echo "Partner with id [ ".$partnerProfileId." ] not found \n";
            return NULL;
        }

        $hasService     = hasService($entityManager,$stringServiceName,$partnerProfileId);
        if($hasService){
            echo "Service Already Exist For Partner";
            return NULL;
        }

        $partnerService = new PartnerService();

        $partnerService->setActive(1);
        $partnerService->setDateAdded(new DateTime());
        $partnerService->setService($serviceToAdd);
        $partnerService->setPartnerProfile($partnerProfile);

        $entityManager->persist($partnerService);
        $entityManager->flush();

        return $partnerService;
    }catch(Exception $e){

        echo "".$e->getTraceAsString();
    }

}

function getPartnerServices($entityManager,$partnerProfileId){

    try{
	//echo 'partnerProfileId ' . $partnerProfileId;
        $partnerServicesArray =  array();
        $partnerProfile       = getClientProfileById($entityManager,$partnerProfileId);
        $partnerServices      = $entityManager->getRepository('PartnerService')->findBy(array('partnerProfile' => $partnerProfile));

        foreach ( $partnerServices as &$partnerService ){
            array_push($partnerServicesArray,$partnerService);
        }

        return $partnerServicesArray;

    }catch(Exception $e){

        echo "".$e->getTraceAsString();
    }
}


function getPartnerServicesOrderByServiceType($entityManager,$partnerProfileId){

	try{
		//echo 'partnerProfileId ' . $partnerProfileId;
		$partnerServicesArray =  array();
		$dql = "Select ps, s, st From PartnerService ps JOIN ps.service s JOIN s.serviceTypeName st
				where ps.partnerProfile = " . $partnerProfileId . " and ps.active = 1 Order By st.name ASC";
		
		$query = $entityManager->createQuery ( $dql);
		
		$partnerServices = $query->getResult ();
		
		foreach ( $partnerServices as &$partnerService ){
			array_push($partnerServicesArray,$partnerService);
		}

		return $partnerServicesArray;

	}catch(Exception $e){

		echo "".$e->getTraceAsString();
	}
}


function getPartnerServicesByStatus($entityManager,$partnerProfileId,$boolStatus){

    try{

        $partnerServicesArray =  array();
        $partnerProfile       = getClientProfileById($entityManager,$partnerProfileId);
        $partnerServices      = $entityManager->getRepository('PartnerService')->findBy(array('partnerProfile' => $partnerProfile,'active' =>$boolStatus));

        foreach ( $partnerServices as &$partnerService ){
            array_push($partnerServicesArray,$partnerService);
        }

        return $partnerServicesArray;

    }catch(Exception $e){

        echo "".$e->getTraceAsString();
    }
}

function getPartnerServiceById($entityManager,$partnerServiceId){

    try{
        $partnerService      = $entityManager->getRepository('PartnerService')->findOneBy(array('partnerServiceId' => $partnerServiceId));
        return $partnerService;
    }catch(Exception $e){
        echo "".$e->getTraceAsString();
    }

    return NULL;
}

function getPartnerServicePrices($entityManager,$partnerProfileId){

    $partnerServicesArray      = getPartnerServices($entityManager,$partnerProfileId);
    $partnerServicePricesArray =  array();

    foreach ( $partnerServicesArray as &$partnerService){
        $partnerServicePrice      = $entityManager->getRepository('PartnerServicePrice')->findOneBy(array('partnerService' => $partnerService));
        array_push($partnerServicePricesArray,$partnerServicePrice);
    }

    return $partnerServicePricesArray;
}

function getPartnerServicePricesByStatus($entityManager,$partnerProfileId,$boolStatus){

    $partnerServicesArray      = getPartnerServicesByStatus($entityManager,$partnerProfileId,$boolStatus);
    $partnerServicePricesArray =  array();

    foreach ( $partnerServicesArray as &$partnerService){
    	
        $partnerServicePrice   = $entityManager->getRepository('PartnerServicePrice')->findOneBy(array('partnerService' => $partnerService, 'active' => $boolStatus));
        
        array_push($partnerServicePricesArray,$partnerServicePrice);
    }

    return $partnerServicePricesArray;
}

function getPartnerServicePriceByPartnerServiceId($entityManager,$partnerServiceId){
    $partnerService        = getPartnerServiceById($entityManager,$partnerServiceId);
    $partnerServicePrice   = $entityManager->getRepository('PartnerServicePrice')->findOneBy(array('partnerService' => $partnerService,'active' => true));

    return $partnerServicePrice;
}

function getPartnerServicesSummaryByStatus($entityManager,$partnerProfileId,$boolStatus){

	$partnerServicesArray         = getPartnerServicesByStatus($entityManager,$partnerProfileId,$boolStatus);
	$partnerServicePriceDTOArray  = array();
	
	foreach ( $partnerServicesArray as &$partnerServiceTMP){

		$partnerServicePrice    = $entityManager->getRepository('PartnerServicePrice')->findOneBy(array('partnerService' => $partnerServiceTMP, 'active' => $boolStatus));
		
		//$partnerService       = $partnerServicePrice->getPartnerService();
		$partnerService         = $partnerServiceTMP;
		$partnerServicePriceDTO = new PartnerServicePriceDTO();

		$partnerServicePriceDTO->setPartnerProfileId($partnerProfileId);
		$partnerServicePriceDTO->setPartnerServiceDateAdded($partnerService->getDateAdded());
		$partnerServicePriceDTO->setPartnerServiceId($partnerService->getPartnerServiceId());
		$partnerServicePriceDTO->setPartnerServicePriceDateAdded($partnerServicePrice->getDateAdded());
		$partnerServicePriceDTO->setPartnerServicePriceId($partnerServicePrice->getPartnerServicePriceId());
		$partnerServicePriceDTO->setPartnerServicePriceStatus($partnerServicePrice->getActive());
		$partnerServicePriceDTO->setPartnerServiceStatus($partnerService->getActive());
		$partnerServicePriceDTO->setServiceAmount($partnerServicePrice->getAmount());
		$partnerServicePriceDTO->setServiceName($partnerService->getPartnerServiceId());

		array_push($partnerServicePriceDTOArray,$partnerServicePriceDTO);

	}

	return $partnerServicePriceDTOArray;
}

function changePartnerServiceStatus($entityManager,$partnerServiceId,$newBoolStatus){

    $partnerService  = $entityManager->getRepository('PartnerService')->findOneBy(array('partnerServiceId' => $partnerServiceId));

    if($partnerService!=NULL){

        $partnerService->setActive($newBoolStatus);
        $entityManager->persist($partnerService);
        $entityManager->flush();

        return $partnerService;

    }else{
        return NULL;
    }
}

function changePartnerServicePriceStatus($entityManager,$partnerServicePriceId,$newBoolStatus){

    $partnerServicePrice      = $entityManager->getRepository('PartnerServicePrice')->findOneBy(array('partnerServicePriceId' => $partnerServicePriceId));

    if($partnerServicePrice!=NULL){
        $partnerServicePrice->setActive($newBoolStatus);
        $entityManager->persist($partnerServicePrice);
        $entityManager->flush();

        return $partnerServicePrice;
    }else{
        return NULL;
    }
}

function changePartnerServicePriceStatusByPartnerService($entityManager,$partnerServiceId,$newBoolStatus){

    $partnerServicePrice = getPartnerServicePriceByPartnerServiceId($entityManager,$partnerServiceId);

    if($partnerServicePrice!=NULL){
        return changePartnerServicePriceStatus($entityManager,$partnerServicePrice->getPartnerServicePriceId(),$newBoolStatus);
    }else{
        //echo"NULL*********partnerServicePrice";
        return NULL;
    }

}

function addPartnerServicePrice($entityManager,$amount,$partnerServiceObject){

    try{
        $partnerServicePriceObject = changePartnerServicePriceStatusByPartnerService($entityManager,$partnerServiceObject->getPartnerServiceId(),false);
    }catch (Exception $e){
        echo "".$e->getTraceAsString();
    }finally{

        $partnerServicePrice = new PartnerServicePrice();

        $partnerServicePrice->setAmount($amount);
        $partnerServicePrice->setDateAdded(new DateTime());
        $partnerServicePrice->setPartnerService($partnerServiceObject);
        $partnerServicePrice->setActive(1);

        $entityManager->persist($partnerServicePrice);
        $entityManager->flush();

        return $partnerServicePrice;
    }
}

function addPartnerServicePriceByPartnerServiceId($entityManager,$amount,$partnerServiceId){
    $partnerServiceObject      = getPartnerServiceById($entityManager,$partnerServiceId);
    return addPartnerServicePrice($entityManager,$amount,$partnerServiceObject);
}

function hasService($entityManager,$stringServiceName,$partnerProfileId){

    try{
        $partnerService      = $entityManager->getRepository('PartnerService')->findOneBy(array('service' => $stringServiceName, 'partnerProfile' => $partnerProfileId));
        if($partnerService!=NULL){
            return true;
        }

    }catch(Exception $e){
        echo "".$e->getTraceAsString();
    }

    return false;

}

?>