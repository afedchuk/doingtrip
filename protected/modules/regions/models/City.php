<?php

class City extends ParentModel {

    private static $_allCity;
    public $name;
         
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{city}}';
                
	}

    public function rules() {
        return array(
            array('url, region_id, country_id', 'required'),
            array('region_id, country_id', 'numerical', 'integerOnly' => true),
            array('url', 'length', 'max' => 255),
            array('sorter', 'safe'),
            array('name', 'safe', 'on' => 'search'),
        );
    }
        
    public function relations() {
		return array(
            'countApartments' => array(self::STAT, 'Apartment', 'city_id', 'group'=>'city_id'),
            'apartments' => array(self::HAS_MANY, 'Apartment', '', 'on'=> $this->getTableAlias().'.id  = apartments.city_id'),
            'services' => array(self::HAS_ONE, 'Services', '', 'on'=> $this->getTableAlias().'.id  = services.apartment_id'),
            'city_description' => array(self::HAS_ONE, 'CityDescription', '', 'on'=> $this->getTableAlias().'.id  = city_description.city_id', 'select' => 'name, sname, description'),
            'region_description' => array(self::HAS_ONE, 'RegionDescription', '', 'on'=> $this->getTableAlias().'.region_id  = region_description.region_id'),
            'country' => array(self::HAS_ONE, 'Currency', '', 'on'=> $this->getTableAlias().'.country_id  = country.id'),
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
        
    public static function getDependency(){
            return new CDbCacheDependency('SELECT MAX(date_updated) FROM {{city}}');
    }
    
    public static function getUrl($id){
        $sql = 'SELECT url FROM {{city}} WHERE id='.$id;
        $result = Yii::app()->db->cache(param('cachingTime', 1209600), self::getDependency())->createCommand($sql)->queryColumn();
        return isset($result[0]) ? setTranslite(strtolower($result[0])) : null;
    }

    public static function getName($id){
		$sql = 'SELECT name FROM {{city_description}} WHERE city_id='.$id;
                $result = Yii::app()->db->cache(param('cachingTime', 1209600), self::getDependency())->createCommand($sql)->queryColumn();
		return isset($result[0]) ? setTranslite(strtolower($result[0])) : null;
	}

    public static function getCityName($id){
        $sql = 'SELECT name FROM {{city_description}} WHERE city_id='.$id.' AND lang="'.Yii::app()->language.'"';
        $result = Yii::app()->db->cache(param('cachingTime', 1209600), self::getDependency())->createCommand($sql)->queryColumn();
        return isset($result[0]) ? $result[0] : null;
    }
        
    public static function getAllCity(){
        if(self::$_allCity === null){
            $sql = 'SELECT  *
            FROM    {{city}} city,
                                {{city_description}} city_description
            WHERE   city.id = city_description.city_id
                                AND city_description.lang =  "'.Yii::app()->language.'"  ORDER BY city_description.name';
               
            $results = Yii::app()->db->createCommand($sql)->queryAll();

            self::$_allCity = CHtml::listData($results, 'city_id', 'name');
        }
        return self::$_allCity;
    }

    public function attributeLabels() {
        return array(
            'country_id' => RegionsModule::t('Country'),
            'region_id' => RegionsModule::t('Region'),
            'url' => RegionsModule::t('Url'),
        );
    }

    public static function getCountryByCity($city_id) {
        return City::model()->with('country')->findByPk($city_id);
    }


    public static function getAllCount(){
        $sql = "SELECT COUNT(id) FROM {{city}}";
        return (int) Yii::app()->db->createCommand($sql)->queryScalar();
    }
        
    public function search(){
        $criteria=new CDbCriteria;
        $criteria->order = 't.sorter ASC, t.date_updated DESC';
        $criteria->with = array('city_description', 'country');


        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>param('adminPaginationPageSize', 20),
            ),
        ));
    }

    public static function sitemap() {
        $city = City::model()->with(array('city_description', 'countApartments'))->cache(param('cachingTime', 1209600), City::getDependency())->findAll(array('order'=>'name ASC'));
          
        $result = array();
        if(!is_null($city)) {
            $i =0;
            foreach($city as $value) { 
                $result[strtoupper(substr(trim($value->city_description->name), 0, (Yii::app()->language == 'en' ? 1 : 2)))][$i] = array('id' => $value->id,
                                                                                              'url' => $value->url,
                                                                                              'description' =>  $value->city_description->description,
                                                                                              'count' => $value->countApartments,
                                                                                              'name' => $value->city_description->name);
                $i++;
            }
        }

        return $result;
    }
       
}