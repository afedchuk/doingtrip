<?php $baseUrl = Yii::app()->request->baseUrl; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="en"/>

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <meta name="description" content="<?php echo CHtml::encode($this->pageDescription); ?>"/>
    <meta name="keywords" content="<?php echo CHtml::encode($this->pageKeywords); ?>"/>

    <link media="screen, projection" type="text/css" href="<?php echo Yii::app()->theme->getBaseUrl(); ?>/assets/css/admin-styles.css" rel="stylesheet"/>

    <!--[if IE]>
	<link href="<?php echo $baseUrl; ?>/css/ie.css" rel="stylesheet" type="text/css"> <![endif]-->
    <link rel="icon" href="<?php echo $baseUrl; ?>/images/icons/favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" href="<?php echo $baseUrl; ?>/images/icons/favicon.ico" type="image/x-icon"/>

	<?php
		Yii::app()->clientScript->registerCssFile('//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css');
		Yii::app()->clientScript->registerCssFile($this->assetsBase   . '/css/screen.css');
        Yii::app()->clientScript->registerScriptFile($this->assetsBase  . '/js/jquery.maskedinput.js', CClientScript::POS_END);
        Yii::app()->clientScript->registerScriptFile($this->assetsBase. '/js/jquery.custom.js', CClientScript::POS_END);
	?>
</head>

<body>
<div id="wrapper">
	<?php
	$this->widget('bootstrap.widgets.TbNavbar', array(
		'fixed' => 'top',
		'brand' => false,
		'collapse' => false, // requires bootstrap-responsive.css
		'items' => array(
			array(
                'class'=>'bootstrap.widgets.TbMenu',
                'items'=>array(
                    array('label'=>Yii::t('index', 'Home'), 'url'=>Yii::app()->createUrl('/'), 'visible' => isset(Yii::app()->getController()->module->id) ? true : false),
                    array('label'=>Yii::t('index', 'Short time'), 'url'=>Yii::app()->createUrl('apartments'), 'active'=>(isset(Yii::app()->getController()->module->id) && Yii::app()->getController()->module->id == 'apartments' && Yii::app()->getController()->action->id == 'index' ? true : false)),
                    array('label'=>Yii::t('index', 'Sellers'), 'url'=>Page::getUrl(1), 'active' => (isset(Yii::app()->getController()->module->id) && Yii::app()->getController()->module->id == 'pages' ? true : false)),
                    array('label'=>Yii::t('index', 'Add proposition'), 'url'=>Yii::app()->createUrl('apartments/main/new'), 'active' => (isset(Yii::app()->getController()->module->id) && Yii::app()->getController()->action->id == 'new' ? true : false) ),
                ),
            ),
			

			array(
				'class' => 'bootstrap.widgets.TbMenu',
				'htmlOptions' => array('class' => 'pull-right'),
				'items' => array(
					array('label' => tc('Language'), 'url' => '#', 'items' => Lang::getAdminMenuLangs()),
					array('label' => tc('Log out'), 'url' =>Yii::app()->createAbsoluteUrl('/user/logout')),
				)
			),
		),
	));

	$countApartmentModeration = Apartment::getCountModeration();
	$bageListings = ($countApartmentModeration > 0) ? "&nbsp<span class=\"badge\">{$countApartmentModeration}</span>" : '';

	if(issetModule('payment')){
		$countPaymentWait = Payments::getCountWait();
		$bagePayments = ($countPaymentWait > 0) ? "&nbsp<span class=\"badge\">{$countPaymentWait}</span>" : '';
	}

	$countCommentPending = Comment::getCountPending();
	$bageComments = ($countCommentPending > 0) ? "&nbsp<span class=\"badge\">{$countCommentPending}</span>" : '';

	$countComplainPending = Complaint::getCountPending();
	$bageComplain = ($countComplainPending > 0) ? "&nbsp<span class=\"badge\">{$countComplainPending}</span>" : '';
