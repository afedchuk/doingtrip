<?php
class CStringHelper
{

    public static function getSnippet($string, $maxlen) {
    
        $len = (mb_strlen($string) > $maxlen)? mb_strripos(mb_substr($string, 0, $maxlen), ' '): $maxlen;

        $cutStr = mb_substr($string, 0, $len);
        
        return (mb_strlen($string) > $maxlen)?  $cutStr . '...' :  $cutStr ;

    }
    public static function randString( $length ) {
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";	

            $str = '';
            $size = strlen( $chars );
            for( $i = 0; $i < $length; $i++ ) {
                    $str .= $chars[ rand( 0, $size - 1 ) ];
            }

            return $str;
    }
}
