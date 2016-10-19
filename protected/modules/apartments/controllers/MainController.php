<?php

class MainController extends ModuleUserController {

        public $modelName = 'Apartment';
        
        public $objType;
        public $roomsCount;
        public $roomsCountMin;
        public $roomsCountMax;
        public $squareCount;
        public $squareCountMin;
        public $squareCountMax;
        public $floorCount;
        public $floorCountMin;
        public $floorCountMax;
        public $price;
        public $city;
        public $city_description;
        public $checkIn;
        public $checkOut;
        public $order = 'desc';
        public $apId;
        public $user_online = false;

        public function behaviors() {
            return array(
                    'recentlyViewed'=>array(
                            'class'=>'application.extensions.ERecentlyViewedBehavior', 
                            'limit'=>5
                    ),
            );
        }

        public function actions() {
            return array(
                'captcha' => array(
                    'class' => 'CCaptchaAction',
                    'backColor' => 0xF2F5F5,
                                    'foreColor' => 0x555555,
                                    'height' => 40,
                ),
            );
        }
        
        private function mobileIndex(&$criteria, $city = null) {
            if(!empty($params = $_GET )) {
                unset($params['lang'], $params['city'], $params['page'], $params['property_search']);
                if($params) {
                    foreach ($params as $key => $value) {
                        $obj = array();
                        foreach ($value as $k => $v) {
                            if(!in_array($key, array('type'))) {
                                $minMax = explode(',', $v);
                                $criteria->addCondition("$key >=:${key}Min AND $key <=:${key}Max");
                                $criteria->params[":${key}Min"] = (!$minMax[0] ? 0 : $minMax[0]);
                                $criteria->params[":${key}Max"] = (!$minMax[1] ? 10000 : $minMax[1]); 
                            } else
                                $obj[] = $v;
                        }
                        if(!empty($obj)) {
                            $criteria->addInCondition(Apartment::model()->getTableAlias().".$key", $obj);
                        }
                    }
                }
            }
        }

