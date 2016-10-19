<?php

$this->menu = array(
	array('label' => tt('Manage of the top menu'), 'url'=>array('admin')),
	array('label' => tt('Add menu item'), 'url'=>array('create')),
	array(
		'label' => tt('Update'),
		'url'=>array('update', 'id' => $model->id)
	),
	array(
		'label'=> tt('Delete item'),
		'url'=>'#',
		'linkOptions'=>array(
			'submit'=>array(
				'delete',
				'id' => $model->id
			),
			'confirm' => tc('Are you sure you want to delete this item?')
		)
	),
);

$this->renderPartial('../view', array(
	'model' => $model
));
