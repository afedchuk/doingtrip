<?php


class ConfigurationModule extends Module{
	public static function t($str='',$params=array(),$dic='configuration') {
		return Yii::t("ConfigurationModule.".$dic, $str, $params);
	}
}
