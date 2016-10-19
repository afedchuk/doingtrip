<?php
$this->pageTitle=Yii::app()->name . ' - ' . NotifierModule::t('Mail editor');

$this->menu = array(
    array('label' => NotifierModule::t('Mail editor'), 'url' => array('admin')),
    array('label'=>NotifierModule::t('Add letter'), 'url'=>array('/notifier/backend/main/create')),
);
$this->adminTitle = NotifierModule::t('Edit');
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
    	        'content'=> $this->renderPartial( '_form', array('model' => $result, 'lang' => $key,  'form' => $form), true ),
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