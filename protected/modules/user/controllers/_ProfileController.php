<?php
Yii::import('application.modules.apartments.helpers.apartmentsHelper');
class ProfileController extends ModuleUserController
{
	public $defaultAction = 'profile';
    public $modelName = 'Apartment';
    private $actions_layout = array('discounts');

    

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;
	/**
	 * Shows a particular model.
	 */
    public function filters()
	{
		return CMap::mergeArray(parent::filters(),array(
			'accessControl', // perform access control for CRUD operations
		));
	}
        

    public function __construct($id, $module = null) {

        if (Yii::app()->user->isGuest) 
            $this->redirect(Yii::app()->createAbsoluteUrl(''));

        parent::__construct($id, $module);

    }

    public function init() {
        parent::init();
        
    }
    protected function beforeAction($action){
        if(in_array(Yii::app()->controller->action->id, $this->actions_layout))
            $this->layout = '//layouts/admin';
        return parent::beforeAction($action);
    }
    
    function dateRange($first, $last, $step = '+1 day', $format = 'd/m/Y' ) { 

        $dates = array();
        $current = strtotime($first);
        $last = strtotime($last);

        while( $current <= $last ) { 

            $dates[] = date($format, $current);
            $current = strtotime($step, $current);
        }

        return $dates;
    }
	public function actionProfile()
	{ 
            Yii::app()->getModule('apartments');
            Yii::app()->getModule('booking');
            Yii::app()->getModule('comments');

            if(Yii::app()->user->getState('isAdmin')) {
                $model = new Apartment();
                $model = $model->with(array('description', 'city', 'user'));
                $this->render('profile/profile',array(
                              'model' => $model
                ));
            } else {
                $apartmens = apartmentsHelper::getUserApartments(Yii::app()->user->id);
                $dateStart = date("Y-m-d", strtotime("-2 weeks"));
                $rangeDates = $this->dateRange($dateStart, date('Y-m-d'), '+1 day', 'Y-m-d');
                $visitedApartments = Apartment::model()->with(array('description', 'statistic:weeks'))->findAll('user_id=:user_id', array(':user_id' => Yii::app()->user->id));

                foreach($apartmens['apartments'] as $apart) {
                   if($apart->owner_active == 1 && empty($apart->images)) {
                        Yii::app()->user->setFlash('warning', UserModule::t('Proposition not have photos'));
                   } elseif($apart->active != 1 && $apart->owner_active == 1) {
                        Yii::app()->user->setFlash('info', UserModule::t('Proposition is wating for response from moderator', array('{title}' => $apart->description->title)));
                   }
                }
                $returnVisitedapartments = array();
                if(!is_null($visitedApartments)) {
                    $id = 0;  
                    foreach($visitedApartments as $apartment) {
                        if(isset($apartment->description)) {
                            $returnVisitedapartments[$id] = array('type'=> 'spline','name' => $apartment->description->title,
                                                                  'data' => $rangeDates);

                            if(!empty($apartment->statistic)) {     
                                foreach($apartment->statistic as $statistic) {
                                    if($key = array_search($statistic->date, $returnVisitedapartments[$id]['data']))
                                        $returnVisitedapartments[$id]['data'][$key] = $statistic['counter'];
                                        
                                }
                                $returnVisitedapartments[$id]['data'] = array_map(function($var) {
                                    return is_numeric($var) ? (int)$var : 0;
                                }, $returnVisitedapartments[$id]['data']); 

                                $id++;
                            }
                        }
                    }
                } 
               
                $rangeDates = array_map(function($var) {
                    return date('jS', strtotime($var));
                 }, $rangeDates);  
                 
                $results = Booking::model()->with(array('description', 'ap', 'thumb'))->findAll('t.sender_id=:sender_id', array(':sender_id'=>Yii::app()->user->id));
                $this->render('profile/profile',array(
                              'model' => $apartmens,
                              'booking' => $results,
                              'ranges' => $rangeDates,
                              'visited' => $returnVisitedapartments
                ));
            }
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionEdit()
	{
                
		$model = User::model()->find('id=:id', array(':id'=>Yii::app()->user->id));
		
		
		// ajax validator
		if(isset($_POST['ajax']) && $_POST['ajax']==='profile-form')
		{
			echo UActiveForm::validate(array($model,$profile));
			Yii::app()->end();
		}
		
		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->validate()) {
				$model->save(false);
				Yii::app()->user->setFlash('success',UserModule::t("Changes is saved."));
				$this->redirect(array('/user/profile'));
                                
			} 
                        
            Yii::app()->user->setFlash('warning', UserModule::t('Check all necessary files'));
		}

