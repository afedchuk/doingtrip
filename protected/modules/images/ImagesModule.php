<?php

class ImagesModule extends Module {
    public static function t($str='',$params=array(),$dic='images') {
        return Yii::t("ImagesModule.".$dic, $str, $params);
    }
}
