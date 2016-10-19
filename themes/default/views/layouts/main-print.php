<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <?php
    $cs = Yii::app()->clientScript;
    $baseUrl = Yii::app()->theme->getBaseUrl();
    ?>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="<?php echo Yii::app()->language; ?>" />
    <meta name="description" content="<?php echo CHtml::encode($this->pageDescription); ?>" />
    <meta name="keywords" content="<?php echo CHtml::encode($this->pageKeywords); ?>" />
    <link rel="icon" href="<?php echo Yii::app()->theme->getBaseUrl(); ?>/icons/favicon.ico" type="image/x-icon" />
    <?php
    $cs->registerCoreScript('jquery');
    $cs->registerCssFile($this->assetsBase  . '/css/print.css');
    ?>
</head>
<body>
<?php 
if(param('useYandexMap') == 1){
	Yii::app()->getClientScript()->registerScriptFile(
		'http://api-maps.yandex.ru/2.0/?load=package.standard,package.clusters&coordorder=longlat&lang='.CustomYMap::getLangForMap(),
		CClientScript::POS_END);
} else if (param('useGoogleMap') == 1){
	Yii::app()->getClientScript()->registerScriptFile('http://maps.googleapis.com/maps/api/js?key=AIzaSyB1Wwh21ce7jnB6yDbjVGN3LC5ns7OoOL4&amp;sensor=false', CClientScript::POS_HEAD);
}
?>
 <?php echo $content; ?>
</body>
</html>
