<?php

class MainController extends ModuleAdminController{
	public $modelName = 'ReferenceCategories';

	public function actionView($id){
		$this->redirect(array('admin'));
	}
	public function actionIndex(){
		$this->redirect(array('admin'));
	}

	public function actionAdmin(){
		$this->getMaxSorter();
		parent::actionAdmin();
	}


}
