<?php


class Apartment extends ParentModel {
    
    public static $tableAlias = 'apartment';
    public $km = 5;
    public $filterDescription = array(
    		'house_price' => array('key' => 'price', 
    							   'values' => array('low' => array(100), 'medium' => array(100,200), 'above_average' => array(200,500), 'high' => array(500, 1000), 'higher' => array(1000))), 
    		'house_type' => array('key' => 'type', 
    							   'values' => array(0, 1, 2, 3, 4)),
    	 	'house_berths' => array('key' => 'berths', 
    	 		 					'values' => array('low' => array(2), 'medium' => array(2,5), 'above_average' => array(5,8), 'higher' => array(8)))
    	 );

    const TYPE_ROOM = 0;
    const TYPE_HOUSE = 1;
    const TYPE_HOTEL = 2;
    const TYPE_COTTAGE = 3;
    const TYPE_TOWNHOUSE = 4;

    private static $_type_arr;


    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_MODERATION = 2;
    const STATUS_DRAFT = 3;

    private static $_apartment_arr;

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function __construct($scenario='insert'){
		//$this->SetTableAlias(self::$tableAlias);
		parent::__construct($scenario);
	}

	public function tableName() {
		return '{{apartment}}';
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

	public function rules() {
		return array(
			array('num_of_rooms, type, city_id, price', 'required'),
			array('num_of_rooms, floor, floor_total, 
				square, window_to, type', 'numerical', 'integerOnly' => true),
			array('price, num_of_rooms', 'numerical', 'min' => 1),
			array('berths', 'length', 'max' => 255),
			array('lat, lng', 'length', 'max' => 25),
			array('id', 'safe', 'on' => 'search'),
			array('floor', 'myFloorValidator'),
			array('is_special_offer, city_id, price, berths, phone, active, owner_active, phone_additional, date_top', 'safe'),
            array('type, city_id, price', 'required', 'on' => 'step_two'),
		);
	}

	public function myFloorValidator($attribute,$params){
		if($this->floor && $this->floor_total){
			if($this->floor > $this->floor_total)
			$this->addError('floor', 'Текущий этаж не может быть больше, чем количество этажей в доме');
		}
	}
        
    public function scopes()
    {
        return array(
            'active'=>array(
                'condition'=>'owner_active='.self::STATUS_ACTIVE,
            ),
            'notactvie'=>array(
                'condition'=>'owner_active='.self::STATUS_INACTIVE,
            ),
            'publish'=>array(
                'condition'=>'active='.self::STATUS_ACTIVE,
            ),
            'nopublish'=>array(
                'condition'=>'active='.self::STATUS_INACTIVE,
            ),
        );
    }

    public function afterFind() {
        parent::afterFind();
    }

	public function relations() {
		return array(
			'windowTo' => array(self::BELONGS_TO, 'WindowTo', 'window_to'),
      
            'description' => array(self::HAS_ONE, 'Description', '', 'on'=> $this->getTableAlias().'.id  = description.apartment_id', 'scopes' => array('lang')),
            
            'desc' => array(self::HAS_MANY, 'Description', '', 'on'=> $this->getTableAlias().'.id  = desc.apartment_id'),
            
            'avalibility' => array(self::HAS_MANY, 'ApartmentDate', '', 'on'=> $this->getTableAlias().'.id  = avalibility.apartment_id'),

            'additional' => array(self::HAS_ONE, 'ApartmentAdditional', '', 'on'=> $this->getTableAlias().'.id  = additional.apartment_id'),

            'discount' => array(self::HAS_ONE, 'ApartmentDiscount', '', 'on'=> $this->getTableAlias().'.id  = discount.apartment_id'),
            
            'city' => array(self::BELONGS_TO, 'City', 'city_id'),

            'complaints' => array(self::HAS_MANY, 'Complaint', 'apartment_id', 'on' => 'complaints.status = '.  Apartment::STATUS_ACTIVE,
                                                                               'order' => 'complaints.date_created DESC',),

            'statistic' => array(self::HAS_MANY, 'Statistic', 'apartment_id', 'order' => 'statistic.date ASC',),
            
            'booking' => array(self::HAS_MANY, 'Booking', 'apartment_id', 'on'=> 'booking.status = 1'),

            'services' => array(self::HAS_ONE, 'Services', '', 'on'=> $this->getTableAlias().'.id  = services.apartment_id'),
            
            'user' => array(self::HAS_ONE, 'User', '', 'on'=> $this->getTableAlias().'.user_id  = user.id'),
            
            'images' => array(self::HAS_MANY, 'Images', 'id_object', 'order' => 'images.sorter'),

			'comments' => array(self::HAS_MANY, 'Comment', 'apartment_id',
				'on' => 'comments.active = '.Comment::STATUS_APPROVED,
				'order' => 'comments.id DESC',
			),
			'commentCount' => array(self::STAT, 'Comment', 'apartment_id',
				'condition' => 'active=' . Comment::STATUS_APPROVED),
            'user' => array(self::BELONGS_TO, 'User', '', 'on'=> $this->getTableAlias().'.user_id = user.id'),
                        
		);
	}

	public function getUrl($id = null, $title = '', $city ='') {
                
        if(is_null($id) && $title == '') 
            $description = Description::model()->with(array('apartment'=>array('city')))->lang()->find('apartment_id=:apartment_id', array(':apartment_id' => $this->id));

		return Yii::app()->createAbsoluteUrl('/apartments/main/view', array(
			'id' => is_null($id) ? $this->id : $id,
            'city' => setTranslite($city),
			'title' => setTranslite(isset($description['title']) ? $description['title'] : $title),
		));
	}

    public static function getSquareMinMax(){
        $ownerActiveCond = '';
        if (param('useUserads'))
            $ownerActiveCond = ' AND owner_active = '.self::STATUS_ACTIVE.' ';

        $sql = 'SELECT MIN(square) as square_min, MAX(square) as square_max FROM {{apartment}} WHERE active = '.self::STATUS_ACTIVE.' '.$ownerActiveCond.'';
        return Yii::app()->db->cache(param('cachingTime', 1209600), self::getDependency())->createCommand($sql)->queryRow();
    }

    public static function getPriceMinMax(){
        $ownerActiveCond = '';
        if (param('useUserads'))
            $ownerActiveCond = ' AND owner_active = '.self::STATUS_ACTIVE.' ';

        $sql = 'SELECT MIN(price) as price_min, MAX(price) as price_max FROM {{apartment}} WHERE active = '.self::STATUS_ACTIVE.' '.$ownerActiveCond;

        return Yii::app()->db->cache(param('cachingTime', 1209600), self::getDependency())->createCommand($sql)->queryRow();
    }

    public static function getRoomsMinMax(){
        $ownerActiveCond = '';
        if (param('useUserads'))
            $ownerActiveCond = ' AND owner_active = '.self::STATUS_ACTIVE.' ';
        $sql = 'SELECT MIN(num_of_rooms) as rooms_min, MAX(num_of_rooms) as rooms_max FROM {{apartment}} WHERE active = '.self::STATUS_ACTIVE.' '.$ownerActiveCond;

        return Yii::app()->db->cache(param('cachingTime', 1209600), self::getDependency())->createCommand($sql)->queryRow();
    }

	public function attributeLabels() {
		return array(
			'id' => tt('ID'),
            'type' => ApartmentsModule::t('Type'),
            'city_id' => ApartmentsModule::t('City'),
			'price' => ApartmentsModule::t('Price'),
			'num_of_rooms' => ApartmentsModule::t('Number of rooms'),
			'floor' => ApartmentsModule::t('Floor'),
			'floor_total' => ApartmentsModule::t('Total number of floors'),
			'square' => ApartmentsModule::t('Square'),
			'window_to' => ApartmentsModule::t('Window to'),
			'special_offer' => ApartmentsModule::t('Special offer'),
			'berths' => ApartmentsModule::t('Number of berths'),
			'eg_cal' => ApartmentsModule::t('Google calendar'),
			'flickr_gallery' => ApartmentsModule::t('Flickr gallery'),
            'phone' => ApartmentsModule::t('Phones'),
            'owner_active' => ApartmentsModule::t('Owner status'),
			'active' => tt('Status'),
			'is_free_from' => tt('Is free from'),
			'is_free_to' => tt('to'),
			'is_special_offer' => ApartmentsModule::t('Special offer'),
		);
	}
        
    public static function getCountModeration(){
        $sql = "SELECT COUNT(id) FROM {{apartment}} WHERE active=".self::STATUS_MODERATION;
        return (int) Yii::app()->db->createCommand($sql)->queryScalar();
    }

    public static function getAllCountActive(){
        $sql = "SELECT COUNT(id) FROM {{apartment}} WHERE active=1 AND owner_active=1";
        return (int) Yii::app()->db->createCommand($sql)->queryScalar();
    }

    public static function getCountByCity($city_id){
        $sql = "SELECT COUNT(id) FROM {{apartment}} WHERE city_id=".$city_id." AND active=1 AND owner_active=1";
        return (int) Yii::app()->db->createCommand($sql)->queryScalar();
    }

	public function search() {

		$criteria = new CDbCriteria;
		$criteria->compare($this->getTableAlias().'.id', $this->id);
		/*$criteria->compare($this->getTableAlias().'.active', $this->active, true);
		$criteria->compare('city_id', $this->city_id);
*/
		if($this->city_id > 0)
			$criteria->compare('city_id', $this->city_id);
		$criteria->compare('type', $this->type);


		
		$criteria->order = $this->getTableAlias().'.date_created DESC';
		$criteria->with = array('city', 'user');

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			//'sort'=>array('defaultOrder'=>'sorter'),
			'pagination'=>array(
				'pageSize'=>param('adminPaginationPageSize', 20),
			),
		));
	}

        
    public function getMapIconUrl(){
		if (isset($this->objType) && $this->objType->icon_file) {
			$iconUrl = Yii::app()->getBaseUrl().'/'.$this->objType->iconsMapPath.'/'.$this->objType->icon_file;
		} else {
			$iconUrl = Yii::app()->getBaseUrl()."/images/house.png";
		}
		return $iconUrl;
	}
    
