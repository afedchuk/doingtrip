<?php

class MainController extends ModuleAdminController{
	public $modelName = 'TranslateMessage';

	public function actionIndex(){
		$this->redirect(array('admin'));
	}

	public function actionView($id){
		$this->redirect(array('admin'));
	}

    public function actionAdmin(){

        $this->rememberPage();

        $model = new TranslateMessage('search');

        $model->setRememberScenario('translate_remember');

        $this->render('admin',array(
                'model'=>$model,
        ));
    }

}