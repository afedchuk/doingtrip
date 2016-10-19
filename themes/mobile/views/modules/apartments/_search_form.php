<div class="more-search-options-container">
<ul class="search-options-list">
    <li class="list-line clearfix">
        <div class="label-container">
            <label><?php echo ApartmentsModule::t('Filter type'); ?></label>
        </div>
        <div data-type="type" class="buttons-container clearfix">
            <?php foreach(Apartment::getTypesArray() as $key=>$type) : ?>
                <div class="item">
                    <a href="javascript:void(0);" id="<?php echo crypt($type); ?>" data-id="<?php echo $key; ?>" class="filter-btn button big grey filter tooltipstered"><?php echo $type; ?></a>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="sidebar-decoration"></div>
    </li>
    <li class="list-line clearfix">
        <div class="label-container">
            <label><?php echo ApartmentsModule::t('Price'); ?></label>
        </div>
        <div data-type="price" class="buttons-container single clearfix price_range">
            <?php foreach(array('low' => 100, 'medium' => array(100, 200), 
                                'above_average' => array(200, 500), 
                                'high' => array(500, 1000), 'higher' => 1000) as $key => $price) { ?>
                <div class="item">
                    <a id="blow" href="javascript:void(0);" data-id="<?php echo is_array($price) ? implode(',',$price) : ($key == 'low' ? ','.$price : $price.','); ?>" class="filter-btn button big grey filter tooltipstered">
                        <?php if(!is_array($price)) { ?>
                            <?php echo ApartmentsModule::t($key.' price', array('{value}' => CurrencymanagerModule::convertcurrency($price, 1))); ?>
                        <?php } else { ?>
                            <?php echo ApartmentsModule::t($key.' price', array('{value}' => (CurrencymanagerModule::convertcurrency($price[0], 2). ' - '. CurrencymanagerModule::convertcurrency($price[1], 1)))); ?>
                        <?php } ?>
                    </a>
                </div>
            <?php } ?>
        </div>
    </li>
    <li class="list-line clearfix">
        <div class="label-container">
            <label><?php echo ApartmentsModule::t('Berths'); ?></label>
        </div>
        <div data-type="berths" class="buttons-container single clearfix price_range">
            <?php foreach(array('low' => 2, 'medium' => array(2, 5), 
                                'above_average' => array(5, 8), 'higher' => 8) as $key => $price) { ?>
                <div class="item">
                    <a id="blow" href="javascript:void(0);" data-id="<?php echo is_array($price) ? implode(',',$price) : ($key == 'low' ? ','.$price : $price.','); ?>" class="filter-btn button big grey filter tooltipstered">
                        <?php if(!is_array($price)) { ?>
                            <?php echo ApartmentsModule::t($key.' price', array('{value}' =>$price)); ?>
                        <?php } else { ?>
                            <?php echo ApartmentsModule::t($key.' price', array('{value}' => ($price[0]. ' - '. $price[1]))); ?>
                        <?php } ?>
                    </a>
                </div>
            <?php } ?>
        </div>
    </li>

</ul>
<div class="apply-search-options">
<button class="stn-btn"><i class="fa fa-filter"></i> <?php echo ApartmentsModule::t('Apply params filter'); ?></button>
</div>
</div>
<div class="more-search-options-button-container">
    <div class="visible-block clearfix">
        <div class="filtered-options-container">
            <ul class="list clearfix">
                <!--li data-id="" id="">
                    <i class="remove"></i>
                    <span>Відпочинковий комплекс</span>
                </li-->
            </ul>
        </div>
    </div>
</div>
