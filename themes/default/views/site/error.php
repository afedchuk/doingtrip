<?php if (YII_DEBUG===true && $error): ?>
	<h2><?=$error['type']?></h2>

	<div class="error">
		<?=$error['message']?>
	</div>

<?php else: ?>
    <div class="error span9">
    <div class="hero-unit mrgT105">
          <h1><?=Yii::t('index','Page not found', array('{code}' => $error['code']))?></h1>
          <br />
          <p><?=Yii::t('index','Error message')?></p>
          <p><b><?=Yii::t('index','Eror home')?>:</b></p>
          <a href="<?php echo Yii::app()->createAbsoluteUrl('apartments/') ?>" class="btn btn-large btn-info">
              <i class="icon-home icon-white"></i> <?=Yii::t('index','Take Me Home')?>
          </a>
        </div>
    </div>
<?php endif ?>
