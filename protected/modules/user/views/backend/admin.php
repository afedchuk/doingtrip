<?php 
$this->breadcrumbs=array(
	Yii::t('common', 'User managment'),
);

$this->menu=array(
	array('label'=>UserModule::t('Add user'), 'url'=>array('/user/backend/main/create')),
);

$this->adminTitle = Yii::t('common', 'User managment');

$columns = array(
	array(
		'class'=>'CCheckBoxColumn',
		'id'=>'itemsSelected',
		'selectableRows' => '2',
		'htmlOptions' => array(
			'class'=>'center',
		),
		'disabled' => '$data->id == 1',
	),
	/*array(
		'name' => 'status',
		'header' => tt('Status'),
		'type' => 'raw',
		'value' => 'Yii::app()->controller->returnStatusHtml($data, "user-grid", 1, 1, "status")',
		'headerHtmlOptions' => array(
			'class'=>'infopages_status_column',
		),
		'filter' => array(0 => tt('Inactive'), 1 => tt('Active')),
	),*/
	array(
		'name' => 'firstname',

	),
	array(
		'name' => 'lastname',
	),

	'phone',
	'email',
	array(
        'name'=>'lastvisit',
        'value'=>'$data->lastvisit != "0" ? date("d/m/y H:i:s",$data->lastvisit) : "-"'
    ),
);

$columns[] = array(
	'class'=>'bootstrap.widgets.TbButtonColumn',
	'template'=>'{preview}{update}{delete}',
	'deleteConfirmation' => tc('Are you sure you want to delete this item?'),
	'buttons' => array(
		'delete' => array(
			'visible' => '$data->id != 1',
		),
		'preview' => array(
			'imageUrl' => $url = Yii::app()->assetManager->publish(
				Yii::getPathOfAlias('zii.widgets.assets.gridview').'/view.png'
			),
			'url'=>'Yii::app()->createUrl("/user/profile", array("user_id"=>$data->id))',
		)
	)
);


$this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'user-grid',
	'type' => 'striped',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'afterAjaxUpdate' => 'function(){$("a[rel=\'tooltip\']").tooltip(); $("div.tooltip-arrow").remove(); $("div.tooltip-inner").remove();}',
	'columns'=>$columns
));

$this->renderPartial('//main/admin-select-items', array(
	'url' => '#',
	'id' => 'user-grid',
	'model' => $model,
	'options' => array(
		'preview' => Yii::t('common', 'Preview'),
		'activate' => Yii::t('common', 'Activate'),
		'deactivate' => Yii::t('common', 'Deactivate'),
		'delete' => Yii::t('common', 'Delete')
	),
));

