<?php

class ApartmentsModule extends Module{

        public static function t($str='',$params=array(),$dic='apartments') {
            return Yii::t("ApartmentsModule.".$dic, $str, $params);
        }
        
        public function settings($settings = array()) {
            
            if(!empty($settings)) {
                
                $cookie = array(); $tmp = array();
                if(isset(Yii::app()->request->cookies['userSettings']))
                    $cookie = CJSON::decode(Yii::app()->request->cookies['userSettings']->value);
                
                foreach($settings as $key=>$value) {
                    if(!is_array($value)) {
                        if(trim($value)) {
                            $tmp[$key] = $value;
                        } else {
                            if(isset($cookie[$key]))
                                unset($cookie[$key]);
                        }
                    } else {
                        foreach($value as $k=>$return) {
                            
                            if(trim($return))
                                $tmp[$key][$k] = $return;
                            else {
                                if(isset($cookie[$key][$k]))
                                    unset($cookie[$key][$k]);
                            }
                        }
                    }
                }

                $cookie = array_merge($cookie, $tmp);
                Yii::app()->request->cookies['userSettings'] = new CHttpCookie('userSettings', CJSON::encode($cookie));
            }
        }
        
	public function beforeControllerAction($controller, $action){
		if(parent::beforeControllerAction($controller, $action)){
			return true;
		} else {
			return false;
		}
	}
}
