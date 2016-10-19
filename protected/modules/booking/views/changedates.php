<?php 
$this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'modal-booking')); ?>
    <?php $form=$this->beginWidget('CActiveForm', array(
    		'id'=>$this->modelName.'-form',
          	'enableAjaxValidation'=>true,
            'clientOptions' => array(
                'validateOnSubmit' => false,
            ),
            'htmlOptions' => array('class' => 'form-horizontal')

    )); ?>
        <div class="modal-header">
            <a class="close" data-dismiss="modal">&times;</a>
            <h2><?php echo BookingModule::t('Change dates for {p}', array('{p}' => $model->description->title)); ?></h2>      
        </div>
        <div class="modal-body">
            <?php echo $form->labelEx($model,'date_start'); ?>
            <?php $this->widget('application.extensions.FJuiDatePicker', array(
                                'model'=>$model,
                                'name' => 'Booking[date_start]',
                                'value' => $model->date_start,
                                'language' => Yii::app()->language,
                                'htmlOptions' => array('class' => 'span3'),
                                'options'=>array(
                                    'dateFormat'=>'yy-mm-dd',
                                    'minDate'=>'new Date()',
                                ),
                    )); 
            ?>
            <?php echo $form->error($model,'date_start'); ?>
            <?php echo $form->labelEx($model,'date_end'); ?>
			<?php $this->widget('application.extensions.FJuiDatePicker', array(
                                'model'=>$model,
                                'name' => 'Booking[date_end]',
                                'value' => $model->date_end,
                                'language' => Yii::app()->language,
                                'htmlOptions' => array('class' => 'span3'),
                                'options'=>array(
                                    'dateFormat'=>'yy-mm-dd',
                                    'minDate'=>'new Date()',
                                ),
                    )); 
            ?>
			<?php echo $form->error($model,'date_end'); ?>
        </div>
        <div class="modal-footer">
            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'type'=>'info',
                'icon' => 'repeat white',
                'buttonType' => 'submit',
                'label'=>BookingModule::t('Change dates'),
                'htmlOptions'=>array(),
            )); ?>
        </div>
    <?php $this->endWidget(); ?>
<?php $this->endWidget(); ?>