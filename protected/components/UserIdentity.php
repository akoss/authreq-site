<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;
	private $totp; 
	private $cardno; 

	const ERROR_PUSH_SENT = 50; 
	const ERROR_PUSH_PENDING = 51; 
	const ERROR_SMS_SENT = 52; 
	const ERROR_SMS_INVALID = 53; 
	const ERROR_CARDREADER_SENT = 54; 
	const ERROR_CARDREADER_INVALID = 55; 
	const ERROR_TOTP_REQUIRED = 56; 
	const ERROR_TOTP_INVALID = 57; 

	function __construct($username, $password, $totp, $cardno) {		
		$this->username = $username; 
		$this->password = $password; 
		$this->totp = $totp; 
		$this->cardno = $cardno;
	}

	private function sendPush($user) {
		$config = Yii::app()->params['database']; 
		$db = new Db($config['url'],$config['user'],$config['password'],$config['srv-db']);
		$signatureRequest = new DatabaseSignatureRequest($db);

		$signatureRequest->setupWith(
			$service_provider_name = Yii::app()->params['service_name'], 
			$message_id = null,
			$response_url = Yii::app()->params['callbackUrl'], 
			$long_description = 'Someone is trying to log in to your ' . Yii::app()->params['service_name'] . ' account \'' . htmlspecialchars($user->username) . "' at " . date("d/m/Y H:m:s") . ".", 
			$short_description = 'Login Attempt', 
			$nonce = null, 
			$expiry_in_seconds = 120, 
			$device_id = $user->authreq_device_id
		);

		Yii::app()->session['authreq_login_message_payload'] = $signatureRequest->getPushMessage()->getPayload();

		if(!$signatureRequest->saved) {
			throw new Exception("Not saved");
		}

		$is_sandbox = Yii::app()->params['use_apns_sandbox'];

		$signatureRequest->sendPush(Yii::app()->params['pushPem'], Yii::app()->params['rootca'], $is_sandbox);

		Yii::app()->session['authreq_login_message_id'] = $signatureRequest->message_id;
	}

	private function checkSessionSignatureStatus($message_id) {
		$config = Yii::app()->params['database']; 
		$db = new Db($config['url'],$config['user'],$config['password'],$config['srv-db']);
		return DatabaseSignatureRequest::isSigned($db, $message_id);
	}

	/**
	 * Authenticates a user.
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$user=User::model()->find('LOWER(username)=?',array(strtolower($this->username)));
		$authmethod = (isset($user) ? $user->getAuthMethod() : null);

		if($user===null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if(!$user->validatePassword($this->password))
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else if($authmethod == User::AUTH_METHOD_AUTHREQ && isset(Yii::app()->session['authreq_login_message_id']) && !$this->checkSessionSignatureStatus(Yii::app()->session['authreq_login_message_id'])) {
			// check whether login succeeded 
			$this->errorCode = self::ERROR_PUSH_PENDING;
		} else if($authmethod == User::AUTH_METHOD_AUTHREQ && !isset(Yii::app()->session['authreq_login_message_id'])) {
			// authreq enabled -- need push
			$this->sendPush($user);
			$this->errorCode = self::ERROR_PUSH_SENT;
		}
		else if($authmethod == User::AUTH_METHOD_TOTP && empty($this->totp)) {
			$this->errorCode = self::ERROR_TOTP_REQUIRED;
		} 
		else if($authmethod == User::AUTH_METHOD_TOTP && !empty($this->totp) && !$user->validateVerificationKey($this->totp)) {
			$this->errorCode = self::ERROR_TOTP_INVALID;
		} 
		else if($authmethod == User::AUTH_METHOD_SMS && empty(Yii::app()->session['sms_totp'])) {
			// sms enabled -- need push
			Yii::app()->session['sms_totp'] = $user->sendSmsAuthCode();
			$this->errorCode = self::ERROR_SMS_SENT;
		} else if($authmethod == User::AUTH_METHOD_SMS && !empty(Yii::app()->session['sms_totp']) && $this->totp != Yii::app()->session['sms_totp']) {
			$this->errorCode = self::ERROR_SMS_INVALID;
		} else if($authmethod == User::AUTH_METHOD_CARDREADER && empty(Yii::app()->session['sms_totp'])) {
			Yii::app()->session['sms_totp'] = "dummy";
			$this->errorCode = self::ERROR_CARDREADER_SENT;
		} else if($authmethod == User::AUTH_METHOD_CARDREADER && !empty(Yii::app()->session['sms_totp']) && ($this->cardno != $user->cardreader_last4 || $this->totp < 10000000 || $this->totp > 99999999)) {
			$this->errorCode = self::ERROR_CARDREADER_INVALID;
		} else {
			$this->_id=$user->id;
			$this->username=$user->username;
			$this->errorCode=self::ERROR_NONE;
		}
		return $this->errorCode == self::ERROR_NONE;
	}

	/**
	 * @return integer the ID of the user record
	 */
	public function getId()
	{
		return $this->_id;
	}
}