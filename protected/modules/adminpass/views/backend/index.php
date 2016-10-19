
<?php
	$this->adminTitle = Yii::t('common', "Change admin password");
	$this->pageTitle=Yii::app()->name . ' - ' . Yii::t('common', "Change admin password");
  $this->breadcrumbs=array(
    Yii::t('common', "Change admin password"),
  );

	$model->scenario = 'changeAdminPass';
	$model->password = '';
	$model->password_repeat = '';

  $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
      'id'=>$this->modelName.'-form',
      'enableAjaxValidation'=>true,
  )); 
	?>
	<p class="note"><?php echo Yii::t('common', 'Fields with <span class="required">*</span> are required.'); ?></p>

    <?php echo $form->errorSummary($model); ?>

    <div class="rowold">
        <?php echo $form->labelEx($model,'old_password'); ?>
        <?php echo $form->passwordField($model,'old_password', array('class'=>'span3')); ?>
        <?php echo $form->error($model,'old_password'); ?>
    </div>

    <div class="rowold">
        <?php echo $form->labelEx($model,'password'); ?>
        <?php echo $form->passwordField($model,'password', array('class'=>'span3')); ?>
        <?php echo $form->error($model,'password'); ?>
    </div>

    <div class="rowold">
        <?php echo $form->labelEx($model,'password_repeat'); ?>
        <?php echo $form->passwordField($model,'password_repeat', array('class'=>'span3')); ?>
        <?php echo $form->error($model,'password_repeat'); ?>
    </div>

    <div class="rowold buttons">
           <?php $this->widget('bootstrap.widgets.TbButton',
                       array('buttonType'=>'submit',
                           'type'=>'info',
                           'icon'=>'ok white',
                           'label'=> tc('Change'),
                       )); ?>
    </div>
<?php $this->endWidget(); ?>