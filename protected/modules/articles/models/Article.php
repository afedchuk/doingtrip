<?php

class Article extends ParentModel {
	public $title;
	public $verifyCode;
  
	
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{articles}}';
	}
	
        public function defaultScope() {
                return array(
                        'condition'=>'lang = "'.Yii::app()->language.'"',
                );
        }
        
	public function rules(){
		return array(
		    array('page_title' , 'required'),
		    array('email, page_title, username verifyCode', 'required', 'on'=>'add'),
		    array('email', 'email'),
		    array('page_title', 'length', 'min'=>2, 'max'=>255),
		    array('page_body' , 'length', 'min'=>2),
		    array('date_updated', 'safe', 'on'=>'search'),
		    array('active', 'safe'),
		    //array('verifyCode', 'captcha', 'allowEmpty'=>!UserModule::doCaptcha('registration'))
		);
	}

    public function i18nFields(){
        return array(
            'page_title' => 'varchar(255) not null',
            'page_body' => 'text not null',
        );
    }

    public function scopes() {
        return array(
            'lang'=>array(
                'condition'=>$this->getTableAlias().'.lang = "'.Yii::app()->language.'"',
            ),
            'active'=>array(
                'condition'=>'active=1',
            ),
        );
    }
   
	
	public function attributeLabels(){
		return array(
			'page_title' => ArticlesModule::t('Title / Question'),
			'page_body' => ArticlesModule::t('Body / Answer'),
			'date_updated' => ArticlesModule::t('Date updated'),
			'username' => ArticlesModule::t('Username'),
			'phone' => ArticlesModule::t('Phone'),
			'email' => ArticlesModule::t('Email'),
			'verifyCode' => ArticlesModule::t('Verifycode'),
			'active' => ArticlesModule::t('Status'),
		);
	}
	
	public function search(){
		
		$criteria=new CDbCriteria;
        $criteria->compare('page_title', $this->page_title, true);
        $criteria->compare('page_body', $this->page_body, true);
        $criteria->compare('lang', Yii::app()->language, true);

        $criteria->order = 'sorter ASC';
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
                'sort' => array(
                        'defaultOrder' => 'date_updated DESC',
                ),
                'pagination'=>array(
                        'pageSize'=>param('adminPaginationPageSize', 20),
                ),
        ));
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
	
	

	public function beforeSave(){
		if($this->isNewRecord){
			$this->active = 1;

			$maxSorter = Yii::app()->db->createCommand()
				->select('MAX(sorter) as maxSorter')
				//->where('active=1')
				->from('{{articles}}')
				->queryScalar();
			$this->sorter = $maxSorter+1;
		}
		return parent::beforeSave();
	}

	public function getUrl(){
		return Yii::app()->createAbsoluteUrl('/articles/main/view', array(
			'id'=>$this->id,
			//'title'=>$this->page_title,
		));
	}

	public static function getCacheDependency(){
		return new CDbCacheDependency('SELECT MAX(date_updated) FROM {{articles}}');
	}
	
	public static function getRel($id, $lang){
		$model = self::model()->resetScope()->findByPk($id);

		$title = 'page_title_'.$lang;
		$model->title = $model->$title;

		return $model;
	}
}