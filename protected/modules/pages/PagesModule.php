<?php

class PagesModule extends Module{
	public static function t($str='',$params=array(),$dic='pages') {
		return Yii::t("PagesModule.".$dic, $str, $params);
	}
}
