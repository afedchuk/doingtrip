<div class="profile-edit">
<?php
	$form=$this->beginWidget('CActiveForm', array(
		'id'=>$this->modelName.'-form',
		'enableAjaxValidation'=>false,
        'htmlOptions' => array('class' => 'form-horizontal'),
	));
	$model->password = '';
	$model->password_repeat = '';
	?>

	
	<div class="control-group">
	    <?php echo $form->labelEx($model,'username', array('class' => 'control-label')); ?>
	    <div class="controls">
	        <?php echo $form->textField($model,'username',array('class' =>'span8','maxlength'=>128)); ?>
	        <?php echo $form->error($model,'username'); ?>
	    </div>
	</div>

	<div class="control-group">
	    <?php echo $form->labelEx($model,'firstname', array('class' => 'control-label')); ?>
	    <div class="controls">
	        <?php echo $form->textField($model,'firstname',array('class' =>'span8','maxlength'=>128)); ?>
	        <?php echo $form->error($model,'firstname'); ?>
	    </div>
	</div>

	<div class="control-group">
	    <?php echo $form->labelEx($model,'lastname', array('class' => 'control-label')); ?>
	    <div class="controls">
	        <?php echo $form->textField($model,'lastname',array('class' =>'span8','maxlength'=>128)); ?>
	        <?php echo $form->error($model,'lastname'); ?>
	    </div>
	</div>

	<div class="control-group">
	    <?php echo $form->labelEx($model,'email', array('class' => 'control-label')); ?>
	    <div class="controls">
	        <?php echo $form->textField($model,'email',array('class' =>'span8','maxlength'=>128)); ?>
	        <?php echo $form->error($model,'email'); ?>
	    </div>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model,'phone', array('class' => 'control-label')); ?>
		<div class="controls">
			<?php echo $form->textField($model,'phone',array('class' =>'span8 phone','maxlength'=>128)); ?>
			<?php echo $form->error($model,'phone'); ?>
		</div>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model,'phone_additional', array('class' => 'control-label')); ?>
		<div class="controls">
			<?php echo $form->textField($model,'phone_additional',array('class' =>'span8 phone','maxlength'=>128)); ?>
			<?php echo $form->error($model,'phone_additional'); ?>
		</div>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model,'skype', array('class' => 'control-label')); ?>
		<div class="controls">
			<?php echo $form->textField($model,'skype',array('class' =>'span8','maxlength'=>128)); ?>
			<?php echo $form->error($model,'skype'); ?>
		</div>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model,'website', array('class' => 'control-label')); ?>
		<div class="controls">
			<?php echo $form->textField($model,'website',array('class' =>'span8','maxlength'=>128)); ?>
			<?php echo $form->error($model,'website'); ?>
		</div>
	</div>

	<?php if(issetModule('paidservices')){ ?>
    <div class="rowold">
		<?php echo $form->labelEx($model,'balance'); ?>
		<?php echo $form->textField($model,'balance',array('size'=>20,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'balance'); ?>
    </div>
	<?php } ?>

	<?php if (!$model->superuser) : ?>
		<?php if(!$model->isNewRecord) : ?>
			<div class="control-group">
				<div class="controls">
					<p class="desc">
						<?php echo UserModule::t('admin_change_pass_user_help');?>
					</p>
				</div>
			</div>
		<?php endif; ?>
		<div class="control-group">
			<?php echo $form->labelEx($model,'password', array('class' => 'control-label')); ?>
			<div class="controls">
				<?php echo $form->passwordField($model,'password',array('class' =>'span8','maxlength'=>128)); ?>
				<?php echo $form->error($model,'password'); ?>
			</div>
		</div>

		<div class="control-group">
			<?php echo $form->labelEx($model,'password_repeat', array('class' => 'control-label')); ?>
			<div class="controls">
				<?php echo $form->passwordField($model,'password_repeat',array('class' =>'span8','maxlength'=>128)); ?>
				<?php echo $form->error($model,'password_repeat'); ?>
			</div>
		</div>
	<?php endif; ?>

	<div class="control-group">
        <div class="controls">
            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'type'=>'info',
                'size' => 'large',
                'buttonType' => 'submit',
                'encodeLabel' => false,
                'label'=>'<i class="fa  fa-floppy-o"></i> '. $model->isNewRecord ? tc('Create') : tc('Save'),
            )); ?>
             <?php $this->widget('bootstrap.widgets.TbButton', array(
                'type'=>'default',
                'size' => 'large',
                'encodeLabel' => false,
                'buttonType' => 'link',
                'label'=>  '<i class="fa fa-sign-out"></i> '.Yii::t('common', 'Cancel'),
                'url' => Yii::app()->createAbsoluteUrl('/user/backend/main/admin')
            )); ?>
        </div>
    </div>

<?php $this->endWidget(); ?>
</div>