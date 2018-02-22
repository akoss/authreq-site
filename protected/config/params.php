<?php

// this contains the application parameters that can be maintained via GUI
return array(
	// this is displayed in the header section
	'title'=>'My Yii Blog',
	// this is used in error pages
	'adminEmail'=>'webmaster@example.com',
	// number of posts displayed per page
	'postsPerPage'=>10,
	// maximum number of comments that can be displayed in recent comments portlet
	'recentCommentCount'=>10,
	// maximum number of tags that can be displayed in tag cloud portlet
	'tagCloudCount'=>20,
	// whether post comments need to be approved before published
	'commentNeedApproval'=>true,
	// the copyright information displayed in the footer section
	'copyrightInfo'=>'Copyright &copy; 2009 by My Company.',

	'database' => array('url' => 'localhost', 'user' => 'root', 'password' => 'almakorte', 'srv-db' => 'authreq-srv', 'site-db' => 'authreq-site'),
	'callbackUrl' => 'http://192.168.0.67:8080/authreq-srv/callback.php',
	'pushPem' => '/Users/harfox/uni/l5project/authreq-site/vendors/authreq-sdk/both.pem',
	'rootca' => '/Users/harfox/uni/l5project/authreq-site/vendors/authreq-sdk/entrust_root_certification_authority.pem',

	//'callbackUrl' => 'https://s02.szente.info/authreq-srv/callback.php',
	//'pushPem' => '/var/www/cert/both.pem',
	//'rootca' => '/var/www/cert/entrust_root_certification_authority.pem',

	'twilio_sid' => "AC7856eb312100f145cba79df0268e4db6",
	'twilio_token' => "ffe8f783bf033ffc746dcca8ed0244cf",
	'twilio_phonenumber' => '+441412802071',
);
