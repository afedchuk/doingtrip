<?php
$this->pageTitle=Yii::app()->name . ' - ' . ConfigurationModule::t('Manage settings');
$title = 'title';
$this->breadcrumbs=array(
	ConfigurationModule::t('Settings')=>array('/configuration/backend/main'),
	ConfigurationModule::t('Update {name}', array('{name}'=>$model->$title)),
);
$this->adminTitle = ConfigurationModule::t('Update param "{name}"', array('{name}'=>$model->$title));
$this->menu = array(
    array('label' => ConfigurationModule::t('Settings'), 'url' => array('/configuration/backend/main/admin')),
    array('label' => ConfigurationModule::t('Add new setting'), 'url' => array('/configuration/backend/main/create')),
);
?>
<div class="profile-edit">
<?php  $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	    'id'=>$this->modelName.'-form',
	    'enableAjaxValidation'=>true,
	     'htmlOptions' => array('class' => 'form-horizontal'),
		)); ?>
		<div class="control-group">
            <?php echo $form->labelEx($model,'title', array('class'=>'control-label')); ?>
            <div class="controls">
                <?php echo $form->textField($model,'title',array('class'=>'span12','maxlength'=>255)); ?>
                <?php echo $form->error($model,'title'); ?>
            </div>
        </div>
        <div class="control-group">
            <?php echo $form->labelEx($model,'value', array('class'=>'control-label')); ?>
            <div class="controls">
                <?php echo $form->textField($model,'value',array('class'=>'span12','maxlength'=>255)); ?>
                <?php echo $form->error($model,'value'); ?>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'type'=>'info',
                    'size' => 'large',
                    'buttonType' => 'submit',
                    'encodeLabel' => false,
                    'label'=>'<i class="fa  fa-floppy-o"></i> '.Yii::t('index', 'Save'),
                )); ?>&nbsp;&nbsp;&nbsp;
                 <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'type'=>'default',
                    'size' => 'large',
                    'encodeLabel' => false,
                    'buttonType' => 'link',
                    'label'=>  '<i class="fa fa-sign-out"></i> '.Yii::t('common', 'Cancel'),
                    'url' => Yii::app()->createAbsoluteUrl('/configuration/backend/main/admin')
                )); ?>
            </div>
        </div>
<?php $this->endWidget(); ?>
</div>