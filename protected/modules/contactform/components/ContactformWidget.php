<?php


class ContactformWidget extends CWidget {
	public $page;
	
	public function getViewPath($checkTheme=false){
		return Yii::getPathOfAlias('application.modules.contactform.views');
	}

	public function run() {
		Yii::import('application.modules.contactform.models.ContactForm');
		$model = new ContactForm;
		$model->scenario = 'insert';
Yii::app()->user->setFlash('warning', 'fgh');
		if(isset($_POST['ContactForm'])){
			$model->attributes=$_POST['ContactForm'];

			if(!Yii::app()->user->isGuest){
				$model->email = Yii::app()->user->email;
				$model->username = Yii::app()->user->username;
			}

			if($model->validate()){
				$notifier = new Notifier;
				$notifier->raiseEvent('onNewContactform', $model);
				
				Yii::app()->user->setFlash('success', 'Спасибо за связь с нами! Мы ответим Вам как можно быстрее.');
				$model = new ContactForm; // clear fields
			} else {
				Yii::app()->user->setFlash('warning', 'Сообщение не было отправлено! Исправьте, пожалуйста, ошибки и повторите снова.');
			}
		}

		$this->render('widgetContactform', array('model' => $model));
	}
}