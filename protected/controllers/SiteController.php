<?php

class SiteController extends Controller
{
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
				'actions' => array('login', 'authreqpoll', 'resetauthreq'),
				'users'=>array('*'),
			),
			array('allow',
				'users'=>array('@'),
			),
			array('deny',
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
		$isTotpPending = false;
		$isTotpInvalid = false;

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
				} else if($login == UserIdentity::ERROR_TOTP_REQUIRED || $login == UserIdentity::ERROR_TOTP_INVALID) {
					$isTotpPending = true;
				} else if($login == UserIdentity::ERROR_CARDREADER_SENT || $login == UserIdentity::ERROR_CARDREADER_INVALID) {
					$isCardreaderPending = true;
				}

				if($login == UserIdentity::ERROR_SMS_INVALID) {
					$isSmsInvalid = true;
				}
				if($login == UserIdentity::ERROR_CARDREADER_INVALID) {
					$isCardreaderInvalid = true;
				}
				if($login == UserIdentity::ERROR_TOTP_INVALID) {
					$isTotpInvalid = true;
				}
			}
		}
		// display the login form
		$this->renderPartial(Yii::app()->params['is_under_apple_approval'] ? 'login_apple_approval' : 'login',array('model'=>$model, 'isCardreaderInvalid' => $isCardreaderInvalid, 'isSmsInvalid' => $isSmsInvalid, 'isTotpInvalid' => $isTotpInvalid, 'isPushPending' => $isPushPending, 'isCardreaderPending' => $isCardreaderPending, 'isSmsPending' => $isSmsPending, 'isTotpPending' => $isTotpPending, 'pollUrl' => Yii::app()->createUrl('site/authreqpoll'), 'resendUrl' => Yii::app()->createUrl('site/resetauthreq'), "logoutUrl" => Yii::app()->createUrl('site/logout')));
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
		$this->renderPartial(Yii::app()->params['is_under_apple_approval'] ? 'dashboard_apple_approval' : 'dashboard', array(
			'transactions' => PaymentTransaction::getRecentTransactions(Yii::app()->user->id), 
		));
	}

	public function actionPayment() 
	{
		$this->renderPartial('payment', array(
			'recipient' => ((Yii::app()->request->isPostRequest && isset($_POST['recipient'])) ? $_POST['recipient'] : null),
			'source' => ((Yii::app()->request->isPostRequest && isset($_POST['source'])) ? $_POST['source'] : null), 
			'amount' => ((Yii::app()->request->isPostRequest && isset($_POST['amount'])) ? round($_POST['amount'],2) : null), 
			'date' => ((Yii::app()->request->isPostRequest && isset($_POST['date'])) ? $_POST['date'] : null), 
			'remarks' => ((Yii::app()->request->isPostRequest && isset($_POST['remarks'])) ? $_POST['remarks'] : null)
		));
	}

	public function actionConfirmpayment() 
	{
		if(!Yii::app()->request->isPostRequest || !isset($_POST['recipient']) || $_POST['recipient'] == 0 || !isset($_POST['source']) || !isset($_POST['amount'])) {
			$this->redirect(Yii::app()->createUrl('site/payment'));
		}

		if(isset($_POST['paymenttransaction_id']) && isset($_POST['signwithsms']) && $_POST['signwithsms'] == 1) {
			$sign = true;
			$paymenttransaction = PaymentTransaction::model()->findByPk($_POST['paymenttransaction_id']); 

			if(empty($paymenttransaction) || Yii::app()->user->id != $paymenttransaction->user_id) {
				$this->redirect(Yii::app()->homeUrl);
			}

			if(isset($_POST['smskey']) && $_POST['smskey'] == $paymenttransaction->sms_expected_authcode) {
				$paymenttransaction->sms_authcode = $_POST['smskey']; 
				$paymenttransaction->save(); 

				$this->redirect(Yii::app()->createUrl('site/successfulpayment?id=' . $paymenttransaction->id));
			} else {
				$signatureStatus = PaymentTransaction::SIGNATURE_STATUS_SMS_SENT;
			}
		} else if(isset($_POST['paymenttransaction_id']) && isset($_POST['signwithtotp']) && $_POST['signwithtotp'] == 1) {
			$sign = true;
			$paymenttransaction = PaymentTransaction::model()->findByPk($_POST['paymenttransaction_id']); 

			if(empty($paymenttransaction) || Yii::app()->user->id != $paymenttransaction->user_id) {
				$this->redirect(Yii::app()->homeUrl);
			}

			$user = User::model()->findByPk($paymenttransaction->user_id);

			if(isset($_POST['smskey']) && $user->validateVerificationKey($_POST['smskey'])) {
				$paymenttransaction->totp_authcode = $_POST['smskey']; 
				$paymenttransaction->save(); 

				$this->redirect(Yii::app()->createUrl('site/successfulpayment?id=' . $paymenttransaction->id));
			} else {
				$signatureStatus = PaymentTransaction::SIGNATURE_STATUS_TOTP_SENT;
			}

		} else if(isset($_POST['paymenttransaction_id']) && isset($_POST['signwithcard']) && $_POST['signwithcard'] == 1) {
			$sign = true;
			$paymenttransaction = PaymentTransaction::model()->findByPk($_POST['paymenttransaction_id']); 

			if(empty($paymenttransaction) || Yii::app()->user->id != $paymenttransaction->user_id) {
				$this->redirect(Yii::app()->homeUrl);
			}

			$user = User::model()->findByPk($paymenttransaction->user_id);

			if(!empty($_POST['authkey']) && is_numeric($_POST['authkey']) && $_POST['authkey'] > 10000000 && $_POST['authkey'] < 100000000 && isset($_POST['cardnumber']) && $_POST['cardnumber'] == $user->cardreader_last4) {
				$paymenttransaction->cardreader_authcode = $_POST['authkey']; 
				$paymenttransaction->save(); 

				$this->redirect(Yii::app()->createUrl('site/successfulpayment?id=' . $paymenttransaction->id));
			} else {
				$signatureStatus = PaymentTransaction::SIGNATURE_STATUS_CARDREADER_SENT;
			}

		} else {
			$sign = ((Yii::app()->request->isPostRequest && isset($_POST['sign'])) ? $_POST['sign'] : null); 

			if($sign) {
				$paymenttransaction = new PaymentTransaction();

				$paymenttransaction->source = $_POST['source'];
				$paymenttransaction->recipient = $_POST['recipient'];
				$paymenttransaction->amount = $_POST['amount'];
				$paymenttransaction->date = (!empty($_POST['date']) && $_POST['date'] != 'Immediately') ? $_POST['date'] : NULL;
				$paymenttransaction->remarks = $_POST['remarks'];
				$paymenttransaction->user_id = Yii::app()->user->id; 
				$paymenttransaction->timestamp = date("Y-m-d H:i:s");

				if(!$paymenttransaction->save()) {
					throw new Exception("Not Saved");
				}

				$signatureStatus = $paymenttransaction->sign();
				$paymenttransaction->refresh();
			} else {
				$paymenttransaction = null;
				$signatureStatus = null;
			}
		}

		if(isset($paymenttransaction) && $signatureStatus == PaymentTransaction::SIGNATURE_STATUS_NOT_NEEDED) {
			$this->redirect(Yii::app()->createUrl('site/successfulpayment?id=' . $paymenttransaction->id));
		} else {
			$this->renderPartial('confirmpayment', array(
				'recipient' => ((Yii::app()->request->isPostRequest && isset($_POST['recipient'])) ? $_POST['recipient'] : null),
				'source' => ((Yii::app()->request->isPostRequest && isset($_POST['source'])) ? $_POST['source'] : null), 
				'amount' => ((Yii::app()->request->isPostRequest && isset($_POST['amount'])) ? round($_POST['amount'],2) : null), 
				'date' => ((Yii::app()->request->isPostRequest && isset($_POST['date'])) ? $_POST['date'] : null), 
				'remarks' => ((Yii::app()->request->isPostRequest && isset($_POST['remarks'])) ? $_POST['remarks'] : null),
				'sign' => $sign, 
				'signatureStatus' => $signatureStatus,
				'pollUrl' => (isset($paymenttransaction) ? (Yii::app()->createUrl('site/authreqpaymenttransactionpoll?id=' . $paymenttransaction->id)) : null),
				'successUrl' => (isset($paymenttransaction) ? (Yii::app()->createUrl('site/successfulpayment?id=' . $paymenttransaction->id)) : null), 
				'paymenttransaction_id' => (isset($paymenttransaction) ? $paymenttransaction->id : null),
				'cardreader_nonce' => (isset($paymenttransaction) ? $paymenttransaction->cardreader_nonce : null),
			));
		}
	}

	public function actionEnrol() {
		$user = User::model()->findByPk(Yii::app()->user->id);

		$config = Yii::app()->params['database']; 
		$db = new Db($config['url'],$config['user'],$config['password'],$config['srv-db']);
		$signatureRequest = new DatabaseSignatureRequest($db);

		$signatureRequest->setupWith(
			$service_provider_name = 'Enrolment - Purple Online Banking', 
			$message_id = null,
			$response_url = Yii::app()->params['callbackUrl'], 
			$long_description = 'Tap on Allow to add this device to your Purple Online Banking account (' . htmlspecialchars($user->username) . ')', 
			$short_description = 'Enrol to Purple Bank', 
			$nonce = null, 
			$expiry_in_seconds = 300, 
			$device_id = -1, 
			$is_enrol = true
		);

		Yii::app()->session['authreq_enrolment_message_id'] = $signatureRequest->message_id;

		$data = "authreq://" . base64_encode($signatureRequest->getPushMessage()->getPayload());

		$this->renderPartial(Yii::app()->params['is_under_apple_approval'] ? 'enrol_apple_approval' : 'enrol', array(
			'qrurl' => "https://chart.googleapis.com/chart?cht=qr&chl=" . urlencode($data) . "&chs=500x500&chld=M",
			'enrolmentUrl' => $data,
			'pollUrl' => Yii::app()->createUrl('site/authreqenrolmentpoll'),
			'successUrl' => Yii::app()->createUrl('site/successfulenrolment'), 
		));
	}

	public function actionSuccessfulenrolment() {
		$result = $this->getEnrolmentResult();

		if($result['is_signed']) {
			$user = User::model()->findByPk(Yii::app()->user->id);
			$user->authreq_device_id = $result['device_id'];
			$user->save();
		}

		Yii::app()->session['authreq_enrolment_message_id'] = null;

		$this->renderPartial(Yii::app()->params['is_under_apple_approval'] ? 'successfulenrolment_apple_approval' : 'successfulenrolment', array(
		));
	}

	public function actionSuccessfulpayment($id=null) {
		if($id == null) $this->redirect(Yii::app()->homeUrl);
		$tr = PaymentTransaction::model()->findByPk($id);
		if($tr->user_id != Yii::app()->user->id || !$tr->isSigned()) {
			$this->redirect(Yii::app()->homeUrl);
		}

		$this->renderPartial('successfulpayment', array(
			'recipient' => $tr->recipient,
			'source' => $tr->source, 
			'amount' => $tr->amount, 
			'date' => $tr->date, 
			'remarks' => $tr->remarks,
		));
	}

	public function actionAuthreqpaymenttransactionpoll($id=null)
	{
		if($id == null || !Yii::app()->request->isAjaxRequest) Yii::app()->end(); 

		$tr = PaymentTransaction::model()->findByPk($id);
		if($tr->user_id != Yii::app()->user->id) {
			Yii::app()->end(); 
		}

		$this->_sendResponse(200, array("success" => $tr->isSigned()));
	}

	private function getEnrolmentResult() {
		$config = Yii::app()->params['database']; 
		$db = new Db($config['url'],$config['user'],$config['password'],$config['srv-db']);
		$message_id = Yii::app()->session['authreq_login_message_id'];
		$result = DatabaseSignatureRequest::isSignedWithDevice($db, Yii::app()->session['authreq_enrolment_message_id']);

		return $result;
	}

	public function actionAuthreqenrolmentpoll()
	{
		if(!isset(Yii::app()->session['authreq_enrolment_message_id'])) {
			Yii::app()->end(); 
		}

		$result = $this->getEnrolmentResult();

		$this->_sendResponse(200, array("success" => $result['is_signed']));
	}

	public function actionResetauthreq()
	{
		if(!Yii::app()->request->isPostRequest || !Yii::app()->request->isAjaxRequest) Yii::app()->end();
		Yii::app()->session['authreq_login_message_id'] = null;
		Yii::app()->session['sms_totp'] = null;
	}

	public function actionGetqrcode()
	{
		echo "<img src='" . User::model()->findByPk(Yii::app()->user->id)->getQrCodeUri() . "'>";
		Yii::app()->end();
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
