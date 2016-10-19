<?php
	$this->pageTitle .= ' - '. ImagesModule::t('Image');
	$this->adminTitle = ImagesModule::t('Image');


	Yii::app()->clientScript->registerCssFile($this->assetsBase.'/css/colorpicker.css');
	Yii::app()->clientScript->registerScriptFile($this->assetsBase.'/js/bootstrap-colorpicker.js', CClientScript::POS_END);
?>
<div class="profile-edit">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>$this->modelName.'-form',
		'enableAjaxValidation'=>false,
		'htmlOptions'=>array('class'=>'form-horizontal', 'enctype'=>'multipart/form-data'),
	)); ?>

	<div class="control-group">
		<?php echo $form->labelEx($model, 'maxImageWidth', array('class'=>'control-label')); ?>
	    <div class="controls">
	       	<?php echo $form->textField($model, 'maxImageWidth', array('class'=>'span12')); ?>
	       	<?php echo $form->error($model, 'maxImageWidth'); ?>
	    </div>
    </div>
    <div class="control-group">
		<?php echo $form->labelEx($model, 'maxImageHeight', array('class'=>'control-label')); ?>
	    <div class="controls">
	       	<?php echo $form->textField($model, 'maxImageHeight', array('class'=>'span12')); ?>
	       	<?php echo $form->error($model, 'maxImageHeight'); ?>
	    </div>
    </div>
    <div class="control-group">
		<?php echo $form->labelEx($model, 'useWatermark', array('class'=>'control-label')); ?>
	    <div class="controls">
	    	<div class="radio">
	       	<?php echo $form->radioButtonList($model, 'useWatermark', array(
			'1' => tc('Yes'),
			'0' => tc('No'),
		), array(
			'onChange' => 'showArea(this.value);',

		)); ?>
		</div>
	       	<?php echo $form->error($model, 'useWatermark'); ?>
	    </div>
    </div>

    <div id="watermarkSettings">
        <div class="control-group">
			<?php echo $form->labelEx($model, 'watermarkType', array('class'=>'control-label')); ?>
				<div class="controls">
				<?php echo $form->radioButtonList($model, 'watermarkType', array(
					ImageSettings::WATERMARK_FILE => ImagesModule::t('Image'),
					ImageSettings::WATERMARK_TEXT => ImagesModule::t('Text'),
				), array(
					'onChange' => 'showMarkArea(this.value);',
				)); ?>
			</div>
        </div>

		<div id="watermarkImageSettings">
            <div class="control-group">
				<?php
					echo CHtml::activeLabel($model, 'watermarkFile', array('required' => true, 'class'=>'control-label'));
					if(param('watermarkFile')){
						echo CHtml::image(Yii::app()->request->getBaseUrl().'/'.Images::UPLOAD_DIR.'/'.param('watermarkFile'));
						echo '<br/><br/>';
					}
				?>

                <div class="controls">
					<?php echo $form->fileField($model, 'watermarkFile'); ?>
					<?php echo $form->error($model, 'watermarkFile'); ?>
				</div>
			</div>
		</div>
		<div id="watermarkTextSettings">
            <div class="control-group">
				<?php echo $form->labelEx($model, 'watermarkContent', array('class'=>'control-label')); ?>
				<div class="controls">
					<?php echo $form->textField($model, 'watermarkContent', array('class' => 'span12')); ?>
					<?php echo $form->error($model, 'watermarkContent'); ?>
				</div>
            </div>

            <div class="control-group">
				<?php echo $form->labelEx($model, 'watermarkTextColor', array('class'=>'control-label')); ?>
				<div class="controls">
	                <div class="input-append color" data-color="<?php echo $model->watermarkTextColor; ?>" data-color-format="rgb" id="watermarkTextColor">
	                    <input id="ImageSettings_watermarkTextColor" type="text" class="span6" value="<?php echo $model->watermarkTextColor; ?>" name="ImageSettings[watermarkTextColor]" />
	                    <span class="add-on"><i style="background-color: <?php echo $model->watermarkTextColor; ?>;"></i></span>
	                </div>

					<?php echo $form->error($model, 'watermarkTextColor'); ?>
				</div>
            </div>

            <div class="control-group">
				<?php echo $form->labelEx($model, 'watermarkTextSize' , array('class'=>'control-label')); ?>
                <div class="controls">
					<?php echo $form->textField($model, 'watermarkTextSize', array('class' => 'span4')); ?>
					<?php echo $form->error($model, 'watermarkTextSize'); ?>
				</div>
            </div>


           <div class="control-group">
				<?php echo $form->labelEx($model, 'watermarkTextOpacity', array('class'=>'control-label')); ?>
				<div class="controls">
	                <div class="input-append">
						<?php echo $form->textField($model, 'watermarkTextOpacity', array('class' => 'span6')); ?>
	                    <span class="add-on">%</span>
	                </div>
					<?php echo $form->error($model, 'watermarkTextOpacity'); ?>
				</div>
            </div>
		</div>

        <div class="control-group">
			<?php echo CHtml::activeLabel($model, 'watermarkPosition', array('class'=>'control-label', 'required' => true)); ?>
			<div class="controls">
				<div id="waermarkPositionTemplate" class="well">
					<div class="relative">
						<input type="radio"
							style="position:absolute; top: 3px; left: 7px;"
							name="ImageSettings[watermarkPosition]"
							value="<?php echo ImageSettings::POS_LEFT_TOP; ?>"
							<?php echo $model->watermarkPosition == ImageSettings::POS_LEFT_TOP ? 'checked="checked"':''; ?>
						/>
	                    <input type="radio"
	                           style="position:absolute; top: 116px; left: 7px;"
	                           name="ImageSettings[watermarkPosition]"
	                           value="<?php echo ImageSettings::POS_LEFT_MIDDLE; ?>"
							<?php echo $model->watermarkPosition == ImageSettings::POS_LEFT_MIDDLE ? 'checked="checked"':''; ?>
	                    />
	                    <input type="radio"
	                           style="position:absolute; top: 224px; left: 7px;"
	                           name="ImageSettings[watermarkPosition]"
	                           value="<?php echo ImageSettings::POS_LEFT_BOTTOM; ?>"
							<?php echo $model->watermarkPosition == ImageSettings::POS_LEFT_BOTTOM ? 'checked="checked"':''; ?>
						/>



	                    <input type="radio"
	                           style="position:absolute; top: 3px; left: 118px;"
	                           name="ImageSettings[watermarkPosition]"
	                           value="<?php echo ImageSettings::POS_CENTER_TOP; ?>"
							<?php echo $model->watermarkPosition == ImageSettings::POS_CENTER_TOP ? 'checked="checked"':''; ?>
						/>
	                    <input type="radio"
	                           style="position:absolute; top: 116px; left: 118px;"
	                           name="ImageSettings[watermarkPosition]"
	                           value="<?php echo ImageSettings::POS_CENTER_MIDDLE; ?>"
							<?php echo $model->watermarkPosition == ImageSettings::POS_CENTER_MIDDLE ? 'checked="checked"':''; ?>
						/>
	                    <input type="radio"
	                           style="position:absolute; top: 224px; left: 118px;"
	                           name="ImageSettings[watermarkPosition]"
	                           value="<?php echo ImageSettings::POS_CENTER_BOTTOM; ?>"
							<?php echo $model->watermarkPosition == ImageSettings::POS_CENTER_BOTTOM ? 'checked="checked"':''; ?>
						/>


	                    <input type="radio"
	                           style="position:absolute; top: 3px; left: 230px;"
	                           name="ImageSettings[watermarkPosition]"
	                           value="<?php echo ImageSettings::POS_RIGHT_TOP; ?>"
							<?php echo $model->watermarkPosition == ImageSettings::POS_RIGHT_TOP ? 'checked="checked"':''; ?>
	                            />
	                    <input type="radio"
	                           style="position:absolute; top: 116px; left: 230px;"
	                           name="ImageSettings[watermarkPosition]"
	                           value="<?php echo ImageSettings::POS_RIGHT_MIDDLE; ?>"
							<?php echo $model->watermarkPosition == ImageSettings::POS_RIGHT_MIDDLE ? 'checked="checked"':''; ?>
	                            />
	                    <input type="radio"
	                           style="position:absolute; top: 224px; left: 230px;"
	                           name="ImageSettings[watermarkPosition]"
	                           value="<?php echo ImageSettings::POS_RIGHT_BOTTOM; ?>"
							<?php echo $model->watermarkPosition == ImageSettings::POS_RIGHT_BOTTOM ? 'checked="checked"':''; ?>
	                            />
					</div>
				</div>
				<?php echo $form->error($model, 'watermarkPosition'); ?>
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
                'label'=>'<i class="fa  fa-floppy-o"></i> '.Yii::t('index', 'Save'),  
            )); ?>
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
<?php
	Yii::app()->clientScript->registerScript('watermarkLoad', '
		$("#watermarkTextColor").colorpicker({
			format: "hex"
		});

		showArea($(\'[name="ImageSettings[useWatermark]"]:checked\').val());
		showMarkArea($(\'[name="ImageSettings[watermarkType]"]:checked\').val());

		function showMarkArea(val){
			$("#watermarkTextSettings").hide();
			$("#watermarkImageSettings").hide();

			if(val == "'.ImageSettings::WATERMARK_FILE.'"){
				$("#watermarkImageSettings").show();
			}
			if(val == "'.ImageSettings::WATERMARK_TEXT.'"){
				$("#watermarkTextSettings").show();
			}
		}

		function showArea(val){
			if(val == 1){
				$("#watermarkSettings").show();
			} else {
				$("#watermarkSettings").hide();
			}
		}
	', CClientScript::POS_END);



