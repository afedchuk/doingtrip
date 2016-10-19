<?php
class MainController extends ModuleAdminController {
	public $modelName = 'User';

	public function actionIndex(){

		$model=$this->loadModel(Yii::app()->user->id);

		if(isset($_POST[$this->modelName])){
			$model->scenario = 'changeAdminPass';
			$model->old_password = $_POST[$this->modelName]['old_password'];
			if($model->validatePassword($model->old_password)){
				$model->attributes=$_POST[$this->modelName];
				if($model->validate()){
					$model->setPassword();
					$model->save(false);
					Yii::app()->user->setFlash('success', Yii::t('module_usercpanel', 'Your password successfully changed.'));
					$this->redirect(array('index'));
				}
			} else {
				Yii::app()->user->setFlash('error', Yii::t('module_adminpass', 'Wrong admin password! Try again.'));
				$this->redirect(array('index'));
			}
		}
		$this->render('index', array('model' => $model));
	}
}