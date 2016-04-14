<?php

require_once "bootstrap.php";
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

	
/**
 * A simple, clean and secure PHP Login Script / MINIMAL VERSION
 * For more versions (one-file, advanced, framework-like) visit http://www.php-login.net
 *
 * Uses PHP SESSIONS, modern password-hashing and salting and gives the basic functions a proper login system needs.
 *
 * @author Panique
 * @link https://github.com/panique/php-login-minimal/
 * @license http://opensource.org/licenses/MIT MIT License
 */


// checking for minimum PHP version
if (version_compare ( PHP_VERSION, '5.3.7', '<' )) {
	exit ( "Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !" );
	echo PHP_VERSION;
} else if (version_compare ( PHP_VERSION, '5.5.0', '<' )) {
	// if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
	// (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
	echo PHP_VERSION;
	require_once ("src/AppBundle/Logic/password_compatibility_library.php");
}
$entityManager = EntityManager::create($conn, $config);

// include the configs / constants for the database connection
require_once ("app/application.php");

// load the login class
require_once ("src/AppBundle/Logic/Login.php");

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process. in consequence, you can simply ...
$login = new Login ($entityManager);


// ... ask if we are logged in here:
if ($login->isUserLoggedIn ($entityManager) == true) {
	// the user is logged in. you can do whatever you want here.
	// for demonstration purposes, we simply show the "you are logged in" view.

	if (isset ( $_SESSION ['user_role'] )) {
		if (strcasecmp ( $_SESSION ['user_role'], "CLIENT" ) == 0) {
			include ("web/views/menu_client.php");
		}else if (strcasecmp ( $_SESSION ['user_role'], "PARTNER" ) == 0) {
			include ("web/views/menu_partner.php");
		}else if (strcasecmp ( $_SESSION ['user_role'], "ADMINISTRATOR" ) == 0) {
			include ("web/views/menu_admin.php");
		}
	}

	if (isset ( $_GET ["booking"] )) {
		include ("web/views/booking.php");
	}elseif (isset ( $_GET ["partnerprofile"] )) {
		include ("web/views/partner_profile.php");
	}elseif (isset ( $_GET ["clientprofile"] )) {
		include ("web/views/client_profile.php");
	}elseif (isset ( $_GET ["mybookings"] )) {
		include ("web/views/my_bookings.php");
	}elseif (isset ( $_GET ["bookingdetails"] )) {
		include ("web/views/booking_details.php");
	}elseif (isset ( $_GET ["updateservices"] )) {
		include ("web/views/update_services.php");
	}elseif (isset ( $_GET ["home"] )) {
		include ("web/views/home.php");
	} elseif (isset ( $_GET ["booking"] )) {
		include ("web/views/booking.php");
	}elseif (isset ( $_GET ["faq"] )) {
		include ("web/views/faq.php");
	}elseif (isset ( $_GET ["pricelist"] )) {
		include ("web/views/pricelist.php");
	}elseif (isset ( $_GET ["contactus"] )) {
		include ("web/views/contactus.php");
	}elseif (isset ( $_GET ["partnergallery"] )) {
		include ("web/views/partner_gallery.php");
	}elseif (isset ( $_GET ["editbooking"] )) {
		include ("web/views/booking.php");
	}else{
		include ("web/views/home.php");
	}
}else{
	include ("web/views/menu_browser.php");

	if (isset ( $_GET ["register"] )) {
		include ("web/views/client_register.php");
	} elseif (isset ( $_GET ["newpartner"] )) {
		include ("web/views/partner_register.php");
	}elseif (isset ( $_GET ["login"] )) {
		include ("web/views/login.php");
	}elseif (isset ( $_GET ["contactus"] )) {
		include ("web/views/contactus.php");
	}elseif (isset ( $_GET ["activateaccount"] )) {
		include ("web/views/activate_account.php");
	}elseif (isset ( $_GET ["resetpassword"] )) {
		include ("web/views/reset_password.php");
	}elseif (isset ( $_GET ["home"] )) {
		include ("web/views/home.php");
	} elseif (isset ( $_GET ["booking"] )) {
		include ("web/views/booking.php");
	}elseif (isset ( $_GET ["faq"] )) {
		include ("web/views/faq.php");
	}elseif (isset ( $_GET ["pricelist"] )) {
		include ("web/views/pricelist.php");
	}elseif (isset ( $_GET ["oauth_token"] )) {
		include ("web/views/twitterlogin.php");
	}elseif (isset ( $_GET ["partnergallery"] )) {
		include ("web/views/partner_gallery.php");
	}else{
		include ("web/views/home.php");
	}
}


include ("web/views/footer.php");
