<?php 


$this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'modal-booking')); ?>
    <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>$this->modelName.'-form-complaint',
            'enableAjaxValidation'=>true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
            'htmlOptions' => array('onsubmit'=>'return false;', 'class' => 'modal-wide')

    )); ?>
        <div class="modal-header">
            <a class="close" data-dismiss="modal">&times;</a>
            <h2><?php echo BookingModule::t('Complaint apartment').'<br/>'.$apartment->getStrByLang($apartment->id); ?></h2>
            <p class="tip"><?php echo BookingModule::t('Tip complaint'); ?></p>
        </div>
     
        <div class="modal-body">
            <?php if(Yii::app()->user->isGuest): ?>
                        <?php echo $form->labelEx($model,'username'); ?>
                        <?php echo $form->textField($model,'username', array('class' => 'span3')); ?>
                        <?php echo $form->error($model,'username'); ?>

                        <?php echo $form->labelEx($model,'email'); ?>
                        <?php echo $form->textField($model,'email', array('class' => 'span3')); ?>
                        <?php echo $form->error($model,'email'); ?>

                        <?php echo $form->labelEx($model,'phone'); ?>
                        <?php echo $form->textField($model,'phone', array('class'=>'phone span3')); ?>
                        <?php echo $form->error($model,'phone'); ?>
            <?php endif; ?>

                <?php echo $form->labelEx($model,'message'); ?>
                <?php echo $form->textArea($model,'message',array('class' => 'span3')); ?>
                <?php echo $form->error($model,'message'); ?>

        </div>
        <div class="modal-footer">
            <?php  echo CHtml::ajaxSubmitButton(ApartmentsModule::t('Send'),Yii::app()->createUrl('/booking/main/complaintapartment', array('id' => $apartment->id, 'title'=> isset($_GET['title']) ? $_GET['title'] : null)),
                                array(
                                    'type'=>'POST',
                                    'data'=> 'js:$("#Apartment-form-complaint").serialize()', 
                                    'success'=>'js:function(string){ }',
                                    'complete' => 'js:function() { location = "'.$apartment->getUrl(null, 0, City::getCityName($apartment->city_id)).'"; }'
                                ),array('class'=>'btn btn-success', 'id'=>'submit-complaint' ));
            ?>
           
        </div>
    <?php $this->endWidget(); ?>
<?php $this->endWidget(); ?>


