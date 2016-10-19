<?php

class CityArea extends CActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{city_area}}';
                
	}
        
        public function defaultScope()
        {
          return array(
            'condition'=>"lang='".Yii::app()->language."'",
          );
        }
        
        public function relations() {
		return array(
                        'city' => array(self::BELONGS_TO, 'City', '', 'on'=> $this->getTableAlias().'.city_id  = city.id'),
		);
	}
                
       
}