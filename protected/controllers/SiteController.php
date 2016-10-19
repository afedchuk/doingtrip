<?php


class SiteController extends ModuleUserController {

	public function actionError() {

		if ($error = Yii::app()->errorHandler->error) {
			if (Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else {
				$this->render('error', array('error' => $error));
			}

		}
	}
	
}