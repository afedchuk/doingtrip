<?php
$this->pageTitle .= ' - '.NewsModule::t('News');
$this->breadcrumbs=array(
	NewsModule::t('News'),
);
?>
<div class="relative mrgT15">
    <div id="right">
        <div class="well">
            <div class="header-title">
                <h2><?php echo NewsModule::t('Latest news'); ?></h2>     
            </div> 
             <div class="list-news">
            <?php
            foreach ($items as $item){
                    echo '<div class="news-items">';
                        echo CHtml::link($item->title, $item->getUrl(), array('class'=>'title'));
                        echo '<p><font class="date"><i class="fa fa-calendar"></i> '.date('d.m.Y',strtotime($item->dateCreated)).'</font></p>';
                        echo '<p class="desc">';
                            echo truncateText(
                                    $item->body,
                                    param('newsModule_truncateAfterWords', 50)
                            );
                        echo '</p>';
                        echo '<p>';
                            echo CHtml::link(NewsModule::t('Read more &raquo;'), $item->getUrl(), array('class'=>'btn btn-small btn-info mrgT15'));
                        echo '</p>';
                    echo '</div>';
            }

            if(!$items){
                    echo NewsModule::t('News list is empty.');
            }
            ?>
             </div>
            <div class="clear"></div>
        </div>
    </div>
    <?php echo $this->renderPartial('user.views.user.menu');?> 
</div>
