<?php

class ContactformModule extends Module{
	public static function t($str='',$params=array(),$dic='contactform') {
            return Yii::t("ContactformModule.".$dic, $str, $params);
    }
}
