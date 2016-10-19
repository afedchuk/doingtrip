<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>$this->modelName.'-form',
    'enableAjaxValidation'=>true,
    'clientOptions' => array(
        'validateOnChange' => true,
        'validateOnSubmit' => true,
    ),
    'htmlOptions' => array('class'=>'form-horizontal well')
));
    Yii::app()->getClientScript()->registerScript(
    'clode',
    '$(".fa-close").click(function() {
        $("#Comment-form").hide(100, function() {
            $("#view-comments").show();
        });
     });',
     CClientScript::POS_END);
    ?>
    <div class="control-group">
	  <div class="controls">
		<i class="fa fa-close pull-right"></i>
	  </div>
	</div>
    <?php if(Yii::app()->user->isGuest){ ?>
    <div class="control-group">
	  <?php echo $form->labelEx($model,'name', array('class' => 'control-label')); ?>
	  <div class="controls">
		<?php echo $form->textField($model, 'name', array('class'=>'span4')); ?>
        <?php echo $form->error($model,'name'); ?>
	  </div>
	</div>
    <div class="control-group">
	  <?php echo $form->labelEx($model,'email', array('class' => 'control-label')); ?>
	  <div class="controls">
		<?php echo $form->textField($model, 'email', array('class'=>'span4')); ?>
        <?php echo $form->error($model,'email'); ?>
	  </div>
	</div>
    <div class="control-group">
	  <?php echo $form->labelEx($model,'phone', array('class' => 'control-label')); ?>
	  <div class="controls">
		<?php echo $form->textField($model, 'phone', array('class'=>' phone span4')); ?>
        <?php echo $form->error($model,'phone'); ?>
	  </div>
	</div>
    <?php } ?>
    <div class="control-group">
     <?php 
     $range = dateRange(date("Y-m-d", strtotime("-10 year", time())), date("Y-m-d", time()),  '+1 year', 'Y');
     $years = array('' => CommentsModule::t('Select year'));
     foreach($range as $value)
         $years[$value] = $value;
     ?>
     <label class="control-label"><?php echo CommentsModule::t('Term') ;?></label>
	  <div class="controls">
		<?php echo $form->dropDownList($model, 'year', array_combine(array_flip($years), $years), array('class'=>'span2')); ?>
        <?php echo $form->dropDownList($model, 'month', array_merge(array('' => CommentsModule::t('Select month')),Yii::app()->getLocale(Yii::app()->language)->getMonthNames('wide',true)), array('class'=>'span2')); ?>
        <?php echo $form->error($model,'year'); ?>
        <?php echo $form->error($model,'month'); ?>
	  </div>
	</div>
    <div class="control-group">
	  <div class="controls">
          <?php $this->widget('CStarRating',array('name'=>'Comment[rating_photos]', 'allowEmpty' => false)); ?>
          <div class="tip"><?php echo CommentsModule::t('Tip rating photos'); ?></div>
          <?php echo $form->error($model,'rating_photos'); ?>
	  </div>
	</div> 
    <div class="control-group">
	  <div class="controls">
          <?php $this->widget('CStarRating',array('name'=>'Comment[rating_clarity]', 'allowEmpty' => false, 'resetText' => tt('Remove the rate', 'comments'))); ?>
          <div class="tip"><?php echo CommentsModule::t('Tip rating clarity'); ?></div>
          <?php echo $form->error($model,'rating_clarity'); ?>
	  </div>
	</div>
    <div class="control-group">
	  <div class="controls">
          <?php $this->widget('CStarRating',array('name'=>'Comment[rating_service]', 'allowEmpty' => false)); ?>
          <div class="tip"><?php echo CommentsModule::t('Tip rating service'); ?></div>
          <?php echo $form->error($model,'rating_service'); ?>
	  </div>
	</div>
    <div class="control-group">
	  <div class="controls">
          <?php $this->widget('CStarRating',array('name'=>'Comment[rating_price]', 'allowEmpty' => false)); ?>
          <div class="tip"><?php echo CommentsModule::t('Tip rating price'); ?></div>
          <?php echo $form->error($model,'rating_price'); ?>
	  </div>
	</div>
    <div class="control-group">
	  <div class="controls">
          <?php $this->widget('CStarRating',array('name'=>'Comment[rating_location]', 'allowEmpty' => false)); ?>
          <div class="tip"><?php echo CommentsModule::t('Tip rating location'); ?></div>
          <?php echo $form->error($model,'rating_location'); ?>
	  </div>
	</div>
    <div class="control-group">
	  <?php echo $form->labelEx($model,'body', array('class' => 'control-label')); ?>
	  <div class="controls">
		<?php echo $form->textArea($model,'body',array('class' => 'span4')); ?>
        <?php echo $form->error($model,'body'); ?>
	  </div>
	</div>
    <div class="control-group ">
      <label class="control-label"><?php echo $form->checkBox($model,'aprove'); ?></label>
	  <div class="controls">
		<div class="tip aprove"><?php echo CommentsModule::t('Tip aprove'); ?></div>
        <?php echo $form->error($model,'aprove'); ?>
	  </div>
	</div>
    <?php if (Yii::app()->user->isGuest){ ?> 
        <div class="control-group">
            <?php echo $form->labelEx($model, 'verifyCode', array('class' => 'control-label')); ?>
           <div class="controls">
               <?php echo $form->textField($model, 'verifyCode',array('class' => 'span2'));?><br/>
               <?php $this->widget('CCaptcha', array('captchaAction' => '/comments/main/captcha'));?>
               <?php echo $form->error($model, 'verifyCode');?>  
           </div>
         </div>
    <?php } ?>
    <div class="control-group">
      <div class="controls">
          <?php echo CHtml::tag('button', array('name'=>'add','class'=>'btn btn-info btn-large'), CHtml::tag('i', array('class'=>'fa fa-plus-circle'), '').' '.CommentsModule::t('Leave a Comment')); ?>
      </div>
    </div>
<?php $this->endWidget(); ?>
<script type="text/javascript">
    $(".phone").mask("(999) 999-99-99");
</script>