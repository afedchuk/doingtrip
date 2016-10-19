<?php

class MainController extends ModuleAdminController{
	public $modelName = 'User';
	public $scenario = 'backend';

	public function actionCreate(){
		$model=new $this->modelName;
		if($this->scenario){
			$model->scenario = $this->scenario;
		}

		if(isset($_POST[$this->modelName])){
			$model->attributes=$_POST[$this->modelName];
			if($model->validate()){
				$model->setPassword();
				$model->save(false);
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('create',array_merge(
				array('model'=>$model),
				$this->params
		));
	}

	public function actionUpdate($id){
		$model = $this->loadModel($id);
		$model->scenario = 'update';

		$this->performAjaxValidation($model);

		if(isset($_POST[$this->modelName])){
			$model->attributes=$_POST[$this->modelName];

			if (isset($_POST[$this->modelName]['password']) && $_POST[$this->modelName]['password'])
				$model->scenario = 'changePass';
			else
				unset($model->password, $model->salt);

			if($model->validate()) {
				if ($model->scenario == 'changePass')
					$model->setPassword();

				if($model->save(false)){
					$this->redirect(Yii::app()->createAbsoluteUrl('/user/backend/main/admin'));
				}
			}
		}
		$this->render('update', array('model'=>$model));
	}


	public function actionView($id){
		if ($id == 1) {
			$this->redirect(array('admin'));
		}

		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionActivate(){
		$field = isset($_GET['field']) ? $_GET['field'] : 'active';

		$action = $_GET['action'];
		$id = $_GET['id'];

		if(!(!$id && $action === null)){
			$model = $this->loadModel($id);

			if($this->scenario){
				$model->scenario = $this->scenario;
			}

			if($model) {
				$model->$field = ($action == 'activate'?1:0);
				$model->update(array($field));

				User::destroyUserSession($model->id);
			}
		}

		if(!Yii::app()->request->isAjaxRequest){
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
	}
}