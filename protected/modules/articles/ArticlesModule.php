<?php

class ArticlesModule extends Module{
	public static function t($str='',$params=array(),$dic='articles') {
		return Yii::t("ArticlesModule.".$dic, $str, $params);
	}
}
