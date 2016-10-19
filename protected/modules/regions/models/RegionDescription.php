<?php

class RegionDescription extends ParentModel {

    public static $tableAlias = 'region_description';
        
    public function __construct(){
		parent::__construct();
	}
        
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{region_description}}';
                
	}
                
    public function defaultScope() {
            return array(
                    'condition'=>'lang = "'.Yii::app()->language.'"',
            );
    }
        
     public static function getAllRegions(){ 
            $sql = 'SELECT  * FROM  {{region_description}} region_description WHERE region_description.lang =  "'.Yii::app()->language.'"  ORDER BY region_description.name';
     
            $results = Yii::app()->db->createCommand($sql)->queryAll();
            
            return CHtml::listData($results, 'region_id', 'name');
    } 
}