<?php

return array(
	'database' => array('url' => 'localhost', 'user' => 'root', 'password' => 'almakorte', 'srv-db' => 'authreq-srv', 'site-db' => 'authreq-site'),

	// LOCAL DEV

	'callbackUrl' => 'http://192.168.100.139:8080/authreq-srv/callback.php',
	'pushPem' => '/Users/harfox/uni/l5project/authreq-site/vendors/authreq-sdk/both.pem',
	'rootca' => '/Users/harfox/uni/l5project/authreq-site/vendors/authreq-sdk/entrust_root_certification_authority.pem',
	'use_apns_sandbox' => true,

	// s02 DEV

	//'callbackUrl' => 'https://s02.szente.info/authreq-srv/callback.php',
	//'pushPem' => '/var/www/cert/both-sandbox.pem',
	//'rootca' => '/var/www/cert/entrust_root_certification_authority.pem',
	//'use_apns_sandbox' => true,

	// s02 PROD

	//'callbackUrl' => 'https://s02.szente.info/authreq-srv/callback.php',
	//'pushPem' => '/var/www/cert/both-prod.pem',
	//'rootca' => '/var/www/cert/entrust_root_certification_authority.pem',
	//'use_apns_sandbox' => false,

	'twilio_sid' => "AC7856eb312100f145cba79df0268e4db6",
	'twilio_token' => "ffe8f783bf033ffc746dcca8ed0244cf",
	'twilio_phonenumber' => '+441412802071',

);
