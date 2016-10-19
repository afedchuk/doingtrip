<?php 
/*echo 'Website is coming soon ';
die;*/
$yii = dirname(__FILE__).'/framework/yiilite.php';
$config = dirname(__FILE__).'/protected/config/main.php';
 

defined('YII_DEBUG') or define('YII_DEBUG', false);
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 0);
 
require_once($yii);
Yii::createWebApplication($config)->run();
