<?php
$apartments = Apartment::findAllWithCache($criteria);

$ids = array();
foreach($apartments as $apartment){
	$ids[] = $apartment->id;
}
$criteriaForMap = new CDbCriteria();
$criteriaForMap->addInCondition('apartment.id', $ids);
?>
<div class="apartment_list_map">
	<?php $this->widget('application.modules.viewallonmap.components.ViewallonmapWidget', array('criteria' => $criteriaForMap, 'filterOn' => false, 'withCluster' => false)); ?>
</div>