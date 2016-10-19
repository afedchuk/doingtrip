<!DOCTYPE html>
<?php
$cs = Yii::app()->clientScript;
$baseUrl = Yii::app()->baseUrl;
$baseThemeUrl = Yii::app()->theme->baseUrl;
?>
<head>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="google-site-verification" content="uSybP_l41VdAVpRXKiOHw7saM2NftGY7K4NODd_ERSY" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="description" content="<?php echo CHtml::encode($this->pageDescription); ?>" />
    <meta name="keywords" content="<?php echo CHtml::encode($this->pageKeywords); ?>" />
    <meta name="language" content="<?php echo Yii::app()->language; ?>" />
	<link rel="icon" href="<?php echo $baseUrl; ?>/images/icons/favicon.ico" type="image/x-icon" />
	<?php
        //$cs->registerCssFile($this->assetsBase . '/css/normalize.css');
		$cs->registerCssFile($this->assetsBase . '/css/framework.css');
		$cs->registerCssFile($this->assetsBase . '/css/owl.theme.css');
		$cs->registerCssFile($this->assetsBase  . '/css/swipebox.css');
        $cs->registerCssFile($baseThemeUrl . '/assets/css/style.css');
		$cs->registerCoreScript('jquery');
		$cs->registerCoreScript('jquery.ui');
		
        $cs->registerScriptFile($this->assetsBase.'/js/jquery.swipebox.js', CClientScript::POS_END);
        $cs->registerScriptFile($this->assetsBase.'/js/owl.carousel.min.js', CClientScript::POS_END);
		$cs->registerScriptFile($this->assetsBase.'/js/snap.js', CClientScript::POS_END);
        $cs->registerScriptFile($baseThemeUrl.'/assets/js/custom.js', CClientScript::POS_END);
        $cs->registerScriptFile($this->assetsBase.'/js/framework.js', CClientScript::POS_END);
        $cs->registerScriptFile($this->assetsBase.'/js/framework.launcher.js', CClientScript::POS_END);
        $cs->registerCssFile('//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css');
    	?>
</head>
<body>
<div id="preloader">
    <div id="status">
        <p class="center-text">
            <?php echo Yii::t('index', 'Loading up the content!'); ?>
        </p>
    </div>
</div>


<div class="all-elements">
    <div id="sidebar" class="page-sidebar">
        <div class="page-sidebar-scroll">
			<div class="sidebar-content-background">
            	<div class="sidebar-section">
                    <a href="#" class="sidebar-close menu-burger  active"></a>
                	<!--em>Меню</em-->
                </div>
                <div class="main-menu__page-overlay js-menu-page-overlay active"></div>
                <div class="sidebar-decoration"></div>
                <!--div class="user-block">         
                   <ul>
                       <li><?php echo CHtml::link('<i class="fa fa-sign-in"></i> '.UserModule::t('Enter'), array('user/main/login')); ?></li>
                       <li><span>/</span><?php echo CHtml::link('<i class="fa fa-lock"></i> '.UserModule::t('Registration'), array('user/main/registration')); ?></li>
                   </ul>
                </div-->
 
                <div class="sidebar-navigation">     
            
                    <div class="nav-item">
                        <a href="#" class="dropdown-nav dropdown-nav-inactive"><?php echo Yii::t('index', 'Guidebook'); ?></a>
                        <div style="display: block;" class="nav-item-submenu">
                            <?php echo CHtml::link(Yii::t('index', 'Home'), array('/')); ?>
                            <?php echo CHtml::link(Yii::t('index', 'Short time'), array('/apartments')); ?>
                            <?php echo CHtml::link(Yii::t('index', 'Areas'), array('/sitemap')); ?>
                        </div>
                    </div>
                    <div class="nav-item">
                        <a href="#" class="dropdown-nav"><?php echo Yii::t('index',  'Add proposition'); ?></a>
                        <div class="nav-item-submenu">
                            <?php echo CHtml::link(Yii::t('index', 'Add proposition'), array('/')); ?>
                            <?php echo CHtml::link(Yii::t('index', 'Faq'), array('/articles')); ?>
                            <?php echo CHtml::link(Yii::t('index', 'News'), array('/news')); ?>
                        </div>
                    </div>
                    
                    <div class="nav-item">
                        <?php echo CHtml::link(Yii::t('index', 'About us'), Page::getUrl(3, false)); ?>
                    </div>
                    <div class="nav-item">
                        <?php echo CHtml::link(Yii::t('index', 'Contact'), array('/contactform')); ?>
                    </div>
                  
                </div>
                <div class="sidebar-decoration"></div>
                <?php echo CHtml::link(Yii::t('index', 'Full version'), array('/main/show'), array('class' => 'full-version')); ?><br/>
                <p class="sidebar-copyright"><?php echo Yii::t('index', 'Footer main message'); ?></p>
            </div>
        </div>
    </div>    
    <div class="page-content" id="content">   
        <div class="content-controls">
            <a class="deploy-sidebar" href="#"><span></span><span></span><span></span></a>
            <div class="add-apartment">
                <a id="add-apartment" href="<?php echo Yii::app()->createAbsoluteUrl('/'); ?>">
                    <?php echo Yii::t('index', 'Add proposition'); ?>
                    <span></span>
                </a>
            </div>
        </div>     
            <?php echo $content; ?>
        </div>  
    </div>  
    <?php  Yii::app()->counter->refresh();
            if(param('useYandexMap') == 1){
                Yii::app()->getClientScript()->registerScriptFile(
                    'http://api-maps.yandex.ru/2.0/?load=package.standard,package.clusters&coordorder=longlat&lang='.CustomYMap::getLangForMap(),
                    CClientScript::POS_END);
            } else if (param('useGoogleMap') == 1){
                Yii::app()->getClientScript()->registerScriptFile('https://maps.googleapis.com/maps/api/js?key='. param('module_apartments_gmapsKey'), CClientScript::POS_END);
            }
    ?>
    <body>
</html>
