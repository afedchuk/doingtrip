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

                            <p class="tip"><?php
                                    if($isGuest){
                                            echo BookingModule::t('Already used our services? Please <a title="Login" href="javascript:void(0);" id="login-ref">login</a>').'<br /><br />';
                                    }
                            ?></p>
        </div>
     
        <div class="modal-body">
                <p class="tip"><?php echo BookingModule::t('Tip booking form'); ?></p>
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
                'type'=>'primary',
                'buttonType' => 'submit',
                'label'=>ApartmentsModule::t('Send'),
                'htmlOptions'=>array('onclick' => 'reloadApartment.resultBlock = \'Booking-form\'; reloadApartment.loading();'),
            )); ?>
            <?php $this->widget('bootstrap.widgets.TbButton', array(
                                                                'type'=>'default',
                                                                'buttonType' => 'submit',
                                                                'encodeLabel' => false,
                                                                'label'=>Yii::t('common', 'Cancel'),
                                                                'htmlOptions' => array('data-dismiss' => "modal", 'aria-hidden' => "true")
                                                            )); ?>
        </div>
    <?php $this->endWidget(); ?>
<?php $this->endWidget(); ?>