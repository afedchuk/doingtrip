<div class="control-group">
    <?php echo $form->labelEx($model->services,'time_race', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo $form->dropDownList($model->services,'start', hoursRange(), array('options' => array('00:00'=>array('selected'=>true)),  'class'=>'span1')); ?>
        <?php echo $form->dropDownList($model->services,'end', hoursRange(), array('options' => array('00:00'=>array('selected'=>true)),  'class'=>'span1')); ?>
        <?php //echo $form->textField($model->services,'time_race',array('value'=> $model->services->time_race > 0 ? $model->services->time_race : '00:00/00:00', 'class'=>'span4 time', 'placeholder' => Services::model()->getAttributeLabel('time_race'))); ?>
        <?php echo $form->error($model->services,'start'); ?>
        <?php echo $form->error($model->services,'end'); ?>
    </div>
</div>
<div class="control-group">
    <?php echo $form->labelEx($model->services,'max_berths', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo $form->textField($model->services,'max_berths',array('class'=>'span1')); ?>
        <?php echo $form->error($model->services,'max_berths'); ?>
    </div>
</div>
<div class="control-group">
    <?php echo $form->labelEx($model->services,'min_days', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo $form->textField($model->services,'min_days',array('class'=>'span1')); ?>
        <?php echo $form->error($model->services,'min_days'); ?>
    </div>
</div>
<div class="control-group">
    <?php echo $form->labelEx($model->services,'with_child', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo $form->dropDownList($model->services,'with_child', array('1' => ApartmentsModule::t('Allow'), '0' => ApartmentsModule::t('Forbidden')), array('options' => array(''=>array('selected'=>true)), 'prompt'=>  ApartmentsModule::t('--Select--'), 'class'=>'span4')); ?>
        <?php echo $form->error($model->services,'with_child'); ?>
    </div>
</div>

<div class="control-group">
    <?php echo $form->labelEx($model->services,'with_animals', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo $form->dropDownList($model->services,'with_animals', array('1' => ApartmentsModule::t('Allow'), '0' => ApartmentsModule::t('Forbidden')), array('options' => array(''=>array('selected'=>true)),  'prompt'=>  ApartmentsModule::t('--Select--'), 'class'=>'span4')); ?>
    </div>
    <?php if($form->error($model->services,'with_animals')): ?>
            <?php echo $form->error($model->services,'with_animals'); ?>
    <?php endif; ?>
</div>
<div class="control-group">
    <?php echo $form->labelEx($model->services,'smoking', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo $form->dropDownList($model->services,'smoking', array('1' => ApartmentsModule::t('Allow'), '0' => ApartmentsModule::t('Forbidden')), array('options' => array(''=>array('selected'=>true)),  'prompt'=>  ApartmentsModule::t('--Select--'), 'class'=>'span4')); ?>
    </div>
    <?php if($form->error($model->services,'smoking')): ?>
            <?php echo $form->error($model->services,'smoking'); ?>
    <?php endif; ?>
</div>
<div class="control-group">
    <?php echo $form->labelEx($model->services,'transfer', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo $form->dropDownList($model->services,'transfer', array('1' => ApartmentsModule::t('Available'), '0' => ApartmentsModule::t('No available')), array('options' => array(''=>array('selected'=>true)),  'prompt'=>  ApartmentsModule::t('--Select--'), 'class'=>'span4')); ?>
    </div>
    <?php if($form->error($model->services,'transfer')): ?>
            <?php echo $form->error($model->services,'transfer'); ?>
    <?php endif; ?>
</div>
<div class="control-group">
    <?php echo $form->labelEx($model->services,'deposit', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo $form->dropDownList($model->services,'deposit', array('1' => ApartmentsModule::t('Available'), '0' => ApartmentsModule::t('No available')), array('options' => array(''=>array('selected'=>true)),  'prompt'=>  ApartmentsModule::t('--Select--'), 'class'=>'span4')); ?>
    </div>
    <?php if($form->error($model->services,'deposit')): ?>
            <?php echo $form->error($model->services,'deposit'); ?>
    <?php endif; ?>
</div>
<div class="control-group">
    <?php echo $form->labelEx($model->services,'docs', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo $form->dropDownList($model->services,'docs', array('1' => ApartmentsModule::t('Available'), '0' => ApartmentsModule::t('No available')), array('options' => array(''=>array('selected'=>true)),  'prompt'=>  ApartmentsModule::t('--Select--'), 'class'=>'span4')); ?>
    </div>
    <?php if($form->error($model->services,'docs')): ?>
            <?php echo $form->error($model->services,'docs'); ?>
    <?php endif; ?>
</div>
<div class="control-group">
    <?php echo $form->labelEx($model->services,'card', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo $form->dropDownList($model->services,'card', array('1' => ApartmentsModule::t('Available'), '0' => ApartmentsModule::t('No available')), array('options' => array(''=>array('selected'=>true)),  'prompt'=>  ApartmentsModule::t('--Select--'), 'class'=>'span4')); ?>
    </div>
    <?php if($form->error($model->services,'card')): ?>
            <?php echo $form->error($model->services,'card'); ?>
    <?php endif; ?>
</div>
<div class="mrgT35"></div> 
<a class="btn btn-info btn-large" href="#2">
    <?php echo ApartmentsModule::t('Back'); ?>
</a>
<a  class="btn btn-large btn-info pull-right" href="#4">
    <?php echo ApartmentsModule::t('Next'); ?>
</a>