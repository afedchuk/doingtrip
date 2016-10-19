<?php

function truncateText($text, $numOfWords = 10, $add = ''){
	if($numOfWords){
		$text = strip_tags($text, '<br/>');
		$text = str_replace(array("\r", "\n"), '', $text);

		$lenBefore = strlen($text);
		if($numOfWords){
			if(preg_match("/(\S+\s*){0,$numOfWords}/", $text, $match))
				$text = trim($match[0]);
			if(strlen($text) != $lenBefore){
				$text .= '.. '.$add;
			}
		}
	}

	return $text;
}

function utf8_substr($str, $from, $len) {
	return preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$from.'}'.
	'((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$len.'}).*#s',
	'$1',$str);
}

function utf8_strlen($s) {
	return preg_match_all('/./u', $s, $tmp);
}

function getSnippet($string, $maxlen) {
    
        $len = (mb_strlen($string) > $maxlen)? mb_strripos(mb_substr($string, 0, $maxlen), ' '): $maxlen;

        $cutStr = mb_substr($string, 0, $len);
        
        return (mb_strlen($string) > $maxlen)?  $cutStr . '...' :  $cutStr ;

}
    
function setTranslite($string, $revert = true) {
 
        static $lang2tr = array(

                'й'=>'j','ц'=>'c','у'=>'u','к'=>'k','е'=>'e', 'є' =>'e', 'н'=>'n','г'=>'g','ш'=>'sh',
                'щ'=>'sh','з'=>'z','х'=>'h','ъ'=>'','ф'=>'f','ы'=>'y','в'=>'v','а'=>'a',
                'п'=>'p','р'=>'r','о'=>'o','л'=>'l','д'=>'d','ж'=>'zh','э'=>'e','я'=>'ja',
                'ч'=>'ch','с'=>'s','м'=>'m','и'=>'i','т'=>'t','ь'=>'','б'=>'b','ю'=>'ju','ё'=>'e','и'=>'i',

                'Й'=>'J','Ц'=>'C','У'=>'U','К'=>'K','Е'=>'E', 'Є' =>'e','Н'=>'N','Г'=>'G','Ш'=>'SH',
                'Щ'=>'SH','З'=>'Z','Х'=>'H','Ъ'=>'','Ф'=>'F','Ы'=>'Y','В'=>'V','А'=>'A',
                'П'=>'P','Р'=>'R','О'=>'O','Л'=>'L','Д'=>'D','Ж'=>'ZH','Э'=>'E','Я'=>'JA',
                'Ч'=>'CH','С'=>'S','М'=>'M','И'=>'I','Т'=>'T','Ь'=>'','Б'=>'B','Ю'=>'JU','Ё'=>'E','И'=>'I',

                'á'=>'a', 'ä'=>'a', 'ć'=>'c', 'č'=>'c', 'ď'=>'d', 'é'=>'e', 'ě'=>'e',
                'ë'=>'e', 'í'=>'i', 'ň'=>'n', 'ń'=>'n', 'ó'=>'o', 'ö'=>'o', 'ŕ'=>'r',
                'ř'=>'r', 'š'=>'s', 'Š'=>'S', 'ť'=>'t', 'ú'=>'u', 'ů'=>'u', 'ü'=>'u',
                'ý'=>'y', 'ź'=>'z', 'ž'=>'z',

                'і'=>'i', 'ї' => 'i', 'b' => 'b', 'І' => 'i',

                ' '=>'-', '\''=>'', '"'=>'', '\t'=>'', '«'=>'', '»'=>'', '?'=>'', '!'=>'', '*'=>''
        );
    
        $url = preg_replace( '/[\-]+/', '-',  !$revert ? strtolower(str_replace (' ','-',$string)) : preg_replace( '/[^\w\-\*]/', '', strtolower( strtr( $string, $lang2tr ) ) ) );

        return  $url;
}

function alphabet() {
    
    $arr = array('uk' => array('А','Б','В','Г','Д','Е','Є','Ж','З','И','І','Ї','Й','К','Л','М','Н','О','П','Р','С','Т','У','Х','Ф','Ц','Ч','Ш','Щ','Ю','Я',),
                 'ru' => range(chr(0xC0), chr(0xDF)),
                 'en' => range('A','Z'));
    
    $abc = array(); 
    foreach ($arr[Yii::app()->language] as $b) {
        if(Yii::app()->language == 'ru')
            $abc[] = iconv('CP1251', 'UTF-8', $b);
        else
            $abc[] = $b;
    }
   
    return $abc;
}

function dateRange( $first, $last, $step = '+1 day', $format = 'Y/m/d' ) {

	$dates = array();
	$current = strtotime( $first );
	$last = strtotime( $last );

	while( $current <= $last ) {

		$dates[] = date( $format, $current );
		$current = strtotime( $step, $current );
	}

	return $dates;
}

function hoursRange( $lower = 0, $upper = 86400, $step = 3600, $format = '' ) {
    $times = array();

    if ( empty( $format ) ) {
        $format = 'H:i';
    }

    foreach ( range( $lower, $upper, $step ) as $increment ) {
        $increment = gmdate( 'H:i', $increment );

        list( $hour, $minutes ) = explode( ':', $increment );

        $date = new DateTime( $hour . ':' . $minutes );

        $times[(string) $increment] = $date->format( $format );
    }
    return $times;
}

function numberReplacing($number, $messages = array()) {
    $length = strlen($number);
    if($number[$length-1] == 1) {
        return $messages[0];
    } elseif(in_array($number[$length-1], range(2, 4))) {
        return $messages[1];
    } else
        return $messages[2];
}

function addhttp($url) {
    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
        $url = "http://" . $url;
    }
    return $url;
}

function randString( $length ) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";  

        $str = '';
        $size = strlen( $chars );
        for( $i = 0; $i < $length; $i++ ) {
                $str .= $chars[ rand( 0, $size - 1 ) ];
        }

        return $str;
}
