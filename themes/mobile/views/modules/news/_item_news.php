<?php 
foreach ($items as $item){ 
    echo '<article class="block-item">';
            echo CHtml::tag('h2', array(), CHtml::link($item->title, $item->getUrl()));
            echo CHtml::tag('p', array(), getSnippet(strip_tags($item->body), 250));
            echo CHtml::link(NewsModule::t('Read more &raquo;'), $item->getUrl(), array('class'=>'more'));
    echo '</article>';
}
?>