<?php 

$this->pageTitle = $model->page_title. ' - '.$this->pageTitle;
$this->pageDescription = $model->meta_description;
$this->pageKeywords = $model->meta_keywords;
$this->breadcrumbs=array(
                         $model->page_title,
                         );
?>
<div class="wide-folio cities-map">                                 
    <div class="wide-item">
        <div class="wide-item-titles">
            <h1 class="main-title">4trip.com.ua</h1>
            <p class="main-text">
            	<?php echo Yii::t('index','Page title'); ?> 
            </p>
        </div>
        <a class="wide-image" href="#">
            <img class="responsive-image" src="<?php echo Yii::app()->request->getBaseUrl(true); ?>/images/wallpapers/adventure.jpg" alt="img">
        </a>
    </div>
</div>
<div class="single-news">
    <article class="block-item about-us">
    	<h2><?php echo $model->page_title;?></h2>
        <p><?php echo $model->content;?></p>
	    <br/>
	    <?php $this->widget('application.extensions.fbLikeBox.fbLikeBox', array(
	            'likebox' => array(
	            'url'=>'https://facebook.com/house4trip',
	            'header'=>'false',
	            'width'=>'auto',
	            'height'=>'180',
	            'layout'=>'light',
	            'show_post'=>'false', 
	            'show_faces'=>'true',
	            'show_border'=>'false',
	         )
	    ));?>
    </article>
</div>
