<?php if($this->images) : ?>
<div class="clear"></div>
<div id="gallery" class="content">
    <div class="slideshow-container">
        <div id="loading" class="loader"></div>
        <div id="slideshow" class="slideshow"></div>
    </div>
</div>
<div id="<?php echo $this->thumbs; ?>" class="navigation">
    <ul class="<?php echo $this->thumbs; ?> noscript">
        <?php foreach($this->images as $image) : ?>
            <li>
                <?php
                    $imgTag = CHtml::image(Images::getThumbUrl($image, 80, 50), Images::getAlt($image), array('rel' => 'nofollow'));
                    echo CHtml::link($imgTag, Images::createFullSize($image), array(
                        'title' => Images::getAlt($image),
                        'class' => 'thumb',
                        'rel' => 'nofollow'
                    ));
                ?>
            </li>
        <?php endforeach; ?>
       
    </ul>
</div>
<?php  Yii::app()->clientScript->registerScript('gallery', "
        if($.galleriffic != undefined) {
        $('div.content').css('display', 'block');
        var gallery = $('#".$this->thumbs."').galleriffic({
            delay:                     2500,
            numThumbs:                 ".$this->numThumbs.",
            preloadAhead:              10,
            enableTopPager:            false,
            enableBottomPager:         true,
            imageContainerSel:         '#slideshow',
            controlsContainerSel:      '#controls',
            captionContainerSel:       '#caption',
            loadingContainerSel:       '#loading',
            nextPageLinkText:          '".Yii::t('common', 'Next')."',
            prevPageLinkText:          '&lsaquo; ".Yii::t('common', 'Previuos')."',
            renderSSControls:          true,
            renderNavControls:         true,
            enableHistory:             true,
            autoStart:                 false,
            syncTransitions:           true,
            defaultTransitionDuration: 900
            
        });
    } ", CClientScript::POS_END);
?>
<?php endif; ?>   
