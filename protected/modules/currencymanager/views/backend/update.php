<?php
$this->breadcrumbs=array(
	tt('Manage currencies')=>array('admin'),
	tt('Update currency'),
);

$this->menu=array(
	array('label'=>tt('Manage currencies'), 'url'=>array('admin')),
	/*array('label'=>tt('Create lang'), 'url'=>array('create')),
	array('label'=>tt('Delete lang'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>tc('Are you sure you want to delete this item?'))),*/
	array('label'=>tt('Create new currency'), 'url'=>array('/currencymanager/backend/main/create')),
);

$this->adminTitle = tt('Update currency');
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>