        public function actionIndex($city = null) {

            Yii::app()->getModule('booking');  
            
            $criteria = new CDbCriteria;
            $this->mobileIndex($criteria, $city);
            if(!Yii::app()->user->getState('isAdmin')){
                $criteria->addCondition('active = ' . Apartment::STATUS_ACTIVE);
                $criteria->addCondition('owner_active = ' . Apartment::STATUS_ACTIVE);
            }
           
            $this->apId = Yii::app()->request->getCParam('apId');
            if($this->apId) {
                $criteria->addCondition(Apartment::model()->getTableAlias().'.id=:apId');
                $criteria->params[':apId'] = $this->apId;
            } 
            
            $this->checkIn = Yii::app()->request->getCParam('check_in');
            $this->checkOut = Yii::app()->request->getCParam('check_out');
            if($this->checkIn && $this->checkOut) {
                $listIds = ApartmentDate::model()->findAll('date>=:check_in AND date<=:check_out', array(':check_in' => $this->checkIn, ':check_out' => $this->checkOut));
                $result = array();
                if(!empty($listIds)) {
                    foreach($listIds as $ids) {
                        $result[] = $ids['apartment_id'];
                    }
                }
                $criteria->addNotInCondition(Apartment::model()->getTableAlias().'.id', $result);
            }
            $this->objType = Yii::app()->request->getParam('objType');
            if($this->objType) { 
                $criteria->addInCondition(Apartment::model()->getTableAlias().'.type', $this->objType);
                
            }
            $user_id = Yii::app()->request->getCParam('user_id');
            if ($user_id) {
                $criteria->addCondition('user_id=:user_id');
                $criteria->params[':user_id'] = $user_id;
                $user = User::model()->findByPk($user_id);
                $this->user_online = User::getOnlineUser($user_id);
            } 
            /*elseif($user_id) {
                Yii::app()->user->setFlash('warning', ApartmentsModule::t('User apartments denied'));
                $this->redirect(Yii::app()->createAbsoluteUrl('apartments'));
            }*/
              
            $roomsMin = Yii::app()->request->getCParam('room_min');
			$roomsMax = Yii::app()->request->getCParam('room_max');
			if($roomsMin || $roomsMax) {
				$criteria->addCondition('num_of_rooms >= :roomsMin AND num_of_rooms <= :roomsMax');
				$criteria->params[':roomsMin'] = $roomsMin;
				$criteria->params[':roomsMax'] = $roomsMax;

				$this->roomsCountMin = $roomsMin;
				$this->roomsCountMax = $roomsMax;
			}
           
            $priceMin = Yii::app()->request->getCParam("price_min");
			$priceMax = Yii::app()->request->getCParam("price_max");
        
			if($priceMin || $priceMax) {
				$criteria->addCondition('(price >= :priceMin AND price <= :priceMax)');
                $criteria->params[':priceMin'] = $priceMin;
				$criteria->params[':priceMax'] = $priceMax;

				$this->price["min"] = $priceMin;
				$this->price["max"] = $priceMax;
			}
            
            $squareMin = Yii::app()->request->getCParam('square_min');
			$squareMax = Yii::app()->request->getCParam('square_max');
			if($squareMin || $squareMax) {
				$criteria->addCondition('square >= :squareMin AND square <= :squareMax');
				$criteria->params[':squareMin'] = $squareMin;
				$criteria->params[':squareMax'] = $squareMax;

				$this->squareCountMin = $squareMin;
				$this->squareCountMax = $squareMax;
			}
            
            $floorMin = Yii::app()->request->getCParam('floor_min');
			$floorMax = Yii::app()->request->getCParam('floor_max');
			if($floorMin || $floorMax) {
				$criteria->addCondition('floor >= :floorMin AND floor <= :floorMax');
				$criteria->params[':floorMin'] = $floorMin;
				$criteria->params[':floorMax'] = $floorMax;

				$this->floorCountMin = $floorMin;
				$this->floorCountMax = $floorMax;
			}
            $scity = ''; $city_model = null; $url = '';
            if(!is_null($city)) {
                $city_model = City::model()->with('city_description')->find('url=:url', array(':url' => $city));
            
                if(!is_null($city_model) && isset($city_model['id'])) {
                     $criteria->addCondition('city_id=:city_id');
                     $criteria->params[':city_id'] = $city_model['id'];
                     $this->city = $city_model->city_description['name'];
                     $url = Yii::app()->session['cityUrl'] = $city_model->url;
                     $scity = $city_model->city_description['sname'];
                     $this->city_description = $city_model->city_description['description'];
                }
            } else
                unset(Yii::app()->session['cityUrl']);

            // find count
            $apCount = Apartment::model()->with(array( 'description'))->count($criteria); 
			$pages = new CPagination($apCount);
            $pages->pageSize = param('module_apartments_widgetApartmentsItemsPerPage', 10);
            $pages->applyLimit($criteria);

            $typeView = User::getModeListShow();
 
            $sort = new CSort('Apartment');
            $sortParam = Yii::app()->request->getCParam('sort');
            $sortOrder = Yii::app()->request->getCParam('order');
            $this->order = ($sortOrder) ? $sortOrder : 'desc';
            //if(!is_null($sortOrder)) {
                $criteria->order = ($sortParam ? $sortParam : Apartment::model()->getTableAlias().'.date_top DESC, '.Apartment::model()->getTableAlias().'.date_created').' '.(($sortOrder) ? $sortOrder : 'desc');
                $sort->applyOrder($criteria);
            //}

            $sorterLinks = Apartment::model()->getSorterLinks($sortParam, $sortOrder, $url);
            $this->updateCityUrl();

            $apartments = Apartment::model()
            ->cache(param('cachingTime', 1209600), Apartment::getDependency())
            ->with(array( 'description', 'services', 'images', 'city', 'user', 'avalibility', 'discount', 'comments'))
            ->findAll($criteria);

            $this->registerPrevNextRels($pages, $city_model);

            //if(Yii::app()->user->getState('isAdmin')){
                Yii::import('ext.gmap.*');
               
            //}
            if(Yii::app()->request->isAjaxRequest){
                if(isset($_GET['page'])){
                    if($pages->pageCount < $_GET['page']){
                        throw new CHttpException(404,'No More results');
                    }
                }
                $this->renderPartial('widgetApartments_list_ajax', 
                    array('count' => $apCount, 'typeView' => $typeView, 'apartments' => $apartments, 'url' => $url,
                     'criteria' => $criteria, 'pages' => $pages, 'sorterLinks' => $sorterLinks, 'user_id' => $user_id, 'scity' => $scity,
                     'user' => isset($user) ? $user : array()));
            } else
                $this->render('widgetApartments_list', 
                    array('count' => $apCount, 'typeView' => $typeView, 'apartments' => $apartments, 'url' => $url, 'sort' => $sortParam,
                        'criteria' => $criteria, 'pages' => $pages, 'sorterLinks' => $sorterLinks, 'user_id' => $user_id, 'scity' => $scity,
                        'user' => isset($user) ? $user : array()));       
        }
        
