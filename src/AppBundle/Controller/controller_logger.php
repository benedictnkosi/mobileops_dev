<?php
/**
 * Created by PhpStorm.
 * User: sibusiso87rn
 * Date: 2016/05/10
 * Time: 6:26 PM
 */

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

require_once ('controller_memcache.php');

function getLogger(){

    if($_SERVER['logger']!=NULL){
        return $_SERVER['logger'];
    }else{

    // Create the logger
    $logger = new Logger('logger');

    // Now add some handlers
    $logger->pushHandler(new StreamHandler(__DIR__.'/../../../server.log', Logger::DEBUG));
    $logger->pushHandler(new FirePHPHandler());

    $_SERVER['logger'] = $logger;

    return $logger;

    }
}

