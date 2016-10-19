<?php $this->pageTitle=Yii::app()->name . ' - '.MessageModule::t("Compose New Message"); ?>
<?php
	$this->breadcrumbs=array(
        UserModule::t("Profile")=>array('/user/profile'),
        MessageModule::t("Inbox") => array('/message/inbox'),
		MessageModule::t("Compose New Message"),
	);
?>

<div class="row-fluid profile-edit">
    <div class="span9">
        <div class="well">
            <div class="page-header">
                <h4><?php echo MessageModule::t('Compose New Message'); ?></h4>
            </div>
        	<?php $form = $this->beginWidget('CActiveForm', array(
        		'id'=>'message-form',
        		'enableAjaxValidation'=>false,
        		'htmlOptions' => array('class' => 'form-horizontal well'),
        	)); ?>
    
        	<div class="control-group">
        		<?php echo $form->labelEx($model,'receiver_id', array('class'=>'control-label')); ?>
                <div class="controls">
                    <div class="input-append span11">
                      <?php echo CHtml::textField('receiver', $receiverName, array('class' => 'span12')) ?>
                       <span class="add-on"><i class="icon-user"></i></span>
                    </div>
        			<?php echo $form->hiddenField($model,'receiver_id'); ?>
                    <?php if($form->error($model,'receiver_id')): ?>
                        <?php echo $form->error($model,'receiver_id'); ?>
                    <?php else: ?>
                        <p class="input-desc">Начните вводить имя или фамилию получателя, Вам автоматичски будет предлождено список пользователей из котоорого Вы можете выбрать получателя.</p>
                   <?php endif; ?> 
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                  <?php echo $form->checkBox($model,'adminLetter', array('checked' => false)); ?>
                  <?php echo MessageModule::t('Tip is admin letter?'); ?>
                  <?php if($form->error($model,'adminLetter')): ?>
                        <?php echo $form->error($model,'adminLetter'); ?>
                   <?php endif; ?> 
                </div>
            </div>
        	<div class="control-group">
        		<?php echo $form->labelEx($model,'subject', array('class'=>'control-label')); ?>
                <div class="controls">
                    <?php echo $form->textField($model,'subject', array('class' => 'span12')); ?>
                    <?php echo $form->error($model,'subject'); ?>
                </div>
            </div>

            <div class="control-group">
        		<?php echo $form->labelEx($model,'body', array('class'=>'control-label')); ?>
                <div class="controls">
                    <?php echo $form->textArea($model,'body', array('class' => 'span12', 'rows' => 2)); ?>
                    <?php if($form->error($model,'body')): ?>
                        <?php echo $form->error($model,'body'); ?>
                   <?php endif; ?>
                </div>
            </div>
            <div class="clear"></div>
            <div class="control-group">
                <div class="controls">
                    <?php $this->widget('bootstrap.widgets.TbButton', array(
                        'type'=>'info',
                        'size' => 'large',
                        'buttonType' => 'submit',
                        'encodeLabel' => false,
                        'label'=>($model->isNewRecord ? '<i class="fa  fa-envelope"></i> '.Yii::t('common', 'Send letter') : '<i class="fa  fa-floppy-o"></i> '.Yii::t('index', 'Save')),
                    )); ?>&nbsp;&nbsp;&nbsp;
                    <?php $this->widget('bootstrap.widgets.TbButton', array(
                                'type'=>'default',
                                'size' => 'large',
                                'encodeLabel' => false,
                                'buttonType' => 'link',
                                'label'=>  '<i class="fa fa-sign-out"></i> '.Yii::t('common', 'Cancel'),
                                'url' => Yii::app()->createAbsoluteUrl('/user/profile')
                    )); ?>
                </div>
            </div>
        	<?php $this->endWidget(); ?>
        </div>
    </div>
<?php echo $this->renderPartial('application.modules.user.views.profile.menu'); ?> 
</div>
<?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_suggest'); ?>
<script type="text/javascript">
$('#Message_adminLetter').click( function() {
    if ($(this).is(':checked')) {
        $("#receiver").attr("disabled", true); 
    } else { 
        $("#receiver").removeAttr("disabled");
    }
})
</script>
