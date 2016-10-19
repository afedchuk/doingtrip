<?php

class Description extends ParentModel {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{apartment_description}}';
                
	}
        
    public function rules() {
		return array(
			array('title, address, description', 'required'),
            array('apartment_id, description_near, ', 'safe')
			
		);
	}

    
    public function relations() {
		return array(
			'apartment' => array(self::BELONGS_TO, 'Apartment', 'apartment_id'),               
		);
	}
    
    public function scopes() {
        return array(
            'lang'=>array(
                'condition'=>$this->tableAlias.'.lang = "'.Yii::app()->language.'"',
            ),
        );
    }
        
    public function attributeLabels() {
		return array(
			'title' => ApartmentsModule::t('Title apartment'),
			'description' => ApartmentsModule::t('Description apartment'),
			'description_near' => ApartmentsModule::t('What is near?'),
			'address' => ApartmentsModule::t('Address'),
		);
	}



}