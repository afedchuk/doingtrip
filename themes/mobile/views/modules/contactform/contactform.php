<?php
$this->pageTitle .= ' - '.  ContactformModule::t('Contact Us');
$this->breadcrumbs=array(ContactformModule::t('Contact title'));
?>
<div class="wide-folio cities-map">                                 
    <div class="wide-item">
        <div class="wide-item-titles">
            <h1 class="main-title">4trip.com.ua</h1>
            <p class="main-text">
                <?php echo Yii::t('index','Contact us title'); ?> 
            </p>
        </div>
        <a class="wide-image" href="#">
            <img class="responsive-image" src="<?php echo Yii::app()->request->getBaseUrl(true); ?>/images/wallpapers/contacts.jpg" alt="img">
        </a>
    </div>
</div>
<?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>$this->modelName.'-form',
                'enableAjaxValidation'=>true,
                'enableClientValidation'=>false,
                'clientOptions' => array(
                    'validateOnSubmit' => false,
                    'validateOnChange' => true,
                ),
                'htmlOptions' => array('class' => 'contacts-form')

             )); ?>

<h4><?php echo ContactformModule::t('Contact title'); ?></h4>  
<div class="decoration"></div>
<?php if(Yii::app()->user->isGuest) { ?>
    <?php echo $form->textField($model,'name', array('placeholder' => User::model()->getAttributeLabel('firstname'))); ?>
    <?php echo $form->error($model,'name'); ?>
    <?php echo $form->textField($model,'email', array('placeholder' => User::model()->getAttributeLabel('email'))); ?>
    <?php echo $form->error($model,'email'); ?>
    <?php echo $form->textField($model,'phone', array('class' => 'phone' ,'placeholder' => User::model()->getAttributeLabel('phone'))); ?>
    <?php echo $form->error($model,'phone'); ?>
<?php } ?>
<?php echo $form->textArea($model,'body', array('placeholder' => $model->getAttributeLabel('body'))); ?>
<?php echo $form->error($model,'body'); ?>
<?php
if (Yii::app()->user->isGuest){
?>        
<?php echo $form->textField($model,'verifyCode', 
array('id'=>'captcha', 
      'placeholder' => User::model()->getAttributeLabel('verifyCode'))); ?>
<?php } ?>
<div class="captcha"><?php $this->widget('CCaptcha'); ?></div>
<?php echo $form->error($model,'verifyCode'); ?>
<br/>
<button class="stn-btn clearfix">
    <i class="fa fa-send"></i> <?php echo ContactformModule::t('Send message'); ?>
</button>
</div>
<?php $this->endWidget(); ?>


