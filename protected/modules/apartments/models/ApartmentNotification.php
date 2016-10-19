<?php

class ApartmentNotification extends ParentModel {

	const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{apartment_notification}}';
                
	}
        


    public function rules() {
		return array(
			array('apartment_id, user_id, notification', 'required'),
            array('visible', 'safe')
			
		);
	}

    
    public function relations() {
		return array(
			'apartment' => array(self::BELONGS_TO, 'Apartment', 'apartment_id'),               
		);
	}


    public function attributeLabels() {
		return array(
			
		);
	}

	public static function add($attributes = array()) {

        $model = new ApartmentNotification;
        $model->attributes = $attributes;
		
		if($model->validate()) {
	        if ($model->save()) {
	            return Yii::app()->db->getLastInsertID();
	        } 
	    }
	    return false;
    }

}
