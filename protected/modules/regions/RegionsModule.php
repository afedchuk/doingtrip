<?php

class RegionsModule extends Module{
     
	public function beforeControllerAction($controller, $action){
		if(parent::beforeControllerAction($controller, $action)){
			return true;
		} else {
			return false;
		}
	}
        
    public static function t($str='',$params=array(),$dic='regions') {
		return Yii::t("RegionsModule.".$dic, $str, $params);
	}
}
