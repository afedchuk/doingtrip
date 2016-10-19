<?php
    $this->pageTitle .= ' - '.NewsModule::t('News').' - '.$model->title;
    $this->breadcrumbs=array(
    	NewsModule::t('News') =>array('/news'),
            $model->title
    );

?>
<div class="wide-folio">                                 
    <div class="wide-item">
        <div class="wide-item-titles">
            <h1 class="main-title">4trip.com.ua</h1>
            <p class="main-text">
                <?php echo NewsModule::t('View title'); ?>
            </p>
        </div>
        <a class="wide-image" href="#">
            <img class="responsive-image" src="<?php echo Yii::app()->request->getBaseUrl(true); ?>/images/wallpapers/optimized-travel-with-us.jpg" alt="img">
        </a>
        <div class="breadcrumb-slider-container">
            <?php if(isset($this->breadcrumbs) && !empty($this->breadcrumbs)):?>
                <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                        'links'=>$this->breadcrumbs,
                        'encodeLabel' => false,
                        'separator'=> '',
                        'htmlOptions'=>array('class'=>'breadcrumbs'),
                )); ?>
            <?php endif?>
        </div>
    </div>
</div>
<div class="single-news">
    <article class="block-item">
        <header class="article-header">
            <h2><?php echo $model->title;?></h2>
        </header> 
        <p><?php echo $model->body;?></p>
    </article>
</div>