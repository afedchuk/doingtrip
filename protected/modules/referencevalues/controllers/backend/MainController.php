<?php


class MainController extends ModuleAdminController{
	
	public $modelName = 'ReferenceValues';
	public $maxSorters = array();

	public function actionView($id){
		$this->redirect(array('admin'));
	}
	public function actionIndex(){
		$this->redirect(array('admin'));
	}

	public function actionAdmin(){
		$references = ReferenceValues::model()->with(array('description','category'))->findAll();
		foreach($references as $sorter){
			$this->maxSorters[$sorter['id']] = $sorter['sorter'];
		}
		parent::actionAdmin();
	}

	public function getCategories($withoutEmpty = 0){
		$sql = 'SELECT id as cat_id, title  FROM {{apartment_reference_categories}} WHERE lang="'.Yii::app()->language.'" ORDER BY sorter ASC';
		$categories = Yii::app()->db->createCommand($sql)->queryAll();

		if(!$withoutEmpty)
			$return[0] = '';
		foreach($categories as $category){
			$return[$category['cat_id']] = $category['title'];
		}
		return $return;
	}
}
