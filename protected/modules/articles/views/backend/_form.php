
<?php  $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	    'id'=>$this->modelName.'-form',
	    'enableAjaxValidation'=>true,
	    'htmlOptions'=>array('class'=>'forn-vertical'),
		)); ?>

	<p class="tip-desc"><?php Yii::t('common', 'Fields with <span class="required">*</span> are required.');?></p>
	<?php echo $form->errorSummary($model); ?>
	<div class="control-group">
	  <?php echo $form->labelEx($model,'page_title', array('class' => 'control-label')); ?>
	  <div class="controls">
		<?php echo $form->textField($model, 'page_title', array('class'=>'span12')); ?>
	  </div>
	</div>
	<div class="control-group">
	  <?php echo $form->labelEx($model,'page_body', array('class' => 'control-label')); ?>
	  <div class="controls">
		<?php
		    echo $this->widget('application.extensions.ckeditor.CKEditor', array(
							'model' => $model,
							'attribute' => 'page_body',
							'editorTemplate' => 'advanced', /* full, basic */
							'skin' => 'kama',
							'toolbar' => array(
								array('Source', '-', 'Bold', 'Italic', 'Underline', 'Strike'),
								array('Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'),
								array('NumberedList', 'BulletedList', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'),
								array('Styles', 'Format', 'Font', 'FontSize', 'TextColor', 'BGColor'),
								array('Image', 'Link', 'Unlink', 'SpecialChar'),
							),
							'htmlOptions' => array('id' => 'page_body')
						), true);
		    
		    ?>
	  </div>
	</div>
	<div class="rowold buttons">
        <?php $this->widget('bootstrap.widgets.TbButton',
                    array('buttonType'=>'submit',
                        'type'=>'primary',
                        'icon'=>'ok white',
                        'label'=> $model->isNewRecord ? tc('Add') : tc('Save'),
                    )); ?>
	</div>

<?php $this->endWidget(); ?>

<div class="clear"></div>
<?php
if (issetModule('seo') && !$model->isNewRecord) {
	$this->widget('application.modules.seo.components.SeoWidget', array(
		'model' => $model,
	));
} ?>

