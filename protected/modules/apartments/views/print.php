<?php 
header('Content-Type: text/html; charset=utf-8');
$this->pageTitle = $apartment->getStrByLang($apartment->id).' - '.$this->pageTitle;
$city = City::getCityName($apartment->city->id);
$this->pageKeywords = $city ? Yii::t('index', 'Meta keywords {value}', array('{value}'=> $city)) :  Yii::t('index', 'Meta keywords'); ?>
<div class="google_wrapper vertical">
	<div class="google_map">
		<div id="map_canvas" class="vertical">
			<?php 
                if(($apartment->lat && $apartment->lng) || Yii::app()->user->getState('isAdmin')){
                        if(param('useGoogleMap') == 1){
                                ?>
                                <div>
                                        <div id="gmap">
                                        	<?php Yii::app()->gmap->actionGmap($apartment->id, $apartment, $this->renderPartial('backend/_marker', array('model' => $apartment),  array('height' => '255px'))); ?>
                                        </div>
                                </div>
                                <?php
                        }
                        if(param('useYandexMap') == 1){
                                ?>
                                <div>
                                        <div id="ymap">
                                        	<?php Yii::app()->ymap->actionYmap($apartment->id, $apartment, $this->renderPartial('backend/_marker', array('model' => $apartment),  array('height' => '255px'))); ?>
                                        </div>
                                </div>
                                <?php
                        }
                }
            ?>
		</div>
	</div>
</div>
<div class="price_info">
	<div class="price">
		<table cellpadding="0" cellspacing="0" align="center">
			<tr>
				<td class="price">
					<?php echo CurrencymanagerModule::convertcurrency($apartment->price); ?>&nbsp;
				</td>
			</tr>
		</table>
	</div>
	<div class="contacts">
		<?php echo $apartment->user->firstname; ?>
		<br/>
		<span>
        	<img rel="nofollow" src="<?php echo Yii::app()->controller->createAbsoluteUrl('/apartments/main/generatephone', array('offset' => 25,'height' => 70,'width' => 230, 'lang' => 'en', 'size' => 19, 'id' => $apartment->id, 'text'=>base64_encode(Apartment::codePhone($apartment->phone).':'.Apartment::codePhone($apartment->phone_additional)))); ?>"/>
        </span>
		<span class="underline">
			<?php echo $apartment->user['email']; ?>
		</span>
	</div>
</div>
<!-- PRINT VERSION -->
<div class="print_version_wrap vertical">
	<div class="toplogo">
		<div class="logo_left">
			<div class="logo"><?php echo ApartmentsModule::t('Title print'); ?></div>
		</div>
		<div class="logo_right">
			www.4trip.com.ua
		</div>
	</div>
	<div class="content">
		<h1><?php echo $apartment->description['title']?></h1><br/>
		<div class="adres">
			<span class="colo1"><?php echo ApartmentsModule::t('Location title'); ?>:</span>&nbsp;<span class="color2"><?php echo implode(', ', array(City::getCityName($apartment->city->id), $apartment->description['address'])); ?></span>
		</div>
		<div class="opis1">
			<div><span class="color1"><?php echo ApartmentsModule::t('Type'); ?></span>:&nbsp;<span class="color2"><?php echo $apartment::getNameByType($apartment->type); ?></span></div>
			<div><span class="color1"><?php echo ApartmentsModule::t('Rooms'); ?></span>:&nbsp;<span class="color2"><?php echo $apartment->num_of_rooms; ?></span></div>
			<div><span class="color1"><?php echo ApartmentsModule::t('Square'); ?></span>:&nbsp;<span class="color2"><?php echo ApartmentsModule::t('Square {value}', array('{value}' => $apartment->square)); ?></span></div>
			<div><span class="color1"><?php echo ApartmentsModule::t('Number of berths'); ?></span>:&nbsp;<span class="color2">2</span></div>
			<div><span class="color1"><?php echo ApartmentsModule::t('Floor'); ?></span>:&nbsp;<span class="color2">0</span></div>
		</div>
		<?php $services = Services::model()->cache(param('cachingTime', 1209600))->find('apartment_id=:apartment_id', array(':apartment_id'=>$apartment->id)); ?>
		<div class="opis2">
			<div><span class="color1"><?php echo ApartmentsModule::t('Min period rent');?></span>:&nbsp;<span class="color2"><?php echo $services['min_days']; ?></span></div>
			<div><span class="color1"><?php echo ApartmentsModule::t('Allow childs'); ?></span>:&nbsp;<span class="color2"><?php echo $services['with_child'] == 0 ? Yii::t('index', 'Forbidden') : Yii::t('index', 'Allow'); ?></span></div>
			<div><span class="color1"><?php echo ApartmentsModule::t('Allow animals'); ?></span>:&nbsp;<span class="color2"><?php echo $services['with_animals'] == 0 ? Yii::t('index', 'Forbidden') : Yii::t('index', 'Allow'); ?></span></div>
			<div><span class="color1"><?php echo ApartmentsModule::t('Allow smoke'); ?></span>:&nbsp;<span class="color2"><?php echo $services['smoking'] == 0 ? Yii::t('index', 'Forbidden') : Yii::t('index', 'Allow'); ?></span></div>
		</div>
	</div>
	<div class="footer">
		&copy;4trip.com.ua<br/>
		<?php echo Yii::t('index', 'Footer main message'); ?></div>
</div>
