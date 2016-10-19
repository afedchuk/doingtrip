<?php
$this->pageTitle .= ' - '.NewsModule::t('News').' - '.$model->title;
$this->breadcrumbs=array(
	NewsModule::t('News') =>array('/news'),
        $model->title
);
?>
<div class="relative">
    <div id="right">
        <div class="well">
            <div class="header-title">
                <h4><?php echo $model->title;?></h4>     
            </div>
            <p><?php echo $model->body; ?></p>
         </div>
    </div>
    <?php echo $this->renderPartial('user.views.user.menu');?> 
</div>