<?php
Yii::app()->clientScript->registerScriptFile($this->assetsBase  . '/js/jquery.lazyload.min.js', CClientScript::POS_END); 
$this->pageTitle .= ' - '.NewsModule::t('News');
$this->breadcrumbs=array(
NewsModule::t('News'),
);
?>

<div class="wide-folio">                                 
    <div class="wide-item">
        <div class="wide-item-titles">
            <h1 class="main-title">4trip.com.ua</h1>
            <p class="main-text">
				<?php echo ApartmentsModule::t('Tip index title'); ?>
			    <?php $count_props = Apartment::getAllCountActive(). ' '.numberReplacing(Apartment::getAllCountActive(), array(ApartmentsModule::t('proposition single'), ApartmentsModule::t('proposition few'), ApartmentsModule::t('propositions'))); ?>
			    <?php $count_cities = City::getAllCount(). ' '.numberReplacing(City::getAllCount(), array(RegionsModule::t('city'), RegionsModule::t('cities'), RegionsModule::t('cities'))); ?>
				<?php echo ucfirst(Yii::t('index', 'Found propositions on site', array('{count}' =>  CHtml::link($count_props, Yii::app()->createAbsoluteUrl('/apartments')), '{cities}' => CHtml::link($count_cities, Yii::app()->createAbsoluteUrl('/sitemap'))))); ?>
			</p>
        </div>
        <a class="wide-image" href="#">
            <img class="responsive-image" src="<?php echo Yii::app()->request->getBaseUrl(true); ?>/images/wallpapers/see-the-world-with-us.jpg" alt="img">
        </a>
    </div>
</div>
<div class="list-news" id="news">
<?php if($items){
            $this->renderPartial('_item_news', array('items' => $items,'pages' => $pages));
      } else {
        echo NewsModule::t('News list is empty.');
      }
?>
</div>
<?php $this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
                    'contentSelector' => '#news',
                    'itemSelector' => '.block-item',
                    'loadingText' => Yii::t('index', 'Loading...'),
                    'donetext' => Yii::t('index', 'No records'),
                    'pages' => $pages,
                    'contentLoadedCallback' => 'function( newElements ) {
                    }',
                )); 
?>
