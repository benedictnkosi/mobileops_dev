<?php

require_once(__DIR__.'/../../../bootstrap.php');
require_once(__DIR__.'/../../../app/application.php');

require_once(__DIR__."/../Logic/Registration.php");
require_once(__DIR__."/../Logic/Login.php");
require_once(__DIR__."/../Logic/FB_Login.php");
require_once(__DIR__."/../Logic/Twitter_Login.php");
require_once(__DIR__.'/../Logic/Email_template.php');
require_once(__DIR__."/../Logic/Mail.php");

require_once(__DIR__."/../Entity/RegistrationKey.php");
require_once(__DIR__."/../Entity/PasswordResetKey.php");
require_once(__DIR__.'/../Entity/LuAccountStatus.php');
require_once(__DIR__.'/../Entity/User.php');
require_once(__DIR__.'/../Entity/UserProfile.php');

//require_once(__DIR__.'/../../twitteroauth/autoload.php');

use Symfony\Bundle\TwigBundle\TwigBundle;


if (isset ( $_POST ['loadFacebookUser'] )) {
	if ($_POST ['loadFacebookUser']) :
	loadFacebookUser($entityManager);
	endif;
}

if (isset ( $_POST ['register'] )) {
	if ($_POST ['register']) :
	registerEmail($entityManager);
	endif;
}


if (isset ( $_POST ['activateaccount'] )) {
	if ($_POST ['activateaccount']) :
	activateaccount($entityManager);
	endif;
}


if (isset ( $_POST ['loadTwitterUser'] )) {
	if ($_POST ['loadTwitterUser']) :
	session_start();
	//print_r($_SESSION);
	loadTwitterUser($entityManager);
	endif;
}


if (isset ( $_POST ['getTwitterURL'] )) {
	if ($_POST ['getTwitterURL']) :
	getTwitterURL();
	endif;
}

if (isset ( $_POST ['login'] )) {
	if ($_POST ['login']) :
	login($entityManager);

	endif;
}

if (isset ( $_POST ['resetpassword'] )) {
	if ($_POST ['resetpassword']) :
	resetPassword($entityManager);
	endif;
}

if (isset ( $_POST ['sendPasswordResetEmail'] )) {
	if ($_POST ['sendPasswordResetEmail']) :
	emailPasswordResetEmail($entityManager);
	endif;
}


function my_session_start($timeout) {
	ini_set ( 'session.gc_maxlifetime', $timeout );
	session_start ();

	if (isset ( $_SESSION ['timeout_idle'] ) && $_SESSION ['timeout_idle'] < time ()) {
		session_destroy ();
		session_start ();
		session_regenerate_id ();
		$_SESSION = array ();
	}
	$_SESSION ['timeout_idle'] = time () + $timeout;
}


function getTwitterURL(){
	try {
		//	session_start();
		my_session_start (86400 * 31);
		//print_r($_SESSION);
		$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
		$request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));

		$_SESSION['oauth_token'] = $request_token['oauth_token'];
		$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
		$url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
			
		$response['status'] = 1;
		$response['message'] = $url;
		$response['other'] = $_SESSION['oauth_token'] ;

		echo json_encode($response);
	} catch (Exception $e) {
		$response['status'] = 2;
		$response['message'] = $e->getMessage();

		echo json_encode($response);
	}

}



//login twitter user
function loadTwitterUser($entityManager){

	try {
		$login = new Twitter_Login ($entityManager);
		$errors = array ();
		$messages = array ();

		$errors = $login->errors;
		$messages = $login->messages;
		$user_role = $login->user_role;
		$email_address = $login->email_address;
		$firstname = $login->firstname;
		$surname = $login->surname;
		$phone_number = $login->phone_number;
		$user_id = $login->user_id;

		if (sizeof ( $login->errors) > 0) {
			$response['status'] = 2;
			$response['message'] = $errors [0];

			echo json_encode($response);
		} else {
			$response['status'] = 1;
			$response['message'] = $messages [0];
			$response['user_role'] = $user_role;
			$response['email_address'] = $email_address;
			$response['firstname'] = $firstname;
			$response['surname'] = $surname;
			$response['phone_number'] = $phone_number;
			$response['user_id'] = $user_id ;
			echo json_encode($response);
		}
	}catch (Exception $e) {
		$response['status'] = 2;
		$response['message'] = $e->getMessage();
		echo json_encode($response);
	}
}


//login facebook user
function loadFacebookUser($entityManager){
	try {
		$login = new FB_Login ($entityManager);
		$errors = array ();
		$messages = array ();

		$errors = $login->errors;
		$messages = $login->messages;
		$user_role = $login->user_role;
		$email_address = $login->email_address;
		$firstname = $login->firstname;
		$surname = $login->surname;
		$phone_number = $login->phone_number;
		$user_id = $login->user_id;

		if (sizeof ( $login->errors) > 0) {
			$response['status'] = 2;
			$response['message'] = $errors [0];

			echo json_encode($response);
		} else {
			$response['status'] = 1;
			$response['message'] = $messages [0];


			$response['user_role'] = $user_role;
			$response['email_address'] = $email_address;
			$response['firstname'] = $firstname;
			$response['surname'] = $surname;
			$response['phone_number'] = $phone_number;
			$response['user_id'] = $user_id ;

			echo json_encode($response);
		}
	}catch (Exception $e) {
		$response['status'] = 2;
		$response['message'] = $e->getMessage();
		echo json_encode($response);
	}
}

