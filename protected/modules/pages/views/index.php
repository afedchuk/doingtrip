<?php 

    $this->pageTitle = $model->page_title. ' - '.$this->pageTitle;
    $this->pageDescription = $model->meta_description;
    $this->pageKeywords = $model->meta_keywords;
    $this->breadcrumbs=array(
                             $model->page_title,
                             );
?>
<div class="mrgT15 relative">
    <div id="right" class="authorization">
        <div class="well">
            <div class="header-title">
                <h4><?php echo $model->page_title;?></h4>     
            </div>
            <?php echo $model->content;?>
        </div>
        <div class="well">
            <?php $this->widget('application.extensions.fbLikeBox.fbLikeBox', array(
                'likebox' => array(
                'url'=>'https://facebook.com/house4trip',
                'header'=>'false',
                'width'=>'580',
                'height'=>'200',
                'layout'=>'light',
                'show_post'=>'false', 
                'show_faces'=>'true',
                'show_border'=>'false',
             )
            ));?>
        </div>
    </div>
    <?php echo $this->renderPartial('user.views.user.menu'); ?> 
</div>