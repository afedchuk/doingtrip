<?php

class Page extends ParentModel {

	public static $tableAlias = 'pages';
        
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{pages}}';
	}
	       
	public function rules(){
		return array(
		    array('page_title' , 'required'),
		    array('date_creates, date_updated', 'safe', 'on'=>'search'),
		    array('is_published', 'safe'),
		);
	}
	
	public function attributeLabels(){
		return array(
			'page_title' => PagesModule::t('Title'),
		);
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
	
	public function defaultScope() {
        return array(
                'condition'=>'lang = "'.Yii::app()->language.'"',
        );
    }

	public static function getUrl($id = null, $url = true) {
         
        if(!is_null($id)) {
            $title = self::model()->cache(param('cachingTime', 1209600))->findAll();

            $result = array();
            foreach($title as $key=>$value) {
                $result[$value->page_id] = array('title' => $value->page_title,
                                            'url' => $value->url);
            }
             
            if(isset($result[$id]))
            	$infoTitle =  isset($result[$id]) && $result[$id]['url'] ? $result[$id]['url'] : $result[$id]['title'];
        }
       
        if(!isset($infoTitle))
        	return false;
        $res = array('/pages/main/view', 
					 'id' => !is_null($id) ? $id : $this->id,
					 'title' => setTranslite(isset($infoTitle)  ? $infoTitle : $this->page_title)
			
        );  

		return $url ? Yii::app()->createAbsoluteUrl('/pages/main/view', array(
											'id' => !is_null($id) ? $id : $this->id,
											'title' => setTranslite(isset($infoTitle)  ? $infoTitle : $this->page_title))) : $res;
	}
        
	public static function getDependency(){
		return new CDbCacheDependency('SELECT MAX(date_updated) FROM {{pages}}');
	}
	

}