<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t('Edit profile');
$this->breadcrumbs=array(
        UserModule::t("Profile")=>array('profile'),
        UserModule::t('Add discount'),
);
?>

<div class="row-fluid profile-wrapper">
    <div class="span9">
        <div class="well profile-edit">
				<?php
					$form=$this->beginWidget('CActiveForm', array(
						'id'=>$this->modelName.'-form',
						'enableAjaxValidation'=>false,
				        'htmlOptions' => array('class' => 'form-horizontal'),
					));
					?>
					<div class="page-header">
                        <h4><?php echo UserModule::t('Add discount'); ?></h4>
                    </div>
					<div class="control-group">
                        <?php echo $form->labelEx($model,'apartment_id', array('class'=>'control-label')); ?>
                        <div class="controls">
                            <?php echo $form->dropDownList($model,'apartment_id', ApartmentDiscount::getApartemnts(), array('class' => 'span8')); ?>
                            <?php echo $form->error($model,'apartment_id'); ?>
                        </div>
                    </div>
					<div class="control-group">
					    <?php echo $form->labelEx($model,'title', array('class' => 'control-label')); ?>
					    <div class="controls">
					        <?php echo $form->textField($model,'title',array('class' =>'span8','maxlength'=>255)); ?>
					        <?php echo $form->error($model,'title'); ?>
					    </div>
					</div>

					<div class="control-group">
					    <?php echo $form->labelEx($model,'value', array('class' => 'control-label')); ?>
					    <div class="controls">
					        <?php echo $form->textField($model,'value',array('class' =>'span1','maxlength'=>3)); ?>
					        <span style="font-size:10px; margin-left:5px;">%</span>
					        <?php echo $form->error($model,'value'); ?>
					    </div>
					</div>



					<div id="is-time">
						<div class="control-group">
						    <?php echo $form->labelEx($model,'date_start', array('class' => 'control-label')); ?>
						    <div class="controls">
						    	<?php $this->widget('application.extensions.FJuiDatePicker', array(
													'model'=>$model,
													'attribute'=>'date_start',
													'language' => Yii::app()->language,
													'htmlOptions' => array('class' => 'span4', 'value' => date('Y/m/d',$model->date_start)),
													'options'=>array(
														'dateFormat'=>'yy/mm/dd',
														'minDate'=>'new Date()',
													),
												));
								?>
						        <?php echo $form->error($model,'date_start'); ?>
						    </div>
						</div>

						<div class="control-group">
						    <?php echo $form->labelEx($model,'date_finish', array('class' => 'control-label')); ?>
						    <div class="controls">
						    	<?php $this->widget('application.extensions.FJuiDatePicker', array(
													'model'=>$model,
													'attribute'=>'date_finish',
													'language' => Yii::app()->language,
													'htmlOptions' => array('class' => 'span4', 'value' => date('Y/m/d',$model->date_finish)),
													'options'=>array(
														'dateFormat'=>'yy/mm/dd',
														'minDate'=>'new Date()',
													),
												));
								?>
						        <?php echo $form->error($model,'date_finish'); ?>
						    </div>
						</div>
					</div>

					<div class="control-group">
					    <div class="controls">
					    	<div class="tip">
						    	<?php echo $form->checkBox($model,'is_time', array('checked' => false)); ?>
						        <?php echo ApartmentDiscount::model()->getAttributeLabel('is_time') ?>
						    </div>
					    </div>
					</div>

					<div id="is-nights" style="display:none;">
						<div class="control-group">
						    
						    <div class="controls">
						    	<div class="discount-block">
							        <select id="Comment_year" name="Comment[year]" class="span3">
										<option selected="selected" value="">більше 1 дня</option>
										<option value="2004">більше 2 дня</option>
										<option value="2005">більше 3 дня</option>
										<option value="2006">більше 5 дня</option>
										<option value="2007">більше 10 днів</option>
										<option value="2008">більше 20 днів</option>
										</select>
																<input type="text" maxlength="255" class="span2">
																<select id="Comment_year" name="Comment[year]" class="span2">
										<option selected="selected" value="">%</option>
										<option value="">грн</option>
									</select>
									<a  class="btn btn-default btn-small"><i class="fa fa-plus" onclick="$(this).parent().parent().after($(this).parent().parent().clone());"></i></a>
								</div>
						    </div>
						</div>
					</div>

					<div class="control-group">
				        <div class="controls">
				            <?php $this->widget('bootstrap.widgets.TbButton', array(
                                'type'=>'info',
                                'size' => 'large',
                                'buttonType' => 'submit',
                                'encodeLabel' => false,
                                'label'=>($model->isNewRecord ? '<i class="fa  fa-plus"></i> '.Yii::t('index', 'Create') : '<i class="fa  fa-floppy-o"></i> '.Yii::t('index', 'Save')),
                            )); ?>&nbsp;&nbsp;&nbsp;
				            <?php $this->widget('bootstrap.widgets.TbButton', array(
                                'type'=>'default',
                                'size' => 'large',
                                'encodeLabel' => false,
                                'buttonType' => 'link',
                                'label'=>  '<i class="fa fa-sign-out"></i> '.Yii::t('common', 'Cancel'),
                                'url' => Yii::app()->createAbsoluteUrl('/user/profile')
                            )); ?>
				        </div>
				    </div>

				<?php $this->endWidget(); ?>
		</div>
	</div>
	<?php echo $this->renderPartial('profile/menu'); ?> 
</div>
<script type="text/javascript">
$('#ApartmentDiscount_is_time').click(function() {
	if($(this).is(':checked')) {
		$('div#is-nights').show();
		$('div#is-time').hide();
	} else {
		$('div#is-nights').hide();
		$('div#is-time').show();
	}

})
</script>