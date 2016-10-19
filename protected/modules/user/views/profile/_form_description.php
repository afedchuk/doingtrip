
<?php  
        if($model->isNewRecord) {
            echo $this->renderPartial( 'profile/_form_add', array('model' => $model,  'form' => $form),  true);
        } else {
            $tabs = array(); 
            foreach($description as $key=>$result) {
                 $tabs['tabs'][] = array(
                    'label' =>  '<span class="icon-'.$key.'"></span> '.Lang::getLangNameByCode($key),
                    'content'=> $this->renderPartial( 'profile/_form', array('model' => $result, 'lang' => $key, 'form' => $form), true ),
                    'active' => ($key == Yii::app()->language) ? true : false);
            }

            $this->widget('bootstrap.widgets.TbTabs', array(
                'type'=>'tabs',
                'placement'=>'above', 
                'tabs'=> $tabs['tabs'],
                'htmlOptions' => array('class' => 'lang-tab')
            ));
        }
?> 
<div class="control-group">
    <?php echo $form->labelEx($model,'owner_active', array('class'=>'control-label')); ?>
    <div class="controls">
        <?php echo $form->dropDownList($model,'owner_active', 
                               array(0 => ApartmentsModule::t('Hide'), 1 => ApartmentsModule::t('Show')),array('class' => 'span6')); ?>
        <?php if($form->error($model,'owner_active')): ?>
            <?php echo $form->error($model,'owner_active'); ?>
        <?php else: ?>
            <p class="input-desc"><?php echo ApartmentsModule::t('Tip owner status'); ?></p>
        <?php endif; ?>
    </div>   
</div>
<div class="control-group">
    <?php echo $form->labelEx($model,'type', array('class'=>'control-label')); ?>
    <div class="controls">
        <?php echo $form->dropDownList($model,'type', Apartment::getTypesArray(), array('prompt'=>  ApartmentsModule::t('--Select--'), 'class' => 'span6')); ?>
        <?php if($form->error($model,'type')): ?>
            <?php echo $form->error($model,'type'); ?>
        <?php else: ?>
            <p class="input-desc"><?php echo ApartmentsModule::t('Tip type'); ?></p>
        <?php endif; ?>
    </div>
</div>
<div class="control-group">
    <?php  echo $form->labelEx($model,'city_id', array('class'=>'control-label')); ?>
    <div class="controls">
        <?php echo $form->dropDownList($model, 'city_id',  City::getAllCity(), array('prompt'=>  ApartmentsModule::t('--Select--'), 'class' => 'span6')) ?>
        <?php if($form->error($model,'city_id')): ?>
            <?php echo $form->error($model,'city_id'); ?>
        <?php endif; ?>
    </div>
</div>
<div class="control-group row-fluid">
    <?php  echo $form->labelEx($model,'price', array('class'=>'control-label')); ?>
    <div class="controls">
        <?php echo $form->textField($model,'price', array('class'=>'span2')); ?>
        <span style="font-size:10px; margin-left:5px;"><?php echo ApartmentsModule::t('Price l'); ?></span>
        <?php echo $form->error($model,'price'); ?>
    </div>
</div>
<div class="control-group row-fluid">
    <?php echo $form->labelEx($model,'square', array('class'=>'control-label')); ?>
    <div class="controls">
        <?php echo $form->textField($model,'square', array('class'=>'span2')); ?>
        <span style="font-size:10px; margin-left:5px;"><?php echo ApartmentsModule::t('Square m'); ?></span>
        <?php echo $form->error($model,'square'); ?>
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
                            range(1, param('moduleApartments_maxRooms', 8))), array('class' => 'span6')); ?>
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
                    ), array('class'=>'span3')); ?> /
        <?php echo $form->dropDownList($model,'floor_total',
                        array_merge(
                                array(0 => 0),
                                range(1, param('moduleApartments_maxFloor', 30))
                        ), array('class'=>'span3')); ?>
        <?php echo $form->error($model,'floor'); ?>
        <?php echo $form->error($model,'floor_total'); ?>
    </div>
</div>

<div class="control-group row-fluid">
    <?php echo $form->labelEx($model,'window_to', array('class'=>'control-label')); ?>
    <div class="controls">
         <?php echo $form->dropDownList($model,'window_to', array('1'=>  ApartmentsModule::t('Into'), '2' => ApartmentsModule::t('Out')), array('class'=>'span6')); ?>
         <?php echo $form->error($model,'window_to'); ?>
    </div>
</div>
<div class="control-group">
        <?php echo $form->labelEx($model,'phone', array('class'=>'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model,'phone', array('class'=>'phone span6', 'data-toggle' => 'tooltip', 'data-title' => UserModule::t('Tip phone'))); ?><br/>
            <?php echo $form->textField($model,'phone_additional', array('class'=>'phone span6', 'data-toggle' => 'tooltip', 'data-title' => UserModule::t('Tip phone') )); ?>
            <?php if($form->error($model,'phone')): ?>
                <?php echo $form->error($model,'phone'); ?>
            <?php else: ?>
                <p class="input-desc"><?php echo ApartmentsModule::t('Tip phones'); ?></p>
            <?php endif; ?>
        </div>
</div>