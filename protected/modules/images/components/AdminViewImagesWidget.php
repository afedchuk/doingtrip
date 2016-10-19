<?php

/* draw gallery with control buttons, inputs for comments */
class AdminViewImagesWidget extends CWidget {

	public $objectId;
	public $images;
	public $withMain = true;

	public function getViewPath($checkTheme=false){
		return Yii::getPathOfAlias('application.modules.images.views');
	}

	public function run() {
		if(!$this->images){
			$sql = 'SELECT id, file_name, comment, id_object, file_name_modified, is_main FROM {{images}} WHERE id_object=:id ORDER BY sorter';
			$this->images = Images::model()->findAllBySql($sql, array(':id' => $this->objectId));
		}

		$this->render('widgetAdminViewImages', array(
			'images' => $this->images,
		));
	}
}