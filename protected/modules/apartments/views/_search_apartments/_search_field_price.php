
<?php  
    $priceAll = Apartment::getPriceMinMax();

    $priceAll['price_min'] = isset($priceAll['price_min']) ? $priceAll['price_min'] : 0;
    $priceAll['price_max'] = isset($priceAll['price_max']) ? $priceAll['price_max'] : 1000;

    if(issetModule('currencymanager')){
        $priceAll['price_min'] = floor(Currency::convertFromDefault($priceAll['price_min']));
        $priceAll['price_max'] = ceil(Currency::convertFromDefault($priceAll['price_max']));
    }

    $diffPrice = $priceAll['price_max'] - $priceAll['price_min'];
    $step = SearchForm::getSliderStep($diffPrice);

    $priceMinSel = (isset($this->price) && isset($this->price["min"]) && $this->price["min"] >= $priceAll["price_min"] && $this->price["min"] <= $priceAll["price_max"])
        ? $this->price["min"] : $priceAll["price_min"];
    $priceMaxSel = (isset($this->price) && isset($this->price["max"]) && $this->price["max"] <= $priceAll["price_max"] && $this->price["max"] >= $priceAll["price_min"])
        ? $this->price["max"] : $priceAll["price_max"];

    SearchForm::renderSliderRange(array(
        'field' => 'price',
        'min' => $priceAll['price_min'],
        'max' => $priceAll['price_max'],
        'min_sel' => $priceMinSel,
        'max_sel' => $priceMaxSel,
        'step' => $step,
        'class' => 'price-search-select',
    ));
?>
