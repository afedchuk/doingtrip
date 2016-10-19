<?php 
$this->pageTitle = $this->pageTitle . ' - '.ComparisonListModule::t('Comparison list');
$this->breadcrumbs=array(
        ApartmentsModule::t('Apartments catalog') => array('/apartments'),
        ComparisonListModule::t('Comparison list')
);
?>
<?php if ($apartments): ?>
<section>
    <table class="table compare">
        <thead class="goods">
            <tr class="head">
                <td><?php echo ComparisonListModule::t('Comparison list');?></td>
                <?php foreach ($apartments as $item) :?>
                    <td>
                        <div class="compare-title">
                            <?php
                            $city_name = City::getCityName($item->city_id); 
                            $title = truncateText($item->getStrByLang($item->id), 10);
                            echo CHtml::link($title, $item->getUrl($item->id, $item->description->title, $city_name), array('class'=>'detailProposition'));
                            ?>
                        </div>

                        <div class="compare-photo">
                                <div>
                                    <?php
                                        echo CHtml::link(
                                            '<i class="icon-ban-circle"></i>',
                                            Yii::app()->createUrl('/comparisonList/main/del', array('apId' => $item->id)),
                                            array('title' => Yii::t('index', 'Delete'))
                                        );
                                    ?>
                                </div>
                                <?php
                                    $res = Images::getMainThumb(150,100, $item->images);
                                    $img = CHtml::image($res['thumbUrl'], $item->getStrByLang($item->id), array(
                                        'title' => $item->getStrByLang($item->id),
                                        'class' => 'apartment_type_img'
                                    )); 
                                    echo CHtml::link($img, $item->getUrl($item->id, $item->description->title, $city_name), array('title' =>  $item->getStrByLang($item->id)));
                                ?>
                            <div class="price">
                                <?php echo ApartmentsModule::t('Price {value} doba', array('{value}' => CurrencymanagerModule::convertcurrency($item->price)));?>
                            </div>
                            <div class="firm-rating-wrapper">
                                <div class="rate-middle">
                                    <span style="width:<?php echo Apartment::convertRating($item['rating']).'%'; ?>"></span>
                                </div>
                            </div>
                        </div>                                
                    </td>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <?php echo ApartmentsModule::t('Address');?>:
                </td>
                <?php foreach ($apartments as $item) :?>
                    <td>
                        <?php 
                        $city_name = City::getCityName($item->city_id); 
                        echo $city_name.', '.$item->description->address; ?>
                    </td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <td>
                    <?php echo ApartmentsModule::t('Floor');?>:
                </td>
                <?php foreach ($apartments as $item) :?>
                    <td>
                        <?php echo $item->floor ? implode('/', array($item->floor, $item->floor_total)) : '-'; ?>
                    </td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <td>
                    <?php echo ApartmentsModule::t('Square');?>:
                </td>
                <?php foreach ($apartments as $item) :?>
                    <td>
                        <?php echo $item->square ? ApartmentsModule::t('Square {value}', array('{value}' => $item->square)) : '-'; ?>
                    </td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <td>
                    <?php echo ApartmentsModule::t('Rooms');?>:
                </td>
                <?php foreach ($apartments as $item) :?>
                    <td>
                        <?php
                        if($item->num_of_rooms){
                            echo $item->num_of_rooms;
                        }
                        ?>
                    </td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <td>
                    <?php echo ApartmentsModule::t('Number of berths');?>:
                </td>
                <?php foreach ($apartments as $item) :?>
                    <td>
                        <?php
                        if($item->berths){
                            echo CHtml::encode($item->berths);
                        }
                        ?>
                    </td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <td>
                    <?php echo ApartmentsModule::t('Window to');?>:
                </td>
                <?php foreach ($apartments as $item) :?>
                    <td>
                        <?php
                        echo ($item->window_to == 1) ? ApartmentsModule::t('Into') : ApartmentsModule::t('Out');
                        ?>
                    </td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <td>
                    <?php echo ApartmentsModule::t('Services apartment'); ?>:
                </td>
                <?php foreach ($apartments as $item) {
                        $references =  Apartment::getCategories($item->id); ?>
                        <td>
                            <?php $services[] = Services::model()->cache(param('cachingTime', 1209600))->find('apartment_id=:apartment_id', array(':apartment_id'=>$item->id)); ?>
                            <div class="references-list">
                            <?php foreach($references as $category) { ?>
                                <?php $i=0; $cat = false; $values = array(); foreach($category['values'] as  $key=>$value) { ?>
                                    <?php if($value['selected'] == true) { ?>
                                        <?php if($cat == false) { $cat = true; ?>
                                            <div><a data-toggle="tooltip" title="<?php echo $category['title']?>" class="<?php echo $category['style']; ?>"></a>
                                       <?php } ?>
                                       <?php $values[] = $value['title'];?>
                                    <?php } ?>
                                <?php  $i++;  }
                                    echo implode(', ', $values);
                                ?>
                                <?php if($cat == true) { ?></div><?php }?>
                            <?php } ?>
                            </div>
                        </td>
                <?php } ?>   
            </tr>
            <tr>
                <td>
                   <?php echo ApartmentsModule::t('Time of enter/exit');  ?>:
                </td>
                <?php foreach ($services as $item) :?>
                    <td><?php echo $item['time_race']; ?></td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <td>
                   <?php echo ApartmentsModule::t('Min period rent');  ?>:
                </td>
                <?php foreach ($services as $item) :?>
                    <td><?php echo $item['min_days']; ?></td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <td>
                   <?php echo ApartmentsModule::t('Max berts places');  ?>:
                </td>
                <?php foreach ($services as $item) :?>
                    <td><?php echo $item['max_berths']; ?></td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <td>
                   <?php echo ApartmentsModule::t('Allow childs');  ?>:
                </td>
                <?php foreach ($services as $item) :?>
                    <td><?php echo $item['with_child'] == 0 ? Yii::t('index', 'Forbidden') : Yii::t('index', 'Allow'); ?></td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <td>
                   <?php echo ApartmentsModule::t('Allow animals');  ?>:
                </td>
                <?php foreach ($services as $item) :?>
                    <td><?php echo $item['with_animals'] == 0 ? Yii::t('index', 'Forbidden') : Yii::t('index', 'Allow'); ?></td>
                <?php endforeach; ?>
            </tr>
             <tr>
                <td>
                   <?php echo ApartmentsModule::t('Allow smoke');  ?>:
                </td>
                <?php foreach ($services as $item) :?>
                    <td><?php echo $item['smoking'] == 0 ? Yii::t('index', 'Forbidden') : Yii::t('index', 'Allow'); ?></td>
                <?php endforeach; ?>
            </tr>
        </tbody>
    </table>
</section>
<div class="clear"></div>

<?php else:?>
    <div class="hero-unit">
        <div class="hero-strapline">
            <h2><?php echo ComparisonListModule::t('List empty'); ?></h2>
        </div>
    </div>
<?php endif;?>
<?php
Yii::app()->clientScript->registerScript('compare-zebra', "
    $('.table tr').not('.head').removeClass('odd').removeClass('int');
    $('.table tr:odd').not('.head').addClass('odd');
    $('.table tr:even').not('.head').addClass('int');
", CClientScript::POS_READY);
?>