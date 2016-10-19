<?php
class Booking extends CActiveRecord {
	
	public $firstname;
    public $lastname;
	public $comment;
	public $useremail;
	public $useremailSearch;
	public $tostatus;
	public $apartment_id;
	public $phone;
	public $email;
	public $dateCreated;
	public $password;
	public $username;
    public $avalibility;
    public $subject;
    public $error;

	const STATUS_NEW=0;
	const STATUS_WAITPAYMENT=1;
	const STATUS_PAYMENTCOMPLETE=2;
	const STATUS_DECLINED=3;
	const STATUS_WAITOFFLINE = 4;

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{booking}}';
	}

	public function scopes() {
	    return array(
	        'datestart' => array('order' => 'date_start DESC'),
	    );
	}

	public static function getYiiDateFormat() {
		$return = 'MM/dd/yyyy';
		if (Yii::app()->language == 'ru') {
			$return = 'dd.MM.yyyy';
		}
		return $return;
	}

	public function rules() {
		return array(
			array('date_start, adult, date_end, time_in, time_out,' . (Yii::app()->user->isGuest ? 'useremail, phone, firstname, lastname' : ''), 'required', 'on' => 'bookingform'),
			array('status', 'numerical', 'integerOnly' => true),
			array('adult', 'numerical', 'integerOnly'=>true, 'min'=>1, 'on' => 'bookingform'),
			array('date_start, date_end', 'date', 'format'=>'yyyy-M-d'),
            array('subject, comment', 'required', 'on' => 'response'),
			array('useremail, comment, avalibility, error', 'safe'),
			array('useremail', 'email'),
			array('pin, book_unique', 'required', 'on' => 'detail'),
			array('date_start, date_end', 'checkAvalibility', 'on' => 'bookingform'),
			array('pin, book_unique', 'getDetail', 'on' => 'detail'),
			array('useremail', 'required', 'on' => 'restore'),
			array('user_id, useremail', 'bookingRestore', 'on' => 'restore'),
			array('useremail', 'myUserEmailValidator', 'on' => 'bookingform'),
			array('useremail, firstname, lastname', 'length', 'max' => 128),
			array('date_start, date_end, date_created, status, useremailSearch, apartment_id, id, child', 'safe', 'on' => 'search'),
		);
	}

	public function getDetail() {
		if(!is_null($this->book_unique) && !is_null($this->pin)) {
			$model = $this->with(array('apartment'))->find('book_unique=:book_unique AND pin=:pin', 
	                   					 array(':book_unique' =>$this->book_unique, ':pin' => $this->pin));
			if($model == null)
				$this->addError('book_unique', BookingModule::t('Booking not found'));
		} 
	}

	public function bookingRestore() {
		if($this->user_id == null) {
			$this->addError('useremail', UserModule::t('Email is incorrect.'));
		} else {
			$result = $this->find('user_id=:user_id', array(':user_id' => $this->user_id));
			if(is_null($result))
				$this->addError('useremail', BookingModule::t('Booking not found'));
			else {
				$message = new YiiMailMessage();          
	            $message->subject = BookingModule::t('Booking restore access');
	            $message->view ='booking_restore';
	            $message->setBody(array('book_unique' => $result->book_unique,
	                                    'pin' => $result->pin,
	                                    ),'text/html', 'utf-8');
	            $message->from = param('adminEmail', 'noreply@orenda.co.ua');
	            $message->setTo($this->useremail); 
	            Yii::app()->mail->send($message);
			}
		}
	}

    public function checkAvalibility() {
        if($this->date_start && $this->date_end) {
            $result = ApartmentDate::model()->checkDates($this->date_start, $this->date_end, $this->apartment_id);
            if(!$result)
                $this->addError('date_end', ApartmentsModule::t('Empty dates'));
        }
    }
	public function myUserEmailValidator() {
		if (Yii::app()->user->isGuest) {
			$model = User::model()->findByAttributes(array('email' => $this->useremail));
			if ($model) {
				$this->addError('useremail',
					Yii::t('module_booking', 'User with such e-mail already registered. Please try again.',
						Yii::app()->createUrl('/user/login')));
			}
		}
	}



	public function relations() {
		Yii::import('application.modules.apartments.models.Apartment');
		return array(
			'ap' => array(self::HAS_ONE, 'Apartment', '', 'on'=>'t.apartment_id = ap.id'),
			'apartment' => array(self::BELONGS_TO, 'Apartment', 'apartment_id'),
			'description' => array(self::HAS_ONE, 'Description', '', 'on'=> 't.apartment_id  = description.apartment_id', 'scopes' => array('lang')),
			'thumb' => array(self::HAS_MANY, 'Images', '', 'on'=> 't.apartment_id  = thumb.id_object'),
			'payments' => array(self::HAS_MANY, 'Payment', 'order_id'),
			'user' => array(self::BELONGS_TO, 'User', 'sender_id'),
			'time_in_value' => array(self::HAS_ONE, 'TimesIn', '', 'on'=>'t.time_in = time_in_value.id'),
			'time_out_value' => array(self::HAS_ONE, 'TimesOut', '', 'on'=>'t.time_out = time_out_value.id'),
		);
	}

	public function behaviors(){
		return array(
			'AutoTimestampBehavior' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
				'createAttribute' => 'date_created',
				'updateAttribute' => 'date_updated',
			),
		);
	}

	public function attributeLabels() {
		return array(
			'date_start' => BookingModule::t('Check-in date'),
            'date_start' => BookingModule::t('Check-in date'),
			'date_end' => BookingModule::t('Check-out date'),
			'subject' => BookingModule::t('Subject'),
			'guests' => BookingModule::t('Guests'),
			'adult' => BookingModule::t('Adult'),
			'child' => BookingModule::t('Child'),
			'book_unique' => BookingModule::t('Book unique'),
			'pin' => BookingModule::t('Pin'),
			'time_in' => BookingModule::t('Check-in time'),
			'time_out' => BookingModule::t('Check-out time'),
			'comment' => BookingModule::t('Comment'),
			'firstname' => BookingModule::t('Your first name'),
            'lastname' => BookingModule::t('Your last name'),
			'status' => BookingModule::t('Status'),
			'useremail' => Yii::t('common', 'E-mail'),
			'useremailSearch' => tt('User e-mail', 'booking'),
			'sum' => tt('Booking price', 'booking'),
			'date_created' => tt('Creation date', 'booking'),
			'dateCreated' => tt('Creation date', 'booking'),
			'apartment_id' => tt('Apartment ID', 'booking'),
			'id' => tt('ID', 'apartments'),
			'phone' => BookingModule::t('Your phone number'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->with = array('user', 'ap', 'description', 'thumb');

		if ($this->date_start) {
			$criteria->compare('date_start', $this->getDateForMysql($this->date_start));
		}

		if ($this->date_end) {
			$criteria->compare('date_end', $this->getDateForMysql($this->date_end));
		}

		if ($this->date_created) {
			$criteria->compare('date_created', $this->getDateForMysql($this->date_created), true);
		}

		if($this->scenario == 'user') {
			$criteria->compare('t.sender_id', Yii::app()->user->id);
		}
		$criteria->compare('t.id', $this->id);
		$criteria->compare('user.email', $this->useremailSearch, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			'sort' => array(
				'defaultOrder' => 't.date_created DESC',
			),
			'pagination'=>array(
				'pageSize'=>param('adminPaginationPageSize', 20),
			),
		));
	}

	public function getDateForMysql($date) {
		$mysqlDate = CDateTimeParser::parse($date, self::getYiiDateFormat());
		return date('Y-m-d', $mysqlDate);
	}

	protected function beforeSave() {
		if($this->isNewRecord){
			$this->book_unique = rand(100000, 999999);
			$this->pin = substr(md5(microtime()),rand(0,26),6);
			$this->guests = $this->adult+$this->child;
		}
		if (!$this->user_id) {
			return false;
		}
		return parent::beforeSave();
	}

	public function paymentSuccess() {
		$this->status = Booking::STATUS_PAYMENTCOMPLETE;
		$this->update(array('status'));

		$notifier = new Notifier;
		$notifier->raiseEvent('onPaymentSuccess', $this, $this->user_id);
	}

	public function getSumLine() {
		if ($this->sum_rur && $this->sum_usd) {
			return $this->sum_rur . ' (' . $this->sum_usd . '$)';
		}
		else if ($this->sum_rur) {
			return $this->sum_rur;
		}
		else if ($this->sum_usd) {
			return $this->sum_usd . ' $';
		}
		return '';
	}

	public static function getDate($mysqlDate, $full = 0) {
		if (!$full) {
			$date = CDateTimeParser::parse($mysqlDate, 'yyyy-MM-dd');
		}
		else {
			$date = CDateTimeParser::parse($mysqlDate, 'yyyy-MM-dd hh:mm:ss');
		}
		return Yii::app()->dateFormatter->format(self::getYiiDateFormat(), $date);
	}

	public static function getJsDateFormat() {
		$dateFormat = 'dd.mm.yy';
		if (Yii::app()->language == 'en') {
			$dateFormat = 'mm/dd/yy';
		}
		return $dateFormat;
	}

	public function getStatuses() {
		return array(
			'' => '',
			Booking::STATUS_NEW => tt('Need admin approve', 'booking'),
			Booking::STATUS_WAITPAYMENT => tt('Wait for payment', 'booking'),
			Booking::STATUS_PAYMENTCOMPLETE => tt('Payment complete', 'booking'),
			Booking::STATUS_DECLINED => tt('Booking declined', 'booking'),
		);
	}

	public function returnStatusHtml() {
		$return = '';
		switch ($this->status) {
			case Booking::STATUS_NEW:
				$return = tt('Need admin approve', 'booking');
				break;
			case Booking::STATUS_WAITPAYMENT:
				$return = tt('Wait for payment', 'booking');
				break;
			case Booking::STATUS_PAYMENTCOMPLETE:
				$return = tt('Payment complete', 'booking');
				break;
			case Booking::STATUS_DECLINED:
				$return = tt('Booking declined', 'booking');
				break;
		}
		return $return;
	}
	
	protected function afterFind() {
		$dateFormat = param('bookingModule_dateFormat', 0) ? param('bookingModule_dateFormat') : param('dateFormat', 'd.m.Y H:i:s');
		$this->dateCreated = date($dateFormat, strtotime($this->date_created));

		return parent::afterFind();
	}

	public function getCountUnreaded($userId) {

		$c = new CDbCriteria();
		$c->addCondition('t.user_id = :user_id');
		$c->addCondition('t.status = :status');
		$c->params = array(
			'user_id' => $userId,
			'status' => self::STATUS_NEW,
		);
		return self::model()->count($c);
	}

}