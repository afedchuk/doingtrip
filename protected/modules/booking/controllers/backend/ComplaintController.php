<?php

class ComplaintController extends ModuleAdminController{
	public $modelName = 'Complaint';

	public function actionAdmin() {
		$sql = 'UPDATE {{complaint}} SET status = 1';
		Yii::app()->db->createCommand($sql)->execute();

		parent::actionAdmin();
	}
}
