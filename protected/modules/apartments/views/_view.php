<div class="apartment-description">
	<?php
		if($data->is_special_offer){
			?>
			<div class="big-special-offer">
				<?php
				echo '<h4>'.Yii::t('common', 'Special offer!').'</h4>';

				if($data->is_free_from != '0000-00-00' && $data->is_free_to != '0000-00-00'){
					echo '<p>';
					echo Yii::t('common','Is avaliable');
					if($data->is_free_from != '0000-00-00'){
						echo ' '.Yii::t('common', 'from');
						echo ' '.Booking::getDate($data->is_free_from);

					}
					if($data->is_free_to != '0000-00-00'){
						echo ' '.Yii::t('common', 'to');
						echo ' '.Booking::getDate($data->is_free_to);
					}
					echo '</p>';
				}
				?>
			</div>
			<?php
		}
	?>
	
	
	<div class="viewapartment-description-top <?php //if(!$img) echo 'viewapartment-no-photo';?>">
		<p>
			<b>
			
			</b><br/>
			<?php echo tt('Apartment ID').': '.$data->id; ?>

		</p>
		<p class="cost padding-bottom10">
			<?php //echo tt('Price from').': '.$data->getPriceFrom().' '.Apartment::getPriceName($data->price_type);; ?>
		</p>
		
		<?php
			if(($data->floor && $data->floor_total) || $data->square || $data->berths || ($data->windowTo && $data->windowTo->getTitle()) ){
				echo '<p>';
				$echo = array();
				if($data->floor && $data->floor_total){
					$echo[] = Yii::t('module_apartments', '{n} floor of {total} total', array($data->floor, '{total}' => $data->floor_total));
				}
				if($data->square){
					$echo[] = Yii::t('module_apartments', 'total square: {n} m<sup>2</sup>', $data->square);
				}
				if($data->berths){
					$echo[] = Yii::t('module_apartments', 'berths').': '.CHtml::encode($data->berths);
				}
				
				echo implode(', ', $echo);
				unset($echo);

				echo '</p>';
			}
		?>

		<?php
			if(!Yii::app()->user->getState('isAdmin') && $data->type == 1){
				echo CHtml::link(tt('Booking'), array('/booking/main/bookingform', 'id' => $data->id), array('class' => 'btnsrch booking-button fancy')); 
				// booking-button
			}
		?>
		<div class="clear">&nbsp;</div>
	</div>
	
	<div class="apartment-description-item">
		<?php
			/*$this->widget('application.modules.gallery.FBGallery', array(
				'images' => $data->images,
				'pid' => $data->id,
				'userType' => $usertype,
			));*/
		?>
	</div>
	<div class="viewapartment-description">
		<?php
 /*
			if($data->getStrByLang('description')){
				echo '<p><b>'.tt('Description').':</b> '.CHtml::encode($data->getStrByLang('description')).'</p>';
			}

			if($data->getStrByLang('description_near')){
				echo '<p><b>'.tt('Near').':</b> '.CHtml::encode($data->getStrByLang('description_near')).'</p>';
			}

			if($data->getStrByLang('address')){
				
				if($data->getStrByLang('address')){
					echo '<p><b>'.tt('Address').':</b> '.CHtml::encode($data->getStrByLang('address')).'</p>';
				}
			}*/
		?>

		<?php
			$prev = '';
			$column1 = 0;
			$column2 = 0;
			$column3 = 0;

			foreach($data->getFullInformation($data->id) as $item){
				if($item['title']){
					if($prev != $item['style']){
						$column2 = 0;
						$column3 = 0;
						echo '<div class="clear"></div>';
					}
					$$item['style']++;
					$prev = $item['style'];
					echo '<div class="'.$item['style'].'">';
					echo '<span class="viewapartment-subheader">'.CHtml::encode($item['title']).'</span>';
					echo '<ul class="apartment-description-ul">';
					foreach($item['values'] as $value){
						if($value){
							echo '<li><span>'.CHtml::encode($value).'</span></li>';
						}
					}
					echo '</ul>';
					echo '</div>';
					if(($item['style'] == 'column2' && $column2 == 2)||$item['style'] == 'column3' && $column3 == 3){
						echo '<div class="clear"></div>';
					}

				}
			}
		?>
		<div class="clear"></div>
	</div>

	<?php
	if(($data->lat && $data->lng)){
		
		if(param('useYandexMap', 1)){
			?>
			<div class="row">
				<div class="row" id="ymap">
					<?php //echo $this->actionYmap($data->id, $data); ?>
				</div>
			</div>
			<?php
		}
	}
	?>
</div>
