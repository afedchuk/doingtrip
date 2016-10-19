<div class="control-group">
    <?php echo $form->labelEx($model,'title', array('class'=>'control-label')); ?>
    <div class="controls">
        <?php echo $form->textField($model,"[$lang]title",array('maxlength'=>255, 'class' => 'span12')); ?>
        <?php if($form->error($model,'title')): ?>
            <?php echo $form->error($model,'title'); ?>
        <?php else: ?>
            <!--p class="input-desc"><?php echo ApartmentsModule::t('Tip title'); ?></p-->
        <?php endif; ?>
    </div>
</div>
<div class="control-group">
    <?php echo $form->labelEx($model,'address', array('class'=>'control-label')); ?>
    <div class="controls">
        <?php echo $form->textField($model,"[$lang]address",array('rows'=>3, 'class' => 'span12')); ?>
        <?php if($form->error($model,'address')): ?>
            <?php echo $form->error($model,'address'); ?>
        <?php else: ?>
            <!--p class="input-desc"><?php echo ApartmentsModule::t('Tip address'); ?></p-->
        <?php endif; ?>
    </div>
</div>
<div class="control-group">
    <?php echo $form->labelEx($model,'[$lang]description', array('class'=>'control-label')); ?>
    <div class="controls">
        <?php echo $form->textArea($model,"[$lang]description",array('class' => 'span12', 'rows' => 6)); ?>
        <?php if($form->error($model,'description')): ?>
            <?php echo $form->error($model,'description'); ?>
        <?php else: ?>
            <!--p class="input-desc"><?php echo ApartmentsModule::t('Tip description'); ?></p-->
        <?php endif; ?>
    </div>
</div>
<div class="control-group">
    <?php echo $form->labelEx($model,"description_near", array('class'=>'control-label')); ?>
    <div class="controls">
        <?php echo $form->textArea($model,"[$lang]description_near",array('class' => 'span12')); ?>
        <?php echo $form->error($model,'description_near'); ?>
        <p class="input-desc"><?php echo ApartmentsModule::t('Tip description near'); ?></p>
    </div>
</div>
