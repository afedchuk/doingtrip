<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'modal-booking')); ?>
<?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>$this->modelName.'-form',
                        'enableAjaxValidation'=>true,
                        'enableClientValidation'=>false,
                        'clientOptions' => array(
                            'validateOnSubmit' => false,
                            'validateOnChange' => true,
                        )
                     )); ?>
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4><?php echo ApartmentsModule::t("Location apartment"); ?></h4>    
</div>
 
<div class="modal-body">
<?php 
    if(($model->lat && $model->lng) || Yii::app()->user->getState('isAdmin')){
            if(param('useGoogleMap') == 1){
                    ?>
                    <div>
                            <div id="gmap">
                                    <?php echo $this->actionGmap($model->id, $model); ?>
                            </div>
                    </div>
                    <?php
            }
            if(param('useYandexMap') == 1){
                    ?>
                    <div>
                            <div id="ymap">
                                    <?php echo $this->actionYmap($model->id, $model); ?>
                            </div>
                    </div>
                    <?php
            }
    }
?>
</div>
<?php $this->endWidget(); ?>
<?php $this->endWidget(); ?>