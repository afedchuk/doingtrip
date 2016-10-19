<div itemscope  itemtype="http://schema.org/Offer" class="blockApartments appartment_item blockList" ap_id="<?php echo $item['id']; ?>" lng="<?php echo $item['lng']; ?>" lat="<?php echo $item['lat']; ?>">
    <?php   $img_show = (($count = count($item->images)) > 0 ?  true  : false); ?>
        <div class="thumb <?php if($img_show) { ?> jcarousel-wrapper<?php } ?>" itemid="<?php echo $item['id'];?>">
            <div <?php if($img_show) { ?>class=" jcarousel"<?php } ?>>
                 <ul>
                    <li>
                        <?php $city_name = City::getCityName($item->city_id);
                            $res = Images::getMainThumb(310, 210, $item->images, null, true);
                            $img = CHtml::image($res['thumbUrl'], $item['description']['title']. ' - ' .$this->pageKeywords, array('style'=> (!$res['link'] ? 'box-shadow: none; margin-top:50px;' : null)));
                            if($res['thumbUrl']){
                                echo CHtml::link('', $item->getUrl($item->id, $item->description->title,  $city_name), array(
                                    'title' => $item['description']['title'],
                                    'class' => 'lazyload',
                                    'style' => 'background: url(/images/indicator.gif) #F7F7F7; background-position: center;',
                                    'data-original' => $res['thumbUrl']
                                ));
                            } 
                        ?>
                    </li>
                </ul>
            </div>
            <?php if($img_show) : ?>
                <a href="#" class="jcarousel-control-prev" rel="nofollow"></a>
                <a href="#" class="jcarousel-control-next" rel="nofollow"></a>
                <div class="apartment_count_img"><img src="/images/photo_count.png"><b><?php echo $count; ?></b></div>
            <?php endif; ?>
        </div>
        <div class="infoBlock">
                <?php if (issetModule('comparisonList')):?>
                        <?php
                        $inComparisonList = false;
                        if (in_array($item->id, Yii::app()->controller->apInComparison))
                            $inComparisonList = true;
                        ?>
                        <div class="row compare-check-control" id="compare_check_control_<?php echo $item->id; ?>">
                            <?php
                            $checkedControl = '';

                            if ($inComparisonList)
                                $checkedControl = ' checked = checked ';
                            ?>
                            <input type="checkbox" name="compare<?php echo $item->id; ?>" class="compare-check compare-float-left" id="compare_check<?php echo $item->id; ?>" <?php echo $checkedControl;?>>
                            <a rel="nofollow" href="<?php echo ($inComparisonList) ? Yii::app()->createUrl('comparisonList/main/index') : 'javascript:void(0);';?>" data-rel-compare="<?php echo ($inComparisonList) ? 'true' : 'false';?>" id="compare_label<?php echo $item->id; ?>" class="compare-label">
                                <?php echo ($inComparisonList) ?  ComparisonListModule::t('In the comparison list') : ComparisonListModule::t('Add to a comparison list ');?>
                            </a>
                        </div>
                <?php endif;?>
                <span class="address">
                    <?php  echo  ApartmentsModule::t('Short city', array('{city}' => $city_name)) .', '.$item['description']['address']?>
                </span>
                <span class="number">
                    #<?php echo $item->id; ?>
                </span>
                <?php  
                    //$title = getSnippet($item['description']['title'], 110);
                    $title = ApartmentsModule::t('Apartment title view '.$item['type'], array('{num_rooms}' => $item['num_of_rooms'], '{city}' => $city_name, '{address}' => $item['description']['address']));
                    echo CHtml::link( $title, 
                    $item->getUrl($item->id, $item->description->title,  $city_name ), array('class' => 'offer detailProposition', 'itemprop' => 'name')); 
                ?>
                <div class="attributes">
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
                        <div class="phone phone-apartment-<?php echo $item->id; ?>">
                            <img rel="nofollow" src="<?php echo Yii::app()->controller->createAbsoluteUrl('/apartments/main/generatephone', array('id' => $item->id, 'text'=>base64_encode(Apartment::codePhone($item->phone).':'.Apartment::codePhone($item->phone_additional)), 'size' => 10)); ?>"/>
                        </div>
                </div>
                <div class="additional">
                    <?php if(isset($item->discount['value'])) { ?>
                        <div class="price" itemprop="price">
                            <?php echo ApartmentDiscount::getDiscoutPrice($item->discount['value'], $item['price']); ?> 
                            <div class="old-price">
                                <?php echo CurrencymanagerModule::convertcurrency($item['price']); ?>   
                            </div>  
                        </div>
                    <?php } else { ?>
                        <div class="price" itemprop="price">
                            <?php echo CurrencymanagerModule::convertcurrency($item['price']); ?>   
                        </div>
                    <?php } ?>
                    <?php $countReviews = numberReplacing(count($item->comments), array(
                                CommentsModule::t('Count of comment', array('{v}' => count($item->comments))), 
                                CommentsModule::t('Count of comments', array('{v}' => count($item->comments))), 
                                CommentsModule::t('Count of comments_', array('{v}' => count($item->comments))))); ?>
                    <?php  echo CHtml::link( BookingModule::t('Booking').CHtml::tag('span', array('class'=>'count'), $countReviews), 
                    Yii::app()->createAbsoluteUrl('/booking/main/bookingform', array('id' => $item['id'], 'title'=> setTranslite($item->description['title']))),
                    array('class' => 'btn btn-grey btn-large'.((Yii::app()->user->id == $item->user->id) ? ' disabled' : null),  
                          'data-target'=>"#", 'data-toggle'=>((Yii::app()->user->id == $item->user->id) ? "mod-disabled" : "modal"),  'rel'=>'nofollow')); ?>  
                </div>
                <div class="rate-middle" style="position:absolute; left:0; bottom:0; margin:0;">
                    <span style="width:<?php echo Apartment::convertRating($item->rating).'%'; ?>"></span>
                </div>
                
        </div>
        <div class="clear"></div>  
</div>
