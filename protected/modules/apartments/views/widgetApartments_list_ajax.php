<?php 

    if($apartments){ $i =1;
            foreach ($apartments as $item){
                    $this->renderPartial('widgetApartments_'.$typeView.'_item', array(
                            'item' => $item,
                            'count' => $count,
                            'criteria' => $criteria,
                            'city' => $this->city ? setTranslite(strtolower($this->city)) : null,
                            'i' => $i,
                    ));
                    $i++;
            }
    }
        
?>