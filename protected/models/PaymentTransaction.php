<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class PaymentTransaction extends CActiveRecord
{

const SIGNATURE_STATUS_NOT_NEEDED = 0;
const SIGNATURE_STATUS_PUSH_SENT = 1;
const SIGNATURE_STATUS_SMS_SENT = 2;
const SIGNATURE_STATUS_CARDREADER_SENT = 3;

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

		$authmethod = $user->getAuthMethod(); 

		if($authmethod == User::AUTH_METHOD_AUTHREQ) {
			$this->sendPush($user);
			return self::SIGNATURE_STATUS_PUSH_SENT;
		}
		else if($authmethod == User::AUTH_METHOD_SMS) {
			$this->sendSms($user);
			return self::SIGNATURE_STATUS_SMS_SENT;
		}
		else if($authmethod == User::AUTH_METHOD_CARDREADER) {
			return self::SIGNATURE_STATUS_CARDREADER_SENT;
		}
		else
		{
			return self::SIGNATURE_STATUS_NOT_NEEDED;
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
		
		$this->authreq_signaturerequest_message_id = $signatureRequest->message_id; 
		$this->save();
	}

	public function isSigned() {
		$config = Yii::app()->params['database']; 
		$db = new Db($config['url'],$config['user'],$config['password'],$config['srv-db']);
		$message_id = $this->authreq_signaturerequest_message_id;
		return DatabaseSignatureRequest::isSigned($db, $message_id);
	}
}
