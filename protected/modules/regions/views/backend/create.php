<?php
$this->breadcrumbs=array(
	RegionsModule::t('Manage apartment city')=>array('admin'),
	RegionsModule::t('Add city'),
);

$this->menu=array(
	array('label'=>RegionsModule::t('Manage apartment city'), 'url'=>array('admin')),
	array('label'=>RegionsModule::t('Add city')),
);

$this->adminTitle = RegionsModule::t('Add city');
?>


<div class="profile-edit">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>$this->modelName.'-form',
		'enableAjaxValidation'=>false,
	  	'htmlOptions' => array('class' => 'form-horizontal'),
	)); ?>

	<div class="control-group">
	    <?php echo $form->labelEx($model,'url', array('class'=>'control-label')); ?>
	    <div class="controls">
	        <?php echo $form->textField($model,'url', array('class'=>'span12')); ?>
	        <?php echo $form->error($model,'url'); ?>
	    </div>
	</div>

	<div class="control-group">
	    <?php  echo $form->labelEx($model,'country_id', array('class'=>'control-label')); ?>
	    <div class="controls">
	        <?php echo $form->dropDownList($model, 'country_id',  Currency::getAllCountries(), array('prompt'=>  ApartmentsModule::t('--Select--'), 'options' => array('197'=>array('selected'=>true)), 'class' => 'span6')) ?>
	        <?php if($form->error($model,'country_id')): ?>
	            <?php echo $form->error($model,'country_id'); ?>
	        <?php endif; ?>
	    </div>
	</div>

	<div class="control-group">
	    <?php  echo $form->labelEx($model,'region_id', array('class'=>'control-label')); ?>
	    <div class="controls">
	        <?php echo $form->dropDownList($model, 'region_id',  RegionDescription::getAllRegions(), array('prompt'=>  ApartmentsModule::t('--Select--'), 'class' => 'span6')) ?>
	        <?php if($form->error($model,'region_id')): ?>
	            <?php echo $form->error($model,'region_id'); ?>
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
                'label'=>'<i class="fa  fa-plus"></i> '.Yii::t('index', 'Create'),  
            )); ?>
            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'type'=>'default',
                'size' => 'large',
                'encodeLabel' => false,
                'buttonType' => 'link',
                'label'=>  '<i class="fa fa-sign-out"></i> '.Yii::t('common', 'Cancel'),
                'url' => array('admin')
            )); ?>
        </div>
  </div>
<?php $this->endWidget(); ?>
</div>