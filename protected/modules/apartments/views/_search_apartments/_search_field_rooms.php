
    <?php
    $allRooms = Apartment::getRoomsMinMax();
    $roomsMin = isset($this->roomsCountMin) ? CHtml::encode($this->roomsCountMin) : 0;
    $roomsMax = isset($this->roomsCountMax) ? CHtml::encode($this->roomsCountMax) : $allRooms['rooms_max'];

    SearchForm::renderSliderRange(array(
        'field' => 'room',
        'min' => 0,
        'max' =>  $allRooms['rooms_max'],
        'min_sel' => $roomsMin,
        'max_sel' => $roomsMax,
        'step' => 1,
        'class' => 'rooms-search-select',
    ));
    ?>
