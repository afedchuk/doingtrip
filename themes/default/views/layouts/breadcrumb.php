<?php if(isset($this->breadcrumbs) && !empty($this->breadcrumbs)):?>
        <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                'links'=>$this->breadcrumbs,
                'encodeLabel' => false,
                'separator'=> '',
                'htmlOptions'=>array('class'=>'breadcrumbBox'),
        )); ?>
        <div class="pull-right">
        	<?php $this->widget('bootstrap.widgets.TbButton', array(
			    'label'=>Yii::t('index', 'My booking'),
			    'type'=>'info',
			    'size'=>'mini',
			    'icon' => 'info-sign white',
			    'url' => Yii::app()->createAbsoluteUrl('apartments/booking/detail'),
			    'htmlOptions' => array('class' => 'pull-right', 'data-toggle' => 'modal')
			)); ?>
        </div>
<?php endif?>

