<?php
$floorItems = array_merge(
    range(0, param('moduleApartments_maxFloor', 30))
);
$floorMin = isset($this->floorCountMin) ? CHtml::encode($this->floorCountMin) : 0;
$floorMax = isset($this->floorCountMax) ? CHtml::encode($this->floorCountMax) : max($floorItems);

SearchForm::renderSliderRange(array(
    'field' => 'floor',
    'min' => 0,
    'max' => param('moduleApartments_maxFloor', 30),
    'min_sel' => $floorMin,
    'max_sel' => $floorMax,
    'step' => 1,
    'class' => 'floor-search-select',
));

?>
