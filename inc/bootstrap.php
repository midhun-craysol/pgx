<?php
// Report all errors except E_NOTICE
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
date_default_timezone_set('UTC');
define("PROJECT_ROOT_PATH", __DIR__ . "/../");

// include main configuration file
include( PROJECT_ROOT_PATH . "/inc/db_cc9178b472c4bb6ae1d9.php");
include( PROJECT_ROOT_PATH . "/inc/general_3b71f92b296c33eff7c3.php");
include( PROJECT_ROOT_PATH . "/inc/routes.php");
 
// include the base controller file
include(PROJECT_ROOT_PATH . "/controllers/base/BaseController.php");
include(PROJECT_ROOT_PATH . "/controllers/base/UserBaseController.php");
 
// include the use model file
include(PROJECT_ROOT_PATH . "/models/base/CrudModel.php");
include(PROJECT_ROOT_PATH.'/razorpay_php/Razorpay.php');

?>