//user registration using email
function registerEmail($entityManager){
	try {
		$registration = new Registration ($entityManager);
		$errors = array ();
		$messages = array ();

		$errors = $registration->errors;
		$messages = $registration->messages;


		if (sizeof ( $registration->errors ) > 0) {
			$response['status'] = 2;
			$response['message'] = $errors [0];

			echo json_encode($response);
		} else {
			$response['status'] = 1;
			$response['message'] = $messages [0];
			emailRegistraionEmail($entityManager);
			echo json_encode($response);
		}
	}catch (Exception $e) {
		$response['status'] = 2;
		$response['message'] = $e->getMessage();
		echo json_encode($response);
	}
}

//reset user passwortd
function resetPassword($entityManager){
	try {
		$errors = array ();
		$messages = array ();
		$password = $_POST['password'];
		$date = new DateTime();

		//get instance of the user using email address
		$user = $entityManager->getRepository('User')->findOneBy(array('emailAddress' => $_POST ['resetpassword']));
		if($user){
			$user_password_hash = password_hash($password, PASSWORD_DEFAULT);
			$user->setPasswordLastChanged($date);
			$user->setPassword($user_password_hash);
			$user->setPasswordRetryCount(0);

			//set account status to ACCOUNT_ACTIVE
			$LuAccountStatus = $entityManager->getRepository('LuAccountStatus')->findOneBy(array('name' => 'ACCOUNT_ACTIVE'));
			$user->setUserUserAccountStatus($LuAccountStatus);

			//check if there is a password reset temp key that hasn't been used
			$PasswordResetKey = $entityManager->getRepository('PasswordResetKey')->findOneBy(array('emailAddress' => $_POST ['resetpassword'], 'uniqueKey' => $_POST ['key'], 'activated' => 0));
			if($PasswordResetKey){
				//set activated to 1 to ensure that the key is only used once
				$PasswordResetKey->setActivated(1);
				$entityManager->persist($PasswordResetKey);
				$entityManager->persist($user);
				$entityManager->flush();

				$messages[] = "You have successfully changed your password";
			}else{
				$errors[] = "Failed to reset password. Please contact support on " . SYSTEM_EMAIL_ADDRESS;
			}

		}else{
			$errors[] = "Failed to find user by email address. Please contact support on " . SYSTEM_EMAIL_ADDRESS;
		}

		if (sizeof ( $errors ) > 0) {
			$response['status'] = 2;
			$response['message'] = $errors [0];

			echo json_encode($response);
		} else {
			$response['status'] = 1;
			$response['message'] = $messages [0];
			echo json_encode($response);
		}
	}catch (Exception $e) {
		$response['status'] = 2;
		$response['message'] = $e->getMessage();
		echo json_encode($response);
	}
}

//send email to user for password with link/url
function emailPasswordResetEmail($entityManager){
	try{
		$errors = array ();
		$messages = array ();

		//get instance of the user using email address
		$user = $entityManager->getRepository('User')->findOneBy(array('emailAddress' => $_POST ['sendPasswordResetEmail']));
		if($user){
			//generate random key and save on DB
			
			$hash = generatePasswordResetKey($entityManager);

			
			$Parameters = array(
    			"first_name" => $user->getUserProfile()->getFirstName(),
   	 			"last_name" => $user->getUserProfile()->getSurname(),
				"url" => " http://www.mobileops.co.za?resetpassword=" . $_POST['sendPasswordResetEmail'] . "&key=" .  $hash,
			);

			$body = generate_email_body("password_reset", $Parameters);
			
			$body = wordwrap($body,70);

			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: ' .SYSTEM_EMAIL_ADDRESS . "\r\n";
			$headers .= 'X-Mailer: PHP/' . phpversion () . "\r\n";

			$message = $body;

			if (mail ( $_POST['sendPasswordResetEmail'] , "MobileOps Reset Password", $message, $headers )) {
				$messages[] = "Successfully sent password reset email to " .$_POST ['sendPasswordResetEmail'] ;
			} else {
				$errors[] = GENERIC_SYSTEM_ERROR ;
			}
		}else{
			$errors[] = "Email address not found";
		}


		if (sizeof ( $errors ) > 0) {
			$response['status'] = 2;
			$response['message'] = $errors [0];

			echo json_encode($response);
		} else {
			$response['status'] = 1;
			$response['message'] = $messages [0];
			echo json_encode($response);
		}
	}catch (Exception $e) {
		$response['status'] = 2;
		$response['message'] = $e->getMessage();
		echo json_encode($response);
	}
}

