<!DOCTYPE html>
<?php
$cs = Yii::app()->clientScript;
$baseUrl = Yii::app()->baseUrl;
$baseThemeUrl = Yii::app()->theme->baseUrl;
?>
<head>
	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
	<meta name="apple-mobile-web-app-capable" content="yes"/>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="description" content="<?php echo CHtml::encode($this->pageDescription); ?>" />
    <meta name="keywords" content="<?php echo CHtml::encode($this->pageKeywords); ?>" />
    <meta name="language" content="<?php echo Yii::app()->language; ?>" />
	<link rel="icon" href="<?php echo $this->assetsBase ; ?>/icons/favicon.ico" type="image/x-icon" />
	<meta name="apple-mobile-web-app-capable" content="yes"/>
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo $this->assetsBase; ?>/images/splash/splash-icon.png"> 
	<link rel="apple-touch-startup-image" href="<?php echo $this->assetsBase; ?>/images/splash/splash-screen.png" media="screen and (max-device-width: 320px)" /> 
	<link rel="apple-touch-startup-image" href="<?php echo $this->assetsBase; ?>/images/splash/splash-screen_402x.png" media="(max-device-width: 480px) and (-webkit-min-device-pixel-ratio: 2)" /> 
	<link rel="apple-touch-startup-image" href="<?php echo $this->assetsBase; ?>/images/splash/splash-screen_403x.png" sizes="640x1096">
	<?php
		$cs->registerCssFile($this->assetsBase  . '/css/framework-style.css');
		$cs->registerCssFile($this->assetsBase  . '/css/framework.css');
		$cs->registerCssFile($this->assetsBase  . '/css/icons.css');
		$cs->registerCssFile($this->assetsBase  . '/css/retina.css');
		$cs->registerCssFile($baseThemeUrl . '/assets/css/style.css');
	?>
	<!--Page Scripts Load -->
	<?php 
		$cs->registerCoreScript('jquery');
		$cs->registerCoreScript('jquery.ui');
		$cs->registerScriptFile($this->assetsBase . '/js/contact.js', CClientScript::POS_END); 
		$cs->registerScriptFile($this->assetsBase . '/js/swipe.js', CClientScript::POS_END); 
		$cs->registerScriptFile($this->assetsBase . '/js/klass.min.js', CClientScript::POS_END); 
		$cs->registerScriptFile($this->assetsBase . '/js/colorbox.js', CClientScript::POS_END);
		$cs->registerScriptFile($this->assetsBase . '/js/retina.js', CClientScript::POS_END);  
		$cs->registerScriptFile($this->assetsBase . '/js/custom.js', CClientScript::POS_END);
	?>
</head>
<body>
	<div id="preloader">
		<div id="status">
	    	<p class="center-text">
				Loading up the content!
	            <em>Loading depends on connection speed</em>
	        </p>
	    </div>
	</div>
	<div class="content">
	    <div class="decoration"></div>
	    	<?php echo $content; ?>
	    <div class="decoration"></div>
	</div>
</div>
</body>
</html>