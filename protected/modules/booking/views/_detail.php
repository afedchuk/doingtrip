<p class="tip">
	<?php if($model->status == 1) : ?>
		<?php echo BookingModule::t('Booking aprove'); ?>
	<?php else: ?>
		<?php echo BookingModule::t('Booking peding'); ?>
	<?php endif; ?>
</p>
<div class="order-info" style="display:block;">
		<h3><?php echo $apartment->description->title; ?></h3>
		<div class="order-info-row">
            <span><?php echo BookingModule::t('Check-in date'); ?>:</span>
            <div><span><?php echo date("Y/m/d", strtotime($model->date_start)); ?></span></div>
        </div>
        <div class="order-info-row">
            <span><?php echo BookingModule::t('Check-out date'); ?>:</span>
            <div><span><?php echo date("Y/m/d", strtotime($model->date_end)); ?></span></div>
        </div>
        <div class="order-info-row">
            <span><?php echo ApartmentsModule::t('Duration'); ?>:</span>
            <div><span class="dbv_rent_nights"><?php echo ApartmentsModule::t('Duration nights {v}', array('{v}' => $nights)); ?></span></div>
        </div>
        <div class="order-info-row">
            <span><?php echo ApartmentsModule::t('Price'); ?>:</span>
            <div><span><?php echo ApartmentsModule::t('Price {value} doba', array('{value}' => CurrencymanagerModule::convertcurrency($apartment->price)));?></span>    
            </div>
        </div>
        <div class="order-info-row">
            <span class="dbv_apt_price_total_text"><?php echo ApartmentsModule::t('Total price'); ?>:</span>
            <div class="order__price">
                <span class="dbv_price dbv_apt_price_total dbv_bold">
                	<?php echo  CurrencymanagerModule::convertcurrency($nights * $apartment->price);?>
                </span>
            </div>
        </div>
</div>