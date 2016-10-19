<?php

class RequestApartment extends CFormModel {
    
	public $user;
	public $date_from;
        public $date_to;
        public $email;
        public $phone;
        public $message;
	
	public function rules() {
		return array(
			array('user, date_from, date_to, phone, email', 'required'),
                        array('user', 'length', 'min' => 3),
                        array('email', 'email'),
			
		);
	}


	public function attributeLabels()
	{
		return array(
			'user'=>ApartmentsModule::t('User'),
                        'date_from' => ApartmentsModule::t('Date from'),
                        'date_to' => ApartmentsModule::t('Date to'),
                        'email' => ApartmentsModule::t('Email'),
                        'phone' => ApartmentsModule::t('Phone'),
                        'message' => ApartmentsModule::t('Message'),
		);
	}
} 