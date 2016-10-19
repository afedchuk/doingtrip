<?php

class MainController extends ModuleAdminController{
	public $modelName = 'Lang';
    public $defaultAction='admin';

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

	public function actionSetDefault(){
        $id = (int) Yii::app()->request->getPost('id');
        $model = Lang::model()->findByPk($id);
        $model->setDefault($admin_mail);

        Yii::app()->end();
    }

	public function actionActivate(){
        $id = (int) $_GET['id'];
        $action = $_GET['action'];
        if($id){
            $model = Lang::model()->findByPk($id);
            if(($model->default == 1) && $action != 'activate'){
                Yii::app()->end();
            }
        }
        parent::actionActivate();
    }

}
