<?php
$this->pageTitle .= ' - '.  ContactformModule::t('Contact Us');
?>
<div class="mrgT55 relative row-fluid">
    <div class="span5">
        <div class="well authorization">
         <?php $form=$this->beginWidget('CActiveForm', array(
                            'id'=>$this->modelName.'-form',
                            'enableAjaxValidation'=>true,
                            'enableClientValidation'=>false,
                            'clientOptions' => array(
                                'validateOnSubmit' => false,
                                'validateOnChange' => true,
                            ),

                         )); ?>

            <div class="header-title">
                <h4><?php echo ContactformModule::t('Contact title'); ?></h4>     
            </div>
            <p class="input-desc">
                    <?php echo ContactformModule::t('Notice contact form'); ?> 
                    <?php echo $form->error($model,'user_id'); ?>
            </p>
            <?php if(Yii::app()->user->isGuest) { ?>
            <div class="control-group">
                <div class="controls">
                    <?php echo $form->textField($model,'name', array('placeholder' => User::model()->getAttributeLabel('firstname'), 'class'=>'span12')); ?>
                    <div class="error">
                        <?php echo $form->error($model,'name'); ?>
                    </div>
                </div>
            </div>

            <div class="control-group">
                <div class="controls">
                    <?php echo $form->textField($model,'email', array('placeholder' => User::model()->getAttributeLabel('email'), 'class'=>'span12')); ?>
                    <div class="error">
                        <?php echo $form->error($model,'email'); ?>
                    </div>
                </div>
            </div>

            <div class="control-group">
                <div class="controls">
                    <?php echo $form->textField($model,'phone', array('class' => 'phone' ,'placeholder' => User::model()->getAttributeLabel('phone'), 'class'=>'span12')); ?>
                    <div class="error">
                        <?php echo $form->error($model,'phone'); ?>
                    </div>
                </div>
            </div>
            <?php } ?>
            <div class="control-group">
                <div class="controls">
                    <?php echo $form->textArea($model,'body', array('class'=>'span3 ','placeholder' => $model->getAttributeLabel('body'), 'class'=>'span12')); ?>
                    <div class="error">
                        <?php echo $form->error($model,'body'); ?>
                    </div>
                </div>
            </div>

            
            <?php
            if (Yii::app()->user->isGuest){
            ?>        
                <div class="control-group ">
                    <div class="controls">
                        <?php $this->widget('CCaptcha', array('captchaAction'=>'/contactform/main/captcha')); ?><br/><br/>
                        <?php echo $form->textField($model,'verifyCode', array('id'=>'captcha', 'placeholder' => User::model()->getAttributeLabel('verifyCode'), 'class'=>'span12')); ?><br/>
                        <div class="error">
                            <?php echo $form->error($model,'verifyCode'); ?>
                        </div>
                     </div>
                 </div>
            <?php
            }
            ?>
           
            <div class="clear"></div>
            <div class="control-group mrgT35">
                <div class="controls">
                    <button class="btn btn-info btn-large">
                        <i class="fa fa-envelope"></i> <?php echo ContactformModule::t('Send message'); ?>
                    </button>
                </div>
            </div>
            <div class="clear"></div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
    <?php echo $this->renderPartial('user.views.user.menu');?> 
</div>
