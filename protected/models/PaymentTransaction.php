<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class PaymentTransaction extends CActiveRecord
{

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{paymenttransaction}}';
	}

	public function rules()
	{
		return array(
			array('user_id, source, recipient, amount', 'required'),
			array('user_id, source, recipient, amount, date, remarks', 'safe'),
		);
	}

	public function relations()
	{
		return array(
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
		);
	}

	public function sign() 
	{
		$user = User::model()->findByPk(Yii::app()->user->id);
		if($user->authreq_device_id != null) {
			$this->sendPush($user);
		}
	}

	private function sourceAsString() {
		if($this->source == 1) {
			return "My Current Account (08233593)";
		} else if($this->source == 2) {
			return "My Savings(08233594)";
		}
		return "Unknown";
	}

	private function recipientAsString() {
		if($this->source == 1) {
			return "Stella Johnson (71809176)";
		} else if($this->source == 2) {
			return "David Grey (74560192)";
		}
		return "Unknown";
	}

	private function sendPush($user) {
		$config = Yii::app()->params['database']; 
		$db = new Db($config['url'],$config['user'],$config['password'],$config['srv-db']);
		$signatureRequest = new DatabaseSignatureRequest($db);

		$signatureRequest->setupWith(
			$service_provider_name = 'Purple Online Banking', 
			$message_id = null,
			$response_url = Yii::app()->params['callbackUrl'], 
			$long_description = 'Paying £' . htmlspecialchars($this->amount) . ' to ' . htmlspecialchars($this->recipientAsString()) . ' from \'' . htmlspecialchars($this->sourceAsString()) . '\'. ' . (!empty($this->remarks) ? ("\nRemark: '" . htmlspecialchars($this->remarks) . "'.") : ""), 
			$short_description = 'Paying £' . htmlspecialchars($this->amount) . ' to ' . htmlspecialchars($this->recipient), 
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

	/*public function authenticate($attribute,$params)
	{
		$this->_identity=new UserIdentity($this->username,$this->password,str_replace(" ", "", $this->totp), $this->cardno);
		if(!$this->_identity->authenticate()) {
			if($this->_identity->errorCode != UserIdentity::ERROR_SMS_INVALID && $this->_identity->errorCode != UserIdentity::ERROR_SMS_SENT && $this->_identity->errorCode != UserIdentity::ERROR_PUSH_SENT && $this->_identity->errorCode != UserIdentity::ERROR_PUSH_PENDING && $this->_identity->errorCode != UserIdentity::ERROR_CARDREADER_SENT && $this->_identity->errorCode != UserIdentity::ERROR_CARDREADER_INVALID) {
				$this->addError('password','Incorrect username or password.');
			}
		}
	}

	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity,$duration);
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_SMS_INVALID) {
			$this->totp = null;
		}
		return $this->_identity->errorCode;
	}*/
}
