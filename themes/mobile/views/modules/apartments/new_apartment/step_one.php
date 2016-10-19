<p class="input-desc"><?php echo ApartmentsModule::t('Tip create header'); ?></p><br/><br/>
<div class="control-group">
     <?php echo $form->labelEx($user,'firstname', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo $form->textField($user,'firstname', array('class' =>'span4')); ?>
        <?php if($form->error($user,'firstname')): ?>
            <?php echo $form->error($user,'firstname'); ?>
        <?php else: ?>
            <p class="input-desc"><?php echo UserModule::t('Tip firstname'); ?></p>
        <?php endif; ?> 
    </div>
</div>
<div class="control-group">
    <?php echo $form->labelEx($user,'lastname', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo $form->textField($user,'lastname', array('class' =>'span4')); ?>
        <?php if($form->error($user,'lastname')): ?>
            <?php echo $form->error($user,'lastname'); ?>
        <?php else: ?>
            <p class="input-desc"><?php echo UserModule::t('Tip lastname'); ?></p>
        <?php endif; ?> 
    </div>
</div>
<div class="control-group">
    <?php echo $form->labelEx($user,'phone', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php //echo $form->dropDownList($user, 'phone_code',  array('+38' => '+38', '+7'=>'+7'), array('class'=>'span1')) ?>
        <?php echo $form->textField($user,'phone', array('class'=>'phone span4', 'data-toggle' => 'tooltip', 'data-title' => UserModule::t('Tip phone'))); ?>
        <?php if($form->error($user,'phone')): ?>
            <?php echo $form->error($user,'phone'); ?>
        <?php else: ?>
            <p class="input-desc"><?php echo UserModule::t('Tip phone'); ?></p>
        <?php endif; ?> 
    </div>
</div>
<div class="control-group">
    <?php echo $form->labelEx($user,'email', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo $form->textField($user,'email', array('class' =>'span4')); ?>
        <?php if($form->error($user,'email')): ?>
            <?php echo $form->error($user,'email'); ?>
        <?php else: ?>
            <p class="input-desc"><?php echo UserModule::t('Tip email'); ?></p>
        <?php endif; ?> 
    </div>
</div>
<div class="control-group">
    <div class="controls">
      <?php echo $form->checkBox($user,'verifyLicense', array('checked' => true)); ?>
      <?php echo CHtml::link(UserModule::t('Tip agree verify license?'), Page::getUrl(2), array('class' => 'agree ')); ?>
      <?php if($form->error($user,'verifyLicense')): ?>
            <?php echo $form->error($user,'verifyLicense'); ?>
       <?php endif; ?> 
    </div>
</div>
<div class="form-hint">
    <?php echo ApartmentsModule::t('Do you have already account?', array('{url}' => Yii::app()->controller->createUrl('/user/main/login'))); ?>
</div>
<div class="mrgT15"></div>
<a class="btn btn-info btn-large pull-right next" href="#2">
        <span><?php echo ApartmentsModule::t("Next"); ?></span>
</a>