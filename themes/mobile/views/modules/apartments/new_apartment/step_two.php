<p class="input-desc"><?php echo ApartmentsModule::t('Tip title'); ?></p><br/><br/>
<div class="control-group">
        <?php echo $form->labelEx($model,'type', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->dropDownList($model,'type', Apartment::getTypesArray(), array('prompt'=>  ApartmentsModule::t('--Select--'), 'class'=>'span4')); ?>
            <?php echo $form->error($model,'type'); ?>
        </div>
</div>
<div class="control-group">
        <?php echo $form->labelEx($model,'city_id', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->dropDownList($model, 'city_id',   City::getAllCity(), array('prompt'=>  ApartmentsModule::t('--Select--'), 'class'=>'span4')) ?>
            <?php echo $form->error($model,'city_id'); ?>
            <!--div class="city-request">
                <a href="#" >Не нашли своего города в списке городов?</a>
            </div-->
        </div>
</div>
<div class="control-group">
    <?php echo $form->labelEx($model->description,'title', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model->description,'title',array('class'=>'span4','data-toggle' => 'tooltip', 'data-title' => ApartmentsModule::t('Tip title'))); ?>
            <?php echo $form->error($model->description,'title'); ?>
        </div>
</div>
<div class="control-group">
    <?php echo $form->labelEx($model->description,'address', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model->description,'address',array('class'=>'span4','data-toggle' => 'tooltip', 'data-title' => ApartmentsModule::t('Tip address'))); ?>
            <?php echo $form->error($model->description,'address'); ?>   
        </div>
</div>

<div class="control-group form-inline">
        <div class="controls ">
            <?php echo $form->textField($model,'num_of_rooms',array('class' => 'span2', 'placeholder' => Apartment::model()->getAttributeLabel('num_of_rooms'), 'value' => ($model->num_of_rooms > 0 ? $model->num_of_rooms : ''))); ?>
            <?php echo $form->textField($model,'price',array('class' => 'span1', 'value' => ($model->price > 0 ? $model->price : ''),  'placeholder' => Apartment::model()->getAttributeLabel('price'))); ?>
            <span style="font-size:10px; margin-left:5px;"><?php echo ApartmentsModule::t('Price l'); ?></span>
            <?php echo $form->error($model,'price'); ?>
            <?php echo $form->textField($model,'square',array('class' => 'span1', 'value' => ($model->square > 0 ? $model->square : ''),  'placeholder' => Apartment::model()->getAttributeLabel('square'))); ?>
            <span style="font-size:10px; margin-left:5px;"><?php echo ApartmentsModule::t('Square m'); ?></span>
            <?php echo $form->error($model,'square'); ?>
        </div>
</div>
<div class="control-group">
    <?php echo $form->labelEx($model->description, 'description', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textArea($model->description,'description',array('class'=>'span4','data-toggle' => 'tooltip', 'data-title' => ApartmentsModule::t('Tip description'))); ?>
            <?php echo $form->error($model->description,'description'); ?>   
        </div>
</div>
<div class="mrgT35"></div>
<?php if(Yii::app()->user->isGuest) {?>
    <a class="btn btn-info btn-large"  href="#1">
        <?php echo ApartmentsModule::t('Back'); ?>
    </a>
<?php } ?>
<a  class="btn btn-info btn-large pull-right" href="#3">
    <?php echo ApartmentsModule::t('Next'); ?>
</a>
  