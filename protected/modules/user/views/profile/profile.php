<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Cabinet of user");
$this->breadcrumbs=array(
	UserModule::t("Cabinet of user"),
);
?>
<?php 
Yii::app()->clientScript->registerScript('comment', "
		function commentResponse(id, value){
			$.ajax({
			    type: 'POST',
				url: '". Yii::app()->createAbsoluteUrl('/comments/main/userComment')."',
				data: 'comment='+value+'&apartment_id='+id,
				success: function(msg){
					
				},
                complete: function() {
                    $('html,body').animate({
                        scrollTop: $('.c12').offset().top
                    }, 500, function() {document.location.reload()});

                }
			});
		}	
	",
    CClientScript::POS_HEAD);
?>
<?php $user = UserModule::user($user_id); ?>
<div class="row-fluid">
    <div class="profile-wrapper">
        <div class="span9">
            <?php if((!$viewer && !Yii::app()->user->getState('isAdmin')) || ($viewer && Yii::app()->user->getState('isAdmin'))) { ?>
            <div class="contact-info-detail well">
                <div class="span2">
                <?php if(!$user->user_image) { ?>
                    <i class="fa fa-user fa-16x" style="color: #999;font-size: 112px; width:90px;"></i>
                <?php } else { ?>
                    <img alt="<?php echo $user->firstname; ?>" src="<?php echo Yii::app()->getBaseUrl(true).'/uploads/users/'.$user->user_image; ?>" class="thumbnail" width="90">
                <?php } ?>
                <a title="<?php echo UserModule::t('Change photo')?>" data-target='#' data-toggle='modal' href="/user/profile/changeavatar"><i class="fa fa-camera fa-2x"></i></a>
            </div>
            <div class="span10 row">
                <div class="span5">
                    <div class="page-header">
                        <h4><?php echo implode(" ", array($user->firstname, $user->lastname))?></h4>
                    </div>
                    <span><strong><?php  echo UserModule::t('Proposition {value}', array('{value}' => count($model['apartments']))); ?></strong></span>
                    <span class="date">(<?php echo UserModule::t('Registration date') . ': '. date("Y/m/d", $user->createtime); ?>)</span>
                    <?php if($user->lastvisit > 0) { ?>
                        <span class="date">(<?php echo UserModule::t('Last visit') . ': '. date("Y/m/d", $user->lastvisit); ?>)</span>
                    <?php } ?>
                </div>
                <div class="span6">
                    <table class="table table-hover">
                            <tbody>
                            <tr>
                                <td><strong><?php echo ApartmentsModule::t('Email'); ?>:</strong></td>
                                <td><span><?php echo $user->email?></span> </td>
                            </tr>
                            <tr>
                                <td><strong><?php echo UserModule::t('Telephone'); ?>:</strong></td>
                                <td><span><?php echo implode(" ", array(Apartment::codePhone($user->phone), Apartment::codePhone($user->phone_additional))); ?></span></td>
                            </tr>
                            <?php if($user->website) {?>
                                <tr>
                                    <td><strong><?php echo UserModule::t('Website'); ?>:</strong></td>
                                    <td><span><a href="<?php echo $user->website; ?>"><?php echo $user->website; ?></a></span></td>
                                </tr>
                            <?php } ?>
                            <?php if($user->skype) {?>
                                <tr>
                                   <td><strong><?php echo UserModule::t('Skype'); ?>:</strong></td>
                                    <td><span><?php echo $user->skype; ?></span></td>
                                </tr>
                            <?php } ?>
                             </tbody>
                         </table>
                </div>
            </div>
            <div class="clear"></div>
            </div>
            <?php } ?>
                <?php if(!Yii::app()->user->getState('isAdmin')) { ?>
                <div class="well">
                    <h6><?php echo UserModule::t('Advertisement profile tip'); ?></h6>
                    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <!-- Left sidebar -->
                    <ins class="adsbygoogle"
                         style="display:block"
                         data-ad-client="ca-pub-2142044052125883"
                         data-ad-slot="2529646455"
                         data-ad-format="auto"></ins>
                    <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                    <div class="clear"></div>
                </div>
                <br/>
            <?php } ?>
            <?php 
                if(Yii::app()->user->getState('isAdmin') && !$viewer) {
                    $this->renderPartial('backend/_apartments_admin', array('model' => $model));
                } else {
                    if(Yii::app()->user->getState('type') < 1) {
                        if(!empty($model['apartments'])) {
                            $this->widget('bootstrap.widgets.TbTabs', array(
                                'type'=>'tabs',
                                'placement'=>'above', 
                                'tabs'=>array(
                                    array( 
                                        'label'=>UserModule::t('Published propositions'),
                                        'content'=>$this->renderPartial( 'profile/_apartments', array('model' => $model), true ),
                                        'active'=>true
                                    ),
                                    array( 
                                        'label'=>UserModule::t('Statistic'),
                                        'content'=>$this->renderPartial( 'profile/_statistics', array('visited' => $visited, 'ranges' => $ranges), true ),   
                                    ),

                                ),
                                'htmlOptions' => array('class' =>'well')
                            )); ?>
                            <?php } else { ?>
                            <div class="well">
                                <div class="hero-strapline">
                                    <div class="page-header">
                                        <h4><?php echo UserModule::t('User published apatments dont exist'); ?></h4>
                                    </div>
                                    <a href="<?php echo Yii::app()->createUrl('/user/profile/createApartment'); ?>" class="btn btn-large btn-info">
                                        <i class="icon-plus-sign icon-white"></i> <?php echo ApartmentsModule::t('Create apartment'); ?>
                                    </a>
                                </div>
                            </div>
                        <?php } ?> 
                        <?php } else { ?>
                            <?php if(count($booking) > 0 ) { ?>
                            <div class="well profile-edit  jcarousel-wrapper">
                                <div class="jcarousel"  id="box-booking">
                                    <ul>
                                <?php foreach($booking as $book) { ?>
                                <li data-item="<?php echo 'item-'.$book->book_unique; ?>">
                                <?php $res = Images::getMainThumb(350, 260, $book->thumb, null);
                                       $img = CHtml::image($res['thumbUrl'], $res['comment'], array('class' => 'thumbnail'));
                                  
                                ?>
                                <p class="tip">
                                    
                                    <i class="fa fa-check"></i> <?php echo BookingModule::t('Tip notify');?><br/><br/>
                                    <?php if(!$book->status) { ?>
                                        <?php echo BookingModule::t('Booking peding');?>
                                    <?php } ?>
                                </p>
                                <h1 class="mb-h1 mb-hotel-name"> Ваше бронювання в помешканні 
                                        <?php $city_name = City::getCityName($book->ap->city_id);
                                        echo CHtml::link($book->description->title, $book->apartment->getUrl($book->apartment_id, $book->description->title, $city_name)); ?>
                                </h1>
                                <div class="mb-above-masthead clearfix">
                                    <div class="mb-book-number">
                                        <?php echo BookingModule::t('Book unique');?>: <b><?php echo $book->book_unique; ?></b>
                                        <?php echo BookingModule::t('Pin' );?>: <b><?php echo $book->pin; ?></b>
                                        <i data-title="<?php echo BookingModule::t('Booking tooltip');?>" data-toggle="tooltip" class="fa fa-lock mb-book-number__clarification"></i>
                                    </div>
                                </div>
                                <div class="mb-main-details mb-prominent">
                                    <div class="mb-masthead-redesign ">
                                        <div class="mb-masthead__hotel-info mb-hotel-info">
                                            <svg class="mb-hotel-info__photo-blur">
                                                <image class="mb-hotel-info__photo-blur__img" style="filter:url(#mb-blur);" xlink:href="<?php echo $res['thumbUrl']; ?>" height="460" width="840" y="0" x="0"/>
                                                <filter id="mb-blur">
                                                    <feGaussianBlur stdDeviation="13"/>
                                                </filter>
                                            </svg>
                                            <div class="mb-inner mb-hotel-info__text">
                                                <div class="mb-hotel-info__block">
                                                    <div class="mb-hotel-info__address">
                                                        <?php echo implode(', ', array($city_name, $book->description->address)); ?><br/>
                                                        <?php $countryByCity = City::model()->getCountryByCity($book->ap->city_id); ?>
                                                        <?php echo $countryByCity->country->country; ?> <i class="icon-<?php echo strtolower($countryByCity->country->currency_code); ?>"></i>
                                                        <ul class="mb-action-list">
                                                            <li class="mb-action">
                                                                <a>
                                                                    <?php  echo CHtml::link('<i class="mb-icon  fa fa-map-marker"></i> '.BookingModule::t('Booking show map'), 
                                                                        Yii::app()->createAbsoluteUrl('/booking/main/showmap', array('id' => $book->id)),
                                                                        array('data-target'=>"#", 'data-toggle'=>"modal", 'data-width' => '500', 'rel'=>'nofollow')); ?> 
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="mb-hotel-info__block">
                                                    <?php echo BookingModule::t('Your phone number');?>: <?php echo implode(', ', array($book->apartment->phone, $book->apartment->phone_additional)); ?>
                                                    <br>
                                                    <a>
                                                        <i class="mb-icon fa fa-list"></i> 
                                                        <?php echo BookingModule::t('Booking show rules');?>
                                                    </a>
                                                </div>
                                                <div class="mb-hotel-info__block">
                                                    <ul class="mb-action-list">
                                                        <li class="mb-action">
                                                            <?php  echo CHtml::link('<i class="mb-icon mb-icon--action-list mb-icon--book-again fa fa-repeat"></i> '.BookingModule::t('Booking again'), 
                                                                        Yii::app()->createAbsoluteUrl('/booking/main/bookingform', array('id' => $book->ap->id, 'title'=> setTranslite($book->description['title']))),
                                                                        array('data-target'=>"#", 'data-toggle'=>"modal", 'data-width' => '310',  'rel'=>'nofollow')); ?>  
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>  
                                        <a data-target="#" data-toggle='modal' data-width='570' data-height='610' href="<?php echo Yii::app()->createAbsoluteUrl('/booking/main/showphotos', array('id' => $book->id)); ?>">
                                            <div style="background-image: url('<?php echo $res['thumbUrl']; ?>'); background-repeat: no-repeat; background-position: right;" class="mb-masthead__hotel-photo mb-hotel-photo ">
                                                <span class="mb-photo-counter">
                                                    <i class="mb-photo-counter__icon fa fa-camera"></i>&nbsp;<?php echo count($book->thumb); ?>
                                                </span>
                                                <div class="mb-hotel-photo__shadow"></div>
                                            </div>
                                        </a>
                                </div>
                                <div class="mb-section mb-section--summary mb-summary">
                                    <div class="mb-table">
                                        <div class="mb-row mb-summary__row--details">
                                            <div class="mb-col mb-summary__col mb-summary__col--dates col--1">
                                                <div class="mb-dates cf mb-dates--has-time">
                                                    <div class="mb-dates__block floatLeft">
                                                        <span class="mb-smallcaps">
                                                            <?php echo BookingModule::t('Check-in date');?>
                                                        </span>
                                                    <span class="mb-dates__day">
                                                        <?php echo date('d', strtotime($book->date_start)); ?>
                                                    </span>
                                                    <span class="mb-dates__month">
                                                        <?php echo strftime('%B', strtotime($book->date_start)); ?>
                                                    </span>
                                                    <span class="mb-dates__weekday">
                                                        <?php echo strftime('%A', strtotime($book->date_start)); ?>
                                                    </span>
                                                    <div class="mb-dates__time marginTop_3"> <i class="bicon-recent"></i>
                                                        <?php echo BookingModule::t('Booking from {t}', array('{t}' => date('H:i', $book->time_in)));?>
                                                    </div>
                                                </div>
                                                <div class="mb-dates__block floatRight">
                                                    <span class="mb-smallcaps">
                                                        <?php echo BookingModule::t('Check-out date');?>
                                                    </span>
                                                    <span class="mb-dates__day"><?php echo date('d', strtotime($book->date_end)); ?></span>
                                                    <span class="mb-dates__month">
                                                        <?php echo strftime('%B', strtotime($book->date_end)); ?>
                                                    </span>
                                                    <span class="mb-dates__weekday"><?php echo strftime('%A', strtotime($book->date_end)); ?></span>
                                                    <div class="mb-dates__time marginTop_3"> <i class="bicon-recent"></i>
                                                        <?php echo BookingModule::t('Booking to {t}', array('{t}' => date('H:i', $book->time_out)));?>
                                                    </div>
                                                </div>
                                                </div> 
                                            </div>
                                            <div class="mb-col mb-summary__col mb-summary__col--with-border col--2">
                                                <div class="mb-rooms-nights marginBottom_10">
                                                    <div class="mb-rooms-nights__block">
                                                        <span class="mb-smallcaps"><?php echo BookingModule::t('Guests');?></span>
                                                        <span class="mb-rooms-nights__num">
                                                            <?php echo $book->guests; ?> 
                                                        </span>
                                                        <div class="mb-rooms-nights__divide">
                                                            <?php echo $book->adult; ?> <i class="fa fa-male" data-title="<?php echo BookingModule::t('Adult');?>"></i> / 
                                                            <?php echo $book->child; ?> <i class="fa fa-child" data-title="<?php echo BookingModule::t('Child');?>" ></i>
                                                        </div>
                                                    </div>
                                                    <div class="mb-rooms-nights__block">
                                                        <span class="mb-smallcaps">&nbsp;</span>
                                                        <span class="mb-rooms-nights__sep">/</span>
                                                    </div>
                                                    <div class="mb-rooms-nights__block">
                                                        <span class="mb-smallcaps">Ночей</span>
                                                        <span class="mb-rooms-nights__num">
                                                            <?php $dates = dateRange($book->date_start, $book->date_end, '+1 day'); 
                                                            $nights = count($dates);
                                                            echo $nights;
                                                            ?>
                                                            <i class="mb-icon mb-icon--nights"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-col mb-summary__col mb-summary__col--with-border  col--3">
                                            <div class="mb-price mb-price--has-price-details">
                                            <span class="mb-smallcaps">
                                            Загальна ціна
                                            </span>
                                            <span class="mb-price__unit mb-price__unit--primary marginBottom_3">
                                                <?php echo ApartmentsModule::t('Price fiulter {value}', array('{value}' => $book->apartment->price * $nights)); ?>
                                            </span>
                                            </div> 
                                            <div class="mb-price-details marginBottom_10">
                                            </div>
                                            </div>
                                        </div> 
                                        <?php if(strtotime($book->date_end) > time()) {?>
                                            <div class="mb-row mb-summary__row--btns">
                                                <div class="mb-col mb-summary__col col--1">
                                                    <?php $this->widget('bootstrap.widgets.TbButton', array(
                                                                        'type'=>'primary',
                                                                        'buttonType' => 'link',
                                                                        'encodeLabel' => false,
                                                                        'label'=>'<i class="fa  fa-calendar"></i> '. BookingModule::t('Change dates'),
                                                                        'htmlOptions' => array('data-target' => '#', 'data-width' => '310',  'href'=>Yii::app()->createAbsoluteUrl('/booking/main/change', array('id' => $book->id)),'data-toggle'=>"modal",  'rel'=>'nofollow'))
                                                                    ); ?>
                                                </div>
                                                <div class="mb-col mb-summary__col mb-summary__col--with-border col--2"></div>
                                                <div class="mb-col mb-summary__col mb-summary__col--with-border mb-summary__col--price-btns col--3">
                                                    <?php $this->widget('bootstrap.widgets.TbButton', array(
                                                                        'type'=>'danger',
                                                                        'size' => 'small',
                                                                        'buttonType' => 'link',
                                                                        'encodeLabel' => false,
                                                                        'label'=>'<i class="fa  fa-times-circle"></i> ' .BookingModule::t('Cancel booking'),
                                                                        'htmlOptions' => array('data-target' => '#', 'data-width' => '310',  'href'=>Yii::app()->createAbsoluteUrl('/booking/main/cancelbooking', array('id' => $book->id)),'data-toggle'=>"modal",  'rel'=>'nofollow'))
                                                                    ); ?>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div> 
                                </div>
                                </div>
                            </li>
                                <?php } ?>
                            </ul>
                                <div class="clear"></div>
                            </div>
                                <a href="#" class="span3 jcarousel-control-prev" rel="nofollow"><i class="fa fa-angle-double-left"></i> <?php echo BookingModule::t('new reservations'); ?></a>
                                <a href="#" class="span3 pull-right jcarousel-control-next" rel="nofollow"><?php echo BookingModule::t('old reservations'); ?> <i class="fa fa-angle-double-right"></i></a>
                                <div class="clear"></div> 
                            </div> 
                            <?php } else { ?>
                                <div class="well">
                                    <?php if(!empty($recentlyViewedPosts)) { ?>
                                        <h4><?php echo UserModule::t('Tip recently viewed apartments'); ?></h4>
                                        <?php $i =1;
                                        foreach ($recentlyViewedPosts as $recentlyViewedPost) {
                                            $this->renderPartial('application.modules.apartments.views.widgetApartments_grid_item', array(
                                                                            'item' => $recentlyViewedPost,
                                                                            'i' => $i
                                                                    ));
                                            $i++;
                                        } ?>
                                        <div class="clear"></div> 
                                        <?php   Yii::app()->clientScript->registerScriptFile($this->assetsBase  . '/js/jquery.lazyload.min.js', CClientScript::POS_END); 
                                                Yii::app()->clientScript->registerScript('recentlyViewed', "        
                                                    widgetlist.apply();
                                                ",
                                                CClientScript::POS_END); ?>
                                    <?php } else { ?>
                                        <div class="hero-strapline">
                                        <div class="page-header">
                                            <h4><?php echo UserModule::t('User booked apatments dont exist'); ?></h4>
                                            <div></div>
                                        </div> 
                                    </div>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        <?php } ?>
                <?php } ?> 

            <?php if(Yii::app()->user->getState('isEditor')) { ?>
            <div class="well">
                <?php //$this->widget('application.modules.news.components.NewsWidget'); ?>
            </div>
            <?php } ?>           
        </div>
        <?php echo $this->renderPartial('profile/menu'); ?>       
    </div>
</div>
<?php Yii::app()->clientScript->registerScript('ajaxMapSetStatus', "
      reloadApartment.resultBlock = 'box-booking';
      reloadApartment.modalContainer = '#modal-booking';
      widgetlist.apply();",
      CClientScript::POS_END); ?>

