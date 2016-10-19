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
            <h2><?php echo $model->description->title; ?></h2>      
        </div>
        <div class="modal-body">
            <p><?php echo BookingModule::t('Are you sure that you want to cancel your reservation?'); ?></p>
            <p class="tip"><?php echo BookingModule::t('Tip cancel booking'); ?></p>
        </div>
        <div class="modal-footer">
            <?php $this->widget('bootstrap.widgets.TbButton', array(
                                                                'type'=>'default',
                                                                'buttonType' => 'submit',
                                                                'encodeLabel' => false,
                                                                'label'=>Yii::t('common','Yes'),
                                                                'htmlOptions' => array('ajax' => array(
                                                                        'type' => 'POST',
                                                                        'url' => Yii::app()->createAbsoluteUrl('/booking/main/cancelbooking', array('id' => $model->id)),
                                                                        'success' => 'function(data) { 
                                                                            $("#modal-booking").modal("hide");
                                                                            window.location.reload();
                                                                         }',
                                                                        'data' => 'Booking[confirm]=ok',
                                                                        'processData' => false,
                                                                    )
                                                                )
                                                            )); ?>
          <?php $this->widget('bootstrap.widgets.TbButton', array(
                                                                'type'=>'default',
                                                                'buttonType' => 'submit',
                                                                'encodeLabel' => false,
                                                                'label'=>Yii::t('common', 'No'),
                                                                'htmlOptions' => array('data-dismiss' => "modal", 'aria-hidden' => "true")
                                                            )); ?>
        </div>
    <?php $this->endWidget(); ?>
<?php $this->endWidget(); ?>