<?php 
    $this->widget('application.modules.fancybox.EFancyBox', array(
                        'target'=>'a.fancy',
                        'config'=>array(
                                        'ajax' => array('data'=>"isFancy=true"),
                                ),
                        )
            );
    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'Apartment-create-form',
        'enableAjaxValidation'=>true,
        'clientOptions' => array('validateOnSubmit'=>true,
                                 'validationUrl' => Yii::app()->createUrl("/apartments/main/uploadPhotos" ), 
                                )                

)); ?>

<?php 
    $this->widget('application.modules.images.components.AdminImagesWidget', array(
        'objectId' => $img,
        'tmp' => true
    ));
?>
<?php $this->endWidget(); ?>
<div class="mrgT35"></div> 

<a class="btn btn-info btn-large" href="#4">
    <?php echo ApartmentsModule::t('Back'); ?>
</a>
<a id="submit-button" class="btn btn-large btn-info pull-right last" onclick="$('#Apartment-create-form').submit();">
    <?php echo ApartmentsModule::t('Next'); ?>
</a>