?>
	<div class="container">
	    <div class="main">
	    	<div class="row-fluid">
		    	<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			                'links'=>$this->breadcrumbs,
			                'separator'=> '',
			                'htmlOptions'=>array('class'=>'breadcrumbBox span12'),
		        )); ?>
		    </div>
	    <div class="row-fluid profile-wrapper">
	        <div class="span9 well">
				<?php echo $content; ?>
	        </div>
	        <?php echo $this->renderPartial('user.views.profile.menu', array(), true); ?>
	    </div>
	    </div>
	</div>
</div>
<div class="footer" id="footer">
    <div class="contain row-fluid">
        <div class="container">
            <div class="span2 first">
               <?php $this->widget('zii.widgets.CMenu',array(
                        'id' => 'footer-links-primary',
                        'items'=> array(
                                    array('label'=>Yii::t('index', 'Short time'), 'url'=>array('/apartments'), 'itemOptions' => isset(Yii::app()->getController()->module->id) && Yii::app()->getController()->module->id == 'apartments' ? array('class' => 'active') : array()),
                                    array('label'=>Yii::t('index', 'Sellers'), 'url'=>Page::getUrl(1, false), 'itemOptions' => isset(Yii::app()->getController()->module->id) && Yii::app()->getController()->module->id == 'pages' ? array('class' => 'active') : array()),
                                    array('label'=>Yii::t('index', 'About us'), 'url'=>Page::getUrl(3, false)),
                                    array('label'=>Yii::t('index', 'News'), 'url'=>array('/news'),  'itemOptions' => isset(Yii::app()->getController()->module->id) && Yii::app()->getController()->module->id == 'news' ? array('class' => 'active') : array()),

                                    ),                      
                    ));
              ?>
            </div> 
            <div class="span3">
                   <?php $this->widget('zii.widgets.CMenu',array(
                            'id' => 'footer-links-primary',
                            'items'=> array(
                                        
                                        array('label'=>Yii::t('index', 'Faq'), 'url'=>array('/articles'),  'itemOptions' => isset(Yii::app()->getController()->module->id) && Yii::app()->getController()->module->id == 'articles' ? array('class' => 'active') : array()),
                                        array('label'=>Yii::t('index', 'Contact'), 'url'=>array('/contactform'), 'itemOptions' => isset(Yii::app()->getController()->module->id) && Yii::app()->getController()->module->id == 'contactform' ? array('class' => 'active') : array()),
                                        array('label'=>Yii::t('index', 'Rules'), 'url'=>Page::getUrl(2, false)),
                                        array('label'=>Yii::t('index', 'Sitemap'), 'url'=>array('/sitemap')),
                                        ),                      
                        ));
                  ?>
            </div>
            <div class="span4">
                <div class="copy-box">
                    <?php echo Yii::t('index', 'Footer main message'); ?>
                    <br/><br/>
                    <!--LiveInternet counter--><script type="text/javascript"><!--
                    document.write("<a href='//www.liveinternet.ru/click' "+
                    "target=_blank><img src='//counter.yadro.ru/hit?t26.6;r"+
                    escape(document.referrer)+((typeof(screen)=="undefined")?"":
                    ";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
                    screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
                    ";"+Math.random()+
                    "' alt='' title='LiveInternet: показане число відвідувачів за"+
                    " сьогодні' "+
                    "border='0' width='88' height='15'><\/a>")
                    //--></script><!--/LiveInternet-->

                </div>
            </div>
            <div class="span2 pull-right">
                <ul class="communities">
                    <li>
                        <a class="icon  type2" target="_blank" href="https://www.facebook.com/house4trip">Facebook</a>
                    </li>
                    <li>
                        <a class="icon  type5" target="_blank" href="https://twitter.com/house4trip">Twitter</a>
                    </li>
                    <li>
                        <a class="icon fleft type1" target="_blank" href="http://vk.com/house4trip">VK</a>
                    </li>
                </ul>
                <ul class="lang-footer">
                    <?php foreach($this->languages as $lang) { ?>
                        <?php if($lang['code'] != Yii::app()->language) {?>
                            <li><?php echo CHtml::link(strtoupper($lang['code']), Yii::app()->createAbsoluteUrl('/', array('lang' => $lang['code']))); ?></li>
                        <?php } ?>
                    <?php } ?>
                </ul>
            </div>

            
        </div>    
    </div>
</div>
<div class="modal-tmp"></div>
</body>
</html>
