<?php

class MainController extends ModuleAdminController {
	public $modelName = 'ImageSettings';

	public function actionIndex(){
		$model = new $this->modelName;

		if(isset($_POST[$this->modelName])){
			$model->attributes = $_POST[$this->modelName];

			if($model->validate()){
				
				$model->save();

				Yii::app()->configuration->init();

				Yii::app()->user->setFlash('success', 'Сохранено!');
			}
		}

		$this->render('index', array('model' => $model));
	}

	public function actionConvert(){
		@set_time_limit(0);
		@ini_set('max_execution_time', 0);

		$sql = 'SELECT id, owner_id FROM {{apartment}} WHERE 1';
		$res = Yii::app()->db->createCommand($sql)->queryAll();
		$ids = CHtml::listData($res, 'id', 'owner_id');

		$sql = 'SELECT pid, imgsOrder FROM {{galleries}} WHERE 1';
		$res = Yii::app()->db->createCommand($sql)->queryAll();

		if($res){
			foreach($res as $item){
				$images = unserialize($item['imgsOrder']);
				if(!isset($ids[$item['pid']])){
					continue;
				}
				if($images){
					$cnt = 0;
					foreach($images as $image => $name){
						$filePath = Yii::getPathOfAlias('webroot.uploads.apartments.'.$item['pid'].'.pictures').'/'.$image;
						Images::addImage($filePath, $item['pid'], ($cnt == 0), $ids[$item['pid']]);
						$cnt++;
					}
				}
			}
		}
	}

}