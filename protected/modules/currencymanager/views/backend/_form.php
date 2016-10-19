<?php
	$form=$this->beginWidget('CustomForm', array(
	'id'=>$this->modelName.'-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('class' => 'form-horizontal')
)); ?>

	<p class="note"><?php echo Yii::t('common', 'Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo $form->errorSummary($model); ?>
    <div class="rowold">
        <?php echo $form->labelEx($model,'active'); ?>
        <?php echo $form->dropDownList($model, 'active', array(
            '1' => tc('Active'),
            '0' => tc('Inactive'),
        ), array('class' => 'width150')); ?>
        <?php echo $form->error($model,'active'); ?>
    </div>
    <div class="rowold">
		<?php echo $form->labelEx($model,'country'); ?>
		<?php echo $form->textField($model, 'country'); ?>
		<?php echo $form->error($model,'country'); ?>
    </div>

	<br/>

	<?php if($model->isNewRecord) { ?>

	<?php } else { ?>
	
	<?php } ?>

	<div class="rowold">
		<?php echo $form->labelEx($model,'currency'); ?>
		<?php echo $form->textField($model, 'currency'); ?>
		<?php echo $form->error($model,'currency'); ?>
	</div>
    
    <div class="rowold">
		<?php echo $form->labelEx($model,'currency_code'); ?>
		<?php echo $form->textField($model, 'currency_code'); ?>
		<?php echo $form->error($model,'currency_code'); ?>
	</div>
    
    <div class="rowold">
		<?php echo $form->labelEx($model,'conversion_rate'); ?>
		<?php echo $form->textField($model, 'conversion_rate'); ?>
		<?php echo $form->error($model,'conversion_rate'); ?>
	</div>

	<div class="clear"></div>

	<div class="rowold buttons">
		   <?php $this->widget('bootstrap.widgets.TbButton',
					   array('buttonType'=>'submit',
						   'type'=>'primary',
						   'icon'=>'ok white',
						   'label'=> $model->isNewRecord ? tc('Add') : tc('Save'),
					   )); ?>
	</div>

<?php $this->endWidget(); ?>