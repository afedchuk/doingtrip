<?php
$this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Login");
?>
<div class="row-fluid relative mrgT55">
    <div class="span5">
        <div class="well authorization">
            <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>$this->modelName.'-form',
                        'enableAjaxValidation'=>false,
                        'enableClientValidation'=>false,
                        'htmlOptions'=> array('enctype' => 'multipart/form-data')
                     )); ?>
            <div class="header-title">
                <h4><?php echo UserModule::t("Login"); ?></h4>     
            </div>
            
            <div class="control-group mrgT15">
                <div class="controls">
                    <?php $this->widget('ext.eauth.EAuthWidget', array('action' => 'user/main/login')); ?>
                </div>
                <!--div class="button-header">
                    <i class="button-header-text">Or</i>
                </div-->
            </div>
            <?php echo UserModule::t("Please fill out the following form with your login credentials:"); ?><br/><br/>
            <div class="error">
                <?php echo $form->error($model,'status'); ?>
            </div>
            <div class="control-group">
                    <div class="controls">
                        <?php echo $form->textField($model,'username', array('class' => 'span12', 'placeholder' => User::model()->getAttributeLabel('email'))) ?>
                        <div class="error">
                            <?php echo $form->error($model,'username'); ?>
                        </div>
                    </div>
            </div>
            <div class="control-group">
                    <div class="controls">
                        <?php echo $form->passwordField($model,'password', array('class' => 'span12', 'placeholder' => User::model()->getAttributeLabel('password'))) ?>
                        <div class="error">
                            <?php echo $form->error($model,'password'); ?>
                        </div>
                    </div>
            </div>
            <div class="clear"></div>
            <div class="control-group mrgT35">
                 <div class="controls">
                    <button class="btn btn-info btn-large" onclick="encrypt('UserLogin-form');">
                        <i class="fa fa-sign-in"></i> <span><?php echo UserModule::t("Enter"); ?></span>
                    </button>
                </div>
            </div>
            <div class="clear"></div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
    <?php echo $this->renderPartial('user.views.user.menu');?> 
</div>
