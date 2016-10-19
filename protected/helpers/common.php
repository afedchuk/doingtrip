<?php

function param($name, $default = null) {
	if (isset(Yii::app()->params[$name]))
        return Yii::app()->params[$name];
	elseif(!($config = ConfigurationModel::config($name))){
        return $config;
    }else
        return $default;
		
}
function isActive($string) {
	$menu_active = Yii::app()->user->getState('menu_active');
	if ($menu_active == $string) {
		return true;
	} elseif (!$menu_active) {
		if (isset(Yii::app()->controller->module->id) && Yii::app()->controller->module->id == $string) {
			return true;
		}
	}
	return false;
}
function tt($message, $module = null, $lang = NULL) {
    
	if ($module === null) {
		if (Yii::app()->controller->module) { 
			return Yii::t('module_' . Yii::app()->controller->module->id, $message, array(), NULL, $lang);
		}
        
		return Yii::t(TranslateMessage::DEFAULT_CATEGORY, $message, array(), NULL, $lang);
	}
	if ($module == TranslateMessage::DEFAULT_CATEGORY) {  
		return Yii::t(TranslateMessage::DEFAULT_CATEGORY, $message, array(), NULL, $lang);
	}

	return Yii::t('module_' . $module, $message, array(), NULL, $lang);
}


function tc($message) {
	return Yii::t(TranslateMessage::DEFAULT_CATEGORY, $message);
}

function isFree(){
	if(defined('IS_FREE') && IS_FREE){
		return true;
	} else {
		return false;
	}
}

function toBytes($str) {
	$val = trim($str);
	$last = strtolower($str[strlen($str) - 1]);
	switch ($last) {
		case 'g':
			$val *= 1024;
		case 'm':
			$val *= 1024;
		case 'k':
			$val *= 1024;
	}
	return $val;
}


function rrmdir($dir) {
	if (is_dir($dir)) {
		$objects = scandir($dir);
		if($objects){
			foreach ($objects as $object) {
				if ($object != "." && $object != "..") {
					if (filetype($dir . "/" . $object) == "dir")
						rrmdir($dir . "/" . $object);
					else
						unlink($dir . "/" . $object);
				}
			}
		}
		reset($objects);
		rmdir($dir);
	}
}

function issetModule($module) {
    if (is_array($module)) {
        foreach ($module as $module_name) {
            if (!isset(Yii::app()->modules[$module_name])) {
                return false;
            }
        }
        return true;
    }
    return isset(Yii::app()->modules[$module]);
}

function deb($mVal, $sName = '') {
	$aCol = array('#FFF082','#BAFF81','#BAFFD7','#F0D9D7');
	$color = $aCol[RAND(0,3)];
	echo "<div style='background-color: $color;'><PRE><b>$sName = </b>";
	if (is_array($mVal)) echo '<br>';
	print_r($mVal);
	echo "</PRE></div>";
}

function throw404(){
	throw new CHttpException(404,'The requested page does not exist.');
}

function bytesToSize($bytes, $precision = 2)
{  
    $kilobyte = 1024;
    $megabyte = $kilobyte * 1024;
    $gigabyte = $megabyte * 1024;
    $terabyte = $gigabyte * 1024;
   
    if (($bytes >= 0) && ($bytes < $kilobyte)) {
        return $bytes . ' B';
 
    } elseif (($bytes >= $kilobyte) && ($bytes < $megabyte)) {
        return round($bytes / $kilobyte, $precision) . ' KB';
 
    } elseif (($bytes >= $megabyte) && ($bytes < $gigabyte)) {
        return round($bytes / $megabyte, $precision) . ' MB';
 
    } elseif (($bytes >= $gigabyte) && ($bytes < $terabyte)) {
        return round($bytes / $gigabyte, $precision) . ' GB';
 
    } elseif ($bytes >= $terabyte) {
        return round($bytes / $terabyte, $precision) . ' TB';
    } else {
        return $bytes . ' B';
    }
}

function array_insert(&$array,$element,$position=null) {
  if (count($array) == 0) {
    $array[] = $element;
  }
  elseif (is_numeric($position) && $position < 0) {
    if((count($array)+position) < 0) {
      $array = array_insert($array,$element,0);
    }
    else {
      $array[count($array)+$position] = $element;
    }
  }
  elseif (is_numeric($position) && isset($array[$position])) {
    $part1 = array_slice($array,0,$position,true);
    $part2 = array_slice($array,$position,null,true);
    $array = array_merge($part1,array($position=>$element),$part2);
    foreach($array as $key=>$item) {
      if (is_null($item)) {
        unset($array[$key]);
      }
    }
  }
  elseif (is_null($position)) {
    $array[] = $element;
  }  
  elseif (!isset($array[$position])) {
    $array[$position] = $element;
  }
  $array = array_merge($array);
  return $array;
}