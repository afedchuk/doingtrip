<?php
$this->breadcrumbs=array(
	Yii::t('common', 'User managment') => array('admin'),
	CHtml::encode($model->email).(CHtml::encode($model->username) != '' ? ' ('.CHtml::encode($model->username).')' : '') => array('view','id'=>$model->id),
	tt('Edit user'),
);

$this->menu=array(
	array('label'=>Yii::t('common', 'User managment'), 'url'=>array('admin')),
	array('label'=>UserModule::t('Delete user'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),
		'confirm'=>UserModule::t('Are you sure you want to delete this item?'))),
	array('label'=>UserModule::t('Add user'), 'url'=>array('/users/backend/main/create')),
);
$model->scenario = 'update';

$this->adminTitle = $model->email.(CHtml::encode($model->username) != '' ? ' ('.CHtml::encode($model->username).')' : '');
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>