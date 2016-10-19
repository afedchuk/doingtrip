<?php

class MainController extends ModuleAdminController{
	public $modelName = 'Currency';

    public function actionAdmin(){
   		$this->getMaxSorter();
   		parent::actionAdmin();
   	}

    public function actionIndex(){
        $this->redirect('admin');
    }

    public function actionView($id){
        $this->redirect('admin');
    }

}
