<?php

/**
 * The followings are the available columns in table 'tbl_user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $profile
 */
class User extends CActiveRecord
{
	const AUTH_METHOD_NONE = 0;
	const AUTH_METHOD_AUTHREQ = 1;
	const AUTH_METHOD_SMS = 2;
	const AUTH_METHOD_CARDREADER = 3;
	/**
	 * Returns the static model of the specified AR class.
	 * @return static the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password', 'required'),
			array('username, password', 'length', 'max'=>128),
			array('profile', 'safe'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'posts' => array(self::HAS_MANY, 'Post', 'author_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'username' => 'Username',
			'password' => 'Password',
		);
	}

	/**
	 * Checks if the given password is correct.
	 * @param string the password to be validated
	 * @return boolean whether the password is valid
	 */
	public function validatePassword($password)
	{
		return CPasswordHelper::verifyPassword($password,$this->password);
	}

	/**
	 * Generates the password hash.
	 * @param string password
	 * @return string hash
	 */
	public function hashPassword($password)
	{
		return CPasswordHelper::hashPassword($password);
	}

	public function getAuthMethod()
	{
		if($this->authreq_device_id != null) {
			return self::AUTH_METHOD_AUTHREQ;
		}
		if($this->sms_phone_no != null)
		{
			return self::AUTH_METHOD_SMS;
		}
		if($this->cardreader_last4 != null)
		{
			return self::AUTH_METHOD_CARDREADER;
		}
		return self::AUTH_METHOD_NONE;
	}

	public function sendSmsAuthCode()
	{
		if(empty($this->sms_phone_no)) {
			return null;
		}
		$authcode = mt_rand(100000,999999);
		$config = Yii::app()->params; 

		$sid = $config['twilio_sid'];
		$token = $config['twilio_token'];
		$client = new Twilio\Rest\Client($sid, $token);

		$client->messages->create(
		    $this->sms_phone_no,
		    array(
		        'from' => $config['twilio_phonenumber'],
		        'body' => "Your Purple Bank authentication code is " . $authcode
		    )
		);

		return $authcode;
	}
}
