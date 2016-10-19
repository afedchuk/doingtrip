<?php
class MainController extends ModuleUserController{
	public $modelName = 'UserAds';
	public $photoUpload = false;

    public function actions() { 
		return (isset($_POST['ajax']) && $_POST['ajax']==='registration-form')?array():array(
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
                'foreColor' => 0x555555,
                'height' => 40,
			),
		);

	}
    
    public function actionLogin()
	{

        $this->modelName = 'UserLogin';
		if (Yii::app()->user->isGuest) {
			$model=new UserLogin;
            if (Yii::app()->request->getQuery('soc_error_save'))
                Yii::app()->user->setFlash('error', tt('Error saving data. Please try again later.', 'socialauth'));
            if (Yii::app()->request->getQuery('deactivate'))
                showMessage(tc('Login'), tt('Your account not active. Administrator deactivate your account.', 'socialauth'), null, true);

            $service = Yii::app()->request->getQuery('service');
            if (isset($service)) {        
                $authIdentity = Yii::app()->eauth->getIdentity($service);
                $authIdentity->redirectUrl = Yii::app()->user->returnUrl;
                $authIdentity->cancelUrl = $this->createAbsoluteUrl('user/login');

                if ($authIdentity->authenticate()) {
                    $identity = new EAuthUserIdentity($authIdentity);

                    if ($identity->authenticate()) {
                        $uid = $identity->id;
                        $existId = User::getIdByUid($uid, $service);
                        if (!$existId) {
                            if(isset($identity->name))
                                $username = explode(" ", $identity->name);

                            $user = User::createUser(array('email' => !isset($identity->email) ? User::getRandomEmail() : $identity->email,
                                                           'firstname' => $username[0], 'lastname' => $username[1], 'type' => 1), true);
                      

                            if (!$user && isset($user['id'])) {
                                $authIdentity->redirect(Yii::app()->createAbsoluteUrl('/user/login') . '?soc_error_save=1');
                            }

                            $success = User::setSocialUid($user['id'], $uid, $service);

                            if (!$success) {
                                User::model()->findByPk($user['id'])->delete();
                                $authIdentity->redirect(Yii::app()->createAbsoluteUrl('/user/login') . '?soc_error_save=1');
                            }

                            $existId = User::getIdByUid($uid, $service);
                        }
                        if ($existId) {
							$result = $model->loginSocial($existId);
							User::updateUserSession();
							
							Yii::app()->user->setFlash('success',UserModule::t('Thank you for your registration.' ));
							if ($result) {
								if ($result === 'deactivate') {
									$authIdentity->redirect(Yii::app()->createAbsoluteUrl('/user/login'));
								}

								$authIdentity->redirect(Yii::app()->createAbsoluteUrl('/user/profile'));
							}
						}
                        
                        $authIdentity->redirect();
                    }
                    else {
                        $authIdentity->cancel();
                    }
                }
                $this->redirect(array('/user/login'));
            }
			// collect user input data
			if (isset($_POST['UserLogin'])) {
                $_POST['UserLogin']['password'] = $this->decrypt($_POST['UserLogin']['password']);
                $model->attributes = $_POST['UserLogin']; 
                if ($model->validate() && $model->login()) {
                	
                    User::updateUserSession();
                    $user = User::model()->findByPk(Yii::app()->user->id);
                    Yii::app()->language = $user->default_lang;
                    Yii::app()->session['currency'] = $user->default_currency; 
                    
                    $user->lastvisit = time();
                    $user->save(false);

                    if (Yii::app()->user->getState('isAdmin')) {
                        $this->redirect(array('/user/profile'));
                        Yii::app()->end();
                    }

                    if (Yii::app()->user->isGuest) {
                        $this->redirect(Yii::app()->user->returnUrl);
                    } else {
                        if (!Yii::app()->user->getState('returnedUrl')) {
                            $this->redirect(array('/user/profile'));
                        } else {
                            $this->redirect(Yii::app()->user->getState('returnedUrl'));
                        }
                    }
                }
            }
			$this->render('/user/login',array('model'=>$model));
		} else
			$this->redirect(Yii::app()->controller->module->returnUrl);
	}
	
    
    public function actionLogout()
	{
		if (!Yii::app()->user->isGuest) 
			Yii::app()->user->logout();
		$this->redirect(Yii::app()->request->urlReferrer);
	}
       
	public function actionIndex(){
		$model = new $this->modelName;
		
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET[$this->modelName])){
			$model->attributes = $_GET[$this->modelName];
		}

		$this->render('index',array(
			'model'=>$model,
		));
	}
    
    public function actionRegistration() {
    		$this->modelName = 'RegistrationForm';
            $model = new RegistrationForm;
            if (Yii::app()->user->id) {
                $this->redirect(Yii::app()->controller->module->profileUrl);
            } else {
                if(isset($_POST['RegistrationForm'])) {
                	$_POST['RegistrationForm']['password'] = $this->decrypt($_POST['RegistrationForm']['password']);
                	$_POST['RegistrationForm']['verifyPassword'] = $this->decrypt($_POST['RegistrationForm']['verifyPassword']);
                    $model->attributes=$_POST['RegistrationForm'];
                    if($model->validate()){
                            $soucePassword = $model->password;
                            $model->unique_id = rand(100000, 999999);
                            $model->activkey=UserModule::encrypting(microtime().$model->password);
                            $model->username = setTranslite(substr($model->firstname, 0, 1).strtolower($model->lastname));
                            $model->password=UserModule::encrypting($model->password);
                            $model->verifyPassword=UserModule::encrypting($model->verifyPassword);
                            $model->createtime=time();
                            $model->subscription=$_POST['RegistrationForm']['subscription'];
                            $model->lastvisit=((Yii::app()->getModule('user')->loginNotActiv||(Yii::app()->getModule('user')->activeAfterRegister&&Yii::app()->getModule('user')->sendActivationMail==false))&&Yii::app()->getModule('user')->autoLogin)?time():0;
                            $model->superuser=0;
                            $model->status=((Yii::app()->getModule('user')->activeAfterRegister)?User::STATUS_ACTIVE:User::STATUS_NOACTIVE);

                            if(!Yii::app()->request->isAjaxRequest)  {
                                if ($model->save(false)) {
                                        if (Yii::app()->getModule('user')->sendActivationMail) { 
                                                $activation_url = Yii::app()->createAbsoluteUrl('/user/activation/activation',array("activkey" => $model->activkey));
                                                $notifier = new Notifier();
				                                $notifier->raiseEvent('onNewUserActivate', $model, array(
				                                    'forceEmail' => $model->email,
				                                    'usrPassword' => $soucePassword,
				                                    'activateUrl' => $activation_url,
				                                )); 
                                        }
                                        
                                        Yii::app()->user->setFlash('success',UserModule::t("Thank you for your registration. Please check your email."). UserModule::t('Please check your email. An instructions was sent to your email address.'));
                                        if (Yii::app()->getModule('user')->activeAfterRegister && Yii::app()->getModule('user')->autoLogin) {
                                                $identity=new UserIdentity($model->username,$soucePassword);
                                                $identity->authenticate();
                                                Yii::app()->user->login($identity,0);
                                                $this->redirect(Yii::app()->controller->module->profileUrl);
                                        } else
                                        	$this->redirect(Yii::app()->controller->module->loginUrl);
                                        
                                }
                            }
                    }  else {
                        if(Yii::app()->request->isAjaxRequest) {
                            echo CActiveForm::validate($model);
                            Yii::app()->end();
                        }

                    }
                }
            }
  
            $this->render('/user/registration', array('model'=>$model));
	}

	public function actionActivate(){
		if(isset($_GET['id']) && isset($_GET['action'])){
			$action = Yii::app()->request->getQuery('action');;
			$model = $this->loadModelUserAd($_GET['id']);
            $model->scenario = 'update_status';

			if($model){
				$model->owner_active = ($action == 'activate'?1:0);
				$model->update(array('owner_active'));
			}
		}
		if(!Yii::app()->request->isAjaxRequest){
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		}
	}
    
    /**
	 * Recovery password
	 */
	public function actionRecovery () {
        
        $this->modelName = 'UserRecoveryForm';
		$form = new UserRecoveryForm;
		if (Yii::app()->user->id) {
		    	$this->redirect(Yii::app()->controller->module->returnUrl);
		    } else {
                if(isset($_POST['UserRecoveryForm'])) {
                    $form->attributes=$_POST['UserRecoveryForm'];
                    if($form->validate()) {
                        $user = User::model()->notsafe()->findbyPk($form->user_id);
                        if(isset($user) && $user->status == 1) {
                            $password = randString(6);
                            $user->password = Yii::app()->getModule('user')->encrypting($password);
                            if(!Yii::app()->request->isAjaxRequest)  {
                                if($user->save(false)){
                                	$notifier = new Notifier();
	                                $notifier->raiseEvent('onRecoveryPassword', $user, array(
	                                    'forceEmail' => $user->email,
	                                    'temprecoverpassword' => $password,
	                                ));
                                }
                                Yii::app()->user->setFlash('success',UserModule::t("Please check your email. An instructions was sent to your email address."));
                                $this->refresh();
                            }
                        } elseif($user->status == 0) {
                            Yii::app()->user->setFlash('warning',UserModule::t('Activate your profile before password reset'));
                        } else {
                        	Yii::app()->user->setFlash('warning',UserModule::t("Email is incorrect."));
                        }
                    } else {
                        if(Yii::app()->request->isAjaxRequest) {
                            echo CActiveForm::validate($form);
                            Yii::app()->end();
                        }
                    }
                }
                $this->render('recovery/recovery',array('model'=>$form));

		    }
	}


	public function actionCreate(){
		$this->modelName = 'Apartment';
		$model = new $this->modelName;


		if(isset($_POST[$this->modelName])){

			$model->attributes=$_POST[$this->modelName];

			if(param('useUseradsModeration', 1)){
				$model->active = Apartment::STATUS_MODERATION;
			} else {
				$model->active = Apartment::STATUS_ACTIVE;
			}
			$model->owner_active = Apartment::STATUS_ACTIVE;
			$coords = array();
			if(($model->address_ru && $model->city) && (param('useGoogleMap', 1) || param('useYandexMap', 1))){
				$city = null;
				if($model->city_id){
					$city = ApartmentCity::model()->findByPk($model->city_id);
					if($city){
						$city = $city->name;
					} else {
						$city = null;
					}
				}
				$coords = Geocoding::getCoordsByAddress($model->address_ru, $city);
				if(isset($coords['lat']) && isset($coords['lng'])){
					$model->lat = $coords['lat'];
					$model->lng = $coords['lng'];
				}
			}
			$model->scenario = 'savecat';
			$model->owner_active = Apartment::STATUS_ACTIVE;
			if($model->save()){
				Yii::app()->user->setState('updateApartmentId', $model->id);
				$this->redirect(array('update', 'id'=>$model->id, 'show' => 'photo-gallery'));
			}
		}
                
                //$model->type = $type;

		$this->render('create',	array(
			'model'=>$model,
			//'categories' => Apartment::getCategories(NULL, $type),
		));
	}

	public function loadModelUserAd($id) {
		$model = $this->loadModel($id);
		if($model->owner_id != Yii::app()->user->id){
			throw404();
		}
		return $model;
	}

	public function actionUpdate($id){
		$model = $this->loadModelUserAd($id);

		$this->performAjaxValidation($model);

		$show = false;
		if(isset($_GET['show']) && $_GET['show']){
			$show = $_GET['show'];
		}

        if(isset($_GET['type'])){
			$type = self::getReqType();
            $model->type = $type;
        }

		if(isset($_POST[$this->modelName])){
			$model->attributes=$_POST[$this->modelName];

			if(param('useUseradsModeration', 1)){
				$model->active = Apartment::STATUS_MODERATION;
			} else {
				$model->active = Apartment::STATUS_ACTIVE;
			}

			if($model->save()){
				if(!(isset($_FILES['uploader']['name'][0]) && $_FILES['uploader']['name'][0])){
					$this->redirect(array('/apartments/main/view','id'=>$model->id));				
				}
				else{
					$this->photoUpload = true;
				}
			}
		}

		$this->render('update',
			array(
				'model'=>$model,
				'categories' => Apartment::getCategories($id, $model->type),
				'show' => $show,
			)
		);
	}


	public function actionDelete($id){
		if(Yii::app()->request->isPostRequest){
			// we only allow deletion via POST request
			$this->loadModelUserAd($id)->delete();
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	
	public function actionGmap($id){
		$model = $this->loadModelUserAd($id);

		$result = MyGMap::actionGmap($id, $model, $this->renderPartial('//../modules/apartments/views/backend/_marker', array('model' => $model), true));
		if($result){
			return $this->renderPartial('//../modules/apartments/views/backend/_gmap', $result, true);
		}
	}

	public function actionYmap($id){
		$model = $this->loadModelUserAd($id);
		
		$result = MyYMap::init()->actionYmap($id, $model, $this->renderPartial('//../modules/apartments/views/backend/_marker', array('model' => $model), true));
		if($result){
			return $this->renderPartial('//../modules/apartments/views/backend/_ymap', $result, true);
		}
	}

	public function actionSavecoords($id){
		if(param('useGoogleMap', 1) || param('useYandexMap', 1)){
			$apartment = $this->loadModelUserAd($id);
			if(isset($_POST['lat']) && isset($_POST['lng'])){
				$apartment->lat = $_POST['lat'];
				$apartment->lng = $_POST['lng'];
				$apartment->save();
			}
			Yii::app()->end();
		}
	}

	public function actionView($id){
		$this->redirect(array('/apartments/main/view', 'id' => $id));
	}
}
