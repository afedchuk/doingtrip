<?php 
$this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'modal-booking')); ?>
    <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>$this->modelName.'-form',
            'enableAjaxValidation'=>true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            )

    )); ?>
        <div class="modal-header">
            <a class="close" data-dismiss="modal">&times;</a>
            <h2><?php echo BookingModule::t('Booking apartment').'<br/>'.$apartment->getStrByLang($apartment->id); ?></h2>
        </div>
     
        <div class="modal-body">
                <?php
                        $this->renderPartial('_form', array(
                                'model' => $model,
                                'form' => $form,
                                'isGuest' => $isGuest,
                                'isSimpleForm' => false,

                        ));
                ?>  
        </div>
        <div class="modal-footer">

            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'type'=>'success',
                'size' => 'small',
                'buttonType' => 'submit',
                'label'=>ApartmentsModule::t('Send'),
                'htmlOptions'=>array(),
            )); ?>
        </div>
    <?php $this->endWidget(); ?>
<?php $this->endWidget(); ?>