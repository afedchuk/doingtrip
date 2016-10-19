<?php

class CityDescription extends CActiveRecord {

  
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{city_description}}';
                
	}

	public function rules() {
		return array(
			array('city_id, name, sname', 'required'),
			array('city_id', 'numerical', 'integerOnly' => true),
			array('name, sname', 'length', 'max' => 255),
			array('description, name, sname', 'safe'),
		);
	}

    public function defaultScope() {
        return array(
                'condition'=>'lang = "'.Yii::app()->language.'"',
        );
    }

    public function attributeLabels() {
		return array(
            'name' => RegionsModule::t('Name'),
           	'sname' => RegionsModule::t('Name title'),
           	'description' => RegionsModule::t('Description'),
		);
	}
}