<?php 
$this->pageTitle=Yii::app()->name . ' - '.UserModule::t('Edit profile');
$this->breadcrumbs=array(
        UserModule::t("Profile")=>array('profile'),
        UserModule::t('Edit profile'),
);
?>

<div class="row-fluid profile-wrapper">
    <div class="span9">
        <div class="well">
            <div class="profile-edit">
                <?php $form=$this->beginWidget('UActiveForm', array(
                        'id'=>'profile-form',
                        'enableAjaxValidation'=>true,
                        'htmlOptions' => array('enctype'=>'multipart/form-data', 'class' => 'form-horizontal'),
                )); ?>
                    <div class="page-header">
                        <h4><?php echo UserModule::t('Edit profile'); ?></h4>
                    </div>
                    <div class="control-group">
                        <?php echo $form->labelEx($model,'firstname', array('class'=>'control-label')); ?>
                        <div class="controls">
                            <?php echo $form->textField($model,'firstname',array('class'=>'span8','maxlength'=>255)); ?>
                            <?php echo $form->error($model,'firstname'); ?>
                        </div>
                    </div>
                
                    <div class="control-group">
                        <?php echo $form->labelEx($model,'lastname', array('class'=>'control-label')); ?>
                        <div class="controls">
                            <?php echo $form->textField($model,'lastname',array('class'=>'span8','maxlength'=>255)); ?>
                            <?php echo $form->error($model,'lastname'); ?>
                        </div>
                    </div>

                    <div class="control-group">
                        <?php echo $form->labelEx($model,'phone', array('class'=>'control-label')); ?>
                        <div class="controls">
                            <?php echo $form->textField($model,'phone',array('maxlength'=>255, 'class'=>'phone span8')); ?>
                            <?php echo $form->error($model,'phone'); ?>
                        </div>
                    </div>

                    <div class="control-group">
                        <?php echo $form->labelEx($model,'phone_additional', array('class'=>'control-label')); ?>
                        <div class="controls">
                            <?php echo $form->textField($model,'phone_additional',array('class'=>'span8 phone', 'maxlength'=>255)); ?>
                            <?php echo $form->error($model,'phone_additional'); ?>
                        </div>
                    </div>

                    <div class="control-group">
                        <?php echo $form->labelEx($model,'website', array('class'=>'control-label')); ?>
                        <div class="controls">
                            <?php echo $form->textField($model,'website',array('class'=>'span8', 'maxlength'=>255)); ?>
                            <?php echo $form->error($model,'website'); ?>
                        </div>
                    </div>

                    <div class="control-group">
                        <?php echo $form->labelEx($model,'skype', array('class'=>'control-label')); ?>
                        <div class="controls">
                            <?php echo $form->textField($model,'skype',array('class'=>'span8', 'maxlength'=>255)); ?>
                            <?php echo $form->error($model,'skype'); ?>
                        </div>
                    </div>

                    <div class="control-group">
                        <?php echo $form->labelEx($model,'viber', array('class'=>'control-label')); ?>
                        <div class="controls">
                            <?php echo $form->textField($model,'viber',array('class'=>'span8', 'maxlength'=>255)); ?>
                            <?php echo $form->error($model,'viber'); ?>
                        </div>
                    </div>

                    <div class="control-group">
                        <?php echo $form->labelEx($model,'email', array('class'=>'control-label')); ?>
                        <div class="controls">
                            <?php echo $form->textField($model,'email',array('class'=>'span8','maxlength'=>128)); ?>
                            <?php echo $form->error($model,'email'); ?>
                        </div>
                    </div>
                    <br/>
                    <div class="page-header">
                        <h4><?php echo UserModule::t('Settings of site'); ?></h4>
                    </div>
                    <?php $langs = array(); foreach($this->languages as $lang) { ?>
                        <?php $langs[$lang['code']] = $lang['name']; ?>
                    <?php } ?>
                    <div class="control-group">
                        <?php  echo $form->labelEx($model,'default_lang', array('class'=>'control-label')); ?>
                        <div class="controls">
                            <?php echo $form->dropDownList($model,'default_lang',  $langs, array('class' => 'span6')); ?>
                            <?php echo $form->error($model,'default_lang'); ?>
                        </div>
                    </div>

                    <div class="control-group">
                        <?php echo $form->labelEx($model,'default_currency', array('class'=>'control-label')); ?>
                        <div class="controls">
                            <?php echo $form->dropDownList($model,'default_currency', Currency::getActiveCurrencies(), array('class' => 'span6')); ?>
                            <?php echo $form->error($model,'default_currency'); ?>
                        </div>
                    </div>
                    <br/>
                    <div class="control-group">
                        <div class="controls">
                            <?php $this->widget('bootstrap.widgets.TbButton', array(
                                'type'=>'info',
                                'size' => 'large',
                                'buttonType' => 'submit',
                                'encodeLabel' => false,
                                'label'=>($model->isNewRecord ? '<i class="fa  fa-plus"></i> '.Yii::t('index', 'Create') : '<i class="fa  fa-floppy-o"></i> '.Yii::t('index', 'Save')),
                                'htmlOptions'=>array('onclick' => "$('form#profile-form').submit();"),
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






