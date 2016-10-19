<?php
$this->pageTitle = ArticlesModule::t('Faq') .' - '. $this->pageTitle;
$this->breadcrumbs=array(
    ArticlesModule::t('Faq'),
);
?>
<div class="faq-list">
    <?php if ($articles) { ?>  
        <ol>
            <?php $i=0; foreach ($articles as $article) { ?>
                <li class="faq-item">
                    <div class="faq-qv"><span class="accordion-icon"></span><?php echo $article['page_title']; ?></div>
                    <div  class="faq-an">
                            <?php echo $article['page_body']; ?>
                    </div>
                </li>
        <?php $i++; } ?>
        </ol>
    <?php } else { ?>
                <p><?php echo ArticlesModule::t('Faq list is empty' ); ?></p>
    <?php } ?>
</div>
<?php  
	Yii::app()->clientScript->registerScriptFile($this->assetsBase  . '/js/jquery.shorten.js', CClientScript::POS_END); 
	Yii::app()->clientScript->registerScript('short', '
	$(".faq-an").shorten({
	    "showChars" : 200,
	    "moreText"  : "'.ApartmentsModule::t('Show full text').'",
	    "lessText"  : "'.ApartmentsModule::t('Hide text').'",
	});',
	CClientScript::POS_READY);
?>