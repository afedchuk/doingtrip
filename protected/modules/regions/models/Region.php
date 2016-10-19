<?php

class Region extends ParentModel {

    public static $tableAlias = 'region';
        
    public function __construct($scenario='insert'){
		$this->SetTableAlias(self::$tableAlias);
		parent::__construct($scenario);
	}
        
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{region}}';
                
	}
        
    public function relations() {
		return array(
            'city' => array(self::HAS_ONE, 'City', '', 'on'=> $this->getTableAlias().'.id  = city.region_id'),
            'region_description' => => array(self::HAS_ONE, 'RegionDescription', '', 'on'=> $this->getTableAlias().'.id  = region_description.region_id'),
		);
	}

        
    public function attributeLabels() {
		return array(
			
		);
	}
   
}