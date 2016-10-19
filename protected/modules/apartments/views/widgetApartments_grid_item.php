<div class="blockApartments  property masonry block-grid<?php if($i%3 == 0) {?> last<?php } ?>"  ap_id="<?php echo $item['id']; ?>" lng="<?php echo $item['lng']; ?>" lat="<?php echo $item['lat']; ?>">
    <div class="img-thumb apartament-<?php echo $item['id'];?>" itemid="<?php echo $item['id'];?>">
            <?php   $city_name = City::getCityName($item->city_id); ?>
            <div data-scroll-reveal="" class="inner" data-scroll-reveal-initialized="true" data-scroll-reveal-complete="true">
                <div class="thumb property-image" itemid="<?php echo $item['id'];?>">
                        <?php
                            $res = Images::getMainThumb(290, 190, $item->images);
                            $img = CHtml::image('/images/opacity.png', $res['comment'], array('class' => 'lazyload', 'data-original' => $res['thumbUrl']));
                           if($res['thumbUrl']){
                                echo CHtml::link($img, $item->getUrl($item->id, $item->description->title, $city_name), array(
                                    'alt' => $item['description']['title'],
                                    'title' => $item['description']['title']
                                ));
                            } 
                        ?>
                    <div class="apartment_count_img">
                        <img src="/images/photo_count.png"><b><?php echo count($item->images); ?></b>
                    </div>
                    <div class="overlay">
                        <div class="info">
                            <span class="tag price"><?php echo CurrencymanagerModule::convertcurrency($item['price']); ?></span>
                        </div>
                    </div>
                </div>
                <aside>
                    <header>
                        <?php if($item->rating && !isset($booking)){
                                    $title = getSnippet($item['description']['title'], 100);
                            } else {
                                    $title = truncateText($item['description']['title'], 8);
                            }
                            echo CHtml::link(CHtml::tag('h3', array(), $title), $item->getUrl($item->id, $item->description->title, $city_name), array('class' => 'offer detailProposition')); 
                            ?>
                        <figure>
                        <?php echo implode(', ', array($city_name, $item->description->address)); ?> 
                             <?php  echo CHtml::link('<i class="mb-icon  fa fa-map-marker"></i> '.BookingModule::t('Booking show map'), 
                                    Yii::app()->createAbsoluteUrl('/booking/main/showmap', array('id' => $item->id, 'ap' => true)),
                                    array('data-target'=>"#", 'data-toggle'=>"modal", 'data-width' => '500', 'rel'=>'nofollow')); ?> 
                        </figure>
                    </header>
       
                    <ul class="attr-apartment">
                        <li><i data-toggle="tooltip" title="<?php echo ApartmentsModule::t('Type'); ?>" class="fa fa-building-o"></i> <?php echo $item::getNameByType($item->type); ?></li>
                        <li><i data-toggle="tooltip" title="<?php echo ApartmentsModule::t('Rooms'); ?>" class="fa fa-cubes"></i> <?php echo $item->num_of_rooms; ?></li>
                        <?php if($item->square > 0) { ?>
                            <li><i data-toggle="tooltip" title="<?php echo ApartmentsModule::t('Square'); ?>" class="fa fa-square"></i> <?php echo ApartmentsModule::t('Square {value}', array('{value}' => $item->square)); ?></li>
                        <?php } ?>
                        <?php if($item->berths && !is_null($item->berths)) { ?>
                            <li><i data-toggle="tooltip" title="<?php echo ApartmentsModule::t('Number of berths'); ?>" class="fa fa-male"></i> <?php echo $item->berths; ?></li>
                        <?php } ?>
                        <?php if($item->floor > 0) { ?>
                            <li><i data-toggle="tooltip" title="<?php echo ApartmentsModule::t('Floor'); ?>" class="fa fa-sort-numeric-desc"></i> <?php echo implode('/', array($item->floor, $item->floor_total)); ?></li>
                        <?php } ?>
                        <li><i data-toggle="tooltip" title="<?php echo ApartmentsModule::t('Window to'); ?>" class="fa fa-windows"></i> <?php echo ($item->window_to == 1) ? ApartmentsModule::t('Into') : ApartmentsModule::t('Out'); ?></li>
                    </ul>
                    <?php echo CHtml::link('Переглянути', $item->getUrl($item->id, $item->description->title, $city_name), array('class' => 'link-arrow'));  ?>
                </aside>
            </div>
        </div>
</div>
<?php if($i%3 == 0) { ?>
<div class="clear"></div>
<?php } ?>
