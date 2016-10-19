<?php

class ReferenceValues extends ParentModel{

	public $oldRefId = 0;
	public $title;

	public static function model($className=__CLASS__){
		return parent::model($className);
	}

	public function tableName(){
		return '{{apartment_reference_values}}';
	}

	public function rules(){
		return array(
			array('sorter', 'numerical', 'integerOnly'=>true),
		);
	}

	public function relations(){
		return array(
			'category' => array(self::BELONGS_TO, 'ReferenceCategory', '', 'on'=> $this->getTableAlias().'.reference_category_id = category.category_id'),
            'description' => array(self::HAS_ONE, 'ReferenceValuesDescription', '', 'on'=> $this->getTableAlias().'.id = description.reference_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
		);
	}

	public function search(){
		$criteria=new CDbCriteria;
		
		$criteria->compare('description.title',$this->title,true);

		$criteria->with = array('description');
		$criteria->order = 't.sorter ASC';

                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>param('adminPaginationPageSize', 20),
			),
		));
	}

	public function afterFind(){
		
		parent::afterFind();
	}

	public function beforeSave(){

		$this->date_updated = new CDbExpression('NOW()');

		return parent::beforeSave();
	}

	public function afterDelete(){
		$sql = 'DELETE FROM {{apartment_reference}} WHERE reference_value_id="'.$this->id.'"';
		Yii::app()->db->createCommand($sql)->execute();

		return parent::afterDelete();
	}

    public static function returnForStatusHtml($data, $for_field, $tableId = '', $onclick = 1, $ignore = 0){
        if($ignore && $data->id == $ignore){
            return '';
        }
        $url = Yii::app()->controller->createUrl("activate",
            array(
                'id' => $data->id,
                'action' => ($data->$for_field == 1 ? 'deactivate' : 'activate'),
                'field' => $for_field
            ));
        $img = CHtml::image(
            Yii::app()->request->baseUrl.'/images/'.($data->$for_field ? '' : 'in').'active.png',
            Yii::t('common', $data->$for_field ? 'Inactive' : 'Active'),
            array('title' => Yii::t('common', $data->$for_field ? 'Deactivate' : 'Activate'))
        );
        $options = array();
        if($onclick){
            $options = array(
                'onclick' => 'ajaxSetStatus(this, "'.$tableId.'"); return false;',
            );
        }
        return '<div align="center">'.CHtml::link($img, $url, $options).'</div>';
    }

}