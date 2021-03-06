<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/../yii/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following line when in production mode
// defined('YII_DEBUG') or define('YII_DEBUG',true);

include("vendors/authreq-sdk/Autoload.php");
include("vendors/Twilio/autoload.php");
include("vendor/autoload.php");

use Twilio\Rest\Client;

require_once($yii);
Yii::createWebApplication($config)->run();
