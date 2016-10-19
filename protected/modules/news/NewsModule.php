<?php


class NewsModule extends Module {
    
    public static function t($str='',$params=array(),$dic='news') {
            return Yii::t("NewsModule.".$dic, $str, $params);
    }
}
