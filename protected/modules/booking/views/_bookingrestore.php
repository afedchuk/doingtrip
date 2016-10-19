<?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>$this->modelName.'-form',
        'enableAjaxValidation'=>true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'afterValidate'=>'js:function(form,data,hasError){
                if(!hasError){
                	$(".tmp-conatiner").stop().css("opacity", "0").html(data).animate({
								        opacity: 1 
								    }, 2000);
                }
            }'
        ),
     )); 
	?>
<div class="modal-body">
	<div class="control-group">
	        <div class="controls">
	            <?php echo $form->textField($booking,'useremail', array('placeholder' => User::model()->getAttributeLabel('email'))) ?>
	            <div class="error">
	                <?php echo $form->error($booking,'useremail'); ?>
	            </div>
	        </div>
	</div>
	<p class="tip"><?php echo BookingModule::t('Restore booking tip'); ?></p>
</div>
<div class="modal-footer">
   <?php 
   		$this->widget('bootstrap.widgets.TbButton', array(
	    'label'=>Yii::t('common', 'Send letter'),
	    'type'=>'primary',
	    'buttonType' =>'submit',
	    'icon' => 'envelope white',
	)); ?>
</div>
<?php $this->endWidget(); ?>