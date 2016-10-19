<div class="gb5 li" style="position: relative;">
	<ul class="navbar">
	    <li><span class="icon-user"></span><a href="<?php echo Yii::app()->createAbsoluteUrl('/user/profile/') ?>"><?php echo UserModule::t('Cabinet'); ?></a></li>
	    <?php if(!empty(Yii::app()->controller->apInComparison)) { ?>
	        <li><span class="icon-list-alt"></span><a href="<?php echo Yii::app()->createUrl('comparisonList/main/index'); ?>"><?php echo ComparisonListModule::t('Comparison list'); ?></a></li>
	    <?php } ?>
	    <li><span class="icon-off"></span><a href="<?php echo Yii::app()->createAbsoluteUrl('/user/logout'); ?>"><?php echo Yii::app()->getModule('user')->t("Logout"); ?></a></li>
	</ul>
</div>