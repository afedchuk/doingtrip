<?php

class Statistic extends CActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{apartment_statistic}}';
                
	}
    
    public function scopes() {
        return array(
            'weeks'=>array(
                'condition'=>'date >= '.date("Y-m-d", strtotime("-2 weeks")),
            ),
        );
    }
}