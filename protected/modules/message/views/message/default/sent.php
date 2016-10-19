<?php $this->pageTitle=Yii::app()->name . ' - '.MessageModule::t("Sent"); ?>
<?php
	$this->breadcrumbs=array(
		UserModule::t("Profile")=>array('/user/profile'),
		MessageModule::t("Sent"),
	);
?>

<div class="row-fluid profile-edit">
    <div class="span9">
        <div class="well">
        	<div class="page-header">
	            <h4><?php echo MessageModule::t('Sent'); ?></h4>
	        </div>
			<?php if ($messagesAdapter->data): ?>
				<?php $form = $this->beginWidget('CActiveForm', array(
					'id'=>'message-delete-form',
					'enableAjaxValidation'=>false,
					'action' => $this->createUrl('delete/')
				)); ?>

				<table class="table table-hover">
					<thead>
						<tr>
							<th><?php echo MessageModule::t('Sender'); ?></th>
							<th><?php echo MessageModule::t('Subject letter'); ?></th>
							<th><?php echo MessageModule::t('Date'); ?></th>
						</tr>
					</thead>
					<?php foreach ($messagesAdapter->data as $index => $message): ?>
						<tr>
							<td>
								<?php echo CHtml::checkBox("Message[$index][selected]"); ?>
								<?php echo $form->hiddenField($message,"[$index]id"); ?>
								<?php echo $message->getReceiverName() ?>
							</td>
							<td><a href="<?php echo $this->createUrl('view/', array('message_id' => $message->id)) ?>"><?php echo $message->subject ?></a></td>
							<td><span class="date"><?php echo date(Yii::app()->getModule('message')->dateFormat, strtotime($message->created_at)) ?></span></td>
						</tr>
					<?php endforeach ?>
				</table>

				<?php $this->widget('bootstrap.widgets.TbButton', array(
			        'type'=>'info',
			        'size' => 'large',
			        'buttonType' => 'submit',
			        'encodeLabel' => false,
			        'label'=>'<i class="fa  fa-trash"></i> '.MessageModule::t("Delete Selected"),
			    )); ?>

				<?php $this->endWidget(); ?>

				<?php $this->widget('CLinkPager', array('pages' => $messagesAdapter->getPagination())) ?>
			<?php else : ?>
				<h4><?php echo MessageModule::t("Messages inbox empty"); ?></h4>
			<?php endif; ?>
		</div>
	</div>
	<?php echo $this->renderPartial('application.modules.user.views.profile.menu'); ?> 
</div>
