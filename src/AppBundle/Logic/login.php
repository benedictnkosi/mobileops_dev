<?php

require_once(__DIR__.'/../../../bootstrap.php');

require_once(__DIR__.'/../Entity/User.php');
require_once(__DIR__.'/../Entity/Address.php');
require_once(__DIR__.'/../Entity/UserProfile.php');
require_once(__DIR__.'/../Entity/LuAccountStatus.php');
require_once(__DIR__.'/../Entity/LuUserRole.php');

/**
 * Class login
 * handles the user's login and logout process
 */

class Login {
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
		$this->my_session_start (1200);


		// check the possible login actions:
		// if user tried to log out (happen when user clicks logout button)
		if (isset ( $_GET ["logout"] )) {
			$this->doLogout ();
		}		// login via post data (if user just submitted a login form)
		elseif (isset ( $_POST ["login"] )) {
			$this->dologinWithPostData ($entityManager);
		}
	}

	private function my_session_start($timeout) {
		ini_set ( 'session.gc_maxlifetime', $timeout );
		session_start ();

		if (isset ( $_SESSION ['timeout_idle'] ) && $_SESSION ['timeout_idle'] < time ()) {
			
			session_destroy ();
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
			// check login form contents
			if (empty ( $_POST ['email'] )) {
				$this->errors [] = "Email field was empty.";
			} elseif (empty ( $_POST ['password'] )) {
				$this->errors [] = "Password field was empty.";
			} elseif (! empty ( $_POST ['email'] ) && ! empty ( $_POST ['password'] )) {


				$user = $entityManager->getRepository('User')->findOneBy(array('emailAddress' => $_POST ['email']));
				if($user){
					if (password_verify ( $_POST ['password'], $user->getPassword() )) {
						//check if account status allows login
						$accountStatus = 	$user->getUserUserAccountStatus()->getName();

						switch ($accountStatus) {
							case 'ACCOUNT_BLOCKED':
								$this->errors [] = "Login failed. Your account is blocked, please contact system administrator";
								break;
							case 'ACCOUNT_LOCKED':
								$this->errors [] = "Login failed. Your account is locked, please reset password";
								break;
							case 'ACCOUNT_NOT_VERIFIED':
								$this->errors [] = "Login failed. Your account is not verified, please verify using link sent to " . $user->getEmailAddress() . " on registration";
								break;
							default:
								$this->messages[] = "successfully authenticated";
								$UserProfile = $user->getUserProfile();

								$serializeUser = serialize($user);
								$_SESSION ['user_object'] = $serializeUser;
								$_SESSION ['email_address'] = $user->getEmailAddress();
								$_SESSION ['user_login_status'] = 1;
								$_SESSION ['user_role'] = $user->getUserUserRole()->getName();
								$_SESSION ['user_id'] = $user->getUserId();
								$_SESSION ['firstname'] = $UserProfile->getFirstName();
								$_SESSION ['surname'] = $UserProfile->getSurname();
								$_SESSION ['phone_number'] = $UserProfile->getPhoneNumber();


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

								//save temp login cookie expiring after 20min
								setcookie ( "mobileops_temp_login", $json, strtotime( '+30 days' ), "/" ); // here we are setting a cookie named username, with the Username on the database that will last 48 hours and will be set on the understandesign.com domain. This is an optional parameter.
								
								if (isset ( $_POST ['rememberme'] )) {
									setcookie ( "mobileops", $json, time () + (86400 * 30), "/" ); // here we are setting a cookie named username, with the Username on the database that will last 48 hours and will be set on the understandesign.com domain. This is an optional parameter.
								}

								//reset password count if not 0
								if($user->getPasswordRetryCount() !== 0){
									$user->setPasswordRetryCount(0);
									$entityManager->persist($user);
									$entityManager->flush();
								}
						}
					}else{
						//lock user account if password retry count = 3 (2 + 1 for this iteration)
						if($user->getPasswordRetryCount() == 2){
							$LuAccountStatus = $entityManager->getRepository('LuAccountStatus')->findOneBy(array('name' => 'ACCOUNT_LOCKED'));
							$user->setUserUserAccountStatus($LuAccountStatus);
							$this->errors [] = "Login failed. Your account is locked, please reset password";
						}else{
							//increase the password retry count by 1 on incorrect password
							$user->setPasswordRetryCount($user->getPasswordRetryCount()+ 1);
							$this->errors [] = "Login failed, incorrect password";
						}
						$entityManager->persist($user);
						$entityManager->flush();
					}

				}else{
					$this->errors [] = "This user does not exist.";
				}
			}
		} catch (Exception $e) {
			$this->errors[] = $e->getMessage();
		}

	}


	/**
	 * perform the logout
	 */
	public function doLogout() {
		try {
			if(!isset($_SESSION))
			{
				session_start();
			}
			
		} catch ( Exception $e ) {
		}
		
		try {
			// unset cookies
			setcookie ( "mobileops_temp_login", "", time () + (86400 * 31), "/" );
			setcookie ( "mobileops", "", time () - (86400 * 31), "/" );
			
			setcookie ( "fbm_" . FB_APPID, "", time () - (86400 * 31), "/" );
			setcookie ( "fbsr_" . FB_APPID, "", time () - (86400 * 31), "/" );
			
			if(isset($_SESSION['email_address']))
			{
				// delete the session of the user
				$_SESSION = array ();
				session_destroy ();
			}
			
				
			
			// return a little feeedback message
			$this->messages [] = "You have been logged out.";
		} catch (Exception $e) {
			$this->errors[] = $e->getMessage();
		}
	}

	/**
	 * simply return the current state of the user's login
	 *
	 * @return boolean user's login status
	 */
	public function isUserLoggedIn($entityManager) {
		try {
			if ((isset ( $_SESSION ['user_login_status'] ) and $_SESSION ['user_login_status'] == 1) || isset ( $_COOKIE ['mobileops'] )) {
				if (strpos ( $_SERVER ["QUERY_STRING"], "logout" ) >-1) {
					return false;
				}
			}
			
			if ((isset ( $_SESSION ['user_login_status'] ) and $_SESSION ['user_login_status'] == 1) and isset ( $_COOKIE ['mobileops_temp_login'] )) {
				setcookie ( "mobileops_temp_login", $_COOKIE ['mobileops_temp_login'], time () + (1200), "/" ); // here we are setting a cookie named username, with the Username on the database that will last 48 hours and will be set on the understandesign.com domain. This is an optional parameter.
				
			}

			//if there is a user session set, udate session with user details
			if ((isset ( $_SESSION ['user_login_status'] ) and $_SESSION ['user_login_status'] == 1) || isset ( $_COOKIE ['mobileops'] )) {
				if (!isset ( $_SESSION ['email_address'] )) {

					$cookie = $_COOKIE['mobileops'];
					$cookie = stripslashes($cookie);
					$savedUserDetailsArray = json_decode($cookie, true);

					$user = $entityManager->getRepository('User')->findOneBy(array('emailAddress' => $savedUserDetailsArray['email_address']));
					if($user){
						$UserProfile = $user->getUserProfile();
						$serializeUser = serialize($user);
								$_SESSION ['user_object'] = $serializeUser;
						$_SESSION ['email_address'] = $user->getEmailAddress();
						$_SESSION ['user_login_status'] = 1;
						$_SESSION ['user_role'] = $user->getUserUserRole()->getName();
						$_SESSION ['firstname'] = $UserProfile->getFirstName();
						$_SESSION ['surname'] = $UserProfile->getSurname();
						$_SESSION ['phone_number'] = $UserProfile->getPhoneNumber();

						$UserDetailsArray=array(
    							'user_role'=>$_SESSION ['user_role'],
    							'email_address'=>$_SESSION ['email_address'],
								'firstname'=>$_SESSION ['firstname'],
								'surname'=>$_SESSION ['surname'],
								'phone_number'=>$_SESSION ['phone_number'],
						);

						setcookie ( "mobileops", $_COOKIE ['mobileops'], time () + (86400 * 30), "/" ); // here we are setting a cookie named username, with the Username on the database that will last 48 hours and will be set on the understandesign.com domain. This is an optional parameter.
						return true;
					}
				}
				return true;
			}
		} catch (Exception $e) {
			$this->errors[] = $e->getMessage();
		}

	}
}