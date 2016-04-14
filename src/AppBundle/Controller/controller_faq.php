<?php

require_once(__DIR__.'/../../../bootstrap.php');
require_once(__DIR__.'/../../../app/application.php');

require_once(__DIR__.'/../Entity/Faq.php');

if (isset ( $_GET ['getFaq'] )) {
	if ($_GET ['getFaq']) :
	getFaq($entityManager);
	endif;
}


//get all services ordered by service type
function getFaq($entityManager){
	try {
		$Faq = $entityManager->getRepository('Faq')->findBy(array());
		$FaqArray = array ();
		$AllFaqArray = array ();
		$i = 0;

		foreach ($Faq as &$value) {
			array_push ( $FaqArray, $value->getQuestion());
			array_push ( $FaqArray, $value->getAnswer());
			array_push ( $AllFaqArray, $FaqArray);
			$FaqArray = array ();
		}

		$response['status'] = 1;
		$response['message'] = $AllFaqArray;
		echo json_encode($response);
	}catch (Exception $e) {
		$response['status'] = 2;
		$response['message'] = $e->getMessage();
		echo json_encode($response);
	}

}

?>