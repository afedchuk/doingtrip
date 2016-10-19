<?php  
	Yii::app()->clientScript->registerScriptFile($this->assetsBase  . '/js/jquery.shorten.js', CClientScript::POS_END); 
	$city_name = City::getCityName($model->city_id);
	$address = implode(', ', array($city_name, $model->description->address));
	$this->pageTitle = implode(', ', array($model->getStrByLang($model->id), $address )).' - '.$this->pageTitle;
	$this->pageDescription = $model->description->description;
	$this->breadcrumbs=array(
	        ApartmentsModule::t('Apartments catalog') => array('/apartments'),
	        $city_name => array('/'.setTranslite($city_name).'/apartments'),
		    $model->description->title,
	); 
?>
<?php $main = Images::getMainThumb(1024, 768, $model->images, null, true); ?>
<div class="wide-image header-slider-container overflow-hidden">
	<a rel="fancy-photo" >
		<img src="<?php echo $main['thumbUrl']; ?>" id="main-photo" class="responsive-image">
	</a>
	<div class="breadcrumb-slider-container">
		<?php if(isset($this->breadcrumbs) && !empty($this->breadcrumbs)):?>
	        <?php $this->widget('zii.widgets.CBreadcrumbs', array(
	                'links'=>$this->breadcrumbs,
	                'encodeLabel' => false,
	                'separator'=> '',
	                'htmlOptions'=>array('class'=>'breadcrumbs'),
	        )); ?>
		<?php endif?>
	</div>
	<div class="ap-price">
		<b itemprop="price"><?php echo  CurrencymanagerModule::convertcurrency($model->price);?></b>
	</div>
</div>
<div class="apartment-short-desc-container">
	<div itemtype="http://schema.org/Offer" itemscope="" itemref="product" itemprop="offers" class="ap-price-contact">
	<div class="contacts-block clearfix">
		<div class="contacts-block">
			<ul class="contacts-list no-js">
				<?php foreach( array(Apartment::codePhone($model->phone), Apartment::codePhone($model->phone_additional), $model->user->email) as $contacts) { ?>
					<li>
						<?php echo $contacts; ?>
					</li>
				<?php } ?>
			</ul>
			<ul class="contacts-list js">
				<li>
					<?php echo substr(Apartment::codePhone($model->phone), 0,9).' '.str_repeat("*", 7); ?>
				</li>
				<li>
					<a href="#" class="mask">
						<?php echo ApartmentsModule::t('Show contacts'); ?>
					</a>
				</li>
			</ul>
		</div>
	</div>
	</div>
	<div class="ap-price-address-facilities">
		<div class="ap-name">
			<h1 itemprop="name"><?php echo $model->description->title; ?></h1>
		</div>
		<div class="ap-address">
			<p><?php echo $address; ?></p>
		</div>
	</div>
	<!--a class="check-booking  button button-blue contactSubmitButton"><?php echo ApartmentsModule::t('When are you staying?'); ?> <i class="fa fa-calendar"></i></a-->
</div>
<?php /*$this->renderPartial('_avalibility',array(
                    'avalibility'=>$avalibility, 'model' => $model
            ));*/
