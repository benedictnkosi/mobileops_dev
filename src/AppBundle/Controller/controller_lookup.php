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
require_once(__DIR__.'/../Entity/LuDatechangeReasons.php');

function getAllLookupsByClass($entityManager,$lookupClass){
	try {
		$activeLookups      = $entityManager->getRepository($lookupClass)->findAll();
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