<?php  $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	    'id'=>$this->modelName.'-form',
	    'enableAjaxValidation'=>true,
	    'htmlOptions'=>array('class'=>'form-horizontal'),
		)); ?>
	<?php echo $form->errorSummary($model); ?>
	<div class="control-group">
	  <?php echo $form->labelEx($model,'name', array('class' => 'control-label')); ?>
	  <div class="controls">
		<?php echo $form->textField($model, 'name', array('class'=>'span8')); ?>
	  </div>
	</div>
	<div class="control-group">
	  <?php echo $form->labelEx($model,'code', array('class' => 'control-label')); ?>
	  <div class="controls">
		<?php echo $form->textField($model, 'code', array('class'=>'span8')); ?>
	  </div>
	</div>
	<div class="control-group">
	  
	  <div class="controls">
	    <?php $this->widget('bootstrap.widgets.TbButton',
			   array('buttonType'=>'submit',
				   'type'=>'info',
				   'icon'=>'ok white',
				   'label'=> $model->isNewRecord ? tc('Add') : tc('Save'),
			   )); ?>
	  </div>
	</div>
	
<?php $this->endWidget(); ?>