<?php

require_once(__DIR__.'/../../../bootstrap.php');
require_once(__DIR__.'/../../../app/application.php');

require_once(__DIR__.'/../Logic/Email_template.php');

require_once(__DIR__.'/../Entity/UserMessages.php');
require_once(__DIR__.'/../Entity/UserProfile.php');
require_once(__DIR__.'/../Entity/User.php');
require_once(__DIR__.'/../Entity/Address.php');
require_once(__DIR__.'/../Entity/LuUserRole.php');
require_once(__DIR__.'/../Entity/LuAccountStatus.php');
require_once (__DIR__."/../Logic/Mail.php");

if (isset ( $_POST ['send_message'] )) {
	if ($_POST ['send_message']) :
	send_message($entityManager);
	endif;
}

function send_message($entityManager){
	try {
		session_start ();
	} catch (Exception $e) {
	}

	try {
		$name = $_POST['firstname'];
		$surname = $_POST['surname'];
		$email = $_POST['email'];
		$phone_number = $_POST['mobile_number'];
		$message_type = $_POST['message_type'];
		$message = $_POST['message'];

		$user = $entityManager->getRepository('User')->findOneBy(array('emailAddress' => $email));
		$UserProfile = $user->getUserProfile();

		$UserMessages = new UserMessages();
		$UserMessages->setCreationUserName($name);
		$UserMessages->setCreationUserSurname($surname);
		$UserMessages->setCreationUserEmailAddress($email);
		$UserMessages->setCreationUserTelNumber($phone_number);
		$UserMessages->setMessage($message);
		$UserMessages->setMessageType($message_type);
		$UserMessages->setUserMessageProfile($UserProfile);

		$entityManager->persist($UserMessages);
		$entityManager->flush();

		if(emailMessage($entityManager)){
			$messages[] = "Successfully sent message to MobileOps" ;
		}else{
			$errors[] = "Failed to send message to MobileOps, please try again" ;	
		}

		$response['status'] = 1;
		$response['message'] = "Successfully sent message";
		echo json_encode($response);
	}catch (Exception $e) {
		$response['status'] = 2;
		$response['message'] = $e->getMessage();
		echo json_encode($response);
	}
}


//send email to user for password with link/url
function emailMessage($entityManager){
	try{
		$errors = array ();
		$messages = array ();

		$Parameters = array(
    			"first_name" => $_POST['firstname'],
   	 			"last_name" => $_POST['surname'],
				"mobile_number" => $_POST['mobile_number'],
				"message" => $_POST['message'],
		);

		$body = generate_email_body("contactus", $Parameters);
			
		$body = wordwrap($body,70);


		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: ' .SYSTEM_EMAIL_ADDRESS. "\r\n";
		$headers .= 'Reply-To: ' .$_POST['email']. "\r\n";

		$headers .= 'X-Mailer: PHP/' . phpversion () . "\r\n";


		if (mail ( SYSTEM_EMAIL_ADDRESS , "MobileOps - " . $_POST['message_type'], $body, $headers )) {
			return true;
		} else {
			return false;
		}

	}catch (Exception $e) {
		return false;
	}
}


?>

