<div class="control-group">
    <?php echo $form->labelEx($model->description,'title', array('class'=>'control-label')); ?>
    <div class="controls">
        <?php echo $form->textField($model->description,"title",array('maxlength'=>255, 'class' => 'span12','data-toggle' => 'tooltip', 'data-title' => ApartmentsModule::t('Tip title'))); ?>
        <?php echo $form->error($model->description,'title'); ?>
    </div>
</div>
<div class="control-group">
    <?php echo $form->labelEx($model->description,'address', array('class'=>'control-label')); ?>
    <div class="controls">
        <?php echo $form->textField($model->description,"address",array('rows'=>3, 'class' => 'span12','data-toggle' => 'tooltip', 'data-title' => ApartmentsModule::t('Tip address'))); ?>
        <?php echo $form->error($model->description,'address'); ?>
    </div>
</div>
<div class="control-group">
    <?php echo $form->labelEx($model->description,'description', array('class'=>'control-label')); ?>
    <div class="controls">
        <?php echo $form->textArea($model->description,"description",array('class' => 'span12', 'rows' => 4,'data-toggle' => 'tooltip', 'data-title' => ApartmentsModule::t('Tip description'))); ?>
        <?php echo $form->error($model->description,'description'); ?>
    </div>
</div>
<div class="control-group">
    <?php echo $form->labelEx($model->description,"description_near", array('class'=>'control-label')); ?>
    <div class="controls">
        <?php echo $form->textArea($model->description,"description_near",array('class' => 'span12')); ?>
        <?php echo $form->error($model->description,'description_near'); ?>
        <p class="input-desc"><?php echo ApartmentsModule::t('Tip description near'); ?></p>
    </div>
</div>
