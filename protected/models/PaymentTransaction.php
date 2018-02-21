<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class PaymentTransaction extends CFormModel
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
			array('id, user_id, source, recipient, amount, date, remarks', 'required'),
			array('id, user_id, source, recipient, amount, date, remarks', 'safe'),
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
