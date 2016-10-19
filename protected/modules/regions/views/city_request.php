<div class="well">
<?php 
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
        'name' => 'id',
        'sortable' => false,
    ),
     array(
        'name' => 'description.title',
        'type' => 'raw',
        'value' => 'CHtml::link(CHtml::encode($data->description->title),Apartment::model()->getUrl($data->id, $data->description->title, City::getCityName($data->city_id)))',
        'sortable' => false,
    ),
    array(
        'name' => 'city_id',
        'value' => '$data->city_id ? City::getCityName($data->city_id) : ""',
        'sortable' => false,
        'filter' => City::getAllCity(),
    ),
    array(
        'name' => 'owner_active',
        'type' => 'raw',
        'value' => 'Apartment::getApartmentsStatus($data->owner_active)',
        'sortable' => false,
        'filter' => Apartment::getApartmentsStatusArray(),
    ),
    array(
        'name' => 'type',
        'type' => 'raw',
        'value' => 'Apartment::getNameByType($data->type)',
        'filter' => Apartment::getTypesArray(),//CHtml::dropDownList('Apartment[type_filter]', $currentType, Apartment::getTypesArray(true)),
        'sortable' => false,
    ),
    
);
$columns[] = array(
    'class'=>'bootstrap.widgets.TbButtonColumn',
    'template'=>'{deactivate}{active}{update}{delete}',
    'deleteConfirmation' => tc('Are you sure you want to delete this item?'),
    'buttons' => array(
        'deactivate' => array(
            'label' => UserModule::t('Active'),
            'icon'=>'eye-close',
            'url'=>'Yii::app()->createUrl("user/profile/activateadmin", array("id"=>$data->id))',
            'visible'=>'($data->active==1)?true:false;'
            
        ),
        'active' => array(
            'label' => UserModule::t('Not active'),
            'icon'=>'eye-open',
            'url'=>'Yii::app()->createUrl("user/profile/activateadmin", array("id"=>$data->id))',
            'visible'=>'($data->active==0)?true:false;'
        ),
        'update' => array(
            'url' => 'Yii::app()->createAbsoluteUrl("user/profile/editApartment", array("id"=>$data->id))',
        ),
        'delete' => array(
            'url' => 'Yii::app()->createAbsoluteUrl("user/profile/deleteApartment", array("id"=>$data->id))',
        ),
    )
);

$this->widget('CustomGridView', array(
    'id'=>'apartments-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'afterAjaxUpdate' => 'function(){$("a[rel=\'tooltip\']").tooltip(); $("div.tooltip-arrow").remove(); $("div.tooltip-inner").remove();}',
    'columns'=>$columns

));
?>
</div>