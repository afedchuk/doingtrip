<?php $this->beginContent('//layouts/main-admin', array('adminView' => 1)); ?>
<div class="row-fluid">
	<div class="page-header span12">
        <h4 class="span10"><?php echo $this->adminTitle; ?></h4>
    
		<div class="span2 pull-right">
			<?php
				if ($this->menu && !empty($this->menu)) {
					 $this->widget('bootstrap.widgets.TbButtonGroup', array(
				        'type'=>'info',
				        'size' => 'small',
				        'buttons'=>array(
				        	array('label'=>Yii::t('common', 'Action'), 'url'=>'#'),
				        	array('items' => $this->menu)
				        ),
				        'htmlOptions' => array('class' => 'pull-right')
				    )); 
				}
			?>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span12">
			<?php $this->widget('bootstrap.widgets.TbAlert'); ?>
		</div>
	</div>
</div>
<?php echo $content; ?>

<?php $this->endContent(); ?>