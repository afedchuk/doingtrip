<?php
$this->pageTitle=Yii::app()->name . ' - ' . NotifierModule::t('Add letter');

$this->menu = array(
    array('label' => NotifierModule::t('Mail editor'), 'url' => array('admin')),
);
$this->adminTitle = NotifierModule::t('Add letter');
?>

<div class="profile-edit">
    <?php $form=$this->beginWidget('CActiveForm', array(
    	'id'=>$this->modelName.'-form',
    	'enableAjaxValidation'=>false,
      'htmlOptions' => array('class' => 'form-horizontal'),
    )); ?>
        <div class="control-group">
          <?php echo $form->labelEx($model,'event', array('class'=>'control-label')); ?>
          <div class="controls">
              <?php echo $form->textField($model,"event",array('maxlength'=>255, 'class' => 'span12')); ?>
              <?php if($form->error($model,'event')): ?>
                  <?php echo $form->error($model,'event'); ?>
              <?php endif; ?>
          </div>
        </div>
        <div class="control-group">
            <?php  echo $form->labelEx($model,'status', array('class'=>'control-label')); ?>
            <div class="controls">
                <?php echo $form->dropDownList($model, 'status',  NotifierModel::getStatusList(), array('prompt'=>  ApartmentsModule::t('--Select--'), 'class' => 'span6')) ?>
                <?php if($form->error($model,'status')): ?>
                    <?php echo $form->error($model,'status'); ?>
                <?php endif; ?>
            </div>
        </div>
    	<div class="control-group">
            <div class="controls">
                <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'type'=>'info',
                    'size' => 'large',
                    'buttonType' => 'submit',
                    'encodeLabel' => false,
                    'label'=>'<i class="fa  fa-plus"></i> '.Yii::t('index', 'Create'), 
                )); ?>
                 <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'type'=>'default',
                    'size' => 'large',
                    'encodeLabel' => false,
                    'buttonType' => 'link',
                    'label'=>  '<i class="fa fa-sign-out"></i> '.Yii::t('common', 'Cancel'),
                    'url' => Yii::app()->createAbsoluteUrl('/regions/backend/main/admin')
                )); ?>
            </div>
        </div>
    <?php $this->endWidget(); ?>
</div>