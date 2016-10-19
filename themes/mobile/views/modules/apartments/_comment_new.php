<h2><?php echo CommentsModule::t('Comments'); ?></h2>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>$this->modelName.'-form',
    'enableAjaxValidation'=>true,
    'action' => Yii::app()->createUrl('comments/main/add'),
    'clientOptions' => array(
        'validateOnChange' => true,
        'validateOnSubmit' => true,
    ),
    'htmlOptions' => array('class'=>'form-horizontal well')
));
    ?>
    <?php if(isset(Yii::app()->user->firstname)) {?>
      <?php $sql = "SELECT service FROM {{users_social}} WHERE user_id=".Yii::app()->user->id;
            $social = Yii::app()->db->createCommand($sql)->queryColumn();
      ?>
      <label>
        <?php echo UserModule::t('Label auth tip', array('{social}' => isset($social[0]) ? ucfirst($social[0]) : '', '{user}' => implode(' ',array(Yii::app()->user->firstname, Yii::app()->user->lastname)))); ?>
        (<?php echo CHtml::tag('a', array('href' => Yii::app()->createAbsoluteUrl('/user/main/logout')), UserModule::t('Logout')); ?>)
      </label>
    <?php } ?>
    <div class="container no-bottom">
      <h4><?php echo CommentsModule::t('Term') ;?></h4>
    </div>
    <div class="container">
      <?php  $range = dateRange(date("Y-m-d", strtotime("-10 year", time())), date("Y-m-d", time()),  '+1 year', 'Y'); ?>
      <div class="submenu-navigation">
          <a class="submenu-nav-deploy"><?php echo CommentsModule::t('Select year'); ?></a>
          <div class="submenu-nav-items">
              <?php foreach($range as $key => $value) {
                 echo CHtml::tag('a', array('data-value' => $key), $value);
                } ?>
          </div>
      </div>
      <?php echo $form->error($model,'year'); ?>
    </div>
    <div class="container">
      <div class="submenu-navigation">
        <a class="submenu-nav-deploy"><?php echo CommentsModule::t('Select month'); ?></a>
        <div class="submenu-nav-items">
            <?php foreach(Yii::app()->getLocale(Yii::app()->language)->getMonthNames('wide',true) as $value) {
               echo CHtml::tag('a', array('data-value' => $key), $value);
              } ?>
        </div>
        <?php echo $form->error($model,'month'); ?>
  	  </div>
    </div>
    <div class="clearfix"><?php $this->widget('CStarRating',array('name'=>'Comment[rating_photos]', 'allowEmpty' => false)); ?></div>
    <p><?php echo CommentsModule::t('Tip rating photos'); ?></p>
    <?php echo $form->error($model,'rating_photos'); ?>
    <div class="clearfix"><?php $this->widget('CStarRating',array('name'=>'Comment[rating_clarity]', 'allowEmpty' => false)); ?></div>
    <p><?php echo CommentsModule::t('Tip rating clarity'); ?></p>
    <?php echo $form->error($model,'rating_clarity'); ?>
    <div class="clearfix"><?php $this->widget('CStarRating',array('name'=>'Comment[rating_service]', 'allowEmpty' => false)); ?></div>
    <p><?php echo CommentsModule::t('Tip rating service'); ?></p>
    <?php echo $form->error($model,'rating_service'); ?>
    <div class="clearfix"><?php $this->widget('CStarRating',array('name'=>'Comment[rating_price]', 'allowEmpty' => false)); ?></div>
    <p><?php echo CommentsModule::t('Tip rating price'); ?></p>
    <?php echo $form->error($model,'rating_price'); ?>
    <div class="clearfix"><?php $this->widget('CStarRating',array('name'=>'Comment[rating_location]', 'allowEmpty' => false)); ?></div>
    <p><?php echo CommentsModule::t('Tip rating location'); ?></p>
    <?php echo $form->error($model,'rating_location'); ?>
    <div class="clearfix container">
  		<?php echo $form->textArea($model,'body',array('placeholder' => Comment::model()->getAttributeLabel('body'))); ?>
      <?php echo $form->error($model,'body'); ?>
  	</div>
    <div class="clearfix">
        <a class="checkbox checkbox-one" href="#"><?php echo CommentsModule::t('Tip aprove'); ?></a>
  	</div>
    <div class="container pull-right">
          <?php echo CHtml::tag('button', array('name'=>'add','class'=>'button button-blue'), CHtml::tag('i', array('class'=>'fa fa-plus-circle'), '').' '.CommentsModule::t('Leave a Comment')); ?>
    </div>
<?php $this->endWidget(); ?>