        private function registerPrevNextRels($pages, $model) {
            if($pages) { 
                $current = $pages->getCurrentPage() + 1;
                $params['page'] = $current - 1;
                if(isset($model->url))
                     $params['city'] = strtolower($model->url);
            
                if($current > 1)
                    Yii::app()->clientScript->registerLinkTag('prev', null, Yii::app()->createAbsoluteUrl('/apartments/main/index',$params));
                if($current > 1){
                    if(!isset($model->url))
                        Yii::app()->clientScript->registerLinkTag('canonical', null, Yii::app()->createAbsoluteUrl('apartments'));
                    else
                        Yii::app()->clientScript->registerLinkTag('canonical', null, Yii::app()->createAbsoluteUrl('apartments', array('city' => $model->url)));
                }
                
                if($current < $pages->getPageCount()) {
                    $params['page'] = $current + 1;
                    Yii::app()->clientScript->registerLinkTag('next', null, Yii::app()->createAbsoluteUrl('/apartments/main/index',$params));
                }
            }
        }

        private function getIdentifierId() {
            if(!Yii::app()->user->hasState("newObject")) {
                $ident =  time();
                $sql = 'SELECT * FROM {{images}} WHERE id_object=:id';
                $existImages = Images::model()->findAllBySql($sql, array(':id' => $ident));
                if(!empty($existImages))
                    $this->getIdentifierId();
                Yii::app()->user->setState("newObject", $ident);
            } else 
                $ident = Yii::app()->user->getState("newObject");
            return $ident;
        }

        public function actionUploadPhotos() {
            if(isset($_GET['qqfile'])){
                Yii::import("ext.EAjaxUpload.qqFileUploader");
                $allowedExtensions = param('allowedImgExtensions', array('jpg', 'jpeg', 'gif', 'png'));
                $sizeLimit = Images::getMaxSizeLimit();
                $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
                
                $dir = $this->getIdentifierId();
                @mkdir(Yii::getPathOfAlias('webroot.tmp.'.$dir),0777);
                $path = Yii::getPathOfAlias('webroot.tmp.'.$dir);
                if(is_writable($path)){  
                    $result = $uploader->handleUpload($path.DIRECTORY_SEPARATOR, false, uniqid());
                    if(isset($result['success']) && $result['success']){
                        $resize = new CImageHandler();
                        if($resize->load($path.DIRECTORY_SEPARATOR.$result['filename'])){
                            $resize->thumb(param('maxImageWidth', 1024), param('maxImageHeight', 768), Images::KEEP_PHOTO_PROPORTIONAL)->save();
                        }
                    }
                   
                }
                $result = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
                echo $result;
            } 
        }
        
        /*private function showPhotos() {
            if(Yii::app()->user->getState('isAdmin')) {
                $dir = $this->getIdentifierId(); $images = array();
                if(is_dir(Yii::getPathOfAlias("webroot.tmp.".$dir))) {
                    $files = CFileHelper::findFiles(Yii::getPathOfAlias("webroot.tmp.".$dir));
                    if(!empty($files )) {
                        foreach($files as $file)
                            $images[] = basename($file);
                    }
                }

                return $images;   
            }         
        }*/

