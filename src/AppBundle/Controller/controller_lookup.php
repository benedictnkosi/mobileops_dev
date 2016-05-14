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
