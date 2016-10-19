<?php
$this->pageTitle= UserModule::t("Registration message") . ' - '.$this->pageTitle;
?>
<div class="row-fluid mrgT55 relative">
    <div class="span5">
        <div class="well authorization">
                <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>$this->modelName.'-form',
                    'enableAjaxValidation'=>true,
                    'enableClientValidation'=>false,
                    'clientOptions' => array(
                        'validateOnSubmit' => false,
                        'validateOnChange' => true,
                    )

                 )); ?>

                <div class="header-title">
                    <h4><?php echo UserModule::t('Registration message'); ?></h4>    
                </div>
                <div class="control-group">
                    <div class="controls">
                        <?php echo $form->textField($model,'email', array('placeholder' => User::model()->getAttributeLabel('email'), 'class' => 'span12')); ?>
                        <div class="error">
                            <?php echo $form->error($model,'email'); ?>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <?php echo $form->textField($model,'firstname', array('placeholder' => User::model()->getAttributeLabel('firstname'), 'class' => 'span12')); ?>
                        <div class="error">
                            <?php echo $form->error($model,'firstname'); ?>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <?php echo $form->textField($model,'lastname', array('placeholder' => User::model()->getAttributeLabel('lastname'), 'class' => 'span12')); ?>
                        <div class="error">
                            <?php echo $form->error($model,'lastname'); ?>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <?php echo $form->textField($model,'phone', array('placeholder' => User::model()->getAttributeLabel('phone'), 'class' => 'span12 phone')); ?>
                        <div class="error">
                            <?php echo $form->error($model,'phone'); ?>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <?php echo $form->passwordField($model,'password', array('placeholder' => User::model()->getAttributeLabel('password'), 'class' => 'span12')); ?>
                        <div class="error">
                            <?php echo $form->error($model,'password'); ?>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <?php echo $form->passwordField($model,'verifyPassword', array('placeholder' => User::model()->getAttributeLabel('verifyPassword'), 'class' => 'span12')); ?>
                        <div class="error">
                            <?php echo $form->error($model,'verifyPassword'); ?>
                        </div>
                    </div>
                </div>
                <?php if (UserModule::doCaptcha('registration')): ?>
                    <div class="control-group">
                        <div class="controls"><br/>
                            <?php $this->widget('CCaptcha', array('captchaAction'=>'/user/main/captcha')); ?><br/><br/>
                            <?php echo $form->textField($model,'verifyCode', array('placeholder' => User::model()->getAttributeLabel('verifyCode'), 'class' => 'span12')); ?>
                            <div class="error">
                                <?php echo $form->error($model,'verifyCode'); ?>
                            </div>
                            <br/>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="control-group">
                    <div class="controls">
                      <?php echo $form->checkBox($model,'subscription', array('checked' => true)); ?>
                     <?php echo UserModule::t('Tip subscription'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                      <?php echo $form->checkBox($model,'agreement', array('checked' => true)); ?>
                      <?php echo UserModule::t('Tip part agreement'); ?>"<a title="<?php echo UserModule::t('Terms of service'); ?>" target="_blank" href="<?php echo Page::getUrl(2); ?>"><?php echo UserModule::t('Terms of service'); ?></a>"
                      <div class="error">
                            <?php echo $form->error($model,'agreement'); ?>
                      </div>
                    </div>
                </div>
                 <div class="clear"></div>
                <div class="control-group mrgT35">
                    <div class="controls">
                        <button class="btn btn-info btn-large" onclick="encrypt('RegistrationForm-form');">
        	                    <i class="fa fa-plus-circle"></i> <span><?php echo UserModule::t("Register"); ?></span>
                        </button>
                    </div>
                </div>
                <div class="clear"></div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
    <?php echo $this->renderPartial('user.views.user.menu');?> 
</div>


        
        
