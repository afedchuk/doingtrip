<?php   
	if($isGuest){
		?>
   	
            <?php echo $form->labelEx($model,'firstname'); ?>
            <?php echo $form->textField($model, 'firstname', array('class'=>' span3')); ?>
            <?php echo $form->error($model,'firstname'); ?>
    
            <?php echo $form->labelEx($model,'lastname'); ?>
            <?php echo $form->textField($model,'lastname', array('class'=>'span3')); ?>
            <?php echo $form->error($model,'lastname'); ?>
   
            <?php echo $form->labelEx($model,'phone'); ?>
            <?php echo $form->textField($model,'phone', array('class'=>'phone span3')); ?>
            <?php echo $form->error($model,'phone'); ?>
              

			<?php echo $form->labelEx($model,'useremail'); ?>
			<?php echo $form->textField($model,'useremail', array('class'=>'phone span3')); ?>
			<?php echo $form->error($model,'useremail'); ?>

      
		<?php
	}
?>

<?php if ($isSimpleForm) { echo '<div id="rent_form">'; } ?>
        
		
		<?php

		if(!$model->date_start){
			//$model->date_start = Yii::app()->dateFormatter->format($dateFormat, time());
			$model->date_start = Yii::app()->dateFormatter->formatDateTime(time(), 'medium', null);
			if(Yii::app()->language == 'en'){
				$model->date_start = date('m/d/Y');
			}
		} ?>

		<div class="control-group">
	        <?php echo $form->labelEx($model,'date_start'); ?>
	        <div class="controls">
	            <?php $this->widget('application.extensions.FJuiDatePicker', array(
					'model'=>$model,
					'attribute'=>'date_start',
					'language' => Yii::app()->language,
					'htmlOptions' => array( 'value' => ''),
					'options'=>array(
						'dateFormat'=>'yy-mm-dd',
						'minDate'=>'new Date()',
					),
					'htmlOptions' => array('class' => 'span2')
				)); ?>
				<?php echo $form->dropDownList($model,'time_in', hoursRange(), array('options' => array('00:00'=>array('selected'=>true)),  'class'=>'span1')); ?>
	            <?php echo $form->error($model,'date_start'); ?>
	            <?php echo $form->error($model,'time_in'); ?>
	        </div>
		</div>

		<div class="control-group">
	        <?php echo $form->labelEx($model,'date_end'); ?>
	        <div class="controls">
	            <?php $this->widget('application.extensions.FJuiDatePicker', array(
					'model'=>$model,
					'attribute'=>'date_end',
					'language' => Yii::app()->language,
					'htmlOptions' => array( 'value' => ''),
					'options'=>array(
						'dateFormat'=>'yy-mm-dd',
						'minDate'=>'new Date()',
					),
					'htmlOptions' => array('class' => 'span2')
				)); ?>
				<?php echo $form->dropDownList($model,'time_out', hoursRange(), array('options' => array('00:00'=>array('selected'=>true)),  'class'=>'span1')); ?>
	            <?php echo $form->error($model,'date_end'); ?>
	            <?php echo $form->error($model,'time_out'); ?>
	        </div>
		</div>

		<div class="clear"></div>

		<div class="control-group">
	        <?php echo $form->labelEx($model,'guests', array('class'=>'control-label')); ?>
	        <div class="controls">
	            <?php echo $form->dropDownList($model,'adult', array_merge(array('0' => 0), range(1, 10)), array('class' => 'span1')); ?> <i data-title="<?php echo BookingModule::t('Adult'); ?>" data-toggle="tooltip" class="fa fa-male"></i>
	            <?php echo $form->dropDownList($model,'child', array_merge(array('0' => 0), range(1, 10)), array('class' => 'span1')); ?> <i data-title="<?php echo BookingModule::t('Child'); ?>" data-toggle="tooltip" class="fa fa-child"></i>
	            <?php echo $form->error($model,'adult'); ?>
	            <p class="input-desc"><?php echo BookingModule::t('Tip guests'); ?></p>
	        </div>
		</div>

<?php if ($isSimpleForm) { echo '</div>'; } ?>


<?php echo $form->labelEx($model,'comment'); ?>
<?php echo $form->textArea($model,'comment',array('class'=>'span3')); ?>
<?php echo $form->error($model,'comment'); ?>
