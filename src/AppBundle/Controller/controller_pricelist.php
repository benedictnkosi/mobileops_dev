<?php



require_once(__DIR__.'/../../../bootstrap.php');

require_once(__DIR__.'/../../../app/application.php');

require_once(__DIR__.'/../Entity/LuService.php');
require_once(__DIR__.'/../Entity/LuServiceType.php');
require_once(__DIR__.'/../Entity/PartnerServicePrice.php');
require_once(__DIR__.'/../Entity/PartnerService.php');
require_once (__DIR__ . '/../Entity/UserProfile.php');
require_once(__DIR__.'/../Entity/Address.php');
require_once (__DIR__ . '/../Entity/UserMobility.php');
require_once (__DIR__ . '/../Entity/LuMobility.php');



if (isset ( $_GET ['getRegions'] )) {

	if ($_GET ['getRegions']) :

	getRegions($entityManager);

	endif;

}



if (isset ( $_GET ['getServiceCategories'] )) {

	if ($_GET ['getServiceCategories']) :

	getServiceCategories($entityManager);

	endif;

}





if (isset ( $_GET ['getPricelist'] )) {

	if ($_GET ['getPricelist']) :

	getPricelist($entityManager);

	endif;

}



function getServiceCategories($entityManager){

	try {

		

		$LuServiceType = $entityManager->getRepository('LuServiceType')->findBy(array('active'=>1),array('name' => 'ASC'));

		$CategoryArray = array ();

		if($LuServiceType){

			foreach ($LuServiceType as $ServiceType) {

				//print_r($ServiceType) ;

				array_push ( $CategoryArray, $ServiceType->getName());

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

		$ServiceCategoryArray = json_decode ( stripslashes ( $_GET ['serviceCategories'] ) );
		
		$lowLatitude = floatval ( $_GET ["lat"] ) - RADIUS;
		$lowLongitude = floatval ( $_GET ["lng"] ) - RADIUS;
		
		$highLatitude = floatval ( $_GET ["lat"] ) + RADIUS;
		$highLongitude = floatval ( $_GET ["lng"] ) + RADIUS;
		
		
		$dql = "SELECT psp, ps, up, a FROM PartnerServicePrice psp JOIN psp.partnerService ps JOIN ps.partnerProfile up JOIN up.address a JOIN ps.service s JOIN s.serviceTypeName st
		where
		(a.latitude BETWEEN $lowLatitude AND $highLatitude)
		and (a.longitude BETWEEN $lowLongitude AND  $highLongitude)
		and psp.active = 1 
		and st.name IN (:serviceCategories)
		ORDER BY st.name,  s.name ";
	
		$query = $entityManager->createQuery ( $dql )->setParameters ( array (
				'serviceCategories' => $ServiceCategoryArray
		) );
		
		$partnerServicePrices = $query->getResult();

		$ServicesNamePriceArray = array ();

		

		if($partnerServicePrices){
			
			$highestPrice = 0;
			$lowestPrice = 99999999999999;
			$ServiceName = "";
			$i = 0;
			foreach ($partnerServicePrices as &$value) {

	
				$mobility = getPartnerMobility ( $entityManager,  $value->getPartnerService ()->getPartnerProfile());
					
				if (! $mobility) {
					continue;
				}
				$LuService = $value->getPartnerService()->getService();
				
				$ServicePrice  = $value->getAmount();

				if ((strcmp ( $ServiceName, $LuService->getName() ) !== 0) && $i !== 0) {
					$tempArray = array ();
					array_push ( $tempArray, $LuService->getServiceTypeName()->getName() .  ' - ' . $ServiceName);
					array_push ( $tempArray, "R" . number_format ( $lowestPrice, 0 ) . ' - ' . "R" . number_format ( $highestPrice, 0 ));
					array_push ( $ServicesNamePriceArray, $tempArray );
					
					$highestPrice = 0;
					$lowestPrice = 99999999999999;
				}
				
				$ServiceName = $LuService->getName();
				if($ServicePrice > $highestPrice){
					$highestPrice = $ServicePrice;
				}
				
				if($ServicePrice < $lowestPrice){
					$lowestPrice = $ServicePrice;
				}
				
				$i ++;
			}

		}else{

			$response['status'] = 2;

			$response['message'] = "Sorry, the selected service categories are not available near you. Please contact administrator @ " . SYSTEM_EMAIL_ADDRESS;

			echo json_encode($response);

			return;

		}

		array_multisort($ServicesNamePriceArray, SORT_ASC);
		$HeadersArray = array ();

		array_push ( $HeadersArray, "SERVICE NAME");

		array_push ( $HeadersArray, "PRICE AROUND YOU");

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




function getPartnerMobility($entityManager, $userProfile) {
	try {

		if ($userProfile != NULL)
			$userMobility = $entityManager->getRepository ( 'UserMobility' )->findOneBy ( array (
					'userProfile' => $userProfile,
					'active' => true
			) );

			return $userMobility;
	} catch ( Exception $e ) {
		echo "" . $e->getTraceAsString ();
	}

	return NULL;
}
?>