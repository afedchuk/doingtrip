<?php

class ReferenceValuesDescription extends CActiveRecord{

	public static function model($className=__CLASS__){
		return parent::model($className);
	}

	public function tableName(){
		return '{{apartment_reference_values_description}}';
	}

	public function rules(){
		return array(
			array('reference_id', 'required'),
			array('reference_id', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			array('title, lang', 'safe'),
		);
	}

	public function relations(){

		return array(
			'description' => array(self::BELONGS_TO, 'ReferenceValuesDescription', 'reference_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'title' => tt('Reference value (Russian)'),
		);
	}
}