<?php


class News extends ParentModel {

	public $title;
	public $body;
	public $dateCreated;

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{news}}';
	}

	public function rules() {
		return array(
			array('title, body', 'required'),
			array('title', 'length', 'max' => 128, 'message' => 'Maximum lenght of title is 128 symbols.'),
			array('title, body', 'safe', 'on' => 'search'),
		);
	}

	public function defaultScope() {
        return array(
                'condition'=>'lang = "'.Yii::app()->language.'"',
        );
    }

	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'title' => tt('News title', 'news'),
			'body' => tt('News body', 'news'),
			'date_created' => tt('Creation date', 'news'),
			'dateCreated' => tt('Creation date', 'news'),
		);
	}

	public function getUrl() {
		return Yii::app()->createAbsoluteUrl('/news/main/view', array(
			'id' => $this->id,
			'title' => setTranslite($this->title),
		));
	}

	public function search() {
		$criteria = new CDbCriteria;
		$criteria->compare('title', $this->title, true);
		$criteria->compare('body', $this->body, true);
		$criteria->compare('lang', Yii::app()->language, true);


		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			'sort' => array(
				'defaultOrder' => 'date_created DESC',
			),
			'pagination' => array(
				'pageSize' => param('adminPaginationPageSize', 20),
			),
		));
	}

	public function behaviors(){
		return array(
			'AutoTimestampBehavior' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
				'createAttribute' => 'date_created',
				'updateAttribute' => 'date_updated',
			),
		);
	}
	
	protected function afterFind() {
		$dateFormat = param('newsModule_dateFormat', 0) ? param('newsModule_dateFormat') : param('dateFormat', 'd.m.Y H:i:s');
		$this->dateCreated = date($dateFormat, strtotime($this->date_created));

		return parent::afterFind();
	}

	public function getAllWithPagination($inCriteria = null){
		if($inCriteria === null){
			$criteria = new CDbCriteria;
			$criteria->order = 'date_created DESC';
		} else {
			$criteria = $inCriteria;
		}

		$pages = new CPagination($this->cache(param('cachingTime', 1209600))->count($criteria));
		$pages->pageSize = 5;
		$pages->applyLimit($criteria);

		$dependency = new CDbCacheDependency('SELECT MAX(date_updated) FROM {{news}}');

		$items = $this->cache(param('cachingTime', 1209600), $dependency)->findAll($criteria);

		return array(
			'items' => $items,
			'pages' => $pages,
		);
	}

}