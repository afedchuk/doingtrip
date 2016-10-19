<?php


class ContactForm extends CActiveRecord {
	public $name;
	public $email;
	public $body;
	public $verifyCode;
	public $phone;
	public $useremail;
	public $username;

	public function tableName() {
		return '{{contactform}}';
	}

	public function behaviors(){
		return array(
			'AutoTimestampBehavior' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
				'createAttribute' => 'date_created',
				'updateAttribute' => null,
			),
		);
	}

	public function rules()	{
		return array(
			array('body'.(Yii::app()->user->isGuest ? ', name, email' : ''), 'required'),
			array('email', 'email'),
			array('verifyCode', 'captcha', 'allowEmpty'=>!Yii::app()->user->isGuest),
			array('phone, user_id, ip', 'safe'),
			array('user_id', 'validateSpam'),
			array('name, email', 'length', 'max' => 128),
			array('phone', 'length', 'max' => 16, 'min' => 5),
			array('body', 'length', 'max' => 1024),
		);
	}

	public function validateSpam($attribute,$params){
		if($this->user_id > 0 || ($this->user_id == 0 && $this->ip)){
			$model = $this->find('user_id=:user_id AND date_created >=:date_created AND ip=:ip', array(':user_id' => $this->user_id,':date_created' => date('Y-m-d H:i:s', time() - 3600), ':ip' => $this->ip));
			if($model) {
				$this->addError('user_id', ContactformModule::t('Already sent {time}', array('{time}' => date('H:i',  strtotime($model->date_created." +1 hours")))));
			}
		}
	}
	
	public function attributeLabels() {
		return array(
			'name' => ContactformModule::t('Name'),
			'email' => ContactformModule::t('Email'),
			'phone' => ContactformModule::t('Phone'),
			'body' => ContactformModule::t('Body'),
			'verifyCode' => ContactformModule::t('Verification Code'),
		);
	}
}