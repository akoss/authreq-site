<?php

class SiteController extends Controller
{
	public $layout='column1';

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}


	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array('dashboard'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'actions'=>array('dashboard'),
				'users'=>array('*'),
			),
		);
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		if (!defined('CRYPT_BLOWFISH')||!CRYPT_BLOWFISH)
			throw new CHttpException(500,"This application requires that PHP was compiled with Blowfish support for crypt().");

		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		$isPushPending = false;
		$isSmsPending = false;
		$isSmsInvalid = false;
		$isCardreaderPending = false;
		$isCardreaderInvalid = false;

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid

			if($model->validate()) {
				$login = $model->login();
				if($login == UserIdentity::ERROR_NONE) {
					$this->redirect(Yii::app()->createUrl('site/dashboard'));
				} else if($login == UserIdentity::ERROR_PUSH_SENT || $login == UserIdentity::ERROR_PUSH_PENDING) {
					$isPushPending = true;
				} else if($login == UserIdentity::ERROR_SMS_SENT || $login == UserIdentity::ERROR_SMS_INVALID) {
					$isSmsPending = true;
				} else if($login == UserIdentity::ERROR_CARDREADER_SENT || $login == UserIdentity::ERROR_CARDREADER_INVALID) {
					$isCardreaderPending = true;
				}

				if($login == UserIdentity::ERROR_SMS_INVALID) {
					$isSmsInvalid = true;
				}
				if($login == UserIdentity::ERROR_CARDREADER_INVALID) {
					$isCardreaderInvalid = true;
				}
			}
		}
		// display the login form
		$this->renderPartial('login',array('model'=>$model, 'isCardreaderInvalid' => $isCardreaderInvalid, 'isSmsInvalid' => $isSmsInvalid, 'isPushPending' => $isPushPending, 'isCardreaderPending' => $isCardreaderPending, 'isSmsPending' => $isSmsPending, 'pollUrl' => Yii::app()->createUrl('site/authreqpoll'), 'resendUrl' => Yii::app()->createUrl('site/resetauthreq'), "logoutUrl" => Yii::app()->createUrl('site/logout')));
	}

	public function actionAuthreqpoll()
	{
		$result = true;
		if(isset(Yii::app()->session['authreq_login_message_id'])) {
			$config = Yii::app()->params['database']; 
			$db = new Db($config['url'],$config['user'],$config['password'],$config['srv-db']);
			$message_id = Yii::app()->session['authreq_login_message_id'];
			$result = DatabaseSignatureRequest::isSigned($db, $message_id);
		}
		$this->_sendResponse(200, array("success" => $result));
	}

	public function actionDashboard() 
	{
		$this->renderPartial('dashboard', array("logoutUrl" => Yii::app()->createUrl('site/logout')));
	}

	public function actionResetauthreq()
	{
		if(!Yii::app()->request->isPostRequest || !Yii::app()->request->isAjaxRequest) Yii::app()->end();
		Yii::app()->session['authreq_login_message_id'] = null;
		Yii::app()->session['sms_totp'] = null;
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	private function _sendResponse($status = 200, $body = '', $content_type = 'application/json')
	{
		$status_header = 'HTTP/1.1 ' . $status;
		header($status_header);
		header('Content-type: ' . $content_type);
		echo CJSON::encode($body);
		Yii::app()->end();
	}
}