        public function actionNew() {
            Yii::app()->getModule('apartments');
            Yii::app()->getModule('regions');


            $user = new User('step_one');
            $model = new Apartment();
            $model->description = new Description();
            $model->services = new Services();
            $model->images = new Images();
            if(($uniqid = $this->getIdentifierId()))
                $model->images->id_object = $uniqid;

            $validate = array();
            if(Yii::app()->user->isGuest){
                if(isset($_POST['User'])){
                        $user->attributes = $_POST['User'];
                        array_push($validate, $user);
                } 
            }

            if(isset($_POST['Apartment'])) {
                $model->scenario = 'step_two';
                $model->attributes = $_POST['Apartment'];
                $model->description->attributes = $_POST['Description'];
                array_push($validate, $model, $model->description);
            }

            if(isset($_POST['Services']))  {
                $model->services->scenario = 'step_third';
                $model->services->setAttributes($_POST['Services']);
                array_push($validate, $model->services);  
            }

            if(Yii::app()->request->isAjaxRequest) {
                echo CActiveForm::validate($validate);
                Yii::app()->end();
            }

            $img = null;
            if(Yii::app()->user->hasState("newObject"))
                $img = Yii::app()->user->getState("newObject");

            if(isset($_POST['Apartment'])) {
                if(!CJSON::decode(CActiveForm::validate($validate))) {

                    $password = null;

                     if(Yii::app()->user->isGuest){
                        $password = call_user_func(array(new User, 'randomString'), 6);
                        $user->password=UserModule::encrypting($password);
                        if($user->save(false)) {
                            $notifier = new Notifier();
                            $notifier->raiseEvent('onNewUser', $user, array(
                                'forceEmail' => $user['email'],
                                'usrPassword' => $password
                            ));
                            $identity=new UserIdentity($user->username,$password);
                            $identity->authenticate();
                            Yii::app()->user->login($identity,0);
                        }
                    } else
                        $user = User::model()->findByPk(Yii::app()->user->id);

                    $model->phone = $user->phone;

                    $model->user_id = $user->primaryKey;
                    if($model->validate())
                        if($model->save(false)) { 
                            $apartmentId = $model->primaryKey;
                            $model->description->apartment_id = $apartmentId;
                            $model->description->lang = Yii::app()->language;
                            
                            $description = array('title','description', 'description_near', 'address');
                            foreach(Lang::getActiveLangs() as $lang) { 
                                if(Yii::app()->language != $lang) {
                                    $translate = new Translator(Yii::app()->params['yandexKey']);
                                    $desc = new Description();
                                    $desc->apartment_id = $apartmentId;
                                    foreach($description as $field)
                                        $desc->setAttribute($field, $translate->translate($model->description->{$field}, Yii::app()->language .'-'. $lang));
                                    $desc->lang = $lang;                 
                                    $desc->save();
                                }
                            }

                            if($model->description->save()) {
                                $city_desc = CityDescription::model()->find('city_id=:city_id',array(':city_id' => $model->city_id));
                                $coords = Geocoding::getCoordsByAddress($model->description->address, $city_desc->name);
                                if(isset($coords['lat']) && isset($coords['lng'])){
                                    $model->lat = $coords['lat'];
                                    $model->lng = $coords['lng'];
                                    $model->save(false);
                                }
                                $model->services->apartment_id = $apartmentId;
                                $model->services->save();
                                if(!empty($_POST['reference_value_id'])) {
                                    foreach($_POST['reference_value_id'] as $value) {
                                        $reference = new Reference();
                                        $reference->apartment_id = $apartmentId;
                                        $reference->reference_value_id = $value;
                                        $reference->save();
                                    }
                                }
                                if(isset($uniqid) && is_dir(Yii::getPathOfAlias('webroot').'/uploads/objects/'.$uniqid)){
                                    @rename(Yii::getPathOfAlias('webroot').'/uploads/objects/'.$uniqid, Yii::getPathOfAlias('webroot').'/uploads/objects/'.$apartmentId);
                                    $gallery = Images::model()->findAll('id_object=:id_object', array(':id_object' => $uniqid));
                                    if(!is_null($gallery)) {
                                        foreach($gallery as $value) {
                                            $sql = "UPDATE {{images}} SET id_object=$apartmentId, id_owner=$model->user_id WHERE id=:id";
                                            Yii::app()->db->createCommand($sql)->execute(array(':id' => $value->id));
                                        }
                                    }
                                }
                                
                                Yii::app()->user->setFlash('success', ApartmentsModule::t('Account with your proposition were created'));
                                $this->redirect(Yii::app()->createAbsoluteUrl('user/profile/editApartment', array('user'=>Yii::app()->user->username,'id'=>$apartmentId)));
                            }

                            
                        }
                }
               
            }

            $this->render('new_apartment/form_apartment', array('model' => $model, 'img' => $img,
                                              'user' => $user));
        }

