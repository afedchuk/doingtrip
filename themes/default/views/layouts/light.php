<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<?php Yii::app()->clientScript->registerMetaTag(CHtml::encode($this->pageDescription), 'description'); ?>
<?php Yii::app()->clientScript->registerMetaTag(CHtml::encode($this->pageKeywords), 'keywords'); ?>
<?php Yii::app()->clientScript->registerMetaTag('text/html; charset=utf-8', null, 'Content-Type'); ?>
<?php Yii::app()->clientScript->registerMetaTag(Yii::app()->language, 'language'); ?>
<?php Yii::app()->clientScript->registerMetaTag( 'noindex, nofollow','googlebot'); ?>
<link rel="icon" href="<?php echo Yii::app()->theme->getBaseUrl(); ?>/icons/favicon.ico" type="image/x-icon" />
<?php
$cs = Yii::app()->clientScript;
$baseUrl = Yii::app()->theme->getBaseUrl();
$cs->registerCoreScript('jquery');
$cs->registerCssFile($baseUrl  . '/assets/css/screen.css');
$cs->registerScriptFile($this->assetsBase  . '/js/jquery.maskedinput.js', CClientScript::POS_END);
$cs->registerScriptFile($baseUrl. '/assets/js/jquery.custom.js', CClientScript::POS_HEAD);
Yii::app()->bootstrap->register();
?>
</head>
<body style='background:url("https://static.licdn.com/scds/common/u/images/themes/katy/textures/texture_grain_200x200_v2.png") repeat scroll 0 0 rgba(0, 0, 0, 0) !important;'>
    <div id="header">
        <noindex>
        <?php 
        $this->widget('bootstrap.widgets.TbNavbar', array(
            'type'=>null,
            'brand'=> false,
            'collapse'=>true,
            'items'=>array(
                array(
                    'class'=>'bootstrap.widgets.TbMenu',
                    'items'=>array(
                        array('label'=>Yii::t('index', 'Home'), 'url'=>Yii::app()->createUrl('/'), 'visible' => isset(Yii::app()->getController()->module->id) ? true : false),
                        array('label'=>Yii::t('index', 'Short time'), 'url'=>Yii::app()->createUrl('apartments'), 'active'=>(isset(Yii::app()->getController()->module->id) && Yii::app()->getController()->module->id == 'apartments' && Yii::app()->getController()->id == 'main' ? true : false)),
                        array('label'=>Yii::t('index', 'Sellers'), 'url'=>Page::getUrl(1), 'active' => (isset(Yii::app()->getController()->module->id) && Yii::app()->getController()->module->id == 'pages' ? true : false)),
                        array('label'=>Yii::t('index', 'Add proposition'), 'url'=>Yii::app()->createUrl('apartments/main/new')),
                    ),
                ),
                array(
                    'class'=>'bootstrap.widgets.TbMenu',
                    'htmlOptions'=>array('class'=>'pull-right'),
                    'items'=>array(
                       // $items,
                        array('label'=>ComparisonListModule::t('Comparison list'), 'url'=>Yii::app()->createUrl('comparisonList/main/index'),  'visible' => (!empty(Yii::app()->controller->apInComparison && isset(Yii::app()->getController()->module->id)) ? true : false)),
                        array('label'=>Yii::t('user', 'Registration'), 'url'=>Yii::app()->createAbsoluteUrl('user/main/registration'), 'visible' => (Yii::app()->user->isGuest && isset(Yii::app()->getController()->module->id) ? true : false)),
                        array('label'=>Yii::t('user', 'Enter'), 'url'=>Yii::app()->createAbsoluteUrl('user/main/login'), 'visible' => (Yii::app()->user->isGuest && isset(Yii::app()->getController()->module->id) ? true : false)),
                        !Yii::app()->user->isGuest ? array('label'=>UserModule::t('Cabinet'), 'url'=>Yii::app()->createAbsoluteUrl('user/profile'),  'visible' => (!Yii::app()->user->isGuest ? true : false), 'items' => array(
                            array('label'=>UserModule::t('Panel administration'), 'url'=>Yii::app()->createAbsoluteUrl('/configuration/backend/main/admin'),  'visible' => (Yii::app()->user->getState("isAdmin") ? true : false), 'icon' => ' wrench'),
                            array('label'=>UserModule::t('Cabinet'), 'url'=>Yii::app()->createAbsoluteUrl('user/profile'),  'visible' => (!Yii::app()->user->isGuest ? true : false), 'icon' => 'user'),
                            array('label'=>UserModule::t('Edit profile'), 'url'=>Yii::app()->createAbsoluteUrl('/user/profile/edit'),  'visible' => (!Yii::app()->user->isGuest ? true : false), 'icon' => 'edit'),
                            array('label'=>UserModule::t('Create apartment'), 'url'=>Yii::app()->createAbsoluteUrl('apartments/main/new'),  'visible' => (!Yii::app()->user->isGuest ? true : false), 'icon' => 'pencil'),
                            array('label'=>Yii::app()->getModule('user')->t("Logout"), 'url'=>Yii::app()->createAbsoluteUrl('/user/logout'),  'visible' => (!Yii::app()->user->isGuest ? true : false), 'icon' => 'off')
                        )) : array(),
                        $this->currencies,
                    ),
                ),

            ),
            'htmlOptions' => array('class' =>!isset(Yii::app()->getController()->module->id) && Yii::app()->getController()->action->id != 'sitemap' ? 'hero' : 'hero')
        )); 
        ?>
        </noindex>
    </div>
<div class="container">
    <div class="main">
        <?php require_once 'breadcrumb.php';?>
        <?php require_once 'messages.php';?>
        <?php echo $content; ?>
    </div>
</div>          
</body>
</html>
