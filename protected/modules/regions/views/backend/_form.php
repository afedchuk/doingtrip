
<div class="control-group">
  <?php echo $form->labelEx($model,'[$lang]name', array('class'=>'control-label')); ?>
  <div class="controls">
      <?php echo $form->textField($model,"[$lang]name",array('maxlength'=>255, 'class' => 'span12')); ?>
      <?php if($form->error($model,'[$lang]name')): ?>
          <?php echo $form->error($model,'[$lang]name'); ?>
      <?php endif; ?>
  </div>
</div>

<div class="control-group">
  <?php echo $form->labelEx($model,'[$lang]sname', array('class'=>'control-label')); ?>
  <div class="controls">
      <?php echo $form->textField($model,"[$lang]sname",array('maxlength'=>255, 'class' => 'span12')); ?>
      <?php if($form->error($model,'[$lang]sname')): ?>
          <?php echo $form->error($model,'[$lang]sname'); ?>
      <?php endif; ?>
  </div>
</div>

<div class="control-group">
  <?php echo $form->labelEx($model,'[$lang]description', array('class'=>'control-label')); ?>
  <div class="controls">
      <?php echo $this->widget('application.extensions.ckeditor.CKEditor', array(
          'model' => $model,
          'attribute' => "[$lang]description",
          'language' => '' . Yii::app()->language . '',
          'editorTemplate' => 'advanced', /* full, basic */
          //'skin' => 'kama',
          'toolbar' => array(
            array('Source', '-', 'Bold', 'Italic', 'Underline', 'Strike'),
            array('Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'),
            array('NumberedList', 'BulletedList', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'),
            array('Styles', 'Format', 'Font', 'FontSize', 'TextColor', 'BGColor'),
            array('Image', 'Link', 'Unlink', 'SpecialChar'),
          ),
          'htmlOptions' => array('id' => "$lang]description")
        ), true);
      ?>
      
      <?php if($form->error($model,'description')): ?>
          <?php echo $form->error($model,'description'); ?>
      <?php else: ?>
          <!--p class="input-desc"><?php echo ApartmentsModule::t('Tip description'); ?></p-->
      <?php endif; ?>
  </div>
</div>