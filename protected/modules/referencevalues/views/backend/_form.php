<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>$this->modelName.'-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?php echo Yii::t('common', 'Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'reference_category_id'); ?>
		<?php echo $form->dropDownList($model,'reference_category_id', $this->getCategories(1)); ?>
		<?php echo $form->error($model,'reference_category_id'); ?>
	</div>

	<div class="row">
		<div class="full-multicolumn-first">
			<?php echo $form->labelEx($model->description,'title', array()); ?>
			<?php echo $form->textField($model->description,'title',array('maxlength'=>255)); ?>
			<?php echo $form->error($model->description,'title'); ?>
		</div>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->