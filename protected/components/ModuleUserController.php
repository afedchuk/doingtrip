<?php 
class ModuleUserController extends Controller{

	
	public $params = array();
	private $_model;
	public $modelName;
	public $bookings = null;
	
	public function getViewPath($checkTheme=false){
		return Yii::getPathOfAlias('application.modules.'.$this->getModule($this->id)->getName().'.views');
	}
        
        
	public function init() {
		$this->userBookings();
		parent::init();
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
				'actions' => array('captcha'),
				'users'=>array('*'),
			),
		);
	}

	public function actionView($id){
		if(Yii::app()->user->getState('isAdmin')){
			$this->redirect(array('backend/main/view', 'id' => $id));
		}
		$this->render('view',array(
			'model'=>$this->loadModel($id, 1),
		));
	}

	public function actionIndex(){     
		$dataProvider=new CActiveDataProvider($this->modelName);
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
                
	}

  	
     public function getViewFile($viewName){

            if(($theme=Yii::app()->getTheme())!==null && ($viewFile=$theme->getViewFile($this,$viewName))!==false)
                return $viewFile;
            $moduleViewPath=$basePath=Yii::app()->getViewPath();
            if(($module=$this->getModule())!==null)
                $moduleViewPath=$module->getViewPath();

            $theme = Yii::app()->theme;
            if($theme && $theme->name){
                $themePath = $theme->getViewPath().DIRECTORY_SEPARATOR.'modules'.DIRECTORY_SEPARATOR.$this->getModule($this->id)->getName();
                if(is_file($themePath.DIRECTORY_SEPARATOR.$viewName.'.php')){
                    $moduleViewPath = $themePath;
                }
            }

            return $this->resolveViewFile($viewName,$moduleViewPath,$basePath,$moduleViewPath);
        } 



	public function loadModel($id = null, $resetScope = 0) {
		if($this->_model===null) {
			if($id == null){
				if(isset($_GET['id'])) { 
					$model = new $this->modelName;                                        
					if($resetScope){
						$this->_model=$model->resetScope()->findByPk($_GET['id']);
					}else{  
						$this->_model=$model->find('id=:id', array(':id'=>$_GET['id']));
					} 
				}
			}
			else{
				$model = new $this->modelName;
				if($resetScope){
					$this->_model=$model->resetScope()->find('id=:id', array(':id'=>$id));
				}else{
					$this->_model=$model->find('id=:id', array(':id'=>$id));
				}
			}

			if($this->_model===null){
				throw new CHttpException(404,'The requested page does not exist.');
			}
		}
		return $this->_model;
	}

	public function loadModelWith($with) {
		if($this->_model===null) {
			if(isset($_GET['id'])) {
				$model = new $this->modelName;
				$this->_model = $model->with($with)->findByPk($_GET['id']); //findByPk($_GET['id']);
			}
			if($this->_model===null){
				throw new CHttpException(404,'The requested page does not exist.');
			}
		}
		return $this->_model;
	}


	protected function performAjaxValidation($model){
		if(isset($_POST['ajax']) && $_POST['ajax']===$this->modelName.'-form'){
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	protected static function isOwner($user_id){
		return Yii::app()->user->getState('isAdmin') || !Yii::app()->user->isGuest && Yii::app()->user->id == $user_id;
	}

	private function userBookings() {
        if (!Yii::app()->user->isGuest && Yii::app()->user->getState('type') == 1) {
            $bookings = Booking::model()->with('description')->findAll('sender_id=:sender_id AND date_start>=:date_start AND canceled=0', array(':sender_id' => Yii::app()->user->id, ':date_start' => date('Y-m-d')));
            if($bookings)
                $this->bookings = $bookings;
        }
    }
	
}
