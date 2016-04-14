<?php

require_once(__DIR__.'/../../../bootstrap.php');

require_once(__DIR__.'/../Entity/User.php');
require_once(__DIR__.'/../Entity/LuAccountStatus.php');
require_once(__DIR__.'/../Entity/LuUserRole.php');
require_once(__DIR__.'/../Entity/UserProfile.php');
require_once(__DIR__.'/../Entity/Address.php');


/**
 * Class registration
 * handles the user registration
 */


class Registration
{
	/**
	 * @var object $db_connection The database connection
	 */
	private $db_connection = null;
	/**
	 * @var array $errors Collection of error messages
	 */
	public $errors = array();
	/**
	 * @var array $messages Collection of success / neutral messages
	 */
	public $messages = array();

	/**
	 * the function "__construct()" automatically starts whenever an object of this class is created,
	 * you know, when you do "$registration = new Registration();"
	 */
	public function __construct($entityManager)
	{
		if (isset($_POST["register"])) {
			$this->registerUser($entityManager);
		}
	}

	/**
	 * handles the entire registration process. checks all error possibilities
	 * and creates a new user in the database if everything is fine
	 */
	private function registerUser($entityManager)
	{

		try{
				
			// escaping, additionally removing everything that could be (html/javascript-) code
			$name = $_POST['firstname'];
			$surname = $_POST['surname'];
			$email = $_POST['email'];
			$phone_number = $_POST['mobile_number'];
			$password = $_POST['password'];
			$complex = $_POST['complex'];
			$latitude = $_POST['lat'];
			$longitude = $_POST['lng'];
			$province = $_POST['administrative_area_level_1'];
			$street_name = $_POST['route'];
			$street_number = $_POST['street_number'];
			$city = $_POST['locality'];
			$suburb = $_POST['sublocality'];

			$idnumber = "";  $userole = ""; $gender = "";

			//get partner field values
			if (strcasecmp ( $_POST["register"], "partner" ) == 0) {
				$idnumber = $_POST['idnumber'];
					
				if (isset($_POST["gender"])) {
					$gender = $_POST['gender'];
				}

				$userole = "PARTNER";
			}elseif(strcasecmp ( $_POST["register"], "client" ) == 0) {
				$userole = "CLIENT";
			}

			// crypt the user's password with PHP 5.5's password_hash() function, results in a 60 character
			// hash string. the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using
			// PHP 5.3/5.4, by the password hashing compatibility library
			$user_password_hash = password_hash($password, PASSWORD_DEFAULT);

			// check if user or email address already exists
			$user = $entityManager->getRepository('User')->findOneBy(array('emailAddress' => $email));
			if($user){
				$this->errors[] = "Sorry, " . $email ." is already registered.";
			} else {

				//create an instance of User and assign properties
				$user = new User();
				$date = new DateTime();
					
				$user->setEmailAddress($email);
				$user->setPassword($user_password_hash);
				$user->setPasswordLastChanged($date);
				$user->setDateCreated($date);

				$LuAccountStatus = $entityManager->getRepository('LuAccountStatus')->findOneBy(array('name' => 'ACCOUNT_NOT_VERIFIED'));
				$user->setUserUserAccountStatus($LuAccountStatus);

				$LuUserRole = $entityManager->getRepository('LuUserRole')->findOneBy(array('name' => $userole));
				$user->setUserUserRole($LuUserRole);

				$Address = new Address();
				$Address->setStreetName($street_name);
				$Address->setStreetNumber($street_number);
				$Address->setCityName ($city);
				$Address->setSuburbName ($suburb);
				$Address->setProvinceName ($province);
				$Address->setLatitude($latitude);
				$Address->setLongitude($longitude);
				$Address->setComplexName($complex);
				$Address->setDateAdded($date);
				
					
				$UserProfile = new UserProfile();
				$UserProfile->setAddress ($Address);
				$UserProfile->setFirstName($name);
				$UserProfile->setSurname($surname);
				$UserProfile->setPhoneNumber($phone_number);
				$UserProfile->setGender($gender);
				$UserProfile->setIdnumberOrPassport($idnumber);
				$UserProfile->setDateCreated($date);
					
				$user->setUserProfile ($UserProfile);
					
				$entityManager->persist($Address);
				$entityManager->persist($UserProfile);

				// write new user's data into database

				$entityManager->persist($user);
				$entityManager->flush();

				// if user has been added successfully
				$user = $entityManager->getRepository('User')->findOneBy(array('emailAddress' => $email));
				if ($user) {
					$this->messages[] = "Your account has been created successfully. Activation email sent";

				} else {
					$this->errors[] = "Sorry, your registration failed. Please try again.";
				}
			}

		} catch (Exception $e) {
			$this->errors[] = $e->getMessage();
		}

	}





}
