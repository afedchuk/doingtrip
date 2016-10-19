<?php

class ReferenceCategory extends ParentModel{
	public static function model($className=__CLASS__){
		return parent::model($className);
	}

	public function tableName(){
		return '{{apartment_reference_categories}}';
	}

	public function rules(){
        return array(
			array('title', 'i18nRequired'),
			array('sorter, type', 'numerical', 'integerOnly'=>true),
			array('title', 'i18nLength', 'max'=>255),
			array($this->getI18nFieldSafe(), 'safe'),
        );
	}

	public function i18nFields(){
        return array(
            'title' => 'varchar(255) not null',
        );
    }

    public function relations(){
		Yii::app()->getModule('referencevalues');
		return array(
			'values' => array(self::HAS_MANY, 'ReferenceValues', 'reference_category_id'),
		);
	}

	public function beforeSave(){
		if($this->isNewRecord){
			$maxSorter = Yii::app()->db->createCommand()
				->select('MAX(sorter) as maxSorter')
				->from($this->tableName())
				->queryScalar();
			$this->sorter = $maxSorter+1;
		}

		return parent::beforeSave();
	}

	public function attributeLabels(){
		return array(
			'title' => tt('Reference category'),
		);
	}

	public function scopes()
    {
    	$ta=$this->getTableAlias(false,false);
        return array(
            'lang'=>array(
                'condition'=>$ta.'.lang="'.Yii::app()->language.'"',
            ),
           
        );
    }  

}