        public function dateRange($first, $last, $step = '+1 day', $format = 'd/m/Y' ) { 
            $dates = array();
            $current = strtotime($first);
            $last = strtotime($last);
            while( $current <= $last ) { 

                $dates[] = date($format, $current);
                $current = strtotime($step, $current);
            }
            return $dates;
        }
        
       
        
        private function updateVisit($id) { 
            if(!Yii::app()->user->getState('isAdmin')) {
                $value = isset(Yii::app()->request->cookies['visitor']) ? Yii::app()->request->cookies['visitor']->value : '';
                $record = Statistic::model()->find('apartment_id=:apartment_id AND date=:date', array(':apartment_id' => $id, ':date' => date("Y-m-d")));
                if($record === null) {
                    $record = new Statistic();
                    $record->setAttributes(array(
                        'apartment_id' => $id,
                        'counter' =>1,
                        'date' => date("Y-m-d")
                        ), false
                    );
                } else {
                    $record->attributes = array(
                        'Statistic' => array(
                            'counter' => $record->counter++,
                            )
                        );
                }
                if(strlen($value) > 0 )  {
                    $value = unserialize($value);
                    if(!empty($value) && !in_array($id, $value)) {
                        array_push($value, $id);
                        $record->save();
                    }
                } else {
                    $record->save();
                    $cookie = new CHttpCookie('visitor', serialize(array($id)));
                    $cookie->expire = strtotime("tomorrow"); 
                    Yii::app()->request->cookies['visitor'] = $cookie;
                }
            }
        }


        
        public function actionView($id) {
            Yii::app()->getModule('comments');
            Yii::app()->getModule('apartments');
            Yii::app()->getModule('booking');
            Yii::app()->getModule('regions');

            $this->updateVisit($id);
            $comment = new Comment;
            if (isset($_POST['Comment'])) {
                $comment->attributes = $_POST['Comment'];
                $comment->apartment_id = $id;
                if(!Yii::app()->user->isGuest){
                    $comment->name = Yii::app()->user->username;
                    $comment->email = Yii::app()->user->email;
                }

                if ($comment->save()) { 
                    if ($comment->active == Comment::STATUS_PENDING)
                        Yii::app()->user->setFlash('success', Yii::t('module_comments','Thank you for your comment. Your comment will be posted once it is approved.'));
                } else {
                        Yii::app()->user->setFlash('warning',Yii::t('module_comments','Please check necessary fields!'));
                }
            }


            $apartment = Apartment::model()
                ->cache(param('cachingTime', 1209600), Apartment::getFullDependency($id))
                ->with( array('comments', 'services', 'description', 'images', 'city', 'user'))
                ->findByPk($id);

            if($apartment == null) {
                Yii::app()->request->redirect(Yii::app()->createUrl('/apartments'), true, 301);
            }
            

            $rating = $this->calculateRating($apartment->comments);
            if($apartment->active != 1 && !Yii::app()->user->getState('isAdmin')){
                Yii::app()->user->setFlash('warning',ApartmentsModule::t('Dont have access for inactive proposition'));
            }

            if($apartment->city_id > 0 && !is_null($apartment->city))
                $this->seoCity = CityDescription::model()->find('city_id=:city_id', array(':city_id' => $apartment->city_id));

            if($apartment === null){
                if($comment->apartment_id){
                    $comment->delete();
                }
                Yii::app()->request->redirect(Yii::app()->createUrl('/apartments'), true, 301);
            }

            if($comment->apartment_id && $apartment->id != $comment->apartment_id){
                $comment->delete();
            }
                
            // Recently items viewed
            $modelClass = get_class($apartment);
            $this->setRecentlyViewed($modelClass, $id);

            $this->pageDescription .= ' - '.$apartment->description->title;
            $request = new RequestApartment();
            if(isset($_POST['RequestApartment'])) {
                $request->attributes = $_POST['RequestApartment'];

                if($request->validate()) {
                        $message = new YiiMailMessage;
                        $user = User::model()->with('profile')->find('id=:id',array(':id'=>$apartment->user_id));
                        $message->setSubject(ApartmentsModule::t('Request email'));
                        $message->setFrom(array($request->email=>$request->user));
                        $message->view = 'request_form_apartment';
                        $message->setBody(array('model' => $request), 'text/html', 'utf-8');
                        $message->setTo($user->email);

                        Yii::app()->mail->send($message);
                }

            }

            $this->render('view', array(
                'avalibility' => new ApartmentDate(),
                'model' => $apartment,
                'comment' => $comment,
                'request' => $request,
				'rating' => $rating,
                'user_online' => User::getOnlineUser($apartment->user->id),
                'references' =>  Apartment::getCategories($id)
            ));
	
        }
        
        
        private function calculateRating($comments) {
            $rating = array('rating_photos', 'rating_clarity', 'rating_service', 'rating_location', 'rating_price');
            $tmp_rating = array(); $main = array(); $count_comment = 0;
            if(!empty($comments)) {
                $count_comment = count($comments);
                for($i=0; $i < $count_comment; $i++) {
                    for($j=0; $j<count($rating); $j++){
                        $main[$rating[$j]] = isset($main[$rating[$j]]) ? ($main[$rating[$j]] + $comments[$i]->{$rating[$j]}) : $comments[$i]->{$rating[$j]};
                        $tmp_rating[$comments[$i]->id][$rating[$j]] = $comments[$i]->{$rating[$j]};
                    }
                    $tmp_rating[$comments[$i]->id]['rating'] = array_sum($tmp_rating[$comments[$i]->id]);
                }
            } 
            return array('comment' => $tmp_rating,
                         'main' => $main,
                         'count' => $count_comment);
            
        }
        public function actionPhotos() {
            if($_POST['aprtment_id']) {
                Yii::app()->getModule('images');
                $images = Images::getObjectThumbs(310, 210, array(), $_POST['aprtment_id']);
                if($images) {
                    $result = array();
                    foreach($images as $image) {
                        $image= array_merge($image, array('id_object' => $_POST['aprtment_id']));
                        $result[] = Images::getThumbUrl($image, 310, 210);
                    }
                }
                echo CJSON::encode($result);
            }
        }

