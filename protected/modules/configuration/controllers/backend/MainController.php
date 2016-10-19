<?php

class MainController extends ModuleAdminController {
	public $modelName = 'ConfigurationModel';
	public $defaultAction='admin';
	
	public function actionView($id){
		$this->redirect(array('admin'));
	}
}
