<?php

require_once(__DIR__.'/../../../bootstrap.php');
require_once (__DIR__."/../../../app/application.php");

require_once(__DIR__.'/../Entity/User.php');
require_once(__DIR__.'/../Entity/Address.php');
require_once(__DIR__.'/../Entity/UserProfile.php');
require_once(__DIR__.'/../Entity/LuAccountStatus.php');
require_once(__DIR__.'/../Entity/LuUserRole.php');



require_once(__DIR__.'/../../twitteroauth/autoload.php');

use Abraham\TwitterOAuth\TwitterOAuth;

/**
 * Class login
 * handles the user's login and logout process
 */

class Twitter_Login {
	/**
	 *
	 * @var object The database connection
	 */
	private $db_connection = null;
	/**
	 *
	 * @var array Collection of error messages
	 */
	public $errors = array ();
	/**
	 *
	 * @var array Collection of success / neutral messages
	 */

	public $messages = array ();
	public $user_role;
	public $email_address;
	public $firstname;
	public $surname;
	public $phone_number;
	public $user_id;

	/**
	 * the function "__construct()" automatically starts whenever an object of this class is created,
	 * you know, when you do "$login = new Login();"
	 */
	public function __construct($entityManager) {
		// create/read session, absolutely necessary
		//$this->my_session_start (86400 * 31);

		// check the possible login actions:
		// if user tried to log out (happen when user clicks logout button)
		if (isset ( $_GET ["logout"] )) {
			$this->doLogout ();
		}		// login via post data (if user just submitted a login form)
		elseif (isset ( $_POST ["loadTwitterUser"] )) {
			$this->dologinWithPostData ($entityManager);
		}
	}

