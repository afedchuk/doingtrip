<?php 
$this->breadcrumbs=array(
	UserModule::t('Discounts managment'),
);


$this->adminTitle = UserModule::t('Discounts managment');

$columns = array(
	
	array(
		'name' => 'title',

	),
	array(
		'name' => 'value',
	),

	array(
        'name'=>'date_start',
        'value'=>'date("d/m/y H:i:s",$data->date_start) '
    ),

    array(
        'name'=>'date_start',
        'value'=>'date("d/m/y H:i:s",$data->date_finish) '
    ),
);

$columns[] = array(
	'class'=>'bootstrap.widgets.TbButtonColumn',
	'template'=>'{update}{deactivate}{active}',
	'deleteConfirmation' => tc('Are you sure you want to delete this item?'),
	'buttons' => array(
		'update' => array(
			'url'=>'Yii::app()->createUrl("user/profile/updatediscount", array("id"=>$data->id))',
		),
		'deactivate' => array(
            'label' => UserModule::t('Active'),
            'icon'=>'eye-close',
            'url'=>'Yii::app()->createUrl("user/profile/activatediscount", array("id"=>$data->id))',
            'visible'=>'($data->status==1)?true:false;'
            
        ),
        'active' => array(
            'label' => UserModule::t('Not active'),
            'icon'=>'eye-open',
            'url'=>'Yii::app()->createUrl("user/profile/activatediscount", array("id"=>$data->id))',
            'visible'=>'($data->status==0)?true:false;'
        ),
	)
);


$this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'user-grid',
	'type' => 'striped',
	'dataProvider'=>$model->search(),
	'afterAjaxUpdate' => 'function(){$("a[rel=\'tooltip\']").tooltip(); $("div.tooltip-arrow").remove(); $("div.tooltip-inner").remove();}',
	'columns'=>$columns
));


