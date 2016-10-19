<?php $this->pageTitle=Yii::app()->name . ' - ' . MessageModule::t("Compose Message"); ?>
<?php $isIncomeMessage = $viewedMessage->receiver_id == Yii::app()->user->getId() ?>

<?php
	$this->breadcrumbs = array(
		UserModule::t("Profile")=>array('/user/profile'),
		($isIncomeMessage ? MessageModule::t("Inbox") : MessageModule::t("Sent")) => ($isIncomeMessage ? array('/message/inbox') : array('/message/sent')),
		CHtml::encode($viewedMessage->subject),
	);
?>

<div class="row-fluid profile-edit">
    <div class="span9">
        <div class="well">
			<div class="span12">
				<?php if ($isIncomeMessage): ?>
					<div class="page-header">
						<h4><?php echo $viewedMessage->getSenderName() ?></h4>
					</div>
				<?php else: ?>
					<div class="page-header">
						<h4><?php echo $viewedMessage->getReceiverName() ?></h4>
					</div>
				<?php endif; ?>
			</div>
			<div class="clear"></div>
			<blockquote>
				<p><?php echo CHtml::encode($viewedMessage->body) ?></p>
				<small><?php echo CHtml::encode($viewedMessage->subject) ?> <cite title="Date"><?php echo date(Yii::app()->getModule('message')->dateFormat, strtotime($viewedMessage->created_at)) ?></cite></small>
			</blockquote>
			<div class="page-header">
		        <h4><?php echo MessageModule::t('Reply') ?></h4>
		    </div>
			<?php $form = $this->beginWidget('CActiveForm', array(
				'id'=>'message-form',
				'enableAjaxValidation'=>false,
				'htmlOptions' => array('class' => 'form-horizontal well'),
			)); ?>
			 <div class="control-group">
			 	<?php echo $form->labelEx($message,'subject', array('class'=>'control-label')); ?>
		        <div class="controls">
		           <?php echo $form->textField($message,'subject',array('class' => 'span12')); ?>
		           <?php echo $form->hiddenField($message,'receiver_id'); ?>
		           <?php echo $form->error($message,'receiver_id'); ?>
		           <?php echo $form->error($message,'subject'); ?>
		        </div>
		    </div>

		    <div class="control-group">
				<?php echo $form->labelEx($message,'body', array('class'=>'control-label')); ?>
		        <div class="controls">
		            <?php echo $form->textArea($message,'body', array('class' => 'span12', 'rows' => 2)); ?>
		            <?php if($form->error($message,'body')): ?>
		                <?php echo $form->error($message,'body'); ?>
		           <?php endif; ?>
		        </div>
		    </div>

		    <div class="control-group">
		        <div class="controls">
				    <?php $this->widget('bootstrap.widgets.TbButton', array(
				                'type'=>'info',
				                'size' => 'large',
				                'buttonType' => 'submit',
				                'encodeLabel' => false,
				                'label'=>'<i class="fa  fa-envelope"></i> '.MessageModule::t("Reply")
				            )); ?>
					<?php $this->endWidget(); ?>
				</div>
		    </div>
		</div>
	</div>
<?php echo $this->renderPartial('application.modules.user.views.profile.menu'); ?> 
</div>