		$this->render('profile/edit',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Change password
	 */
	public function actionChangepassword() {
		$model = new UserChangePassword;
		if (Yii::app()->user->id) {
			
			// ajax validator
			if(isset($_POST['ajax']) && $_POST['ajax']==='changepassword-form')
			{
				echo UActiveForm::validate($model);
				Yii::app()->end();
			}
			
			if(isset($_POST['UserChangePassword'])) {
					$model->attributes=$_POST['UserChangePassword'];
					if($model->validate()) {
						$new_password = User::model()->notsafe()->findbyPk(Yii::app()->user->id);
						$new_password->password = UserModule::encrypting($model->password);
						$new_password->activkey=UserModule::encrypting(microtime().$model->password);
						$new_password->save();
						Yii::app()->user->setFlash('success',UserModule::t("New password is saved."));
						$this->redirect(array("profile"));
					} else {
                        Yii::app()->user->setFlash('warning', UserModule::t('Check all necessary files'));
                     }
			}
			$this->render('profile/changepassword',array('model'=>$model));
	    }
	}
        
    public function actionRequests() {
       Yii::app()->getModule('booking');
       Yii::app()->getModule('apartments');

       $model = Booking::model()->with(array('apartment','user'))->findAll('t.user_id=:user_id', array(':user_id'=>Yii::app()->user->id));
       $this->render('profile/requests', array('model'=>$model));
    }

        
	public function loadUser()
	{
          
		if($this->_model===null)
		{
			if(Yii::app()->user->id)
				$this->_model=Yii::app()->controller->module->user();
			if($this->_model===null)
				$this->redirect(Yii::app()->controller->module->loginUrl);
		}
                  
		return $this->_model;
	}
        
    public function actionChangeAvatar() {
            
            $user = User::model()->find('id=:id', array(':id'=>Yii::app()->user->id));
            $user->scenario = 'upload';
            $oldImage = $user->user_image;
            
            if(isset($_GET['qqfile'])){
                Yii::import("ext.EAjaxUpload.qqFileUploader");
                $allowedExtensions = param('allowedImgExtensions', array('jpg', 'jpeg', 'gif', 'png'));
                $sizeLimit = Images::getMaxSizeLimit();
                $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
                
                $path = Yii::getPathOfAlias('webroot.uploads.users');
                if(is_writable($path)){  
                    touch($path.DIRECTORY_SEPARATOR.'index.htm');
                    $result = $uploader->handleUpload($path.DIRECTORY_SEPARATOR, false, uniqid());
                    if(isset($result['success']) && $result['success']){
                        $resize = new CImageHandler();
                        if($resize->load($path.DIRECTORY_SEPARATOR.$result['filename'])){
                            $resize->thumb(150, 270, Images::KEEP_PHOTO_PROPORTIONAL)
                                ->save();
                            $user->user_image = $result['filename'];
                            if($user->save(false))
                                @unlink($path.DIRECTORY_SEPARATOR.$oldImage);
                        } else {
                            $result['error'] = 'Wrong image type.';
                            @unlink($path.DIRECTORY_SEPARATOR.$result['filename']);
                        }
                    }
                   
                }
                $result = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
                echo $result;
            } else {
            
            if(Yii::app()->request->isAjaxRequest){
                Yii::app()->clientScript->scriptMap['bootstrap.css'] = false;
                Yii::app()->clientScript->scriptMap['bootstrap.min.css'] = false;
                Yii::app()->clientScript->scriptMap['bootstrap.min.js'] = false;
                Yii::app()->clientscript->scriptMap['jquery.js'] = false;
                Yii::app()->clientscript->scriptMap['jquery.min.js'] = false;
                Yii::app()->clientscript->scriptMap['jquery-ui.min.js'] = false;
                Yii::app()->clientscript->scriptMap['jquery-ui-i18n.min.js'] = false;
            }
            $this->renderPartial('profile/form_upload', array('user'=>$user), false, true);
            }
            
        }
        
        public function actionActivateAdmin($id) { 
            if(Yii::app()->user->getState('isAdmin')) {
                if($id && ($model = $this->loadModel($id)) != false ) {
                    $model->active = ($model->active ?  0 : 1);
                    $model->save(false);

                    $this->redirect(Yii::app()->createAbsoluteUrl('user/profile'));
                }
            }
        }
        public function actionActivateApartment($id) {
            Yii::app()->getModule('apartments');
            $this->modelName = 'Apartment'; 
            
            if($id && ($model = $this->loadModel($id)) != false ) { 
                if($model->user_id ==  Yii::app()->user->id) {
                    $model->owner_active ? $model->owner_active = 0 : $model->owner_active = 1;
                    $model->save(false);
                    
                    Yii::app()->user->setFlash('success', ApartmentsModule::t('Your information updated'));
                    $user = User::model()->find('id=:id', array(':id'=>Yii::app()->user->id));
                    $this->redirect(Yii::app()->createAbsoluteUrl('user/profile'));
                }
            }
        }
        
        public function actionDeleteApartment($id) {
            Yii::app()->getModule('apartments');
            $this->modelName = 'Apartment'; 
            if($id && ($model = $this->loadModel($id)) != false ) { 
                if(Yii::app()->user->getState('isAdmin') || $model->user_id ==  Yii::app()->user->id) {
                    $model->delete();
                    Yii::app()->user->setFlash('success', ApartmentsModule::t('Your apartment deleted'));
                    
                    $user = User::model()->find('id=:id', array(':id'=>Yii::app()->user->id));
                    $this->redirect(Yii::app()->createAbsoluteUrl('user/profile'));
                }
            } 
        }
        
        private function saveDescriptionItems($id, $apartment, $data) { 
            if(!empty($data)) {  
               foreach(Lang::getActiveLangs() as $lang) { 
                
                   if(isset($data[$lang])) {
                       $apartment[$lang]->setAttributes($data[$lang]);
                       if($apartment[$lang]->isNewRecord) {
                           $apartment[$lang]->apartment_id = $id;
                           $apartment[$lang]->lang = $lang;
                       }
                       
                       if($apartment[$lang]->validate())
                           $apartment[$lang]->save(false);
                       else
                           echo UActiveForm::validate(array($apartment[$lang]));
                   }
               }
            }
            return true;
        }
        
        private function getDescriptions($id) {
            $description = array();
            foreach(Lang::getActiveLangs() as $lang) {
                $result = Description::model()->find('apartment_id=:apartment_id AND lang=:lang', array(':apartment_id' => $id, ':lang' => $lang));
                if($result === null)
                    $description[$lang] = new Description();
                else
                    $description[$lang] = $result;
            }
            return $description;
        }

        public function actionServicesApartment($id) {
            Yii::app()->getModule('apartments');
          

            $apartment = Apartment::model()->findByPk($id);
            if($apartment !== false && $this->isOwner($apartment->user_id)) {
                if(isset($_POST['Apartment'])) {
                    if(Yii::app()->request->isAjaxRequest) {
                    }
                }
                $this->render('profile/services_apartment',array('model' => $apartment));
            }
        }
        
        public function actionEditApartment($id) {

                
            Yii::app()->getModule('apartments');
            Yii::app()->getModule('regions');
            
            $apartment = Apartment::model()
                        ->cache(param('cachingTime', 1209600), Apartment::getDependency())
                        ->with( 'comments', 'city')
                        ->findByPk($id);
          
            $description = $this->getDescriptions($id);
            if((isset($apartment->user_id) && !Yii::app()->user->getState('isAdmin') && Yii::app()->user->id != $apartment->user_id) || is_null($apartment)) {
                Yii::app()->user->setFlash('notice', UserModule::t('Don\'t repeat this request again.'));
                $this->redirect(Yii::app()->createAbsoluteUrl('user/profile'));
            }
           
            $apartment->services = Services::model()->find('apartment_id='.$id);
        
            if(is_null($apartment->services))
                $apartment->services = new Services ();

            if(isset($_POST['Apartment'])){
                $apartment->attributes = $_POST['Apartment'];
                $validate = $apartment->validate();
                
                if(isset($_POST['Services'])) {
                    $apartment->services->attributes = $_POST['Services'];
                    $apartment->services->time_race = $_POST['Services']['start'].'/'.$_POST['Services']['end'];
                    $apartment->services->apartment_id = $id;
                    $apartment->services->save(false);
                }
                
                if(isset($_POST['reference_value_id']) && !empty($_POST['reference_value_id'])) {
                    Reference::model()->deleteAll('apartment_id=:apartment_id', array(':apartment_id'=>$id));
                    foreach($_POST['reference_value_id'] as $reference) {
                        $references = new Reference;
                        $references->reference_value_id = $reference;
                        $references->apartment_id = $id;
                        $references->save();
                    }

                }
                         

                if($validate && $this->saveDescriptionItems($id, $description, $_POST['Description'])) {
                    $apartment->save(false);
                    Yii::app()->user->setFlash('success', ApartmentsModule::t('Your information updated'));
                    $this->redirect(Yii::app()->createAbsoluteUrl('user/profile/editApartment', array('user'=>Yii::app()->user->username, 'id' => $id)));
                } else {
                    Yii::app()->user->setFlash('warning', ApartmentsModule::t('Check all necessary fields'));
                }
            }
            
            $references = Reference::model()->findAll('apartment_id=:apartment_id', array(':apartment_id'=>$id));

            $selected = array();
            if(!is_null($references)) {
                foreach($references as $value) 
                    $selected[] = $value['reference_value_id'];
            }
            $references_all = Apartment::getReferences($id); 
            $this->render('profile/create_apartment',array('model'=>$apartment,
                                                  'description' => $description,
                                                  'categories' => $references_all['references'],
                                                  'selected' => $selected)
                         );
            
        }
        
        
        public function actionDeleteImage($id) {
            
            if(Yii::app()->request->isAjaxRequest) {
                
                Yii::app()->getModule('apartments');
                
                if(isset($_POST['id'])) {  
                    $images = Galleries::model()->find('pid=:pid', array(':pid'=>$id));
                    $tmp = unserialize($images['imgsOrder']);

                    if(isset($_POST['type']) && $_POST['type'] == 'delete') {
                        foreach($tmp as $key=>$value) {
                            if($key == $_POST['id'])
                                unset($tmp[$key]);

                        }

                        $images->imgsOrder = serialize($tmp);
                        if($images->save(false)) {
                            if(file_exists(Yii::app()->getBasePath(). '/uploads/apartments/'.$id.'/'.$key)) {
                                @unlink(Yii::app()->getBasePath(). '/uploads/apartments/'.$id.'/'.$key);
                            }
                        }
                    }
                }
            }
        }
        
        public function actionComplaints() {
            
            Yii::app()->getModule('apartments');
            Yii::app()->getModule('booking');
            
            $model = Complaint::model()->with(array('apartment'))
                                       ->findAll('user_id=:user_id', array(':user_id' => Yii::app()->user->id));

            $this->render('profile/complaintsList', array('complaints' => $model));
            
        }
        
        public function actionResponceComplaint() {
            
            Yii::app()->getModule('booking');
            if(Yii::app()->request->isAjaxRequest) {
                
                if(isset($_POST['complaint_id']) && $_POST['complaint_id']) {
                    
                    $responce = new ComplaintResponce();
                    $responce->complaint_id = $_POST['complaint_id'];
                    $responce->responce_message = $_POST['message'];
                    $responce->save();
                }
            }
        }
        
        public function actionFreeDates($id) {
            Yii::app()->getModule('apartments');
            if(Yii::app()->request->isAjaxRequest) {
                if(isset($_POST['date']) && isset($_POST['type'])) {
                    if(!$_POST['type'])
                        ApartmentDate::model()->deleteAll('apartment_id=:apartment_id AND date=:date', array(':apartment_id' => $id, ':date' => $_POST['date']));
                    elseif((int)$_POST['type'] == 1) {
                        $exist = ApartmentDate::model()->find('apartment_id=:apartment_id AND date=:date', array(':apartment_id' => $id, ':date' => $_POST['date']));
                        if(!$exist) {
                            $record = new ApartmentDate();
                            $record->apartment_id = $id;
                            $record->date = $_POST['date'];
                            $record->save(false);
                        }
                    }
                    Yii::app()->end();
                }
               
                $avalibility = Apartment::model()->with(array('avalibility'))->find('apartment_id=:apartment_id', array(':apartment_id' => $id));
                $exist_dates = array();
                if(isset($avalibility->avalibility) && $avalibility->avalibility) {
                    foreach($avalibility->avalibility as $dates) {
                        $tmp = explode('-', $dates['date']);
                        $exist_dates[] = $tmp[0]."-".intval($tmp[1])."-".intval($tmp[2]);
                    }
                }
               
                Yii::app()->clientScript->scriptMap['bootstrap.css'] = false;
                Yii::app()->clientScript->scriptMap['bootstrap.min.css'] = false;
                Yii::app()->clientscript->scriptMap['bootstrap.min.js'] = false;
                Yii::app()->clientscript->scriptMap['jquery.js'] = false;
                Yii::app()->clientscript->scriptMap['jquery.min.js'] = false;
                Yii::app()->clientscript->scriptMap['jquery-ui.min.js'] = false;
                Yii::app()->clientscript->scriptMap['jquery-ui-i18n.min.js'] = false;
                
                $this->renderPartial('profile/free_dates', array('model' => CJSON::encode($exist_dates)), false, true);
            }
        }

        private function translateDescription($model, $apartmentId) {
            $description = array('title','description', 'description_near', 'address');
            foreach(Lang::getActiveLangs() as $lang) { 
                if(Yii::app()->language != $lang) {
                    $translate = new GoogleTranslater();
                    $desc = new Description();
                    $desc->apartment_id = $apartmentId;
                    foreach($description as $field)
                        $desc->setAttribute($field, $translate->translateText($model->{$field}, Yii::app()->language, $lang));
                    $desc->lang = $lang;                 
                    if(!$desc->save())
                        return false;
                }
            }
            return true;
        }

        public function actionCreateApartment(){ 
            Yii::app()->getModule('apartments');
            Yii::app()->getModule('regions');

            $model = new Apartment;
            $model->services = new Services;
            $model->description = new Description;

            if(isset($_POST['Apartment'])){

                $model->attributes = $_POST['Apartment'];
                $model->user_id = Yii::app()->user->id;
  
                if(param('useUseradsModeration', 1))
                    $model->active = Apartment::STATUS_MODERATION;
                else
                    $model->active = Apartment::STATUS_ACTIVE;

                $model->owner_active = Apartment::STATUS_ACTIVE;
                $model->scenario = 'savecat';

                $model->description->setAttributes($_POST['Description']);
                $model->description->lang = Yii::app()->language;
                if($model->validate() && $model->description->validate()) {   
                    if($model->save()){
                            $apartment_id = $model->id;
                            $model->description->apartment_id = $apartment_id;
                            $model->description->save();
                            $desc = $this->translateDescription($model->description, $apartment_id);
                            if($desc == true) {
                                $city_desc = CityDescription::model()->find('city_id=:city_id',array(':city_id' => $model->city_id)); 
                                $address = Description::model()->find('apartment_id=:apartment_id', array(':apartment_id' => $apartment_id));
                                $coords = Geocoding::getCoordsByAddress($address->address, $city_desc->name);
                                if(isset($coords['lat']) && isset($coords['lng'])){
                                    $model->lat = $coords['lat'];
                                    $model->lng = $coords['lng'];
                                    $model->save(false);
                                }
                                // Check exist conditions
                                if(isset($_POST['Services'])) {
                                    $model->services->attributes = $_POST['Services'];
                                    $model->services->time_race = $_POST['Services']['start'].'/'.$_POST['Services']['end'];
                                    $model->services->apartment_id = $apartment_id;
                                    $model->services->save();
                                }

                                Yii::app()->user->setFlash('success', ApartmentsModule::t('Your apartment added'));
                                Yii::app()->user->setState('updateApartmentId', $model->id);
                                $this->redirect(Yii::app()->createAbsoluteUrl('user/profile/editApartment', array('id' => $model->id)));
                            }
                    }
                } else {
                    Yii::app()->user->setFlash('warning', ApartmentsModule::t('Check all necessary files'));
                }
            }
                

            $this->render('profile/create_apartment',	array(
                'model'=>$model,
                'description' => array(),
                'categories' => Apartment::getReferences(NULL),
                'selected' => array()
            ));
	}
    
    public function actionSavecoords($id){
		if(param('useGoogleMap', 1) || param('useYandexMap', 1) || param('useOSMMap', 1)){
			$apartment = $this->loadModel($id);
			if(isset($_POST['lat']) && isset($_POST['lng'])){
				$apartment->lat = $_POST['lat'];
				$apartment->lng = $_POST['lng'];
				$apartment->save(false);
			}
			Yii::app()->end();
		}
	}

    public function actionToTop($id) {
        $apartment = Apartment::model()->findByPk($id);
        if($apartment != null) {
            if($this->isOwner($apartment->user_id)) {
                if((int)$apartment->date_top < strtotime('-24 hours', time())) {
                    Apartment::model()->updateByPk($id,array('date_top'=>time()));
                    Yii::app()->user->setFlash('success', UserModule::t('Success top'));
                } else {
                    Yii::app()->user->setFlash('warning', UserModule::t('Notice top'));
                }
            } else
                 Yii::app()->user->setFlash('notice', UserModule::t('Don\'t repeat this request again.'));
            $this->redirect(Yii::app()->request->urlReferrer);
        }
    }

    public function actionDiscounts() {

        $discounts = new ApartmentDiscount();
        $this->render('profile/discount_list',  array('model' => $discounts));
    }

    public function actionDiscountCreate() {
        $this->modelName = 'ApartmentDiscout';

        $discount = new ApartmentDiscount();
        if(isset($_POST['ApartmentDiscount'])){
            $discount->setAttributes($_POST['ApartmentDiscount']);
            if($discount->validate()) {   
                if($discount->save()){
                    Yii::app()->user->setFlash('success', UserModule::t('Discount added'));
                    $this->redirect(Yii::app()->createAbsoluteUrl('user/profile/discounts'));
                }
            } 
        }
        $this->render('profile/discount_form',  array('model' => $discount));
    }

    public function actionUpdateDiscount($id) {
        $discount = ApartmentDiscount::model()->with(array('apartment'))->findByPk($id);
        if($discount->apartment->user_id != Yii::app()->user->id)
            $this->redirect(Yii::app()->createAbsoluteUrl('user/profile/discounts'));
        if(isset($_POST['ApartmentDiscount'])){
            $discount->setAttributes($_POST['ApartmentDiscount']);
            if($discount->validate()) {
                if($discount->save()){
                    Yii::app()->user->setFlash('success', UserModule::t('Discount saved'));
                    $this->redirect(Yii::app()->createAbsoluteUrl('user/profile/discounts'));
                }
            }
        }
        $this->render('profile/discount_form',  array('model' => $discount));
    }
    
    public function actionGmap($id, $model = null){ 
		if($model === null)
			$model = $this->loadModelWith(array('description', 'city', 'images'));
		$result = CustomGMap::actionGmap($id, $model, $this->renderPartial('apartments.views.backend._marker', array('model' => $model), true));
		if($result){
            return $this->renderPartial('apartments.views.backend._gmap', $result, true);
		}
		return '';
	}

	public function actionYmap($id, $model = null){
		if($model === null)
			$model = $this->loadModelWith(array('description', 'city', 'images'));
		$result = CustomYMap::init()->actionYmap($id, $model, $this->renderPartial('apartments.views.backend._marker', array('model' => $model), true));
		if($result){
			return $this->renderPartial('apartments.views.backend._ymap', $result, true);
		}
		return '';
	}

}