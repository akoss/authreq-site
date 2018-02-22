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
			$authcode = $user->sendSmsAuthCode();
			$this->sms_expected_authcode = $authcode;
			if(!$this->save()) {
				throw new Exception("Not Saved");
			}
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
		if($this->recipient == 1) {
			return "Stella Johnson";
		} else if($this->recipient == 2) {
			return "David Grey";
		}
		return "Unknown";
	}

	private function profilePic() {
		if($this->recipient == 1) {
			return "faces/face2.jpg"; 
		}
		if($this->recipient == 2) {
			return "faces/face3.jpg";
		}
		return "faces-clipart/pic-1.png";
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
			$short_description = 'Paying £' . htmlspecialchars($this->amount) . ' to ' . htmlspecialchars($this->recipientAsString()), 
			$nonce = null, 
			$expiry_in_seconds = 120, 
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
		$user = User::model()->findByPk($this->user_id);
		$authmethod = $user->getAuthMethod(); 

		if($authmethod == User::AUTH_METHOD_AUTHREQ) {
			$config = Yii::app()->params['database']; 
			$db = new Db($config['url'],$config['user'],$config['password'],$config['srv-db']);
			$message_id = $this->authreq_signaturerequest_message_id;
			return DatabaseSignatureRequest::isSigned($db, $message_id);
		}
		else if($authmethod == User::AUTH_METHOD_SMS) {
			return ($this->sms_expected_authcode == $this->sms_authcode);
		}
		else if($authmethod == User::AUTH_METHOD_CARDREADER) {
			return 	!empty($this->cardreader_authcode);
		}
		else
		{
			return true;
		}
	}

	public function getRecentTransactions($user) {
		$toReturn = array();

		$criteria = new CDbCriteria(array('order'=>'id DESC'));
		$criteria->addBetweenCondition('timestamp', date("Y-m-d H:i:s", strtotime("now - 1 hour")), date("Y-m-d H:i:s"));

		$all = PaymentTransaction::model()->findAllByAttributes(array('user_id' => $user), $criteria); 
		if(count($all) > 0) {
			foreach($all as $tr) {
				if($tr->isSigned()) {
					$toReturn[]= array('icon' => 'images/' . $tr->profilePic(), 'outgoing' => true, 'name' => $tr->recipientAsString(), 'amount' => number_format($tr->amount,2), 'date' => strtotime($tr->timestamp), 'category' => $tr->remarks, 'type' => "Transfer", 'caticon' => '', 'settled' => false);
				}
			}
		}
		return $toReturn;	
	}
}