?>
<div class="apartment-full-desc-container">
	<div id="details" class="apartment-desc">
		<h4><?php echo ApartmentsModule::t('Apartment title view '.$model->type, array('{num_rooms}' => $model->num_of_rooms, '{city}' => isset($this->seoCity->sname) ? $this->seoCity->sname : $city_name, '{address}' => $model->description->address)); ?></h4>
		<ul class="attr-apartment container">
	        <li><?php echo ApartmentsModule::t('Type'); ?>:<span><?php echo $model::getNameByType($model->type); ?></span></li>
	        <li><?php echo ApartmentsModule::t('Rooms'); ?>:<span><?php echo $model->num_of_rooms; ?></span></li>
	        <li><?php echo ApartmentsModule::t('Square'); ?>:<span><?php echo ApartmentsModule::t('Square {value}', array('{value}' => $model->square)); ?></span></li>
	        <li><?php echo ApartmentsModule::t('Number of berths'); ?>:<span><?php echo $model->berths; ?></span></li>
	        <li><?php echo ApartmentsModule::t('Floor'); ?>:<span><?php echo implode('/', array($model->floor, $model->floor_total)); ?></span></li>
	        <li><?php echo ApartmentsModule::t('Window to'); ?>:<span><?php echo ($model->window_to == 1) ? ApartmentsModule::t('Into') : ApartmentsModule::t('Out'); ?></span></li>
	    </ul>
		<h2><?php echo ApartmentsModule::t('Description apartment'); ?>:</h2>
		<p class="short-description">
			<?php echo $model->description->description; ?>
		</p>
		<?php if($model->description->description_near) { ?>
	        <p><h2><?php echo ApartmentsModule::t('What is near?'); ?></h2></p>
	        <p> <?php echo $model->description->description_near; ?> </p>  
	    <?php } ?>
	    <?php 
			if($model->images) { ?>
				<ul id="gallery" class="clear gallery square-thumb">
				<?php foreach($model->images as $image) { ?>
					<li>
			        	<a href="<?php echo Images::getFullSizeUrl($image); ?>" class="swipebox">
			            	<img src="<?php echo Images::getThumbUrl($image, 320, 220, null, true); ?>" />
			            	<div class="img-overlay"></div>
			            	<div class="style-h">
	                            <span class="white-rounded"><i class="fa fa-search"></i></span>
	                        </div>
			            </a>
			        </li>
				<?php } ?>
			</ul>
		<?php } ?>
    </div>
    <h2><?php echo ApartmentsModule::t('Map road'); ?>:</h2>
    <div itemtype="http://schema.org/GeoCoordinates" itemscope="" itemprop="geo" class="location-coords">
		<i class="fa fa-location-arrow"></i><?php echo $model->lat; ?>, <?php echo $model->lng; ?>
		<a target="_blank" href="http://maps.google.com/?q=<?php echo $model->lat; ?>,<?php echo $model->lng; ?>">
			<?php echo ApartmentsModule::t('Map show'); ?>
		</a>
		<meta itemprop="latitude" content="<?php echo $model->lat; ?>">
		<meta itemprop="longitude" content="<?php echo $model->lng; ?>">
	</div>
</div>
<?php if(($model->lat && $model->lng) || Yii::app()->user->getState('isAdmin')){
if(param('useGoogleMap') == 1){ ?>
<div id="gmap">
    <?php Yii::app()->gmap->actionGmap($model->id, $model, $this->renderPartial('_marker', array('model' => $model), true), array('height' => '200px')); ?>
</div>               
<?php } } ?>
<div class="apartment-full-desc-container">
    <div id="list-comments" class="review-list">  
    	<?php if (Yii::app()->user->isGuest) { ?>
	    	<label><?php echo UserModule::t('Auth tip'); ?></label>
	    	<?php $this->widget('ext.eauth.EAuthWidget', array('action' => 'user/main/login', 'popup' => false)); ?>
	    <?php } else { ?>
	    	<?php  $this->renderPartial('_comment_new', array('model' => $comment
                                    ));
            ?>
	    <?php } ?>
	    <h2><?php echo CommentsModule::t('Comments {value}', array('{value}' => $rating['count'])); ?></h2>
        <div id="view-comments">
        <?php   if($model->commentCount){ 
                        $this->renderPartial('_comments',array(
                                'apartment'=>$model,
                                'comments'=>$model->comments,
                                'rating' => $rating,
                        ));
                } else 
                        echo CHtml::tag('p',array('class' => 'view-info'), CommentsModule::t('There are no comments'));
        ?>
        </div>
        <div class="clear"></div>
    </div>
</div>
<?php Yii::app()->clientScript->registerScript('short', '
	$(".short-description, .body").shorten({
	    "showChars" : 250,
	    "moreText"  : "'.ApartmentsModule::t('Show full text').'",
	    "lessText"  : "'.ApartmentsModule::t('Hide text').'",
	});',
	CClientScript::POS_READY);
?>