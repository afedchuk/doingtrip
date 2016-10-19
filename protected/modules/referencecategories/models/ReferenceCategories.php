<?php

class ReferenceCategories extends ParentModel{

	public static function model($className=__CLASS__){
		return parent::model($className);
	}

	public function tableName(){
		return '{{apartment_reference_categories}}';
	}

	public function behaviors(){
		return array(
			'AutoTimestampBehavior' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
				'createAttribute' => null,
				'updateAttribute' => 'date_updated',
			),
		);
	}

	public function rules(){
        return array(
			array('style', 'required'),
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

	public function attributeLabels(){
		return array(
			'id' => 'ID',
            'type' => tc('Type'),
			'title' => tt('Reference name'),
			'sorter' => 'Sorter',
			'date_updated' => 'Date Updated',
			'style' => tt('Display style'),
		);
	}

	public function defaultScope() {
        return array(
                'condition'=>'lang = "'.Yii::app()->language.'"',
        );
    }
    
	public function search(){
		$criteria=new CDbCriteria;

		$criteria->compare('title',$this->title,true);
		$criteria->order = 'sorter ASC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>param('adminPaginationPageSize', 20),
			),
		));
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

	public function beforeDelete(){
        Yii::import('application.modules.formdesigner.models.FormDesigner');

		$sql = 'DELETE FROM {{apartment_reference_values}} WHERE reference_category_id="'.$this->id.'";';
		Yii::app()->db->createCommand($sql)->execute();

		$sql = 'DELETE FROM {{apartment_reference}} WHERE reference_id="'.$this->id.'"';
		Yii::app()->db->createCommand($sql)->execute();

		return parent::beforeDelete();
	}
}