    public function getMinMax($filter, $type) {

        $criteria=new CDbCriteria;
        $criteria->select = $type.'('.$filter.') AS '.$filter;
        $row = $this->model()->cache(param('cachingTime', 1209600))->find($criteria);

        return  $row[$filter];
    }

	public function getStrByLang($id, $field = null){    
		$description = Description::model()->lang()->find('apartment_id=:apartment_id', array(':apartment_id' => $id));
		return !is_null($field) ? $description['title'] : $description['title'];
	}


    public function getApartmentsUser($user_id, $current) {

        $query = "SELECT * FROM {{apartment}} apartment,
                                {{apartment_description}} apartment_description

                           WHERE apartment.id = apartment_description.apartment_id

                                 AND apartment_description.lang = '".Yii::app()->language."'
                                 AND apartment.id <> ".$current;

        $dependency = new CDbCacheDependency('SELECT MAX(date_updated)  FROM {{apartment}}');

        $rows = Yii::app()->db->cache(param('cachingTime', 1209600), $dependency)->createCommand($query)->queryAll();

        $apartments = array();

        foreach($rows as $row) {
            $images = unserialize($row['imgsOrder']);

            reset($images);

            $image = '';
            if(file_exists(Yii::app()->getBasePath(). '/uploads/apartments/'.$row['pid'].'/'.key($images))) {
                $image = Yii::app()->request->getBaseUrl(true).ImageHelper::thumb(100, 100, Yii::app()->getBasePath(). '/uploads/apartments/'.$row['pid'].'/'.key($images), array('method' => 'resize'));
            }

            $apartments[] = array('title' => $row['title'],
                                  'id' => $row['id'],
                                  'image' => $image,
                                  'price' => $row['price'],
                                  'description' => $row['description']);


        }

        return $apartments;
    }
    
