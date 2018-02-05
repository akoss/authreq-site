<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;

	const ERROR_PUSH_SENT = 50; 
	const ERROR_PUSH_PENDING = 51; 

	private function sendPush($user) {
		$config = Yii::app()->params['database']; 
		$db = new Db($config['url'],$config['user'],$config['password'],$config['srv-db']);
		$signatureRequest = new DatabaseSignatureRequest($db);

		$signatureRequest->setupWith(
			$service_provider_name = 'Purple Online Banking', 
			$message_id = null,
			$response_url = Yii::app()->params['callbackUrl'], 
			$long_description = 'Login with ' . htmlspecialchars($user->username) . ' near Glasgow, UK', 
			$short_description = 'Login (' . htmlspecialchars($user->username) . ')', 
			$nonce = null, 
			$expiry_in_seconds = 5000, 
			$device_id = $user->authreq_device_id
		);

		if(!$signatureRequest->saved) {
			throw new Exception("Not saved");
		}

		$signatureRequest->sendPush(Yii::app()->params['pushPem'], Yii::app()->params['rootca']);
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
		if($user===null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if(!$user->validatePassword($this->password))
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else if(isset(Yii::app()->session['authreq_login_message_id']) && !$this->checkSessionSignatureStatus(Yii::app()->session['authreq_login_message_id'])) {
			// check whether login succeeded 
			$this->errorCode = self::ERROR_PUSH_PENDING;
		} else if(!empty($user->authreq_device_id) && !isset(Yii::app()->session['authreq_login_message_id'])) {
			// login enabled -- need push
			// send push
			$this->sendPush($user);
			$this->errorCode = self::ERROR_PUSH_SENT;
		}
		else
		{
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