        public function actionPrint() {
            
            $this->layout = "//layouts/main-print";
            if(Yii::app()->getRequest()->getQuery('id')) {
                $apartment = Apartment::model()
                    ->cache(param('cachingTime', 1209600), Apartment::getFullDependency($_GET['id']))
                    ->with( 'comments', 'description', 'images', 'city', 'user')
                    ->findByPk(Yii::app()->getRequest()->getQuery('id'));
                if($apartment == null) {
                    $this->layout = "//layouts/main";
                    Yii::app()->request->redirect(Yii::app()->createUrl('/apartments'), true, 301);
                }
                $this->render('print', array('apartment' => $apartment));
            }
        }

       
        public function actionAvalibility() {
           if (Yii::app()->request->isAjaxRequest){ 
           		$count = 0;
                if (isset($_POST['ApartmentDate'])) {  
                    $avalibility = new ApartmentDate();
                    $avalibility->scenario = 'check';
                    $avalibility->attributes = $_POST['ApartmentDate'];
                    $avalibility->apartment_id = $_POST['Apartment']['id'];
                    if ($avalibility->validate()){
                    	$count = count($this->dateRange($avalibility->check_in, $avalibility->check_out));
                        $result = ApartmentDate::model()->checkDates($avalibility->check_in, $avalibility->check_out, $avalibility->apartment_id);
                        $getPrice = Apartment::model()->findByAttributes(array('id' => $avalibility->apartment_id));
                        if(!$result)
                            echo CJSON::encode(array('status' =>'fail', 'message' => ApartmentsModule::t('Empty dates')));
                        else
                            echo CJSON::encode(array('status' =>'success', 'details' => array('nights' => numberReplacing("$count", array(Yii::t('common','Night', array('{v}' => $count)), Yii::t('common','Nights', array('{v}' => $count)), Yii::t('common','Nights_', array('{v}' => $count)))),
                            						 'total' => isset( $getPrice->price) ? ApartmentsModule::t('Price {value}', array('{value}' => $count * $getPrice->price)) : 0), 'message' => ApartmentsModule::t('Free dates')));   
                        Yii::app()->end();
                    }
                    echo CJSON::encode(array('status' => 'fail', 'message' => ApartmentsModule::t('Check all necessary fields')));
                    Yii::app()->end();
                }
           }
        }
        public function actionResetFilter() {
            Yii::app()->getModule('booking');
            if(Yii::app()->request->isAjaxRequest)  {
                if(isset(Yii::app()->request->cookies['userSettings']))  
                    unset(Yii::app()->request->cookies['userSettings']);

                $result = apartmentsHelper::getApartments(param('module_apartments_widgetApartmentsItemsPerPage', 10), $this->usePagination, 0, $this->criteria);
                $this->renderPartial('widgetApartments_list', array_merge($result, array('settings' => $this->settings, 'counter' => $result['count'], 'cookie' =>  isset(Yii::app()->request->cookies['userSettings']) ? CJSON::decode(Yii::app()->request->cookies['userSettings']->value) : array())));

                Yii::app()->end();
            }
        }

