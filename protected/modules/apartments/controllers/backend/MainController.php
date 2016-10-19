<?php

class MainController extends ModuleAdminController {

	public $modelName = 'Apartment';

	public function actionView($id = 0) {
		//$this->layout='//layouts/inner';

		$this->render('view', array(
			'model' =>  $this->loadModelWith(array('windowTo', 'objType', 'city')),
			'statistics' => Apartment::getApartmentVisitCount($id),
		));
	}

    public function actionAdmin(){

        $countNewsProduct = NewsProduct::getCountNoShow();
        if($countNewsProduct > 0){
            Yii::app()->user->setFlash('info', Yii::t('common', 'There are new product news') . ': '
                . CHtml::link(Yii::t('common', '{n} news', $countNewsProduct), array('/news/backend/main/product')));
        }

		$this->rememberPage();


		$this->getMaxSorter();

		$model = new Apartment('search');
		$model = $model->with(array('user'));

    	$this->render('admin',array_merge(array('model'=>$model), $this->params));


    }

	public function actionUpdate($id){

        $this->_model = $this->loadModel($id);
		if(!$this->_model){
			throw404();
		}


		if(issetModule('bookingcalendar')) {
			$this->_model = $this->_model->with(array('bookingCalendar'));
		}
                
                if(isset($_GET['type'])){
                    $type = self::getReqType();

                    $this->_model->type = $type;
                }

		
		$originalActive = $this->_model->active;
		$this->_model->scenario = 'savecat';

		if(isset($_POST[$this->modelName])){
			$this->_model->attributes=$_POST[$this->modelName];

			if ($this->_model->type != Apartment::TYPE_BUY && $this->_model->type != Apartment::TYPE_RENTING) {
				if(($this->_model->address && $this->_model->city) && (param('useGoogleMap', 1) || param('useYandexMap', 1))){
					if (!$this->_model->lat && !$this->_model->lng) { # уже есть
						$city = null;
						if($this->_model->city_id){
							$city = ApartmentCity::model()->findByPk($this->_model->city_id);
							if($city){
								$city = $city->name;
							} else {
								$city = null;
							}
						}

						$coords = Geocoding::getCoordsByAddress($this->_model->address, $city);

						if(isset($coords['lat']) && isset($coords['lng'])){
							$this->_model->lat = $coords['lat'];
							$this->_model->lng = $coords['lng'];
						}
					}
				}
			}

			if($this->_model->validate()){
				$this->_model->active = Apartment::STATUS_ACTIVE;
				$this->_model->save(false);
				$this->redirect(array('view','id'=>$this->_model->id));
			}
			$this->_model->active = $originalActive;
		}

		if($this->_model->active == Apartment::STATUS_DRAFT){
			Yii::app()->user->setState('menu_active', 'apartments.create');
			$this->render('create', array(
				'model' => $this->_model,
			));
			return;
		}

		$this->render('update', array(
			'model' => $this->_model,
		));
	}

    private static function getReqType(){
        $type = Yii::app()->getRequest()->getQuery('type');
        $existType = array_keys(Apartment::getTypesArray());
        if(!in_array($type, $existType)){
            $type = Apartment::TYPE_DEFAULT;
        }
        return $type;
    }

	public function actionCreate(){
          
		$model = new $this->modelName;
                $model->scenario = 'admin';
		$model->active = Apartment::STATUS_DRAFT;
		$model->type = Apartment::TYPE_RENT;
		$model->save(false);

		$this->redirect(array('update', 'id' => $model->id));
	}

	public function getWindowTo(){
		$sql = 'SELECT id, title_'.Yii::app()->language.' as title FROM {{apartment_window_to}}';
		$results = Yii::app()->db->createCommand($sql)->queryAll();
		$return = array();
		$return[0] = '';
		if($results){
			foreach($results as $result){
				$return[$result['id']] = $result['title'];
			}
		}
		return $return;
	}

	public function actionSavecoords($id){
		if(param('useGoogleMap', 1) || param('useYandexMap', 1)){
			$apartment = $this->loadModel($id);
			if(isset($_POST['lat']) && isset($_POST['lng'])){
				$apartment->lat = $_POST['lat'];
				$apartment->lng = $_POST['lng'];
				$apartment->save(false);
			}
			Yii::app()->end();
		}
	}

	public function actionGmap($id, $model = null){
		if($model === null){
			$model = $this->loadModel($id);
		}
             
		$result = CustomGMap::actionGmap($id, $model, $this->renderPartial('_marker', array('model' => $model), true));

		if($result){
			return $this->renderPartial('_gmap', $result, true);
		}
		return '';
	}

	public function actionYmap($id, $model = null){

		if($model === null){
			$model = $this->loadModel($id);
		}

		$result = CustomYMap::init()->actionYmap($id, $model, $this->renderPartial('_marker', array('model' => $model), true));

		if($result){
			//return $this->renderPartial('backend/_ymap', $result, true);
		}
		return '';
	}
}