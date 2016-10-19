<?php


class ComplaintResponce extends CActiveRecord {
	private static $_allReasons;

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{complaint_responce}}';
	}



	public function rules() {
		return array(
			
			array('complaint_id', 'numerical', 'integerOnly' => true),
			array('responce_message, complaint_id', 'required'),
		);
	}

	
	public function behaviors(){
		return array(
			'AutoTimestampBehavior' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
				'createAttribute' => 'date_created',
			),
		);
	}

	public static function getAllReasons($val = null) {
		if (self::$_allReasons === null) {
			$sql = 'SELECT responce_message AS name, id
                    FROM {{complaint_responce}}
                    ORDER BY sorter';

			$results = Yii::app()->db->createCommand($sql)->queryAll();
			if(!empty($results))
				self::$_allReasons = CHtml::listData($results, 'id', 'name');
		}
		if ($val && array_key_exists($val, self::$_allReasons))
			return self::$_allReasons[$val];

		return self::$_allReasons;
	}

}