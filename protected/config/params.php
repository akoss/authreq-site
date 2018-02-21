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
	'callbackUrl' => 'http://172.20.10.3:8080/authreq-srv/callback.php',
	'pushPem' => '/Users/harfox/uni/l5project/authreq-site/vendors/authreq-sdk/both.pem',
	'rootca' => '/Users/harfox/uni/l5project/authreq-site/vendors/authreq-sdk/entrust_root_certification_authority.pem',
);
