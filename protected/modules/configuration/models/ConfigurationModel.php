<?php


class ConfigurationModel extends ParentModel {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{configuration}}';
	}

	public function rules() {
		return array(
			array('name, value', 'required'),
			array('name, value', 'length', 'max' => 255),
			array('title', 'safe'),
		);
	}

	public function attributeLabels() {
		return array(
			'name' => ConfigurationModule::t('Name'),
			'value' => ConfigurationModule::t('Value'),
			'title' => ConfigurationModule::t('Title'),
		);
	}

	public static function config($key = '') {

        $model = self::model()->cache(1209600, self::getDependency())->findAll();
        
        $arr = array();
        foreach($model as $value) {
            Yii::app()->params[$value->name] = $value->value;
            $arr[$value->name] = $value->value;
        }
        
        if(is_null($model))
           return false;

        return $key && isset($arr[$key]) ? $arr[$key] : Yii::app()->params;
    }

    public static function getDependency(){
            return new CDbCacheDependency('SELECT MAX(date_updated) FROM {{configuration}}');
    }

	public function search() {
		$criteria = new CDbCriteria;
		$title = 'title';
		$criteria->compare($title, $this->$title, true);
		$criteria->compare('value', $this->value, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			'sort' => array(
				'defaultOrder' => 'title',
			),
			'pagination' => array(
				'pageSize' => param('adminPaginationPageSize', 20),
			),
		));
	}

	public static function updateValue($key, $value){
		$sql = 'UPDATE {{configuration}} SET value=:value, date_updated=NOW() WHERE name=:name';
		Yii::app()->db->createCommand($sql)->execute(array(
			':value' => $value,
			':name' => $key,
		));

		Configuration::clearCache();
	}

	public function beforeSave() {
		Configuration::clearCache();
		if ($this->isNewRecord){
			$this->date_updated = new CDbExpression('NOW()');
		}
		return parent::beforeSave();
	}

}