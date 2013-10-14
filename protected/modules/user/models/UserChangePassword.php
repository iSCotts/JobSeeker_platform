<?php
/**
 * UserChangePassword class.
 * UserChangePassword is the data structure for keeping
 * user change password form data. It is used by the 'changepassword' action of 'UserController'.
 */
class UserChangePassword extends CFormModel {
    public $oldPassword;
	public $password;
	public $verifyPassword;
	
	public function rules() {
		return array(
			array('oldPassword,password, verifyPassword', 'required'),
			array('password', 'length', 'max'=>128, 'min' => 6,'message' => UserModule::t("Incorrect password (Minimum length is 6 symbols).")),
                        array('oldPassword', 'compareOldPass', 'compareAttribute'=>'password', 'message' => UserModule::t("Old passoword is incorrect"), 'required'),
			array('verifyPassword', 'compare', 'compareAttribute'=>'password', 'message' => UserModule::t("Verify password does not march new password")),
                        array('password', 'passwordAlphaNumeric'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'password'=>UserModule::t("New Password"),
			'verifyPassword'=>UserModule::t("Retype Password"),
		);
                
	}
        
        public function passwordAlphaNumeric($attribute,$params)
        {
            $numeric = '/[0-9]+/u';
            $aplha = '/[A-Za-z_]+/u';
            if(!preg_match($aplha, $this->$attribute))
            {
                $this->addError($attribute, 'your password must contain some alpha values!');
            }
            else if(!preg_match($numeric, $this->$attribute))
            {
                $this->addError($attribute, 'your password must contain some numeric values!');
            }
            
        }
        
        public function compareOldPass($attribute,$params)
        {
            $user = UserModule::user();
            $identity=new UserIdentity($user->username,$this->oldPassword);
            
            if(!$identity->checkOldPassword())
            {
                $this->addError($attribute,'Please enter correct password');
            }
        }
        
        
} 