//generate random key for account activation and save on DB
function generateRegistrationKey($entityManager) {
	try{
		$hash = md5( rand(0,1000) );
		$RegistrationKey = new RegistrationKey();

		$RegistrationKey->setUniqueKey($hash);
		$RegistrationKey->setEmailAddress($_POST['email']);

		$entityManager->persist($RegistrationKey);
		$entityManager->flush();

		return $hash;
	}catch (Exception $e) {
		$response['status'] = 2;
		$response['message'] = $e->getMessage();
		echo json_encode($response);
	}
}


//generate random key and save on DB
function generatePasswordResetKey($entityManager) {
	try{
		$hash = md5( rand(0,1000) );
		$PasswordResetKey = new PasswordResetKey();

		$PasswordResetKey->setUniqueKey($hash);
		$PasswordResetKey->setEmailAddress($_POST['sendPasswordResetEmail']);

		$entityManager->persist($PasswordResetKey);
		$entityManager->flush();

		return $hash;
	}catch (Exception $e) {
		$response['status'] = 2;
		$response['message'] = $e->getMessage();
		echo json_encode($response);
	}
}

//email user on registraion with the activation key
function emailRegistraionEmail($entityManager) {
	try {
		$hash = generateRegistrationKey($entityManager);

		
		$Parameters = array(
    			"first_name" => $_POST['firstname'],
   	 			"last_name" => $_POST['surname'],
				"url" => "http://www.mobileops.co.za?activateaccount=" . $_POST['email'] . "&key=" .  $hash,
			);

		$body = generate_email_body("registration", $Parameters);
			
		
		$body = wordwrap($body,70);

		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: ' .SYSTEM_EMAIL_ADDRESS . "\r\n";
		$headers .= 'X-Mailer: PHP/' . phpversion () . "\r\n";


		if (mail ( $_POST['email'] , "MobileOps Registration", $body, $headers )) {
			return true;
		} else {
			return false;
		}
	}catch (Exception $e) {
		$response['status'] = 2;
		$response['message'] = $e->getMessage();
		echo json_encode($response);
	}
}

//activate account using the activation link
function activateaccount($entityManager){
	try{
		//get/check if there is a random key and email address on the DB for the activation link
		$RegistrationKey = $entityManager->getRepository('RegistrationKey')->findOneBy(array('emailAddress' => $_POST ['activateaccount'], 'uniqueKey' => $_POST ['key'], 'activated' => 0));

		$errors = array();
		$messages= array();

		if($RegistrationKey){
			//if random key exist and user exist, set the user status to ACCOUNT_ACTIVE
			$user = $entityManager->getRepository('User')->findOneBy(array('emailAddress' => $_POST ['activateaccount']));
			if($user){
				$LuAccountStatus = $entityManager->getRepository('LuAccountStatus')->findOneBy(array('name' => 'ACCOUNT_ACTIVE'));
				$user->setUserUserAccountStatus($LuAccountStatus);

				$entityManager->persist($user);

				//changed the random key to a used state
				$RegistrationKey = $entityManager->getRepository('RegistrationKey')->findOneBy(array('emailAddress' => $_POST ['activateaccount'], 'uniqueKey' => $_POST ['key']));
				$RegistrationKey->setActivated(1);

				$entityManager->persist($RegistrationKey);
				$entityManager->flush();

				$messages[] = "Successfully activated your account. Please login" ;
			}else{
				$errors[] = "Oops, failed to activate your account, please contact support at " . SYSTEM_EMAIL_ADDRESS ;
			}

		} else {
			$errors[] = "Oops, failed to activate your account, please contact support at " . SYSTEM_EMAIL_ADDRESS ;
		}

		if (sizeof ( $errors ) > 0) {
			$response['status'] = 2;
			$response['message'] = $errors [0];

			echo json_encode($response);
		} else {
			$response['status'] = 1;
			$response['message'] = $messages [0];
			echo json_encode($response);
		}
	}catch (Exception $e) {
		$response['status'] = 2;
		$response['message'] = $e->getMessage();
		echo json_encode($response);
	}
}

//login user using email address
function login($entityManager){
	try{
		$login = new login ($entityManager);
		$errors = array ();
		$messages = array ();

		$errors = $login->errors;
		$messages = $login->messages;
		$user_role = $login->user_role;
		$email_address = $login->email_address;
		$firstname = $login->firstname;
		$surname = $login->surname;
		$phone_number = $login->phone_number;
		$user_id = $login->user_id;

		if (sizeof ( $login->errors) > 0) {
			$response['status'] = 2;
			$response['message'] = $errors [0];

			echo json_encode($response);
		} else {
			$response['status'] = 1;
			$response['message'] = $messages [0];
			$response['user_role'] = $user_role;
			$response['email_address'] = $email_address;
			$response['firstname'] = $firstname;
			$response['surname'] = $surname;
			$response['phone_number'] = $phone_number;
			$response['user_id'] = $user_id ;
			echo json_encode($response);
		}
	}catch (Exception $e) {
		$response['status'] = 2;
		$response['message'] = $e->getMessage();
		echo json_encode($response);
	}
}
?>
