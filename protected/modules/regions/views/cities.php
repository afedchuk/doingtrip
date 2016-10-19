<?php 
Yii::app()->clientScript->registerScript('city', "
    $('.city-list li a').click(function() {
        window.location = $(this).attr('href')+window.location.search
        return false;
    });
",
CClientScript::POS_HEAD, array(), true);
$this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'modal-booking')); ?>
    <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>$this->modelName.'-form',
            'enableAjaxValidation'=>true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
            'htmlOptions' => array('class' => 'form-horizontal')

    )); ?>
        <div class="modal-header">
            <a class="close" data-dismiss="modal">&times;</a>
            <h2><?php echo RegionsModule::t('Choose region'); ?></h2>
        </div>
        <div class="modal-body">
                <?php $i =0; $count = ceil(count($model)/4); ?>
                <ul class="city-list">
                    <li><?php echo CHtml::link(RegionsModule::t('Search all regions'), Yii::app()->createUrl('apartments'), array('class' => 'bold')); ?></li>
                    <?php  foreach($model as $value) { if(isset($value->city_description->name) && $value->city_description->name) { $count = count($value->apartments); ?>
                        <?php if($count > 0 ) { ?>
                            <li>
                                <?php echo CHtml::link($value->city_description->name.' <span>('.$count .')</span>', Yii::app()->createAbsoluteUrl('apartments', array('city' => $value->url)), array('title' => $value->city_description->name)); ?>
                            </li> 
                        <?php } ?>
                    <?php  } } ?>
                </ul>
        </div>
        <div class="modal-footer">
            
        </div>
    <?php $this->endWidget(); ?>
<?php $this->endWidget(); ?>