<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{
	public $username;
	public $password;
	public $totp;
	public $cardno;
	public $rememberMe;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username, password', 'required'),
			// rememberMe needs to be a boolean
			array('rememberMe', 'boolean'),
			// password needs to be authenticated
			array('password', 'authenticate'),
			array('totp, cardno', 'safe'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'rememberMe'=>'Remember me next time',
			'totp' => "One-time key",
			'cardno' => "Last 4 digits of card number",
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 * @param string $attribute the name of the attribute to be validated.
	 * @param array $params additional parameters passed with rule when being executed.
	 */
	public function authenticate($attribute,$params)
	{
		$this->_identity=new UserIdentity($this->username,$this->password,str_replace(" ", "", $this->totp), $this->cardno);
		if(!$this->_identity->authenticate()) {
			if($this->_identity->errorCode != UserIdentity::ERROR_SMS_INVALID && $this->_identity->errorCode != UserIdentity::ERROR_SMS_SENT && $this->_identity->errorCode != UserIdentity::ERROR_PUSH_SENT && $this->_identity->errorCode != UserIdentity::ERROR_PUSH_PENDING && $this->_identity->errorCode != UserIdentity::ERROR_CARDREADER_SENT && $this->_identity->errorCode != UserIdentity::ERROR_CARDREADER_INVALID && $this->_identity->errorCode != UserIdentity::ERROR_TOTP_INVALID && $this->_identity->errorCode != UserIdentity::ERROR_TOTP_REQUIRED) {
				$this->addError('password','Incorrect username or password.');
			}
		}
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
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
	}
}
