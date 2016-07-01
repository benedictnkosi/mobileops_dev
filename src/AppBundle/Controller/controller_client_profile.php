<?php
require_once(__DIR__.'/../../../bootstrap.php');
require_once(__DIR__.'/../../../app/application.php');

require_once(__DIR__.'/../Entity/User.php');
require_once(__DIR__.'/../Entity/LuAccountStatus.php');
require_once(__DIR__.'/../Entity/LuUserRole.php');
require_once(__DIR__.'/../Entity/UserProfile.php');
require_once(__DIR__.'/../Entity/Address.php');
require_once(__DIR__.'/../Entity/UserUserService.php');
require_once(__DIR__.'/../Entity/LuService.php');
require_once(__DIR__.'/../Entity/LuServiceType.php');


if (isset ( $_POST ['savePersonalDetails'] )) {
	if ($_POST ['savePersonalDetails']) :
	savePersonalDetails($entityManager);
	endif;
}

if (isset ( $_GET ['getClientProfile'] )) {
	if ($_GET ['getClientProfile']) :
	getClientProfile($entityManager);
	endif;
}

function savePersonalDetails($entityManager){
	try {
		session_start ();
	} catch (Exception $e) {
	}

	try {
		$name = $_POST['firstname'];
		$surname = $_POST['surname'];
		$email = $_SESSION ['email_address'];
		$phone_number = $_POST['mobile_number'];
		$complex = $_POST['complex'];
		$latitude = $_POST['lat'];
		$longitude = $_POST['lng'];
		$province = $_POST['administrative_area_level_1'];
		$street_name = $_POST['route'];
		$street_number = $_POST['street_number'];
		$suburb = $_POST['sublocality'];
		$city = $_POST['locality'];

		$user = $entityManager->getRepository('User')->findOneBy(array('emailAddress' => $_SESSION ['email_address']));
		if($user){
			$date = new DateTime();
			$UserProfile = $user->getUserProfile();

			$Address = $UserProfile->getAddress();
			$Address->setStreetName($street_name);
			$Address->setStreetNumber($street_number);
			$Address->setCityName ($city);
			$Address->setSuburbName ($suburb);
			$Address->setProvinceName ($province);
			$Address->setLatitude($latitude);
			$Address->setLongitude($longitude);
			$Address->setComplexName($complex);
			$Address->setDateAdded($date);

			$UserProfile->setAddress ($Address);
			$UserProfile->setFirstName($name);
			$UserProfile->setSurname($surname);
			$UserProfile->setPhoneNumber($phone_number);
			$UserProfile->setDateCreated($date);

			$user->setUserProfile ($UserProfile);

			$entityManager->persist($Address);
			$entityManager->persist($UserProfile);
			$entityManager->persist($user);

			$entityManager->flush();

			$response['status'] = 1;
			$response['message'] = "Successfully updated personal details";
			echo json_encode($response);
		}else{
			$response['status'] = 2;
			$response['message'] = "User with email " . $_SESSION ['email_address'] . " not found. Please email administrator @ " .SYSTEM_EMAIL_ADDRESS;
			echo json_encode($response);
		}
	} catch (Exception $e) {
		$response['status'] = 2;
		$response['message'] = $e->getMessage();
		echo json_encode($response);
	}

}


function getClientProfile($entityManager){
	try {
		session_start ();
	} catch (Exception $e) {
	}

	try {


		$profileArray = array ();

		$user = $entityManager->getRepository('User')->findOneBy(array('emailAddress' => $_SESSION ['email_address']));
		if($user){
			$UserProfile = $user->getUserProfile();

			$profileArray['name'] = $UserProfile->getFirstName();
			$profileArray['surname'] = $UserProfile->getSurname();
			$profileArray['email'] = $user->getEmailAddress();
			$profileArray['mobile_number'] = $UserProfile->getPhoneNumber();
			
			$Adresss = $UserProfile->getAddress();
			if($Adresss){
				$profileArray['address'] =  $Adresss->getStreetNumber() . " " .$Adresss->getStreetName() .", " . $Adresss->getCityName() . ", " . COUNTRY;
				$profileArray['complex'] = $Adresss->getComplexName();
				$profileArray['latitude'] = $Adresss->getLatitude();
				$profileArray['longitude'] = $Adresss->getLongitude();
				$profileArray['province'] = $Adresss->getProvinceName();
				$profileArray['street_name'] = $Adresss->getStreetName();
				$profileArray['street_number'] = $Adresss->getStreetNumber();
				$profileArray['city'] = $Adresss->getCityName();
				$profileArray['suburb'] = $Adresss->getSuburbName();
			}else{
				$profileArray['address'] =  "";
				$profileArray['complex'] = "";
				$profileArray['latitude'] = "";
				$profileArray['longitude'] = "";
				$profileArray['province'] = "";
				$profileArray['street_name'] = "";
				$profileArray['street_number'] = "";
				$profileArray['city'] = "";
				$profileArray['suburb'] = "";
			}
				

			$response['status'] = 1;
			$response['message'] = $profileArray;
			echo json_encode($response);
		}else{
			$response['status'] = 2;
			$response['message'] = "User with email " . $_SESSION ['email_address'] . " not found. Please email administrator @ " . SYSTEM_EMAIL_ADDRESS;
			echo json_encode($response);
		}
	} catch (Exception $e) {
		$response['status'] = 2;
		$response['message'] = $e->getMessage();
		echo json_encode($response);
	}

}


function getClientProfileById($entityManager,$userProfileId){

	try{

		$clientProfile = $entityManager->getRepository('UserProfile')->findOneBy(array('userProfileId' => $userProfileId));
		//echo "FOUND ".$clientProfile->getFirstName()." \n";

		return $clientProfile;

	}catch(Exception $e){
		echo "".$e->getTraceAsString();
	}
	return $clientProfile;
}


?>