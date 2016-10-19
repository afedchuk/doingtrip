<?php

class MainController extends ModuleUserController {

	protected function beforeAction($action) {
        if(Yii::app()->request->isAjaxRequest){
            Yii::app()->clientScript->scriptMap['bootstrap.css'] = false;
            Yii::app()->clientScript->scriptMap['bootstrap.min.css'] = false;
            Yii::app()->clientScript->scriptMap['bootstrap.min.js'] = false;
            Yii::app()->clientscript->scriptMap['jquery.js'] = false;
            Yii::app()->clientscript->scriptMap['jquery.min.js'] = false;
        }
        return parent::beforeAction($action);
    }

	public function actionVk(){
		  $this->renderPartial('vk', array(), false, true);
	}

	public function actionVk(){
		  $this->renderPartial('facebook', array(), false, true);
	}

}