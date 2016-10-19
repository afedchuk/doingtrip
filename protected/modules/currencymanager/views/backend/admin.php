<?php
$this->breadcrumbs=array(
	tt('Manage currencies'),
);

$this->menu = array(
	array('label'=>tt('Add currency'), 'url'=>array('create')),
);
$this->adminTitle = tt('Manage currencies');

$this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'langs-grid',
	'type' => 'striped bordered',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'afterAjaxUpdate' => 'function(){$("a[rel=\'tooltip\']").tooltip(); $("div.tooltip-arrow").remove(); $("div.tooltip-inner").remove();}',
	'columns'=>array(
		array(
			'name' => 'active',
			'type' => 'raw',
			'value' => 'Yii::app()->controller->returnStatusHtml($data, "comment-grid")',
			'headerHtmlOptions' => array('class'=>'span1'),
			'filter' => true,
			'sortable' => true,
		),
		array(
            'header' => tc('Conversion rate'),
            'type' => 'raw',
            'value' => '$data->conversion_rate',
            'filter' => false,
            'sortable' => true,
            'headerHtmlOptions' => array(
                'class'=>'span2',
            ),
        ),
		array(
            'name' => 'currency',
            'type' => 'raw',
            'value' => '$data->currency',
            'filter' => false,
            'sortable' => true,
            'headerHtmlOptions' => array(
                'class'=>'span6',
            ),
        ),
		array(
			'name' => 'currency_code',
			'type' => 'raw',
			'value' => '$data->currency_code',
			'sortable' => true,
			'filter' => false,
			'headerHtmlOptions' => array(
				'class'=>'span2',
			),
		),

		array(
			//'class'=>'CButtonColumn',
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{up}{down}{update}{delete}',
			'deleteConfirmation' => tc('Are you sure you want to delete this item?'),
				'headerHtmlOptions' => array('class'=>'span1'),
				'buttons' => array(
                    'down' => array(
						'label' => tc('Move an item down'),
						'imageUrl' => Yii::app()->assetManager->publish(
							Yii::getPathOfAlias('zii.widgets.assets.gridview').'/down.gif'
						),
						'url'=>'Yii::app()->createUrl("/currencymanager/backend/main/move", array("id"=>$data->id, "direction" => "down", "catid" => "0"))',
						'options' => array('class'=>'infopages_arrow_image_up'),

						'visible' => '$data->sorter < "'.$maxSorter.'"',
						'click' => "js: function() { ajaxMoveRequest($(this).attr('href'), 'langs-grid'); return false;}",
					),
					'up' => array(
						'label' => tc('Move an item up'),
						'imageUrl' => Yii::app()->assetManager->publish(
							Yii::getPathOfAlias('zii.widgets.assets.gridview').'/up.gif'
						),
						'url'=>'Yii::app()->createUrl("/currencymanager/backend/main/move", array("id"=>$data->id, "direction" => "up", "catid" => "0"))',
						'options' => array('class'=>'infopages_arrow_image_down'),
						'visible' => '$data->sorter > 1',
						'click' => "js: function() { ajaxMoveRequest($(this).attr('href'), 'langs-grid'); return false;}",
					),
                    'delete' => array(
                        'label' => tc('Delete item'),
						'visible' => '$data->active != 1'
					)
				),
		),
	),
));


?>