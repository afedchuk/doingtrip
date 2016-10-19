<?php

class DefaultController extends ModuleUserController
{
	public function actionIndex()
	{

		$this->redirect(array('currency/'));
		//$this->render('index');
	}

    public function actionAjaxupdate($act)
    {
        $autoIdAll = $_POST['id'];
            if(count($autoIdAll)>0){
                foreach($autoIdAll as $autoId){
                    $model=$this->loadModel($autoId);
                    if($act=='doActive')
                        $model->status = '1';
                    if($act=='doInactive')
                        $model->status = '0';
                    if($model->save())
                        echo 'ok';
                    else
                        throw new Exception("Sorry",500);
                }
            }
    }

    public function actionSetCurrency($currency=''){
        Yii::app()->getModule('currencymanager')->setdefaultcurrency($currency);
        return true;
    }

    public function loadModel($id)
    {
        $model=Currency::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }
}