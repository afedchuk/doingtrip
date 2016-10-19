<?php if (YII_DEBUG===true && $error): ?>
	<h2><?=$error['type']?></h2>

	<div class="error">
		<?=$error['message']?>
	</div>

<?php else: ?>
  <div class="container error-wrapper"> 
            <h4 class="center-text">
              <?=Yii::t('index','Page not found')?>
            </h4>
            <p class="center-text">
                <?=Yii::t('index','Error message')?>
            </p>
            <a href="<?php echo Yii::app()->createAbsoluteUrl('apartments/') ?>">
              <i class="fa fa-home"></i>
            </a>
        </div>
<?php endif ?>