	private function my_session_start($timeout) {
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

	/**
	 * log in with post data
	 */
	private function dologinWithPostData($entityManager) {

		try {
			//if FB user id not in the DB, first time login with facebook. create an empty user instance and populate with data
			$request_token;
			$request_token['oauth_token'] = $_SESSION['oauth_token'];
			$request_token['oauth_token_secret'] = $_SESSION['oauth_token_secret'];


			$connection; $twitter_user;
			if (isset($_POST['oauth_token']) && $request_token['oauth_token'] !== $_POST['oauth_token']) {
				$this->errors[] = "Twitter login failed, please try again";
				return;
			}else{
				$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_POST['oauth_token'], $request_token['oauth_token_secret']);
				$access_token = $connection->oauth("oauth/access_token", array("oauth_verifier" => $_POST['oauth_verifier']));
				$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
				$twitter_user = $connection->get("account/verify_credentials", array('include_email' => 'true'));
			}

				

			$user =  null;

			//get user instance using FB user id. only the fb id is required to authenticate
			$userByTwitterId = $entityManager->getRepository('User')->findOneBy(array('twitterNetworkId' => $twitter_user->id_str));

			//check if email already registered
			$userByEmail = $entityManager->getRepository('User')->findOneBy(array('emailAddress' => $twitter_user->email));

			if($userByTwitterId){
				$user = $userByTwitterId;
			}elseif ($userByEmail){
				$user = $userByEmail;
					
				//save the TwitterNetworkId( to user
				$user->setTwitterNetworkId($twitter_user->id_str);
				$entityManager->persist($user);
				$entityManager->flush();
			}

			if($user){
				$this->messages[] = "successfully authenticated";
					
				$UserProfile = $user->getUserProfile();
					
				//default user_role to 'CLIENT' as only clients are allowed to login with social media
				$_SESSION ['user_role'] = 'CLIENT';

				$_SESSION ['email_address'] = $user->getEmailAddress();
				$_SESSION ['user_login_status'] = 1;
				$_SESSION ['firstname'] = $UserProfile->getFirstName();
				$_SESSION ['surname'] = $UserProfile->getSurname();
				$_SESSION ['phone_number'] = $UserProfile->getPhoneNumber();
				$_SESSION ['user_id'] = $user->getUserId();

				$this->user_role = $_SESSION ['user_role'];
				$this->email_address = $_SESSION ['email_address'];
				$this->firstname = $_SESSION ['firstname'];
				$this->surname = $_SESSION ['surname'];
				$this->phone_number = $_SESSION ['phone_number'];
				$this->user_id = $_SESSION ['user_id'];

				$UserDetailsArray=array(
    							'user_role'=>$_SESSION ['user_role'],
    							'email_address'=>$_SESSION ['email_address'],
								'firstname'=>$_SESSION ['firstname'],
								'surname'=>$_SESSION ['surname'],
								'phone_number'=>$_SESSION ['phone_number'],
								'user_id'=>$_SESSION ['user_id'],
				);

				$json = json_encode($UserDetailsArray);

				//auto remember for facebook, 30 days expiry cookie
				setcookie ( "mobileops", $json, time () + (86400 * 30), "/" ); // here we are setting a cookie named username, with the Username on the database that will last 48 hours and will be set on the understandesign.com domain. This is an optional parameter.
			}else{

				$user = new User();
				$date = new DateTime();
				$UserProfile = new UserProfile();
				$Address = new Address();
				$Address->setDateAdded($date);
					
				$usernameSurname = explode(" ", $twitter_user->name);
				$UserProfile->setFirstName($usernameSurname[0]);
				$UserProfile->setSurname($usernameSurname[1]);
				$UserProfile->setDateCreated($date);

				$user->setEmailAddress($twitter_user->email);
				$user->setTwitterNetworkId($twitter_user->id_str);
				$user->setDateCreated($date);

				//fb login set account status to ACCOUNT_ACTIVE
				$LuAccountStatus = $entityManager->getRepository('LuAccountStatus')->findOneBy(array('name' => 'ACCOUNT_ACTIVE'));
				$user->setUserUserAccountStatus($LuAccountStatus);

				$LuUserRole = $entityManager->getRepository('LuUserRole')->findOneBy(array('name' => 'CLIENT'));
				$user->setUserUserRole($LuUserRole);

				$user->setUserProfile ($UserProfile);
				$UserProfile->setAddress($Address);
					
				//save new user on DB
				$entityManager->persist($Address);
				$entityManager->persist($UserProfile);
				$entityManager->persist($user);
				$entityManager->flush();


				$_SESSION ['email_address'] = $user->getEmailAddress();
				$_SESSION ['user_login_status'] = 1;
				$_SESSION ['user_role'] = 'CLIENT';

				// if user has been added successfully
				$user = $entityManager->getRepository('User')->findOneBy(array('emailAddress' => $_SESSION ['email_address']));
				if ($user) {
					$this->messages[] = "Your account has been created successfully.";

					//default user_role to 'CLIENT' as only clients are allowed to login with social media
					$_SESSION ['user_role'] = 'CLIENT';

					$_SESSION ['email_address'] = $user->getEmailAddress();
					$_SESSION ['user_login_status'] = 1;
					$_SESSION ['firstname'] = $UserProfile->getFirstName();
					$_SESSION ['surname'] = $UserProfile->getSurname();
					$_SESSION ['phone_number'] = $UserProfile->getPhoneNumber();
					$_SESSION ['user_id'] = $user->getUserId();

					$this->user_role = $_SESSION ['user_role'];
					$this->email_address = $_SESSION ['email_address'];
					$this->firstname = $_SESSION ['firstname'];
					$this->surname = $_SESSION ['surname'];
					$this->phone_number = $_SESSION ['phone_number'];
					$this->user_id = $_SESSION ['user_id'];

					$UserDetailsArray=array(
    							'user_role'=>$_SESSION ['user_role'],
    							'email_address'=>$_SESSION ['email_address'],
								'firstname'=>$_SESSION ['firstname'],
								'surname'=>$_SESSION ['surname'],
								'phone_number'=>$_SESSION ['phone_number'],
								'user_id'=>$_SESSION ['user_id'],
					);

					$json = json_encode($UserDetailsArray);
						
					setcookie ( "mobileops", $json, time () + (86400 * 30), "/" ); // here we are setting a cookie named username, with the Username on the database that will last 48 hours and will be set on the understandesign.com domain. This is an optional parameter.
				} else {
					$this->errors[] = "Sorry, your registration failed. Please try again.";
				}
			}

		} catch (Exception $e) {
			$this->errors[] = $e->getMessage();
		}

	}
}