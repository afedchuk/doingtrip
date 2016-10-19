<?php
$this->pageTitle=Yii::app()->name . ' - ' .NotifierModule::t('Mail editor');

$this->adminTitle = NotifierModule::t('Mail editor');

$this->menu=array(
    array('label'=>NotifierModule::t('Add letter'), 'url'=>array('/notifier/backend/main/create')),
);


?>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped',
    'dataProvider'=>$model->active()->search(),
    'filter'=>$model,
    'afterAjaxUpdate' => 'function(){$("a[rel=\'tooltip\']").tooltip(); $("div.tooltip-arrow").remove(); $("div.tooltip-inner").remove();}',
    'columns'=>array(

        array(
            'name' => 'status',
            'value' => '$data->getStatusName()',
            'filter' => NotifierModel::getStatusList(),
        ),
        array(
            'name' => 'event',
        ),
        array(
            'value' => '$data->subject',
        ),

        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{update}',
            'buttons' => array(
                'update' => array(
                    'url'=>'Yii::app()->createUrl("/notifier/backend/main/update", array("id"=>$data->letter_id, "direction" => "up"))',
                )
            ),
        ),
    ),
));

?>