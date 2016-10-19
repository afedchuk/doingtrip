<?php
$this->breadcrumbs=array(
	tt('Manage currencies')=>array('admin'),
	tt('Add currency'),
);

$this->menu=array(
	array('label'=>tt('Manage currencies'), 'url'=>array('admin')),
);

$this->adminTitle = tt('Add currency');
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>