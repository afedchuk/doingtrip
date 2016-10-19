<div class="gb5">
    <div id="container">
        <?php if (Yii::app()->user->isGuest) : ?>
            <div id="topnav" class="topnav"> <?php echo CHtml::link(Yii::t('user', 'Registration'), Yii::app()->createAbsoluteUrl('user/main/registration') ); ?> <a class="signin"><span><?php echo Yii::t('user', 'Enter'); ?></span></a> </div>
            <?php $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'login-form',
                            'enableClientValidation' => true,
                            'clientOptions' => array(
                                'validateOnSubmit' => true
                            ),
                           'action'=>Yii::app()->createUrl('/user/login')
                        )
                    );
            ?>
            <fieldset id="signin_menu">
                    <p>
                        <?php echo $form->labelEx($model,'username'); ?>
                        <?php echo $form->textField($model,'username'); ?>
                        <?php echo $form->error($model,'username'); ?>
                    </p>
                    <p>
                        <?php echo $form->labelEx($model,'password'); ?>
                        <?php echo $form->passwordField($model,'password'); ?> 
                        <?php echo $form->error($model,'password'); ?>
                    </p>

                    <p class="remember">
                        <?php $this->widget('bootstrap.widgets.TbButton', array(
                                    'label'=>Yii::t('user', 'Enter button'),
                                    'buttonType' => 'button',
                                    'type'=>'warning', 
                                    'size'=>'small', 
                                    'htmlOptions' => array('onclick' => '$("#login-form").submit();')
                                )); 
                       ?> 
                        <a class="forgot" id="resend_password_link" href="<?php echo Yii::app()->createAbsoluteUrl('user/recovery'); ?>"><?php echo Yii::t('user', 'Forgot your password?');?></a> 
                    </p>
            </fieldset>
            <?php $this->endWidget(); ?>
        <?php endif; ?>
    </div>
</div>
<?php  Yii::app()->clientScript->registerScript(
           'loginBox',
           '$(document).ready(function() {
                $(".signin").click(function(e) {
                    e.preventDefault();
                    $("fieldset#signin_menu").toggle();
                    $(".signin").toggleClass("menu-open");
                });

                $("fieldset#signin_menu").mouseup(function() {
                    return false
                });
                $(document).mouseup(function(e) {
                    if($(e.target).parent("a.signin").length==0) {
                        $(".signin").removeClass("menu-open");
                        $("fieldset#signin_menu").hide();
                    }
                });
            });',
        
           CClientScript::POS_END
       );
?>