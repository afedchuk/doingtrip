<?php 
$this->beginWidget('bootstrap.widgets.TbModal', 
	array('id'=>'social-contain', 'autoOpen' => false ,
		  'htmlOptions'=> array('style' => 'bottom: 10px; right: 10px; top:auto; width:300px; left: auto;'))); ?>
	<div class="modal-header">
	    <a class="close" data-dismiss="modal">&times;</a>
	    <div class="title">
	    	<img src="/images/fb-dialog-logo.png" alt="facebook"><br/><br/>
	    	<?php  echo Yii::t('common','Solial header title' ); ?>
	    </div>      
	</div>
	<div class="modal-body">
		<div class="social clearfix">
			<?php echo $rendered; ?>
		</div>
	</div>
<?php $this->endWidget(); ?>





