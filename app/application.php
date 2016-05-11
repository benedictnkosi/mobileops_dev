<?php

/**
 * Configuration for: Database Connection
 *
 * For more information about constants please @see http://php.net/manual/en/function.define.php
 * If you want to know why we use "define" instead of "const" @see http://stackoverflow.com/q/2447791/1114320
 *
 * DB_HOST: database host, usually it's "127.0.0.1" or "localhost", some servers also need port info
 * DB_NAME: name of the database. please note: database and database table are not the same thing
 * DB_USER: user for your database. the user needs to have rights for SELECT, UPDATE, DELETE and INSERT.
 * DB_PASS: the password of the above user
 */

define("SYSTEM_EMAIL_ADDRESS", "info@mobileops.co.za");
define("NOTIFICATION_EMAIL_GROUP", "info@mobileops.co.za,nkosi.benedict@gmail.com");
define("DOMAIN_NAME", "mobileops.co.za");
define("COUNTRY", "South Africa");
define('GENERIC_SYSTEM_ERROR', "An error occurred, please contact system administrator @ info@mobileops.co.za");
define("RADIUS", 0.1019);



define("FB_APPID", "773233792802919"); //LIVE
//define("FB_APPID", "773239122802386"); //TEST


//Twitter login

//production
/*
define('CONSUMER_KEY', 'PZiBO5CHLXxIQ2etaC388QK7m');
define('CONSUMER_SECRET', 'faz1O0stOF6dDiaFNB0BJUR7wIbsH5BzW4Yl2EkUXb3tUqvMBD');
define('OAUTH_CALLBACK', 'http://mobileops-test.co.za/index.php');
*/

//test local

define('CONSUMER_KEY', 'JKAVnMjUMLTd6ZkVUvEQTJaBC');
define('CONSUMER_SECRET', 'KRfEBQxfQh7y7bH7mIroxFFpMwoia7g3o8AfJFxbzloCuYUp17');
define('OAUTH_CALLBACK', 'http://mobileops-test.co.za/index.php');


$_SESSION = array ();