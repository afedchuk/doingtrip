<?php
/**
 * RegistrationForm class.
 * RegistrationForm is the data structure for keeping
 * user registration form data. It is used by the 'registration' action of 'UserController'.
 */
class RegistrationForm extends User {
    
	public $verifyPassword;
	public $verifyCode;
	
	public function rules() {
            
		$rules = array(
			array('phone, firstname, lastname, password, verifyPassword, email', 'required'),
			array('password', 'length', 'max'=>128, 'min' => 4,'message' => UserModule::t("Incorrect password (minimal length 4 symbols).")),
			array('email', 'email'),
			array('email', 'unique', 'message' => UserModule::t("This user's email address already exists.")),
			array('verifyPassword', 'compare', 'compareAttribute'=>'password', 'message' => UserModule::t("Retype Password is incorrect.")),
            array('subscription, type', 'safe')
		);

		if (isset($_POST['ajax']) && $_POST['ajax']==='RegistrationForm-form') 
			return $rules;
		else 
			array_push($rules,array('verifyCode', 'captcha', 'allowEmpty'=>!UserModule::doCaptcha('registration')));
                
		return $rules;
                
	}

	
}