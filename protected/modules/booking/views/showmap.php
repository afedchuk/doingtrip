<?php 
$this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'modal-booking')); ?>
    <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>$this->modelName.'-form',
            'enableAjaxValidation'=>true,
            'clientOptions' => array(
                'validateOnSubmit' => false,
            ),
            'htmlOptions' => array('class' => 'form-horizontal')

    )); ?>
        <div class="modal-header">
            <a class="close" data-dismiss="modal">&times;</a>
            <h2><?php echo $description->title; ?></h2>      
        </div>
        <div class="modal-body">
            <?php if(param('useGoogleMap') == 1){ ?>
                <div>
                    <div id="gmap">
                        <?php Yii::app()->gmap->actionGmap($model->id, $model, $marker); ?>
                    </div>
                </div>
              <?php } if(param('useYandexMap') == 1){ ?>
                 <div>
                    <div id="ymap">
                        <?php Yii::app()->ymap->actionYmap($model->id, $model, $marker); ?>
                    </div>
                 </div>    
              <?php } ?>
        </div>
    <?php $this->endWidget(); ?>
<?php $this->endWidget(); ?>
<?php Yii::app()->clientScript->registerScript('resize-map', "setTimeout(function(){ 
            google.maps.event.trigger(mapGMap, 'resize'); 
            google.maps.event.trigger(markersGMap[".$model->id."], 'click');
            mapGMap.panTo(markersGMap[".$model->id."].position);
        }, 1000);",
        CClientScript::POS_READY);
?>