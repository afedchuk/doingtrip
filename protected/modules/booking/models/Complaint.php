<?php


class Complaint extends CActiveRecord {
	
	const STATUS_PENDING=0;
	const STATUS_APPROVED=1;
        
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{complaint}}';
	}

	public static function getYiiDateFormat() {
		$return = 'MM/dd/yyyy';
		if (Yii::app()->language == 'ru') {
			$return = 'dd.MM.yyyy';
		}
		return $return;
	}

	public function relations() {
		Yii::import('application.modules.apartments.models.Apartment');
		return array(
			'apartment' => array(self::BELONGS_TO, 'Apartment', '', 'on'=> 'apartment_id  = apartment.id', ),
			'description' => array(self::HAS_ONE, 'Description', '', 'on'=> 'apartment_id  = description.apartment_id', 'scopes' => array('lang')),
		);
	}

	public function rules() {
		return array(
			
			array('status, apartment_id', 'numerical', 'integerOnly' => true),
			array('phone', 'safe'),
			array('email', 'email'),
			array('username, email', 'length', 'max' => 128),
			array('username, email, message', 'required'),
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
			'email' => BookingModule::t('E-mail'),
			'message' => BookingModule::t('Message'),
			'username' => BookingModule::t('Your username'),
			'status' => BookingModule::t('Status'),
			'phone' => BookingModule::t('Your phone number'),
		);
	}
        
    public static function getCountPending(){
		$sql = "SELECT COUNT(complaint_id) FROM {{complaint}} WHERE status=".self::STATUS_PENDING;
		return (int) Yii::app()->db->createCommand($sql)->queryScalar();
	}

	public static function getUserEmailLink($data) {
		return "<a href='mailto:".$data->email."'>".$data->name."</a>";
	}

	public function search(){
		$criteria = new CDbCriteria();

		$criteria->compare('username',$this->username, true);
		$criteria->compare('message',$this->message, true);
		$criteria->compare('complaint_id',$this->complaint_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>param('adminPaginationPageSize', 20),
			),
			'sort'=>array('defaultOrder'=>'complaint_id DESC'),
		));
	}

}