<?php
$this->pageTitle=Yii::app()->name . ' - ' . ConfigurationModule::t('Manage settings');
$this->breadcrumbs=array(
	ConfigurationModule::t('Settings'),
);
$this->menu = array(
	array('label' => ConfigurationModule::t('Add new key'), 'url' => array('create')),
);
$this->adminTitle = ConfigurationModule::t('Manage settings');

$this->widget('bootstrap.widgets.TbGridView', array(
	'dataProvider'=>$model->search(),
	'type' => 'striped',
	'filter'=>$model,
	'columns'=>array(
		array(
			'name'=>'title',
			'type'=>'raw',
			'htmlOptions' => array('class' => 'span6'),
		),
		array(
			'name'=>'value',
			'value' => 'getSnippet($data->value, 35)',
		),
		array(
			'name'=>'name',
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template' => '{update}{delete}',
		),
	),
)); ?>