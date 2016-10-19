
<div class="control-group">
  <?php echo $form->labelEx($model,'[$lang]subject', array('class'=>'control-label')); ?>
  <div class="controls">
      <?php echo $form->textField($model,"[$lang]subject",array('maxlength'=>255, 'class' => 'span12')); ?>
      <?php if($form->error($model,'[$lang]subject')): ?>
          <?php echo $form->error($model,'[$lang]subject'); ?>
      <?php endif; ?>
  </div>
</div>
<div class="control-group">
  <?php echo $form->labelEx($model,'[$lang]body', array('class'=>'control-label')); ?>
  <div class="controls">
      <?php echo $this->widget('application.extensions.ckeditor.CKEditor', array(
          'model' => $model,
          'attribute' => "[$lang]body",
          'language' => '' . Yii::app()->language . '',
          'editorTemplate' => 'advanced',
          'toolbar' => array(
            array('Source', '-', 'Bold', 'Italic', 'Underline', 'Strike'),
            array('Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'),
            array('NumberedList', 'BulletedList', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'),
            array('Styles', 'Format', 'Font', 'FontSize', 'TextColor', 'BGColor'),
            array('Image', 'Link', 'Unlink', 'SpecialChar'),
          ),
          'htmlOptions' => array('id' => "$lang]body")
        ), true);
      ?>
      <p class="input-desc"><?php echo NotifierModule::t('Mail template for users'); ?></p>
      <?php if($form->error($model,'[$lang]body')): ?>
          <?php echo $form->error($model,'[$lang]body'); ?>
      <?php endif; ?>
  </div>
</div>
<div class="control-group">
  <?php echo $form->labelEx($model,'[$lang]body_admin', array('class'=>'control-label')); ?>
  <div class="controls">
      <?php echo $this->widget('application.extensions.ckeditor.CKEditor', array(
          'model' => $model,
          'attribute' => "[$lang]body_admin",
          'language' => '' . Yii::app()->language . '',
          'editorTemplate' => 'advanced',
          'toolbar' => array(
            array('Source', '-', 'Bold', 'Italic', 'Underline', 'Strike'),
            array('Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'),
            array('NumberedList', 'BulletedList', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'),
            array('Styles', 'Format', 'Font', 'FontSize', 'TextColor', 'BGColor'),
            array('Image', 'Link', 'Unlink', 'SpecialChar'),
          ),
          'htmlOptions' => array('id' => "$lang]body_admin")
        ), true);
      ?>
      <p class="input-desc"><?php echo NotifierModule::t('Mail template for admin'); ?></p>
      <?php if($form->error($model,'[$lang]body_admin')): ?>
          <?php echo $form->error($model,'[$lang]body_admin'); ?>
      <?php endif; ?>
  </div>
</div>
<div class="control-group">
    <?php  echo $form->labelEx($model,'[$lang]status', array('class'=>'control-label')); ?>
    <div class="controls">
        <?php echo $form->dropDownList($model, '[$lang]status',  NotifierModel::getStatusList(), array('prompt'=>  ApartmentsModule::t('--Select--'), 'class' => 'span6')) ?>
        <?php if($form->error($model,'[$lang]status')): ?>
            <?php echo $form->error($model,'[$lang]status'); ?>
        <?php endif; ?>
    </div>
</div>

