<div class="input-desc"><?php echo ApartmentsModule::t('Tip conditions'); ?></div>
<div class="control-group row-fluid">
    <?php echo $form->labelEx($model->services,'time_race', array('class'=>'control-label')); ?>
    <div class="controls">
        <?php echo $form->dropDownList($model->services,'start', hoursRange(), array('class'=>'span3')); ?><span class="grey">/</span>
        <?php echo $form->dropDownList($model->services,'end', hoursRange(), array('class'=>'span3')); ?>
        
        <?php echo $form->error($model->services,'start'); ?>
        <?php echo $form->error($model->services,'end'); ?>
    </div>
</div>
<div class="control-group row-fluid">
    <?php echo $form->labelEx($model->services,'max_berths', array('class'=>'control-label')); ?>
    <div class="controls">
        <?php echo $form->textField($model->services,'max_berths', array('class'=>'span2')); ?>
    </div>
</div>
<div class="control-group row-fluid">
    <?php echo $form->labelEx($model->services,'min_days', array('class'=>'control-label')); ?>
    <div class="controls">
        <?php echo $form->textField($model->services,'min_days' , array('class'=>'span2')); ?><span class="grey data"><?php echo ApartmentsModule::t('days'); ?></span>
    </div>
</div>
<div class="control-group row-fluid">
    <?php echo $form->labelEx($model->services,'with_child', array('class'=>'control-label')); ?>
    <div class="controls">
        <?php echo $form->dropDownList($model->services,'with_child', array('1' => ApartmentsModule::t('Allow'), '0' => ApartmentsModule::t('Forbidden')), array('prompt'=>  ApartmentsModule::t('--Select--'))); ?>
    </div>
</div>
<div class="control-group row-fluid">
    <?php echo $form->labelEx($model->services,'with_animals', array('class'=>'control-label')); ?>
    <div class="controls">
        <?php echo $form->dropDownList($model->services,'with_animals', array('1' => ApartmentsModule::t('Allow'), '0' => ApartmentsModule::t('Forbidden')), array('prompt'=>  ApartmentsModule::t('--Select--'))); ?>
    </div>
</div>
<div class="control-group row-fluid">
    <?php echo $form->labelEx($model->services,'smoking', array('class'=>'control-label')); ?>
    <div class="controls">
        <?php echo $form->dropDownList($model->services,'smoking', array('1' => ApartmentsModule::t('Allow'), '0' => ApartmentsModule::t('Forbidden')), array('prompt'=>  ApartmentsModule::t('--Select--'))); ?>
    </div>
</div>
<div class="control-group row-fluid">
    <?php echo $form->labelEx($model->services,'transfer', array('class'=>'control-label')); ?>
    <div class="controls">
        <?php echo $form->dropDownList($model->services,'transfer', array('0' => ApartmentsModule::t('No available'), '1' => ApartmentsModule::t('Available'), '2' => ApartmentsModule::t('Additional price')), array('prompt'=>  ApartmentsModule::t('--Select--'),'options' => array(''=>array('selected'=>true)))); ?>
    </div>
</div>
<div class="control-group row-fluid">
    <?php echo $form->labelEx($model->services,'deposit', array('class'=>'control-label')); ?>
    <div class="controls">
        <?php echo $form->dropDownList($model->services,'deposit', array('0' => ApartmentsModule::t('Not necessarily'), '1' => ApartmentsModule::t('Necessarily')), array('prompt'=>  ApartmentsModule::t('--Select--'))); ?>
    </div>
</div>
<div class="control-group row-fluid">
    <?php echo $form->labelEx($model->services,'docs', array('class'=>'control-label')); ?>
    <div class="controls">
        <?php echo $form->dropDownList($model->services,'docs', array('0' => ApartmentsModule::t('Not necessarily'), '1' => ApartmentsModule::t('Necessarily')), array('prompt'=>  ApartmentsModule::t('--Select--'))); ?>
    </div>
</div>
<div class="control-group row-fluid">
    <?php echo $form->labelEx($model->services,'card', array('class'=>'control-label')); ?>
    <div class="controls">
        <?php echo $form->dropDownList($model->services,'card', array('0' => ApartmentsModule::t('Forbidden'), '1' => ApartmentsModule::t('Allow')), array('prompt'=>  ApartmentsModule::t('--Select--'))); ?>
    </div>
</div>