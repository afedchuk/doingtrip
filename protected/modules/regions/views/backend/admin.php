<?php
$this->breadcrumbs=array(
	RegionsModule::t('Manage apartment city')
);

$this->menu=array(
	array('label'=>RegionsModule::t('Add city'), 'url'=>array('/regions/backend/main/create')),
);

$this->adminTitle =RegionsModule::t('Manage apartment city');

$columns = array(
	array(
		'class'=>'CCheckBoxColumn',
		'id'=>'itemsSelected',
		'selectableRows' => '2',
		'htmlOptions' => array(
			'class'=>'center',
		),
	),
	array(
		'name' => 'city_description.name',
		'sortable' => false,
	),
	array(
		'name' => 'city_description.description',
		'sortable' => false,
		'value' => 'getSnippet(strip_tags($data->city_description->description), 250)'
	),
	array(
		'name' => 'url',
		'sortable' => false,
	),
	array(
		'name' => 'country.country',
		'sortable' => false,
	),
);


$columns[] = array(
	'class'=>'bootstrap.widgets.TbButtonColumn',
	'template'=>'{up}{down}{update}{delete}',
	'deleteConfirmation' => tc('Are you sure you want to delete this item?'),
	'buttons' => array(
		'up' => array(
			'label' => tc('Move an item up'),
			'imageUrl' => $url = Yii::app()->assetManager->publish(
				Yii::getPathOfAlias('zii.widgets.assets.gridview').'/up.gif'
			),
			'url'=>'Yii::app()->createUrl("/regions/backend/main/move", array("id"=>$data->id, "direction" => "up"))',
			'options' => array('class'=>'infopages_arrow_image_up'),
			'visible' => '$data->sorter > 1',
			'click' => "js: function() { ajaxMoveRequest($(this).attr('href'), 'apartment-city-grid'); return false;}",
		),
		'down' => array(
			'label' => tc('Move an item down'),
			'imageUrl' => $url = Yii::app()->assetManager->publish(
				Yii::getPathOfAlias('zii.widgets.assets.gridview').'/down.gif'
			),
			'url'=>'Yii::app()->createUrl("/regions/backend/main/move", array("id"=>$data->id, "direction" => "down"))',
			'options' => array('class'=>'infopages_arrow_image_down'),
			'visible' => '$data->sorter < "'.$maxSorter.'"',
			'click' => "js: function() { ajaxMoveRequest($(this).attr('href'), 'apartment-city-grid'); return false;}",
		),
	),
	'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }'
);

$this->widget('bootstrap.widgets.TbGridView', array(
	'type' => 'striped',
	'dataProvider'=>$model->search(),
	'afterAjaxUpdate' => 'function(){$("a[rel=\'tooltip\']").tooltip(); $("div.tooltip-arrow").remove(); $("div.tooltip-inner").remove();}',
	'columns'=>$columns
));

?>

<?php
	$this->renderPartial('//main/admin-select-items', array(
		'url' => '/apartmentCity/backend/main/itemsSelected',
		'id' => 'apartment-city-grid',
		'model' => $model,
		'options' => array(
			'delete' => Yii::t('common', 'Delete')
		),
	));
?>
