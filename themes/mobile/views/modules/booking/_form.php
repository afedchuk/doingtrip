<?php   
	if($isGuest){
		?>
            <?php echo $form->textField($model, 'firstname', array( 'placeholder' => Booking::model()->getAttributeLabel('firstname'))); ?>
            <?php echo $form->error($model,'firstname'); ?>

            <?php echo $form->textField($model,'lastname', array('placeholder' => Booking::model()->getAttributeLabel('lastname'))); ?>
            <?php echo $form->error($model,'lastname'); ?>

            <?php echo $form->textField($model,'phone', array('placeholder' => Booking::model()->getAttributeLabel('phone'))); ?>
            <?php echo $form->error($model,'phone'); ?>
              
			<?php echo $form->textField($model,'useremail', array( 'placeholder' => Booking::model()->getAttributeLabel('useremail'))); ?>
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
		}


		$this->widget('application.extensions.FJuiDatePicker', array(
			'model'=>$model,
			'attribute'=>'date_start',
			'language' => Yii::app()->language,
			'htmlOptions' => array( 'value' => '', 'placeholder' => Booking::model()->getAttributeLabel('date_start')),
			'options'=>array(
				'dateFormat'=>'yy-mm-dd',
				'minDate'=>'new Date()',
			),
		)); ?>

            
        <?php echo $form->labelEx($model,'time_in'); ?>
		<?php echo $form->dropDownList($model,'time_in', $this->getTimesIn(), array()); ?>
		<?php echo $form->error($model,'time_in'); ?>
		<?php

		$this->widget('application.extensions.FJuiDatePicker', array(
			'model'=>$model,
			'attribute'=>'date_end',
			'language' => Yii::app()->language,
			'htmlOptions' => array( 'value' => '', 'placeholder' => Booking::model()->getAttributeLabel('date_end')),
			'options'=>array(
				'dateFormat'=>'yy-mm-dd',
                'minDate'=>'new Date()',
			),
			));

		?>
		<?php echo $form->error($model,'date_end'); ?>

		<?php echo $form->labelEx($model,'time_out'); ?>
		<?php echo $form->dropDownList($model,'time_out', $this->getTimesOut(), array()); ?>
		<?php echo $form->error($model,'time_out'); ?>


<?php if ($isSimpleForm) { echo '</div>'; } ?>


<?php echo $form->labelEx($model,'comment'); ?>
<?php echo $form->textArea($model,'comment',array()); ?>
<?php echo $form->error($model,'comment'); ?>
