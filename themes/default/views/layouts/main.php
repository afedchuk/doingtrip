<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <?php Yii::app()->clientScript->registerMetaTag('text/html; charset=utf-8', null, null, array('http-equiv' => 'Content-Type'));?>
    <?php Yii::app()->clientScript->registerMetaTag(CHtml::encode($this->pageKeywords), 'keywords');?>
    <?php Yii::app()->clientScript->registerMetaTag(CHtml::encode($this->pageDescription), 'description');?>
    <meta name='yandex-verification' content='6bca259b4c447c3f' />
    <!--meta name="google-site-verification" content="uSybP_l41VdAVpRXKiOHw7saM2NftGY7K4NODd_ERSY" /-->
    <meta name="google-site-verification" content="GMcXU1trrBxb7hMEJ3V09xCFvrrvhBJNM0sd-uJRmcs" />
    <link rel="icon" href="<?php echo Yii::app()->baseUrl; ?>/images/icons/favicon.ico" type="image/x-icon" />
<?php foreach($this->languages as $lang) { ?>
<?php $hreflang = $lang['code'] == Yii::app()->params->language ? 'x-default' : $lang['code'];  ?>
    <link rel="alternate" hreflang="<?php echo $hreflang; ?>" href="<?php echo Yii::app()->request->getBaseUrl(true).Yii::app()->controller->createLangUrl($lang['code']); ?>"/>
<?php } ?>
<?php $cs = Yii::app()->clientScript;
$baseUrl = Yii::app()->theme->getBaseUrl(); ?>
<?php 
$cs->registerCssFile($this->assetsBase   . '/css/screen.css');
$cs->registerCssFile('//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css');
$cs->registerScriptFile($this->assetsBase  . '/js/jquery.ui.datepicker.js', CClientScript::POS_END);
$cs->registerScriptFile($this->assetsBase  . '/js/jquery.ui.datepicker-'.Yii::app()->language.'.js', CClientScript::POS_END);
$cs->registerScriptFile($this->assetsBase  . '/js/jquery.maskedinput.js', CClientScript::POS_END);
$cs->registerScriptFile($this->assetsBase  . '/js/jquery.jcarousel.min.js', CClientScript::POS_END);
$cs->registerScriptFile($this->assetsBase  . '/js/cryptojs/rollups/aes.js', CClientScript::POS_END);
$cs->registerScriptFile($this->assetsBase  . '/js/cryptojs/components/enc-base64.js', CClientScript::POS_END);
$cs->registerScriptFile($this->assetsBase. '/js/jquery.custom.js', CClientScript::POS_END);   ?>
</head>
<body <?php if(!isset(Yii::app()->getController()->module->id) || Yii::app()->getController()->action->id == 'sitemap') { ?>class="hero" <?php } ?>>
    <div id="wrapper">
    <img src="/images/wallpapers/main.jpg" id="bg-layout"/>
    <div id="header">
        <?php 
        $public_menu = array(
                    'class'=>'bootstrap.widgets.TbMenu',
                    'encodeLabel'=>false,
                    'htmlOptions'=>array('class'=>'pull-right'),
                    'submenuHtmlOptions' => array('class' => 'multi-level'),
                    'items'=>array(

                        array('label'=> ComparisonListModule::t('Comparison list'). ' <span class="badge label-info">('.count($this->apInComparison).')</span>', 'url'=>Yii::app()->createAbsoluteUrl('comparisonList/main/index'),  'visible' => (!empty(Yii::app()->controller->apInComparison) && isset(Yii::app()->getController()->module->id) ? true : false)),
                        array('label'=>'<i class="fa fa-lock"></i> '.UserModule::t('Registration'), 'url'=>Yii::app()->createAbsoluteUrl('user/main/registration'), 'visible' => (Yii::app()->user->isGuest ? true : false)),
                        array('label'=>'<i class="fa fa-sign-in"></i> '.UserModule::t('Enter'), 'url'=>Yii::app()->createAbsoluteUrl('user/main/login'), 'visible' => (Yii::app()->user->isGuest? true : false)),
                        array('label'=>'<i class="icon-envelope"></i>'.(Yii::app()->getModule('message')->getCountUnreadedMessages(Yii::app()->user->getId()) ? '<small>+'.Yii::app()->getModule('message')->getCountUnreadedMessages(Yii::app()->user->getId()).'</small>' : '  '), 'url'=>Yii::app()->createAbsoluteUrl('/message/inbox'), 'visible' => (!Yii::app()->user->isGuest ? true : false), 'itemOptions' => array('class' => 'messages')),
                    ),
                );
        
        if(!Yii::app()->user->isGuest) {
            array_push($public_menu['items'],
                array('label'=>'<i class="fa fa-unlock"></i> '.UserModule::t('Cabinet'), 'url'=>Yii::app()->createAbsoluteUrl('user/profile'),  'visible' => (!Yii::app()->user->isGuest ? true : false), 'items' => array(
                array('label'=>UserModule::t('Panel administration'), 'url'=>Yii::app()->createAbsoluteUrl('/configuration/backend/main/admin'),  'visible' => (Yii::app()->user->getState("isAdmin") ? true : false), 'icon' => ' wrench'),
                array('label'=>UserModule::t('Cabinet'), 'url'=>Yii::app()->createAbsoluteUrl('user/profile'),  'visible' => (!Yii::app()->user->isGuest ? true : false), 'icon' => 'user',),
                //array('label' => tc('Booking')),
                //array('label'=>UserModule::t('Edit profile'), 'url'=>Yii::app()->createAbsoluteUrl('/user/profile/edit'),  'visible' => (!Yii::app()->user->isGuest ? true : false), 'icon' => 'edit'),
               // array('label'=>UserModule::t('Create apartment'), 'url'=>Yii::app()->createAbsoluteUrl('apartments/main/new'),  'visible' => (!Yii::app()->user->isGuest ? true : false), 'icon' => 'pencil'),
                //array('label'=>'<i class="fa fa-sign-out"></i> '.Yii::app()->getModule('user')->t("Logout"), 'url'=>Yii::app()->createAbsoluteUrl('/user/logout'),  'visible' => (!Yii::app()->user->isGuest ? true : false))
            )));
            if(isset($this->bookings) && !is_null($this->bookings)) {
                array_push($public_menu['items'][4]['items'], array('label' => tc('Booking')));
                foreach ($this->bookings as $key => $value) {
                    $label = $value->description->title. '<span>'.strftime ('%e %b', strtotime($value['date_start'])) .' - '. strftime ('%e %b', strtotime($value['date_end'])).'</span>';
                    array_push($public_menu['items'][4]['items'],  array('label' => $label, 'url'=>Yii::app()->createAbsoluteUrl('user/profile#item-'. $value->book_unique), 'itemOptions' => array('class' => 'sub-book-item')));
                }

            }

            array_push($public_menu['items'][4]['items'], array('label'=>UserModule::t('Edit profile'), 'url'=>Yii::app()->createAbsoluteUrl('/user/profile/edit'),  'visible' => (!Yii::app()->user->isGuest ? true : false), 'icon' => 'edit'),
                  array('label'=>UserModule::t('Create apartment'), 'url'=>Yii::app()->createAbsoluteUrl('apartments/main/new'),  'visible' => (!Yii::app()->user->isGuest ? true : false), 'icon' => 'pencil'),
                  array('label'=>'<i class="fa fa-sign-out"></i> '.Yii::app()->getModule('user')->t("Logout"), 'url'=>Yii::app()->createAbsoluteUrl('/user/logout'),  'visible' => (!Yii::app()->user->isGuest ? true : false))
            );
        }


       
        $types = Apartment::getTypesArray();
        $resultTypes = array();
        if(!empty($types)) {
            foreach($types as $key => $type) {
                $resultTypes[] = array('label' => $type, 'url' => Yii::app()->createAbsoluteUrl('/apartments' , array('objType' => array($key))));
            }
        }
        array_push($public_menu['items'], $this->currencies);

        $apartConditions = array();
        if(isset($this->cityUrl) && $this->cityUrl)
            $apartConditions['city'] = $this->cityUrl;
        $this->widget('bootstrap.widgets.TbNavbar', array(
            'type' => null,//'inverse',
            'brand'=> false,
            'collapse'=>true,
            'items'=>array(
                array(
                    'class'=>'bootstrap.widgets.TbMenu',
                    'encodeLabel'=>false,
                    'submenuHtmlOptions' => array('class' => 'multi-level'),
                    'items'=>array(
                        array('label'=>Yii::t('index', 'Home'), 'url'=>Yii::app()->createAbsoluteUrl('/'), 'visible' => isset(Yii::app()->getController()->module->id) ? true : false),
                        array('label'=>Yii::t('index', 'Short time'), 'url'=>Yii::app()->createAbsoluteUrl('apartments' ,$apartConditions), 'active'=>(isset(Yii::app()->getController()->module->id) && Yii::app()->getController()->module->id == 'apartments' && Yii::app()->getController()->action->id == 'index' ? true : false), 
                                'itemOptions' =>   array('class' => 'dropdown-submenu-wide'),
                                //'items' => $resultTypes
                        ),
                        //array('label'=>Yii::t('index', 'Sellers'), 'url'=>Page::getUrl(1), 'active' => (isset(Yii::app()->getController()->module->id) && Yii::app()->getController()->module->id == 'pages' ? true : false)),
                        array('label'=>Yii::t('index', 'Add proposition').'<span>'.Yii::t('index', 'Free').'</span>', 'url'=>Yii::app()->createAbsoluteUrl('apartments/main/new'), 'active' => (isset(Yii::app()->getController()->module->id) && Yii::app()->getController()->action->id == 'new' ? true : false), 'itemOptions' =>   array('class' => 'new-apartment') ),
                    ),
                ),
                $public_menu

            ),
            'htmlOptions' => array('class' =>!isset(Yii::app()->getController()->module->id) || Yii::app()->getController()->action->id == 'sitemap' ? 'hero' : '')
        )); 
        ?>
    </div>
        <?php 
        Yii::app()->counter->refresh();
        if(param('useYandexMap') == 1){
        	Yii::app()->getClientScript()->registerScriptFile(
        		'http://api-maps.yandex.ru/2.0/?load=package.standard,package.clusters&coordorder=longlat&lang='.CustomYMap::getLangForMap(),
        		CClientScript::POS_END);
        } else if (param('useGoogleMap') == 1){
        	Yii::app()->getClientScript()->registerScriptFile('https://maps.googleapis.com/maps/api/js?key='. param('module_apartments_gmapsKey'), CClientScript::POS_HEAD);
        }
        ?>
        <div class="container">
            <?php require_once 'breadcrumb.php';?>
            <?php require_once 'messages.php';?>
            <div class="clear"></div>
            <?php echo $content; ?>
            <div class="clear"></div>
        </div>
    </div>
    <div class="<?php if(!isset(Yii::app()->getController()->module->id) || Yii::app()->getController()->action->id == 'sitemap') { ?>hero <?php } ?>footer" id="footer">
        <div class="contain row-fluid">
            <?php if(isset(Yii::app()->getController()->module->id) || Yii::app()->getController()->action->id == 'sitemap') { ?>
            <div class="container">
                <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                        'links'=>$this->breadcrumbs,
                        'separator'=> '›',
                        'encodeLabel' => false,
                        'htmlOptions'=>array('class'=>'bottom-bread'),
                )); ?>
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
                <div class="copy-box">
                    <?php if(isset($this->scity) && $this->scity) { ?>
                        <?php echo Yii::t('index', 'Footer main message {city}', array('{city}' => $this->scity)); ?>
                    <?php } else { ?>
                        <?php echo Yii::t('index', 'Footer main message'); ?>
                    <?php } ?>
                    <br/><br/>
                </div>
                <div class="span4">
                    <div class="footer-social">
                        <ul class="clearfix"><li>
                            <a target="_blank" href="https://www.facebook.com/house4trip" class="facebook"></a>
                            </li><li>
                            <a target="_blank" href="https://vk.com/house4trip" class="vk"></a>
                            </li><li>
                            <a target="_blank" href="https://plus.google.com/u/0/105002978878105654625/posts" class="gplus"></a>
                            </li><li>
                            <a target="_blank" href="https://twitter.com/house4trip" class="twitter"></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div> 
            <?php } ?>
            <div class="footer-bottom">
                <div class="container">
                    <?php if(!isset(Yii::app()->getController()->module->id) && Yii::app()->getController()->action->id != 'sitemap') { ?>
                        <div class="footer-social">
                            <ul class="clearfix"><li>
                                <a target="_blank"  href="https://www.facebook.com/house4trip" class="facebook"></a>
                                </li><li>
                                <a target="_blank" href="https://vk.com/house4trip" class="vk"></a>
                                </li><li>
                                <a target="_blank" href="https://plus.google.com/u/0/105002978878105654625/posts" class="gplus"></a>
                                </li><li>
                                <a target="_blank" href="https://twitter.com/house4trip" class="twitter"></a>
                                </li>
                            </ul>
                        </div>
                    <?php } ?>
                </div>
            </div>   
        </div>
    </div>
    <?php 
        if(!isset($_COOKIE['socbox']) || $_COOKIE['socbox'] === NULL) {
           $this->widget('application.extensions.social.social', array(
            'style'=>'horizontal', 
                'networks' => array(
                'facebook'=>array(
                    'href'=>'https://www.facebook.com/house4trip',
                    'action'=>'like',
                    'colorscheme'=>'light',
                    'width'=>'120px',
                    )
                )
          ));
        }
    ?>
    <div class="modal-tmp"></div>
    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-77857924-1', 'auto');
  ga('send', 'pageview');
  var CIPHERKEY = '<?php echo param("hexKey"); ?>';
  var CIPHERIV = '<?php echo param("hexIv"); ?>';
</script>
    <!--script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-53087685-1', 'auto');
    ga('send', 'pageview');
    </script-->
    <?php if (issetModule('comparisonList')) { 
    Yii::app()->clientScript->registerScript('compareList', "
        compareList.addUrl = '".Yii::app()->createAbsoluteUrl('/comparisonList/main/add')."';
        compareList.delUrl = '".Yii::app()->createAbsoluteUrl('/comparisonList/main/del')."';
        compareList.indexUrl ='".Yii::app()->createAbsoluteUrl('comparisonList/main/index')."';
        compareList.inComparisonMsg = '".ComparisonListModule::t('In the comparison list')."';
        compareList.limitMsg = '".ComparisonListModule::t('max_limit', array('{n}' => param('countListingsInComparisonList', 5)))."';
        compareList.errorMsg = '".tc('Error')."';
        compareList.delMsg = '".ComparisonListModule::t('Add to a comparison list')."';
        compareList.apply()",#3BA1BF
    CClientScript::POS_READY);
    } ?>
</body>
</html>
