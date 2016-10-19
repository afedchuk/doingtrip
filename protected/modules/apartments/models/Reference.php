<?php

class Reference extends CActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{apartment_reference}}';
	}

	public function rules() {
		return array(
			array('reference_value_id, apartment_id', 'required'),
			array('reference_value_id, apartment_id', 'numerical', 'integerOnly' => true),
			array('id, reference_value_id, apartment_id', 'safe', 'on' => 'search'),
		);
	}

	public function relations() {

		
		Yii::app()->getModule('referencevalues');
                
		return array(
			'value' => array(self::HAS_ONE, 'ReferenceValues', '', 'on' => 'reference.reference_value_id = category.id'),
		);
	}

	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'reference_value_id' => 'Reference Value',
			'apartment_id' => 'Apartment',
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('reference_value_id', $this->reference_value_id);
		$criteria->compare('apartment_id', $this->apartment_id);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			'pagination' => array(
				'pageSize' => param('adminPaginationPageSize', 20),
			),
		));
	}

}