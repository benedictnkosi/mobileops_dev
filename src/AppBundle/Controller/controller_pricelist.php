<?php



require_once(__DIR__.'/../../../bootstrap.php');

require_once(__DIR__.'/../../../app/application.php');



require_once(__DIR__.'/../Entity/RegionService.php');

require_once(__DIR__.'/../Entity/LuService.php');

require_once(__DIR__.'/../Entity/LuRegion.php');

require_once(__DIR__.'/../Entity/RegionServicePrice.php');

require_once(__DIR__.'/../Entity/LuServiceType.php');





if (isset ( $_GET ['getRegions'] )) {

	if ($_GET ['getRegions']) :

	getRegions($entityManager);

	endif;

}



if (isset ( $_GET ['getServiceCategoriesForRegion'] )) {

	if ($_GET ['getServiceCategoriesForRegion']) :

	getServiceCategoriesForRegion($entityManager);

	endif;

}





if (isset ( $_GET ['getPricelist'] )) {

	if ($_GET ['getPricelist']) :

	getPricelist($entityManager);

	endif;

}





function getRegions($entityManager){

	try {

		$LuRegion = $entityManager->getRepository('LuRegion')->findBy(array('active'=>1),array('name' => 'ASC'));

		$RegionArray = array ();

		if($LuRegion){

			foreach ($LuRegion as &$value) {

				array_push ( $RegionArray, $value->getName());

			}

			$response['status'] = 1;

			$response['message'] = $RegionArray;

			echo json_encode($response);

		}else{

			$response['status'] = 2;

			$response['message'] = "No regions found, please contact administrator @ " . SYSTEM_EMAIL_ADDRESS;

			echo json_encode($response);

			return;

		}



	} catch (Exception $e) {

		$response['status'] = 2;

		$response['message'] = $e->getMessage();

		echo json_encode($response);

	}



}







function getServiceCategoriesForRegion($entityManager){

	try {

		

		//$LuServiceType = $entityManager->getRepository('LuServiceType')->findBy(array(),array('name' => 'ASC'));

		$dql = "SELECT DISTINCT  st.name FROM RegionService rs JOIN rs.service s JOIN s.serviceTypeName st JOIN rs.region r

		where r.name = '" . $_GET ['getServiceCategoriesForRegion'] . "' and rs.active = 1";



		$query = $entityManager->createQuery($dql);

		$query->setMaxResults(10);

		$ServiceTypes = $query->getResult();



		$CategoryArray = array ();

		if($ServiceTypes){

			foreach ($ServiceTypes as $ServiceType) {

				//print_r($ServiceType) ;

				array_push ( $CategoryArray, $ServiceType['name']);

			}

			$response['status'] = 1;

			$response['message'] = $CategoryArray;

			echo json_encode($response);

		}else{

			$response['status'] = 2;

			$response['message'] = "No service categories found, please contact administrator @ " . SYSTEM_EMAIL_ADDRESS;

			echo json_encode($response);

			return;

		}



	} catch (Exception $e) {

		$response['status'] = 2;

		$response['message'] = $e->getMessage();

		echo json_encode($response);

	}



}







function getPricelist($entityManager){

	try {

		//$LuRegion = $entityManager->getRepository('LuRegion')->findOneBy(array('name' => $_GET['getPricelist']));

		//$RegionService = $entityManager->getRepository('RegionService')->findOneBy(array('region' => $LuRegion));



		$dql = "SELECT rsp, rs, r, s, st FROM RegionServicePrice rsp JOIN rsp.regionService rs JOIN rs.region r JOIN rs.service s JOIN s.serviceTypeName st  

		where r.name = '" . $_GET['getPricelist'] . "'

		and st = '" . $_GET['servicetype'] . "' and rsp.active = 1";



		//echo $dql;

		$query = $entityManager->createQuery($dql);

		

		$RegionServicePrices = $query->getResult();

		$ServicesNamePriceArray = array ();

		

		if($RegionServicePrices){

			foreach ($RegionServicePrices as &$value) {

				//echo $value->getRegionService()->getService()->getName();

				$tempArray = array ();



				$LuService = $value->getRegionService()->getService();

				$ServiceName = $value->getRegionService()->getService()->getName();



				$LuService2 = $entityManager->getRepository('LuService')->findOneBy(array('name' => $ServiceName));

				$ServiceTypeName = $LuService2->getServiceTypeName()->getName();



				//only add service prices for the relevent service type

				//need to find a way to filter while selecting from db

				if (strcmp($ServiceTypeName, $_GET['servicetype']) == 0) {

					$ServicePrice = $value->getAmount();

					//array_push ( $tempArray, $ServiceTypeName);

					array_push ( $tempArray, $ServiceName);

					array_push ( $tempArray, "R" . number_format ( $ServicePrice, 2 ) );

					array_push ( $ServicesNamePriceArray, $tempArray);

				}



			}

		}else{

			$response['status'] = 2;

			$response['message'] = "Sorry, the service for " . $_GET['servicetype']  . " is not available in your area. Please contact administrator @ " . SYSTEM_EMAIL_ADDRESS;

			echo json_encode($response);

			return;

		}



		array_multisort($ServicesNamePriceArray, SORT_ASC);



		$HeadersArray = array ();



		array_push ( $HeadersArray, "Service Name");

		array_push ( $HeadersArray, "Price");

		array_unshift ( $ServicesNamePriceArray, $HeadersArray);



		$response['status'] = 1;

		$response['message'] = $ServicesNamePriceArray;

		echo json_encode($response);





	} catch (Exception $e) {

		$response['status'] = 2;

		$response['message'] = $e->getMessage();

		echo json_encode($response);

	}

}





?>