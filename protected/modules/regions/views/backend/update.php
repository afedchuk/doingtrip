<?php
$this->breadcrumbs=array(
	RegionsModule::t('Manage apartment city')=>array('admin'),
	RegionsModule::t('Edit city'),
);

$this->menu=array(
    array('label'=>RegionsModule::t('Manage apartment city'), 'url'=>array('admin')),
    array('label'=>RegionsModule::t('Add city'), 'url'=>array('/regions/backend/main/create')),
);

$this->adminTitle = RegionsModule::t('Edit city');
?>


<div class="profile-edit">
    <?php $form=$this->beginWidget('CActiveForm', array(
    	'id'=>$this->modelName.'-form',
    	'enableAjaxValidation'=>true,
      'htmlOptions' => array('class' => 'form-horizontal'),
    )); ?>        
    	<?php 
    	$tabs = array(); 
    	foreach($description as $key=>$result) {
    	     $tabs['tabs'][] = array(
    	        'label' =>  '<span class="icon-'.$key.'"></span> '.Lang::getLangNameByCode($key),
    	        'content'=> $this->renderPartial( '_form', array('model' => $result, 'lang' => $key, 'form' => $form), true ),
    	        'active' => ($key == Yii::app()->language) ? true : false);
    	}

    	$this->widget('bootstrap.widgets.TbTabs', array(
    	    'type'=>'tabs',
    	    'placement'=>'above', 
    	    'tabs'=> $tabs['tabs'],
    	    'htmlOptions' => array('class' => 'lang-tab')
    	));
    	?>

        <div class="control-group">
            <?php echo $form->labelEx($model,'url', array('class'=>'control-label')); ?>
            <div class="controls">
                <?php echo $form->textField($model,'url', array('class'=>'span12')); ?>
                <?php echo $form->error($model,'url'); ?>
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
                    'label'=>'<i class="fa  fa-floppy-o"></i> '.Yii::t('index', 'Save'),  
                )); ?>
                 <?php $this->widget('bootstrap.widgets.TbButton', array(
                    'type'=>'default',
                    'size' => 'large',
                    'encodeLabel' => false,
                    'buttonType' => 'link',
                    'label'=>  '<i class="fa fa-sign-out"></i> '.Yii::t('common', 'Cancel'),
                    'url' => Yii::app()->createAbsoluteUrl('/regions/backend/main/admin')
                )); ?>
            </div>
        </div>
    <?php $this->endWidget(); ?>
</div>