        public function actionLoadMainThumb($id) {
            echo json_encode(Images::getMainThumb(210, 200, null, $id));
        }
        
        public function actionLoadSearch() {
            if(Yii::app()->request->isAjaxRequest)  {
                Yii::app()->getModule('referencevalues');
                Yii::app()->getModule('apartments');
                
                $cookie = array();
                if(isset(Yii::app()->request->cookies['userSettings']))  
                   $cookie = CJSON::decode(Yii::app()->request->cookies['userSettings']->value); 
                      
                $this->renderPartial('loadSearch',array('settings' => $cookie));
            }
        }
        


        public function actionGeneratePhone($id = null, $text = array(), $width=160, $font=4, $height=50, $size = 11, $offset = 17) {
                $text = base64_decode($text); 
                if(empty($text)) {
                    $apartmentInfo = Apartment::model()->find('id=:id', array(':id'=>$id));
                    if ($apartmentInfo->phone) {
                        $text = array($apartmentInfo->phone,
                                      $apartmentInfo->phone_additional);
                    }

                } else {
                    $text = explode(':',$text);
                }
                $font = Yii::getPathOfAlias('webroot').'/themes/default/assets/fonts/pfagorasanspro-regular.ttf';
                if (!empty($text)) {
                        $image = imagecreate($width, $height);
                        $bg = imagecolorallocate($image,  252,  252,  252 );
                        $textcolor = imagecolorallocate($image, 51, 51, 51);
                        imagecolortransparent($image, $bg);
                        foreach($text as $value) {
                            if($value) {
                                imagettftext($image, $size, 0, 5, $offset, $textcolor, $font, $value);
                                $offset = $offset+$offset;
                            }
                        }
                        ob_clean();
                        header("Expires: " . date(DATE_RFC822,strtotime(" 2 day")));
                        header("Content-type: image/png");
                        imagepng($image);
                        imagedestroy($image);
                }
        }

        public function actionLoadMap($id) {

            if($id) {
                $apartment = Apartment::model()->with('description')->findByPk($id);
                $this->renderPartial('loadmap', array('model' => $apartment));
            }
        }
            
        public function actionAnotherDesc() {
                
                if(isset($_GET['apartment_id']) && Yii::app()->request->isAjaxRequest) {
                    $model = Apartment::model()->find('id=:id', array(':id'=>$_GET['apartment_id']));
                    $img = $model->getAllImages(80,0, 0, 205);

                    $this->renderPartial('viewImages',array('images'=>$img));
                }
        }
}
