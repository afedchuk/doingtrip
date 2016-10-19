<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
		<td valign="top" width="170px">
			<?php
			$city_name = City::getCityName($item->city_id);
			$res = Images::getMainThumb(150,100, $item->images);
			$img = CHtml::image($res['thumbUrl'], $item->description->title, array(
				'title' => $item->description->title,
			));
			echo CHtml::link($img, $item->getUrl($item->id, $item->description->title,  $city_name), array('title' => $item->description->title));
			?>
		</td>
		<td valign="top">
			<?php  echo  $city_name .', '.$item->description->address; ?>
            <div class="attributes">
                    <?php 
                        if( ($item->floor && $item->floor_total) || $item->square || $item->berths){
                            if($item->square)
                                echo '<span class="grey-content">'.Yii::app()->getModule('apartments')->t('Square').':</span>'.Yii::app()->getModule('apartments')->t('Square {value}', array('{value}'=>$item->square)).'<br/>';

                             if($item->floor && $item->floor_total)
                                 echo '<span class="grey-content">'.Yii::app()->getModule('apartments')->t('Floor').':</span>'.Yii::app()->getModule('apartments')->t('Square {n} of {total}', array('{n}'=>$item->floor, '{total}'=>$item->floor_total)).'<br/>';
                        }
                    ?>
                    <?php echo ApartmentsModule::t('Type');?>: <?php echo Yii::app()->getModule('apartments')->t('Type '.$item->type)?><br/>
                    <?php if($item->num_of_rooms != '0') { ?>
                    <?php echo ApartmentsModule::t('Rooms'); ?>: <?php echo $item->num_of_rooms; ?><br/>
                    <?php } ?>
                    <?php if($item->berths) { ?>
                    <?php echo ApartmentsModule::t('Berths'); ?>: <?php echo $item->berths; ?><br/>
                    <?php } ?>
                </div>
            <p class="cost">
            	<?php echo ApartmentsModule::t('Price {value} doba', array('{value}'=>  CurrencymanagerModule::convertcurrency($item['price']))); ?>   
            </p>
		</td>
	</tr>
</table>