<?php
$this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Restore");
?>
<div class="row-fluid relative mrgT55">
    
    <div class="span5">
        <div class="well authorization">
                <?php $form=$this->beginWidget('CActiveForm', array(
                            'id'=>$this->modelName.'-form',
                            'enableAjaxValidation'=>true,
                            'enableClientValidation'=>false,
                            'clientOptions' => array(
                                'validateOnSubmit' => false,
                                'validateOnChange' => false,
                            ),

                         )); ?>
                
                <div class="header-title">
                    <h4><?php echo UserModule::t("Restore"); ?></h4>     
                </div>
                <p class="input-desc">
                    <?php echo UserModule::t('Restore tip message'); ?>
                </p>
                <?php echo $form->textField($model,'login_or_email',  array('class' => 'span12', 'placeholder' => User::model()->getAttributeLabel('email'))) ?>
                <div class="error">
                    <?php echo $form->error($model,'login_or_email'); ?>
                </div>

                <div class="mrgT15">
                    <button class="btn btn-large btn-info">
                        <span><i class="fa fa-wrench "></i> <?php echo UserModule::t("Restore"); ?></span>
                    </button>
                </div>
                <?php $this->endWidget(); ?>
            </div>
    </div>
    <?php echo $this->renderPartial('user.views.user.menu');?> 
</div>
