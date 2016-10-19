<?php
Yii::app()->clientScript->registerScript('ajaxSetStatus', "
	function ajaxSetStatus(elem, id){
		$.ajax({
			url: $(elem).attr('href'),
			success: function(){
				$('#'+id).yiiGridView.update(id);
			}
		});
	}
    ",
    CClientScript::POS_HEAD);

$this->breadcrumbs=array(
	Yii::t('common', 'References') => array('/site/viewreferences'),
	tt('Manage reference values'),
);

$this->menu=array(
	array('label'=>tt('Create value'), 'url'=>array('/referencevalues/backend/main/create')),
);


$this->adminTitle = tt('Manage reference values');

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
		'name' => 'description.title',
		'sortable' => false,
	),
	array(
		'name' => 'category.title',
		'sortable' => false,
	),
);
$columns[] = array(
	'class'=>'bootstrap.widgets.TbButtonColumn',
	'template'=>'{up}{down}{update}{delete}',
	'deleteConfirmation' => tc('Are you sure you want to delete this item?'),
	'buttons' => array(
		'up' => array(
			'label' => tt('Move value item up'),
			'imageUrl' => $url = Yii::app()->assetManager->publish(
				Yii::getPathOfAlias('zii.widgets.assets.gridview').'/up.gif'
			),
			'url'=>'Yii::app()->createUrl("/referencevalues/backend/main/move", array("id"=>$data->id, "direction" => "up", ))',
			'options' => array('class'=>'infopages_arrow_image_up'),
			'visible' => '$data->sorter > 1',
			'click' => "js: function() { ajaxMoveRequest($(this).attr('href'), 'reference-values-grid'); return false;}",
		),
		'down' => array(
			'label' => tt('Move value item up'),
			'imageUrl' => $url = Yii::app()->assetManager->publish(
				Yii::getPathOfAlias('zii.widgets.assets.gridview').'/down.gif'
			),
			'url'=>'Yii::app()->createUrl("/referencevalues/backend/main/move", array("id"=>$data->id, "direction" => "down"))',
			'options' => array('class'=>'infopages_arrow_image_down'),
			'visible' => '$data->sorter < Yii::app()->controller->maxSorters[$data->id]',
			'click' => "js: function() { ajaxMoveRequest($(this).attr('href'), 'reference-values-grid'); return false;}",
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
?>
