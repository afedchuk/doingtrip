<?php
$this->breadcrumbs=array(
	Yii::t('module_comments', 'Comments'),
);


$this->adminTitle = Yii::t('module_comments', 'Comments');

$this->widget('bootstrap.widgets.TbGridView', array(
	'type' => 'striped',
	'id'=>'comment-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'afterAjaxUpdate' => 'function(){$(".rating-block input").rating({"readOnly":true}); $("a[rel=\'tooltip\']").tooltip(); $("div.tooltip-arrow").remove(); $("div.tooltip-inner").remove();}',
	'columns'=>array(
		array(
			'class'=>'CCheckBoxColumn',
			'id'=>'itemsSelected',
			'selectableRows' => '2',
			'htmlOptions' => array(
				'class'=>'center',
			),
		),
		array(
			'name' => 'active',
			'type' => 'raw',
			'value' => 'Yii::app()->controller->returnStatusHtml($data, "comment-grid")',
			'headerHtmlOptions' => array('class'=>'infopages_status_column'),
			'filter' => false,
			'sortable' => false,
		),
		array(
			'name' => 'name',
			'type' => 'raw',
			'value' => 'Comment::getUserEmailLink($data)',
			//'filter' => true,
			'sortable' => true
		),
		'body',
		array(
			'name' => 'apartment_id',
			'type' => 'raw',
			'value' => 'CHtml::link($data->apartment->id, $data->apartment->getUrl())',
			'sortable' => true
		),
		array(
			'name' => 'date_created',
			'headerHtmlOptions' => array('style' => 'width:130px;'),
			'filter' => false,
			'sortable' => true,
		),
		array(
			'name' => 'rating',
			'type' => 'raw',
			'value'=>'$this->grid->controller->widget("CStarRating", array(
				"name" => $data->id,
				"id" => $data->id,
				"value" => $data->rating,
				"readOnly" => true,
			), true)',
			'headerHtmlOptions' => array('style' => 'width:85px;'),
			'htmlOptions' => array('class' => 'rating-block'),
			'filter' => false,
			//'sortable' => false,
		),
		array(
			//'class'=>'CButtonColumn',
			'class'=>'bootstrap.widgets.TbButtonColumn',
            'template' => '{update} {delete}',
			'deleteConfirmation' => tc('Are you sure you want to delete this item?'),
			'viewButtonUrl' => '',
		),
	),
));

$this->renderPartial('//main/admin-select-items', array(
	'url' => '/comments/backend/main/itemsSelected',
	'id' => 'comment-grid',
	'model' => $model,
	'options' => array(
		'activate' => Yii::t('common', 'Activate'),
		'deactivate' => Yii::t('common', 'Deactivate'),
		'delete' => Yii::t('common', 'Delete')
	),
));
?>