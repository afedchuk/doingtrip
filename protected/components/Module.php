<?php


class Module extends CWebModule {

	public $defaultController = 'main';

	public function init() {
		// this method is called when the module is being created
		// you may place code here to customize the module or the application
		// import the module-level models and components
		$this->setImport(array(
			'application.modules.'.$this->getName() . '.models.*',
			'application.modules.'.$this->getName() . '.components.*',
		));

		$this->setViewPath(Yii::app()->getBasePath() . '/modules/' . $this->getName(). '/views');
	}

	public static function t($str='',$params=array(),$dic=null) {
		if(Yii::app()->controller->module){
			if($dic === null){
				return Yii::t('module_'.Yii::app()->controller->module->id, $str, $params);
			}
			else{
				return Yii::t('module_'.Yii::app()->controller->module->id.'_'.$dic, $str, $params);
			}
		}
	}
}
