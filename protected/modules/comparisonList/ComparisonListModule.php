<?php

class ComparisonListModule extends Module{
        public static function t($str='',$params=array(),$dic='comparison') {
            return Yii::t("ComparisonListModule.".$dic, $str, $params);
        }
}
