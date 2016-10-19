<?php

class NotifierModule extends Module{
	public static function t($str='',$params=array(),$dic='notifier') {
		return Yii::t("NotifierModule.".$dic, $str, $params);
	}
}