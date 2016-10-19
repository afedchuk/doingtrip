<?php 
$this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'contain')); ?>
    <?php $form=$this->beginWidget('CActiveForm', array(
    		'id'=>$this->modelName.'-form',
          	'enableAjaxValidation'=>true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
            'htmlOptions' => array('class' => 'form-horizontal')

    )); ?>
        <div class="modal-header">
            <a class="close" data-dismiss="modal">&times;</a>
            <h2><?php echo MessageModule::t('Compose New Message'); ?></h2>      
        </div>
     	
        <div class="modal-body">
        	<p class="tip"><?php echo BookingModule::t('Tip send message'); ?></p>
                <?php echo $form->labelEx($model,'subject'); ?>
	            <?php echo $form->textField($model, 'subject', array('class'=>' span3', 'value' => BookingModule::t('Booking apartment {title}', array('{title}' => $apartment->description->title)))); ?>
	            <?php echo $form->error($model,'subject'); ?>

	            <?php echo $form->labelEx($model,'comment'); ?>
				<?php echo $form->textArea($model,'comment',array('class'=>'span3')); ?>
				<?php echo $form->error($model,'comment'); ?>

        </div>
        <div class="modal-footer">
            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'type'=>'default',
                'size' => 'small',
                'icon' => 'envelope',
                'buttonType' => 'submit',
                'label'=>ApartmentsModule::t('Send'),
                'htmlOptions'=>array(),
            )); ?>
        </div>
    <?php $this->endWidget(); ?>
<?php $this->endWidget(); ?>