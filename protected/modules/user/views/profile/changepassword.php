<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Change password");
$this->breadcrumbs=array(
	UserModule::t("Profile") => array('/user/profile'),
	UserModule::t("Change password"),
);
?>

<div class="row-fluid profile-wrapper">
    <div class="span9">
        <div class="well">               
            <div class="profile-edit">
            <?php $form=$this->beginWidget('UActiveForm', array(
                    'id'=>'changepassword-form',
                    'enableAjaxValidation'=>true,
                    'htmlOptions' => array('enctype'=>'multipart/form-data', 'class' => 'form-horizontal'),
            )); ?>
                <div class="page-header">
                    <h4><?php echo UserModule::t("Change password"); ?></h4>
                </div>
                <div class="control-group">
                    <?php echo $form->labelEx($model,'password', array('class'=>'control-label')); ?>
                    <div class="controls">
                    <?php echo $form->passwordField($model,'password', array('class' => 'span6')); ?>
                    <?php if($form->error($model,'password')): ?>
                        <?php echo $form->error($model,'password'); ?>
                    <?php else: ?>
                        <p class="input-desc"><?php echo UserModule::t('Minimal password length 4 symbols.'); ?></p>
                    <?php endif; ?>
                    </div>
                </div>

                <div class="control-group">
                    <?php echo $form->labelEx($model,'verifyPassword', array('class'=>'control-label')); ?>
                    <div class="controls">
                        <?php echo $form->passwordField($model,'verifyPassword', array('class' => 'span6')); ?>
                        <?php if($form->error($model,'verifyPassword') != ""): ?>
                            <?php echo $form->error($model,'verifyPassword'); ?>
                        <?php else: ?>
                            <p class="input-desc"><?php echo UserModule::t('Tip repeat password'); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <?php $this->widget('bootstrap.widgets.TbButton', array(
                            'type'=>'info',
                            'size' => 'large',
                            'buttonType' => 'submit',
                            'encodeLabel' => false,
                            'label'=>'<i class="fa  fa-floppy-o"></i> '.Yii::t('index', 'Save'),
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
    </div>
<?php echo $this->renderPartial('profile/menu'); ?> 
</div>