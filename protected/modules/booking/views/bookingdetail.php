<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'modal-booking')); ?>
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h2><?php echo BookingModule::t('Booking detail'); ?></h2>
		<p class="tip"><?php echo BookingModule::t('Detail tip'); ?></p>
    </div>
    <div class="tmp-conatiner">
	    <div class="modal-body">
			<?php if(is_null($model)) : ?>
				<?php $form=$this->beginWidget('CActiveForm', array(
				        'id'=>$this->modelName.'-form',
				        'enableAjaxValidation'=>true,
				        'clientOptions' => array(
				            'validateOnSubmit' => true,
				            'afterValidate'=>'js:function(form,data,hasError){
				                        if(!hasError){
				                        	$.ajax({
				                                    "type":"POST",
				                                    "url":"'.Yii::app()->createAbsoluteUrl("apartments/booking/detail").'?checked=true",
				                                    "data":form.serialize(),
				                                    "success":function(data){$(".modal-body").html(data);},
				                            });
				                        }
				            }'
				        ),
				     )); 
				?>
					<div class="control-group">
					        <div class="controls">
					            <?php echo $form->textField($booking,'book_unique', array('autocomplete'=>'off', 'placeholder' => Booking::model()->getAttributeLabel('book_unique'))) ?>
					            <div class="error">
					                <?php echo $form->error($booking,'book_unique'); ?>
					            </div>
					        </div>
					</div>
					<div class="control-group">
					        <div class="controls">
					            <?php echo $form->textField($booking,'pin', array( 'autocomplete'=>'off', 'placeholder' => Booking::model()->getAttributeLabel('pin'))) ?>
					            <div class="error">
					                <?php echo $form->error($booking,'pin'); ?>
					            </div>
					        </div>
					</div>
				<?php $this->endWidget(); ?>
				<p class="tip">
				   <?php echo BookingModule::t('Forget pin', array('link'=>CHtml::ajaxLink(
					  		  BookingModule::t('Press here'),
					  		  Yii::app()->createAbsoluteUrl("apartments/booking/restore"),
							  array(
							    'type' => 'GET',
							    'beforeSend' => "function( request ){
							                     
							     }",
							    'success' => "function( data ) {
							    	$('.tmp-conatiner').stop().css('opacity', '0').html(data).animate({
								        opacity: 1 
								    }, 2000);
							 	}",
							    'data' => array()
							  ),
							  array( 
							    'href' => Yii::app()->createAbsoluteUrl("apartments/booking/restore"),
							    'class' => 'forget-link',
							  )))); 
					?>
				</p>
			<?php endif; ?>
		</div>
		<div class="modal-footer">
	       <?php 
	       		$this->widget('bootstrap.widgets.TbButton', array(
			    'label'=>BookingModule::t('Find booking'),
			    'type'=>'primary',
			    'buttonType' =>'submit',
			    'icon' => 'search white',
			    'htmlOptions' => array('onclick' => '$("form#'.$this->modelName.'-form").submit()')
			)); ?>
		</div>
	</div>
<?php $this->endWidget(); ?>
