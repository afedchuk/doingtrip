<?php 
$this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Create apartment");
$this->breadcrumbs=array(
        UserModule::t("Profile")=>array('/user/profile'),
        UserModule::t("Create apartment"),
);

$this->widget('application.modules.fancybox.EFancyBox', array(
            'target'=>'a.fancy',
            'config'=>array(
                            'ajax' => array('data'=>"isFancy=true"),
                    ),
            )
);
?>
<div class="row-fluid profile-wrapper">
    <div class="span9">
     <div class="well">
        <div class="profile-edit">
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'Apartment-form',
            'htmlOptions' => array('enctype'=>'multipart/form-data', 'class' => 'form-horizontal', 'onsubmit' => '$("#submit-button").addClass("disabled"); $("#cancel-button").after("<br/>'.Yii::t('common','Button waiting').'");'),
        )); ?>
            <?php 
            $tabs['tabs'] = array( array(
                                        'label' => '<i class="fa  fa-gears"></i> <br/>'.Yii::t('index', 'Tab general'),
                                        'content'=> $this->renderPartial('profile/_form_description', array('description' => $description, 'model' => $model, 'form' => $form), true ),
                                        'active' => true
                                        ),
                                    array(
                                        'label' => '<i class="fa  fa-thumb-tack"></i> <br/>'.ApartmentsModule::t('Conditions of rent'),
                                        'content' => $this->renderPartial('profile/_form_conditions', array('model' => $model, 'form' => $form), true )),
                                    array(
                                        'label' => '<i class="fa  fa-coffee"></i> <br/>'.Yii::t('index', 'Tab services'),
                                        'content' => $this->renderPartial('profile/_form_services', array('selected' => $selected, 'categories' => $categories,'model' => $model, 'form' => $form), true )),
                                    );
             if(!$model->isNewRecord) {
                $tabs['tabs'][] = array('label' => '<i class="fa  fa-camera"></i> <br/>'.Yii::t('index', 'Tab photos'),
                                      'content' => $this->renderPartial('profile/_form_photos', array('categories' => $categories,'model' => $model, 'form' => $form), true ),
                                      );
                $tabs['tabs'][] = array('label' => '<i class="fa  fa-map-marker"></i> <br/>'.Yii::t('index', 'Tab map'),
                                      'content' => $this->renderPartial('profile/_form_map', array('categories' => $categories,'model' => $model, 'form' => $form), true ),
                                      'itemOptions' => array('onclick' => 'reInitMap();')
                                      );

             } 
            $this->widget('bootstrap.widgets.TbTabs', array(
                                'type'=>'tabs',
                                'placement'=>'above', 
                                'id' => 'apartment-tab',
                                'tabs' => $tabs['tabs'],
                            ));
            ?>
            <br/>
            <div class="control-group">
                <div class="controls">
                    <?php $this->widget('bootstrap.widgets.TbButton', array(
                        'type'=>'info',
                        'size' => 'large',
                        'buttonType' => 'submit',
                        'encodeLabel' => false,
                        'label'=>($model->isNewRecord ? '<i class="fa  fa-plus"></i> '.Yii::t('index', 'Create') : '<i class="fa  fa-floppy-o"></i> '.Yii::t('index', 'Save')),
                        'htmlOptions'=>array('id' => 'submit-button','onclick' => "$('form#Apartment-form').submit();"),
                    )); ?>&nbsp;&nbsp;&nbsp;
                     <?php $this->widget('bootstrap.widgets.TbButton', array(
                        'type'=>'default',
                        'size' => 'large',
                        'encodeLabel' => false,
                        'buttonType' => 'link',
                        'label'=>  '<i class="fa fa-sign-out"></i> '.Yii::t('common', 'Cancel'),
                        'url' => Yii::app()->createAbsoluteUrl('/user/profile'),
                        'htmlOptions'=>array('id' => 'cancel-button')
                    )); ?>
                </div>
          </div>
          <div class="clear"></div>
    </div>
     <?php $this->endWidget(); ?>
 </div>
</div>
<?php echo $this->renderPartial('profile/menu'); ?> 
</div>