    public static function getFullInformation($apartmentId, $catId = null){

        $addWhere = '';
        
		if ($catId)
			$addWhere .= ' AND reference_categories.category_id = '.(int) $catId.' ';

		$sql = '
			SELECT	style,
					reference_categories.title as category_title,
					reference_description.title as value,
					reference_categories.category_id as ref_id,
					reference_values.id as ref_value_id
			FROM	{{apartment_reference}} reference,
                    {{apartment_reference_values_description}} reference_description,
					{{apartment_reference_categories}} reference_categories,
					{{apartment_reference_values}} reference_values
			WHERE	reference.apartment_id = "'.intval($apartmentId).'" AND reference_values.id = reference_description.reference_id  AND  reference_values.reference_category_id = reference_categories.category_id 
					AND reference.reference_value_id = reference_values.id AND reference_categories.lang="'.Yii::app()->language.'" AND reference_description.lang="'.Yii::app()->language.'"
					'.$addWhere.'';

		// Таблица apartment_reference меняется только при измении объявления (т.е. таблицы apartment)
		// Достаточно зависимости от apartment вместо apartment_reference
		$dependency = new CDbCacheDependency('
			SELECT MAX(val) FROM
				(SELECT MAX(date_updated) as val FROM {{apartment_reference_values}}
				UNION
				SELECT MAX(date_updated) as val FROM {{apartment_reference_categories}}
				UNION
				SELECT MAX(date_updated) as val FROM {{apartment}} WHERE id = "'.intval($apartmentId).'") as t
		');

		$results = Yii::app()->db->cache(param('cachingTime', 1209600), $dependency)->createCommand($sql)->queryAll();

		$return = array();
		foreach($results as $result){
			if(!isset($return[$result['ref_id']])){
				$return[$result['ref_id']]['title'] = $result['category_title'];
				$return[$result['ref_id']]['style'] = $result['style'];
			}
			$return[$result['ref_id']]['values'][$result['ref_value_id']] = $result['value'];
		}
      
		return $return;
	}
    
    public static function getCategories($id = null, $selected = array()){
		$sql = '
			SELECT	reference_description.title as value_title,
					reference_categories.title as category_title, reference_categories.style,
					reference_category_id, reference_values.id
			FROM	{{apartment_reference_values}} reference_values,
                    {{apartment_reference_values_description}} reference_description,
					{{apartment_reference_categories}} reference_categories
			WHERE	reference_values.id = reference_description.reference_id AND reference_values.reference_category_id = reference_categories.category_id AND reference_categories.lang="'.Yii::app()->language.'" AND reference_description.lang="'.Yii::app()->language.'"';

		$dependency = new CDbCacheDependency('
			SELECT MAX(val) FROM
				(SELECT MAX(date_updated) as val FROM {{apartment_reference_values}}
				UNION
				SELECT MAX(date_updated) as val FROM {{apartment_reference_categories}}) as t
		');

		$results = Yii::app()->db->cache(param('cachingTime', 1209600), $dependency)->createCommand($sql)->queryAll();
		$return = array();
		if($id){
			$selected = Apartment::getFullInformation($id);
		} else {
			if ($selected && count($selected)) {
				$tmp = array();
				foreach($selected as $selKey => $selVal) {
					$tmp[$selKey]['values'] = $selVal;
				}
				$selected = $tmp;
			}
		}
          
		if($results){
			foreach($results as $result){
				$return[$result['reference_category_id']]['title'] = $result['category_title'];
                $return[$result['reference_category_id']]['style'] = $result['style'];
				$return[$result['reference_category_id']]['values'][$result['id']]['title'] = $result['value_title'];
                  
				if(isset($selected[$result['reference_category_id']]['values'][$result['id']] )){
					$return[$result['reference_category_id']]['values'][$result['id']]['selected'] = true;
				}
				else{
					$return[$result['reference_category_id']]['values'][$result['id']]['selected'] = false;
				}
			}
		}
		return $return;
	}
	
	public static function getReferences($id = null, $type = 0){

		$sql = 'SELECT	*
			FROM	{{apartment_reference_values}} reference_values,
                                {{apartment_reference_values_description}} reference_description
			WHERE	reference_values.id = reference_description.reference_id
                                AND reference_description.lang =  "'.Yii::app()->language.'"
			ORDER BY reference_values.sorter';

		$results = Yii::app()->db->cache(param('cachingTime', 1209600))->createCommand($sql)->queryAll();
		$selected = array();
		if($id){
			$selected = Apartment::getFullInformation($id);
		}
		return $id ? array('references' => $results, 'selected' => $selected) : $results;
	}

	public function saveCotegories(){
		if(isset($_POST['reference_value_id'])){
			$sql = 'DELETE FROM {{apartment_reference}} WHERE apartment_id="'.$this->id.'"';
			Yii::app()->db->createCommand($sql)->execute();

			foreach($_POST['reference_value_id'] as $value){
					$sql = 'INSERT INTO {{apartment_reference}} (reference_value_id,  apartment_id)
						VALUES (:refId,  :apId) ';
					$command = Yii::app()->db->createCommand($sql);
					$command->bindValue(":refId", $value, PDO::PARAM_INT);
					$command->bindValue(":apId", $this->id, PDO::PARAM_INT);
					$command->execute();
				
			}
		}
	}
        
    public function beforeSave(){
		if(!$this->square){
			$this->square = 0;
		}

		if($this->isNewRecord){
			$this->date_top = time();
		}
        
        if($this->scenario == 'admin') {
            if($this->isNewRecord){
                    $this->user_id = Yii::app()->user->id;
                    // if admin
                    $userInfo = User::model()->findByPk($this->user_id);
                    if ($userInfo && $userInfo->superuser == 1) {
                            $this->active = self::STATUS_ACTIVE;
                    }
                    $maxSorter = Yii::app()->db->createCommand()
                            ->select('MAX(sorter) as maxSorter')
                            ->from($this->tableName())
                            ->queryScalar();
  
                    $this->sorter = $maxSorter+1;
            }
        }
        
        $coords = array();
        if(($this->city_id) && (param('useGoogleMap', 1) || param('useYandexMap', 1))){
            Yii::app()->getModule('regions');
        }
		return parent::beforeSave();
	}

	
	public function afterSave(){
		if($this->scenario == 'savecat'){
			$this->saveCotegories();
		}

		return parent::afterSave();
	}

	public function beforeDelete(){
		
        $sql = 'DELETE FROM {{apartment_reference}} WHERE apartment_id="'.$this->id.'"';
        Yii::app()->db->createCommand($sql)->execute();

        $sql = 'DELETE FROM {{apartment_description}} WHERE apartment_id="'.$this->id.'"';
        Yii::app()->db->createCommand($sql)->execute();
        
        $sql = 'DELETE FROM {{apartment_comments}} WHERE apartment_id="'.$this->id.'"';
        Yii::app()->db->createCommand($sql)->execute();

        $dir = Yii::getPathOfAlias('webroot.uploads.objects') . '/'.$this->id;
        rrmdir($dir);

        $sql = 'DELETE FROM {{images}} WHERE id_object="'.$this->id.'"';
        Yii::app()->db->createCommand($sql)->execute();

        $sql = 'SELECT id FROM {{booking}} WHERE apartment_id="'.$this->id.'"';
        $bookings = Yii::app()->db->createCommand($sql)->queryColumn();

        if($bookings){
                //$sql = 'DELETE FROM {{payments}} WHERE order_id IN ('.implode(',', $bookings).')';
                //Yii::app()->db->createCommand($sql)->execute();
        }

        $sql = 'DELETE FROM {{booking}} WHERE apartment_id="'.$this->id.'"';
        Yii::app()->db->createCommand($sql)->execute();
        return parent::beforeDelete();
    }
    
    public function afterDelete() {
        Yii::app()->cache->flush();  
        parent::afterDelete();
    }


    public function canShowInView($field) {

        switch($field){
            case 'floor_all':
                if(!$this->floor && !$this->floor_total){
                    return false;
                }
                break;

            case 'phone':
                if( !$this->phone ){
                    if(!isset($this->user) || !$this->user->phone){
                        return false;
                    }
                }
                break;

            default:
                if(!isset($this->$field) || !$this->$field){
                    return false;
                }
        }

        if (issetModule('formdesigner')) {
            Yii::import('application.modules.formdesigner.models.*');
            return FormDesigner::canShow($field, $this);
        }

        return true;
    }

    public static function getSorterLinks($param, $order, $city){
        $return = array(); 
        $param = is_null($param) ? Apartment::model()->getTableAlias().'.date_updated' : $param;
        $order = ($order == 'asc' ? 'desc' : 'asc');
        $url = $city ? array('city' => $city) : array();
        foreach(array(Apartment::model()->getTableAlias().'.date_updated','price', 'square', 'rating') as $attribute) {
            $return[] =  CHtml::link(Yii::app()->getModule('apartments')->t('Sorting by '.$attribute), Yii::app()->createAbsoluteUrl('apartments/', $url),array(
                'data-order' => ($param == $attribute ?  ($order ?  $order : 'asc') : 'desc'),
                'data-sort' => $attribute,
                'class' => $param == $attribute ? 'active asc' : null
                )
            ); 
        } 
        /*$return[] =  CHtml::link(ApartmentsModule::t('Filter'), '',array(
                'class' => 'filters-toggle'
                )
            ); */
        return $return;
    }

    public function isValidApartment($id){
            $sql = 'SELECT id FROM {{apartment}} WHERE id = :id';
            $command = Yii::app()->db->createCommand($sql);
            return $command->queryScalar(array(':id' => $id));
    }


    public static function getFullDependency($id){
            return new CDbCacheDependency('
                    SELECT MAX(val) FROM
                            (SELECT MAX(date_updated) as val FROM {{apartment_comments}} WHERE apartment_id = "'.intval($id).'"
                            UNION
                            SELECT MAX(date_updated) as val FROM {{apartment}} WHERE id = "'.intval($id).'"
                            UNION
                            SELECT MAX(date_updated) as val FROM {{images}}) as t
            ');
    }

    public static function getImagesDependency(){
            return new CDbCacheDependency('
                    SELECT MAX(val) FROM
                            (SELECT MAX(date_updated) as val FROM {{apartment}}
                            UNION
                            SELECT date_updated as val FROM {{images}}) as t
            ');
    }

    public static function getDependency(){
            return new CDbCacheDependency('SELECT MAX(date_updated) FROM {{apartment}}');
    }

    public static function getExistsRooms(){
            $sql = 'SELECT DISTINCT num_of_rooms FROM {{apartment}} WHERE active=1 AND num_of_rooms > 0 ORDER BY num_of_rooms';
            return Yii::app()->db->cache(param('cachingTime', 1209600), self::getDependency())->createCommand($sql)->queryColumn();
    }

    public static function getTypesArray($withAll = false){
        $types = array();
		
		if($withAll){
            $types[0] = tt('All');
        }

        $types[self::TYPE_ROOM] = ApartmentsModule::t('Room');
        $types[self::TYPE_HOUSE] = ApartmentsModule::t('House');
        $types[self::TYPE_HOTEL] = ApartmentsModule::t('Hotel');
        $types[self::TYPE_COTTAGE] = ApartmentsModule::t('Cottage');
        $types[self::TYPE_TOWNHOUSE] = ApartmentsModule::t('Townhouse');
        return $types;
    }
	

    public static function getNameByType($type){
        if(!isset(self::$_type_arr)){
            self::$_type_arr = self::getTypesArray();
        }
        return self::$_type_arr[$type];
    }
    
    public static function getModerationStatusArray($withAll = false){
		$status = array();
		if($withAll){
            $status[''] = tt('All', 'common');
        }

		$status[0] = tt('Inactive', 'common');
		$status[1] = tt('Active', 'common');
		$status[2] = tt('Awaiting moderation', 'common');

		return $status;
    }
    
    public static function getApartmentsStatusArray($withAll = false) {
            $status = array();
            if($withAll){
                $status[''] = Yii::t('common', 'All');
            }

            $status[0] = Yii::t('common', 'Inactive');
            $status[1] = Yii::t('common', 'Active');
            return $status;
    }

    public static function getApartmentsStatus($status){
        if(!isset(self::$_apartment_arr)){
            self::$_apartment_arr = self::getApartmentsStatusArray();
        }
        return self::$_apartment_arr[$status];
    }

    public static function getCityArray($with_all = false){
        Yii::import('application.modules.regions.models.City');
        $cityArr = array();
        $cityModel = City::model()->findAll();
        
        foreach($cityModel as $city){
            $cityArr[$city->id] = $city->name;
        }
        if($with_all){
            $cityArr[0] = tt('All city', 'apartments');
        }
        return $cityArr;
    }
    
    public static function convertRating($rating) {
        return ($rating * 100)/5;
    }

    public static function findAllWithCache($criteria){

		return Apartment::model()
				->cache(param('cachingTime', 1209600), Apartment::getImagesDependency())
				->with(array('images', 'description', 'city'))
				->findAll($criteria);
	}

	public static function codePhone($phone) {
		$phone = trim($phone);
		if(isset($phone[0]) && $phone[0] == '(' && $phone[1] == 0)
			$phone = '+38'. $phone;
		elseif(isset($phone[0]) &&  $phone[0] == '('  && in_array($phone[1], array(7,8,9)))
			$phone = '+7'. $phone;
         return $phone;
	}

	public function getNearby( $lat, $lng, $distance = 5, $unit = 'km' ) {
		// radius of earth; @note: the earth is not perfectly spherical, but this is considered the 'mean radius'
		if( $unit == 'km' ) { $radius = 6371.009; }
		elseif ( $unit == 'mi' ) { $radius = 3958.761; }
		 
		// latitude boundaries
		$maxLat = ( float ) $lat + rad2deg( $distance / $radius );
		$minLat = ( float ) $lat - rad2deg( $distance / $radius );
		 
		// longitude boundaries (longitude gets smaller when latitude increases)
		$maxLng = ( float ) $lng + rad2deg( $distance / $radius)  /  cos( deg2rad( ( float ) $lat ) );
		$minLng =  ( float ) $lng - rad2deg( $distance / $radius)  /  cos( deg2rad( ( float ) $lat ) );
		 
		$max_min_values = array(
		'max_latitude' => $maxLat,
		'min_latitude' => $minLat,
		'max_longitude' => $maxLng,
		'min_longitude' => $minLng
		);
		 
		return $max_min_values;
	}
}
