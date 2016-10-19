<div class="control-group row-fluid">
    <?php  echo $form->labelEx($model,'price', array('class'=>'control-label')); ?>
    <div class="controls">
        <?php echo $form->textField($model,'price', array('class'=>'span2')); ?>
        <?php echo $form->error($model,'price'); ?>
    </div>
</div>
<div class="control-group row-fluid">
    <?php echo $form->labelEx($model,'square', array('class'=>'control-label')); ?>
    <div class="controls">
        <?php echo $form->textField($model,'square', array('class'=>'span2')); ?>
    </div>
</div>
<div class="control-group row-fluid">
    <?php echo $form->labelEx($model,'berths', array('class'=>'control-label')); ?>
    <div class="controls">
        <?php echo $form->textField($model,'berths',array('class' => 'span2','maxlength'=>255)); ?>
    </div>
</div>
<div class="control-group row-fluid">
    <?php echo $form->labelEx($model,'num_of_rooms', array('class'=>'control-label')); ?>
    <div class="controls">
         <?php echo $form->dropDownList($model,'num_of_rooms', array_merge(array('0' => 0),
                            range(1, param('moduleApartments_maxRooms', 8))), array('style'=>'width:110px;')); ?>
        <?php echo $form->error($model,'num_of_rooms'); ?>
    </div>
</div>

<div class="control-group row-fluid">
    <?php echo $form->labelEx($model,'floor', array('label' => ApartmentsModule::t('Floor from floors'), 'class'=>'control-label')); ?>
    <div class="controls">
         <?php echo $form->dropDownList($model,'floor',
                    array_merge(
                            array(0 => 0),
                            range(1, param('moduleApartments_maxFloor', 30))
                    ), array('style'=>'width:50px;')); ?> /
        <?php echo $form->dropDownList($model,'floor_total',
                        array_merge(
                                array(0 => 0),
                                range(1, param('moduleApartments_maxFloor', 30))
                        ), array('style'=>'width:50px;')); ?>
        <?php echo $form->error($model,'floor'); ?>
        <?php echo $form->error($model,'floor_total'); ?>
    </div>
</div>

<div class="control-group row-fluid">
    <?php echo $form->labelEx($model,'window_to', array('class'=>'control-label')); ?>
    <div class="controls">
         <?php echo $form->dropDownList($model,'window_to', array('1'=>  ApartmentsModule::t('Into'), '2' => ApartmentsModule::t('Out')), array('style'=>'width:110px;')); ?>
         <?php echo $form->error($model,'window_to'); ?>
    </div>
</div>