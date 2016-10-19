<?php 
$this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'modal-booking')); ?>
    <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'User-form',
            'enableAjaxValidation'=>true,
            'htmlOptions' => array('enctype' => 'multipart/form-data'),
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),

    )); ?>
        <div class="modal-header">
            <a class="close" data-dismiss="modal">&times;</a>
            <h2><?php echo ImagesModule::t('Upload image')?></h2>  
            <p class="tip"><?php echo ImagesModule::t('Avatar upload description')?></p>
        </div>
     	
        <div class="modal-body">
        	<?php $this->widget('ext.EAjaxUpload.EAjaxUpload',
            array(
                'id'=>'uploadFile',
                'config'=>array(
                    'action' => Yii::app()->createUrl('/user/profile/changeAvatar'),
                    'allowedExtensions'=> param('allowedImgExtensions', array('jpg', 'jpeg', 'gif', 'png')),
                    'sizeLimit' => Images::getMaxSizeLimit(),
                    'minSizeLimit' => param('minImgFileSize', 5*1024),
                    'multiple' => true,
                    'onComplete'=>"js:function(id, fileName, responseJSON){ window.location.reload(); }",
                    /*'onSubmit' => 'js:function(id, fileName){  }',*/
                    'messages'=>array(
                        'typeError'=>ImagesModule::t("{file} has invalid extension. Only {extensions} are allowed."),
                        'sizeError'=>ImagesModule::t("{file} is too large, maximum file size is {sizeLimit}."),
                        'minSizeError'=>ImagesModule::t("{file} is too small, minimum file size is {minSizeLimit}."),
                        'emptyError'=>ImagesModule::t("{file} is empty, please select files again without it."),
                        'onLeave'=>ImagesModule::t("The files are being uploaded, if you leave now the upload will be cancelled."),
                    ),
                )
            )); ?>
        </div>
    <?php $this->endWidget(); ?>
<?php $this->endWidget(); ?>
