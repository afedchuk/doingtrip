<?php

class ModuleAdminController extends Controller {
	public $layout='//layouts/admin';
	public $params = array();
	public $photoUpload = false;
	public $scenario = null;
	public $reset = true;
	public $with = array();
	protected $_model = null;
	public $isAdmin = true;
	public $redirectTo = null;

	function init(){
		Yii::app()->bootstrap;
		Yii::app()->params['useBootstrap'] = true;

		parent::init();
		//$this->menuTitle = Yii::t('common', 'Operations');
	}

	public function getViewPath($checkTheme=false){
		if($checkTheme && ($theme=Yii::app()->getTheme())!==null){
			if (is_dir($theme->getViewPath().DIRECTORY_SEPARATOR.'modules'.DIRECTORY_SEPARATOR.$this->getModule($this->id)->getName().DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'backend'))
				return $theme->getViewPath().DIRECTORY_SEPARATOR.'modules'.DIRECTORY_SEPARATOR.$this->getModule($this->id)->getName().DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'backend';
		}
		return Yii::getPathOfAlias('application.modules.'.$this->getModule($this->id)->getName().'.views.backend');
	}


	public function beforeAction($action){
    
		if($action->controller && $action->controller->module && $action){ 
			$module = $action->controller->module->id;
			$controller = str_replace('/', '_', $action->controller->id);

			$act = $action->id;

			/*$helpName = "help_{$module}_{$controller}_{$act}";

			$sql = 'SELECT translation_'.Yii::app()->language.' as translate FROM {{translate_message}}
				WHERE category=:category AND status=:status AND message=:message';
			$result = Yii::app()->db->createCommand($sql)->queryScalar(array(
				':category' => 'module_'.$module,
				':status' => TranslateMessage::STATUS_NO_ERROR,
				':message' => $helpName,
			));
			if($result){
				Yii::app()->user->setFlash('help', $result);
			}*/
		}   
		return parent::beforeAction($action);
	}


