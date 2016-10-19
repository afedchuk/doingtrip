<?php
foreach ($news as $item){
	echo '<div>';
	echo CHtml::link($item->title, $item->getUrl(), array('class'=>'title'));
	echo '<small>'.date("Y/m/d", strtotime($item->dateCreated)).'</small>';
	echo '</div>';
}

if(!$news){
	echo tt('News list is empty.', 'news');
}

if($pages){
	$this->widget('itemPaginator',array('pages' => $pages, 'header' => ''));
}
?>

