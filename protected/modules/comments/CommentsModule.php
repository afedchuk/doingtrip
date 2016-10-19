<?php

class CommentsModule extends Module{
    
    public static function t($str='',$params=array(),$dic='comments') {
            return Yii::t("CommentsModule.".$dic, $str, $params);
    }

}