	public function filters(){
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	public function accessRules(){
		return array(
			array(
				'allow',
				'expression' => 'Yii::app()->user->getState("isAdmin")',
			),
			array(
				'deny',
				'users'=>array('*'),
			),
		);
	}

	public function actionView($id){
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionCreate(){
		$model=new $this->modelName; 
		if($this->scenario){
			$model->scenario = $this->scenario;
		}
		$this->performAjaxValidation($model);

		if(isset($_POST[$this->modelName])){
			$model->attributes=$_POST[$this->modelName];
			if($model->save()){
				if (!empty($this->redirectTo))
					$this->redirect($this->redirectTo);
				else
					$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('create',array_merge(
				array('model'=>$model),
				$this->params
		));
	}

	public function actionUpdate($id){
		if($this->_model === null){
			$model = $this->loadModel($id);
		}
		else{
			$model = $this->_model;
		}

		$this->performAjaxValidation($model);

		if(isset($_POST[$this->modelName])){
			$model->attributes=$_POST[$this->modelName];
			if($model->validate()){
				if($model->save(false)){
					if (!empty($this->redirectTo))
						$this->redirect($this->redirectTo);
					else
						$this->redirect(array('view','id'=>$model->id));
				}
			}
		}

		$this->render('update',
			array_merge(
				array('model'=>$model),
				$this->params
			)
		);
	}

	public function actionDelete($id){

			// we only allow deletion via POST request
			$this->loadModel($id)->delete();
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		
	}

	public function actionIndex(){
		$dataProvider=new CActiveDataProvider($this->modelName);

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionAdmin(){ 
		$model = new $this->modelName('search');

		if($this->reset)
			$model->resetScope();
		
		if($this->scenario){
			$model->scenario = $this->scenario;
		}

		if($this->with){
			$model = $model->with($this->with);
		}

		$model->unsetAttributes();  // clear any default values
		if(isset($_GET[$this->modelName])){
			$model->attributes=$_GET[$this->modelName];
		}
		$this->render('admin',
					array_merge(array('model'=>$model), $this->params)
				);
	}

	public function loadModel($id = null){
		if(!$this->_model){
			$model = new $this->modelName;
		} else {
			$model = $this->_model;
		}
		if($id !== null){
			if($this->with){
				$model = $model->resetScope()->with($this->with)->findByPk($id);
			}
			else{
				$model = $model->resetScope()->findByPk($id);
			}
		}
		if($this->scenario){
			$model->scenario = $this->scenario;
		}

		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');

		$this->_model = $model;
		return $this->_model;
	}

	public function loadModelWith($with) {
		if(isset($_GET['id'])) {
			$model = new $this->modelName;
			if($this->scenario){
				$model->scenario = $this->scenario;
			}

			$model = $model->with($with)->findByPk($_GET['id']);
			if($model===null){
				throw new CHttpException(404,'The requested page does not exist.');
			}
			return $model;
		}
		return null;
	}

	protected function performAjaxValidation($model){
		if(isset($_POST['ajax']) && $_POST['ajax']===$this->modelName.'-form'){
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionMove(){
		if(isset($_GET['id']) && isset($_GET['direction'])){
			$direction = isset($_GET['direction']) ? $_GET['direction'] : '' ;

			$model = $this->loadModel($_GET['id']);
			$catId = Yii::app()->request->getQuery('catid', '');
			$regionId = Yii::app()->request->getQuery('regionid', '');
			$countryId = Yii::app()->request->getQuery('countryid', '');

			if($model && ($direction == 'up' || $direction == 'down' || $direction == 'fast_up' || $direction == 'fast_down') ){
				$addWhere = '';
				if (!empty($catId) && $catId > 0) {
				    $addWhere = ' AND reference_category_id = "'.$catId.'"';
				}
				if (!empty($regionId) && $regionId > 0) {
					$addWhere = ' AND region_id = "'.$regionId.'"';
				}
				if (!empty($countryId) && $countryId > 0) {
					$addWhere = ' AND country_id = "'.$countryId.'"';
				}

				$sorter = $model->sorter;

				if($direction == 'up' || $direction == 'fast_up'){
					if($sorter > 1){
						if($direction == 'up') {
							$sql = 'UPDATE '.$model->tableName().' SET sorter="'.$sorter.'" WHERE sorter < "'.($sorter).'" '.$addWhere.' ORDER BY sorter DESC LIMIT 1';
							Yii::app()->db->createCommand($sql)->execute();
							$model->sorter--;
						} else {
							$sql = 'UPDATE '.$model->tableName().' SET sorter=sorter+1 WHERE sorter < "'.($sorter).'" '.$addWhere;
							Yii::app()->db->createCommand($sql)->execute();
							$model->sorter=1;
						}

						$model->save(false);
					}
				}
				if($direction == 'down' || $direction == 'fast_down'){
					if (!empty($catId) && $catId > 0) {
					    $maxSorter = Yii::app()->db->createCommand()
							->select('MAX(sorter) as maxSorter')
							->from($model->tableName())
							->where('reference_category_id=:catid', array(':catid'=>$catId))
							->queryScalar();
					} elseif (!empty($regionId) && $regionId > 0) {
						$maxSorter = Yii::app()->db->createCommand()
							->select('MAX(sorter) as maxSorter')
							->from($model->tableName())
							->where('region_id=:regionid', array(':regionid'=>$regionId))
							->queryScalar();
					} elseif (!empty($countryId) && $countryId > 0) {
						$maxSorter = Yii::app()->db->createCommand()
							->select('MAX(sorter) as maxSorter')
							->from($model->tableName())
							->where('country_id=:countryid', array(':countryid'=>$countryId))
							->queryScalar();
					}
					else {
					    $maxSorter = Yii::app()->db->createCommand()
						->select('MAX(sorter) as maxSorter')
						->from($model->tableName())
						->queryScalar();

					}

					if($sorter < $maxSorter){
						if ($direction == 'down') {
							$sql = 'UPDATE '.$model->tableName().' SET sorter="'.$sorter.'" WHERE sorter > "'.($sorter).'" '.$addWhere.' ORDER BY sorter ASC LIMIT 1';
							Yii::app()->db->createCommand($sql)->execute();
							$model->sorter++;
						} else {
							$sql = 'UPDATE '.$model->tableName().' SET sorter=sorter-1 WHERE sorter > "'.($sorter).'" '.$addWhere;
							Yii::app()->db->createCommand($sql)->execute();
							$model->sorter=$maxSorter;
						}

						$model->save(false);
					}
				}
			}
		}
		if(!Yii::app()->request->isAjaxRequest){
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
	}

	public function getMaxSorter(){
		$model = new $this->modelName;
		$maxSorter = Yii::app()->db->createCommand()
			->select('MAX(sorter) as maxSorter')
			->from($model->tableName())
			->queryScalar();

		$this->params['maxSorter'] = $maxSorter;
		return $maxSorter;
	}

	public function getMinSorter(){
		$model = new $this->modelName;
		$minSorter = Yii::app()->db->createCommand()
			->select('MIN(sorter) as maxSorter')
			->from($model->tableName())
			->queryScalar();
		$this->params['minSorter'] = $minSorter;
		return $minSorter;
	}

	public function actionActivate(){
        $field = isset($_GET['field']) ? $_GET['field'] : 'active';

		$useModuleUserAds = false;
		if (param('useUserads', 1) && Yii::app()->request->getParam('id') && (Yii::app()->request->getParam('value') != null)) {
			$useModuleUserAds = true;
			$this->scenario = 'update_status';
			$action = Yii::app()->request->getParam('value', null);
			$id = Yii::app()->request->getParam('id', null);
			$availableStatuses = Apartment::getModerationStatusArray();

			if (!array_key_exists($action, $availableStatuses)) {
				$action = 0;
			}
		}
		else {
			$action = $_GET['action'];
			$id = $_GET['id'];
		}

		if(!(!$id && $action === null)){
			$model = $this->loadModel($id);

			if($this->scenario){
				$model->scenario = $this->scenario;
			}

			if($model){
				if ($useModuleUserAds) {
					$model->$field = $action;
				}
				else {
					$model->$field = ($action == 'activate' ? 1 : 0);
				}
                $className = get_class($model);
                if($model->$field == 1 && ($className == 'UserAds' || $className == 'Apartment')){
                    $_POST['set_period_activity'] = 1;
                }
				$model->save(false);
			}
		}

		if(!Yii::app()->request->isAjaxRequest){
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		elseif ($useModuleUserAds)  {
			echo CHtml::link($availableStatuses[$action]);
		}
	}

    public function actionItemsSelected(){
        $idsSelected = Yii::app()->request->getPost('itemsSelected');

        $work = Yii::app()->request->getPost('workWithItemsSelected');

        if($idsSelected && is_array($idsSelected) && $work){
            $idsSelected = array_map('intval', $idsSelected);

            foreach($idsSelected as $id){
                $model = $this->loadModel($id);
                $model->scenario = 'changeStatus';

                if($work == 'delete'){
                    $model->delete();
                }elseif($work == 'activate') {
                    $model->active = 1;
                    $model->update('active');
                }elseif($work == 'deactivate') {
                    $model->active = 0;
                    $model->update('active');
                }
            }
        }

        if(!Yii::app()->request->isAjaxRequest){
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
    }

    protected function rememberPage(){
        // persist page number
        $pageParam = $this->modelName . '_page';
        if (isset($_GET[$pageParam])) {
            $page = $_GET[$pageParam];
            Yii::app()->user->setState($this->id . '-page', (int) $page);
        } else {
            $page = Yii::app()->user->getState($this->id . '-page', 1);
            $_GET[$pageParam] = $page;
        }
    }
}