<?php
$this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Login");
?>
<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'modal-booking')); ?>
<?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>$this->modelName.'-form',
                        'enableAjaxValidation'=>true,
                        'enableClientValidation'=>false,
                        'clientOptions' => array(
                            'validateOnSubmit' => false,
                            'validateOnChange' => true,
                        )
                     )); ?>
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4><?php echo UserModule::t("Login"); ?></h4>    
</div>
 
<div class="modal-body">
    <?php echo UserModule::t("Please fill out the following form with your login credentials:"); ?>
    <?php $this->widget('ext.eauth.EAuthWidget', array('action' => 'user/main/login')); ?>
    <?php echo $form->error($model,'status'); ?>
    <?php echo $form->labelEx($model,'username', array('class' => 'control-label')); ?>
    <?php echo $form->textField($model,'username', array('class'=>'span3')) ?>
    <?php echo $form->error($model,'username'); ?>
    <?php echo $form->labelEx($model,'password', array('class' => 'control-label')); ?>
    <?php echo $form->passwordField($model,'password', array('class'=>'span3')) ?>
    <?php echo $form->error($model,'password'); ?>
</div>
 
<div class="modal-footer">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'type'=>'info',
        'label'=>UserModule::t("Login"),
        'url'=>'#',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'Close',
        'url'=>'#',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); ?>
</div>
<?php $this->endWidget(); ?>
<?php $this->endWidget(); ?>