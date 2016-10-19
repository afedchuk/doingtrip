<?php


class MainController extends ModuleUserController{
    public $page;
    public $modelName = 'Contact';

	public function actions() {
		return array(
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
                'foreColor' => 0x555555,
                'height' => 40,
			),
		);
	}

	public function actionIndex(){
        Yii::app()->getModule('user');
		Yii::import('application.modules.contactform.models.ContactForm');
               
		$model = new ContactForm;
		if(isset($_POST['ContactForm'])){
			$model->attributes=$_POST['ContactForm'];
			$model->ip =$_SERVER['REMOTE_ADDR'];

            if(!Yii::app()->user->isGuest) {
            	$user = User::model()->findByPk(Yii::app()->user->id);
            	if($user) {
            		$model->name = $user->firstname;
            		$model->email = $user->email;
            		$model->phone = $user->phone;
            		$model->user_id = $user->id;
            	}
            }

			if($model->validate()) {
				if(!isset($_POST['ajax'])) {
					if($model->save(false)) {
		                Yii::app()->user->setFlash('success', ContactformModule::t('Message was sent'));
		                $this->redirect(Yii::app()->createAbsoluteUrl('/contactform/main/index'));
		            }
	            }               
			} 

			if(Yii::app()->request->isAjaxRequest) {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
		}

		$this->render('contactform', array('model' => $model));
	}
}