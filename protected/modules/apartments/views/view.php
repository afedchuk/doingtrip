<?php 
Yii::app()->clientScript->registerCoreScript('rating');
$city_name = City::getCityName($model->city_id);
$address = implode(', ', array(ApartmentsModule::t('Short city', array('{city}' => $city_name)), $model->description->address));
$title = ApartmentsModule::t('Apartment title view '.$model->type, array('{num_rooms}' => $model->num_of_rooms, '{city}' => isset($this->seoCity->sname) ? $this->seoCity->sname : $city_name, '{address}' => $model->description->address));
$this->pageTitle = $title ;
$this->pageKeywords = ApartmentsModule::t('{type} title {value}', array('{type}' => $model::getNameByType($model->type), '{value}' => $city_name));
$this->pageDescription = $title;
$this->breadcrumbs=array(
        Yii::t('index','Short time'). CHtml::tag('span', array('class'=>'count-properties'), '('.Apartment::getAllCountActive().')') => array('/apartments'),
        $city_name. CHtml::tag('span', array('class'=>'count-properties'), '('.Apartment::getCountByCity($model->city_id).')') => array('/'.City::getUrl($model->city_id).'/apartments'),
	    $model->description->title,
);
if(isset($this->seoCity->sname))
  $this->scity = $this->seoCity->sname;
?>
<div class="well info head-view relative">
      <ul class="view-actions">
        <li><a href="<?php echo Yii::app()->createAbsoluteUrl('apartments/main/print', array('id'=>$model->id, 'title'=> setTranslite($model->description->title)))?>"><i class="fa fa-print"></i> <?php echo ApartmentsModule::t('Print'); ?>
            </a>
            </li>
        <?php if((!Yii::app()->user->isGuest && Yii::app()->user->id == $model->user_id) || Yii::app()->user->getState('isAdmin')) { ?>
          <li data-toggle="tooltip" data-original-title="<?php echo UserModule::t('To top tip'); ?>">
            <i class="fa fa-level-up"></i> 
            <a rel="nofollow" href="<?php echo Yii::app()->createAbsoluteUrl('user/profile/toTop', array('id' => $model->id, 'title' => setTranslite($model->description->title))); ?>"><?php echo UserModule::t('To top'); ?></a>
          </li>
        <?php } ?>
      </ul>
      <a class="pull-right back-catalog" href="<?php echo Yii::app()->createAbsoluteUrl('/'.City::getUrl($model->city_id).'/apartments'); ?>"><?php echo ApartmentsModule::t('Back to catalog'); ?></a>
    <?php 
        if ($model->images && !empty($model->images)) {
            $image = Images::getMainThumb(210, 200, $model->images);
            $this->widget('application.modules.images.components.ImagesWidget', array(
                'images' => $model->images,
                'objectId' => $model->id,
            ));
        }
    ?>
   <div class="detail-info ">
    <div class="head-title">
        <h1><?php echo $title; ?></h1>
    </div>

    <ul class="attr-apartment">
        <li><?php echo ApartmentsModule::t('Type'); ?>:<span><?php echo $model::getNameByType($model->type); ?></span></li>
        <li><?php echo ApartmentsModule::t('Rooms'); ?>:<span><?php echo $model->num_of_rooms; ?></span></li>
        <li><?php echo ApartmentsModule::t('Square'); ?>:<span><?php echo ApartmentsModule::t('Square {value}', array('{value}' => $model->square)); ?></span></li>
        <li><?php echo ApartmentsModule::t('Number of berths'); ?>:<span><?php echo $model->berths; ?></span></li>
        <li><?php echo ApartmentsModule::t('Floor'); ?>:<span><?php echo implode('/', array($model->floor, $model->floor_total)); ?></span></li>
        <li><?php echo ApartmentsModule::t('Window to'); ?>:<span><?php echo ($model->window_to == 1) ? ApartmentsModule::t('Into') : ApartmentsModule::t('Out'); ?></span></li>
    </ul>
    <div class="user-details">
         <p class="user-name"><?php echo $model->user->firstname; ?></p>
         <div class="clearfix"></div>
         <span class="date">(<?php echo UserModule::t('Registration date') . ': '. date("Y/m/d", $model->user->createtime); ?>)</span>
         <?php echo CHtml::link('<i class="fa fa-user"></i>'.ApartmentsModule::t('Another propositions of user'), Yii::app()->createAbsoluteUrl('apartments').'?property_search[user_id]='.$model->user_id, array('class' => 'another-apartments')); ?>
         <span class="status<?php if($user_online) { ?> online<?php }?>">
          <i class="fa fa-circle"></i> <?php echo ($user_online == true ? UserModule::t('User online') : UserModule::t('User offline')); ?>
         <span>
    </div>
    <div class="contacts-detail">
        <img rel="nofollow" src="<?php echo Yii::app()->controller->createAbsoluteUrl('/apartments/main/generatephone', array('lang' => 'en','id' => $model->id, 'size'=>19, 'height' => 70,'offset' => 25,'width'=>230, 'text'=>base64_encode(Apartment::codePhone($model->phone).':'.Apartment::codePhone($model->phone_additional)))); ?>"/>
        
    </div>
    <?php if($model->user !== null): ?>
    <span class="qr-code">
    <?php $body = 'BEGIN:VCARD
VERSION:4.0
N:'.$model->user->firstname.';'.$model->user->lastname.';;;
FN:'.$model->user->lastname.' '.$model->user->firstname.'
ORG:'.Yii::t('index','Short time').'
TITLE:'.$model->description->title.'
TEL;TYPE=work,voice;VALUE=uri:tel:'.$model->phone.'
TEL;TYPE=home,voice;VALUE=uri:tel:'.$model->phone_additional.'
ADR;TYPE=work;LABEL="'.$city_name.', '.$model->description->address.'"
:;;'.$model->description->address.';'.$city_name.'
EMAIL:'.$model->user->email.'
END:VCARD';

        $this->widget('application.extensions.qrcode.QRCodeGenerator',array('data' => $body,
                                                                            'subfolderVar' => true,
                                                                            'matrixPointSize' => 1,
                                                                            'filename' => md5(setTranslite($body)).'.png'
                                                                          )); 
     ?>
      <?php endif; ?>
    </span>
    <div class="buttons-request">            
        <?php   echo CHtml::link(CHtml::tag('button', array('class'=>'btn btn-default btn-large'), 
                                 CHtml::tag('i', array('class'=>'fa fa-thumbs-down'), '').' '.ApartmentsModule::t('Complaint')), array('/booking/main/complaintapartment', 'id' => $model->id, 'title'=> setTranslite($model->description->title)), array('class' => 'btnsrch booking-button', 'data-toggle'=>'modal','rel' => 'nofollow', 'data-width' => '310')); 
        ?>
        <?php   echo CHtml::link(CHtml::tag('button', array('class'=>'btn btn-info btn-large'), 
                                 CHtml::tag('i', array('class'=>'fa fa-envelope'), '').' '.ApartmentsModule::t('Request title')), array('/booking/main/bookingform', 'id' => $model->id, 'title'=> setTranslite($model->description->title)), array('class' => 'btnsrch booking-button pull-right', 'data-toggle'=>'modal', 'rel' => 'nofollow', 'data-width' => '310')); 
        ?>    
    </div>
</div>
 <div class="clear"></div>
    <?php  $this->widget('ext.sharebox.EShareBox', array(
                        'url' => Yii::app()->createAbsoluteUrl('/apartments/main/view', array(
                            'id' => $model->id,
                            'city' => setTranslite($city_name),
                            'title' => setTranslite($model->description->title),
                        )),
                        'title'=> $model->description->title,
                        'description' => $city_name.', '.$model->description->address.'. '.$model->description->description,
                        'image' => Yii::app()->request->getBaseUrl(true). (isset($image['thumbUrl']) ? $image['thumbUrl'] : ''),
                        'iconSize' => 24,
                        'include' => array('facebook', 'twitter', 'vk'),
                    ));  
     ?>
    <div class="clear"></div>
</div>
<?php $this->renderPartial('application.modules.apartments.views._avalibility',array(
                    'avalibility'=>$avalibility, 'model' => $model
            ));
?>
<br/>
<div class="well info full-page-ppp-navigation">
    <ul id="overview" class="full-page-ppp-navigation-links">
        <li class="full-page-ppp-navigation-link overview overview-link pull-left">
            <a href="#overview" class="full-page-ppp-section-link overview">
              <span class="fa fa-home fa-2x"></span><br/>
              <?php echo ApartmentsModule::t('Description apartment'); ?>
            </a>
        </li>
        <li class="full-page-ppp-navigation-link overview pull-left room-guide-link">
          <a href="#room_guide" class="full-page-ppp-section-link overview">
            <span class="fa fa-cog fa-2x"></span><br/>
            <?php echo ApartmentsModule::t('Service and conditions'); ?>
          </a>
        </li>
        <li class="full-page-ppp-navigation-link location-link overview  pull-left">
          <a href="#location" class="full-page-ppp-section-link overview">
            <span class="fa fa-globe fa-2x"></span><br/>
            <?php echo ApartmentsModule::t('Map'); ?>
            </a>
        </li>
        <li class="full-page-ppp-navigation-link overview pull-left ">
          <a href="#reviews" class="full-page-ppp-section-link ">
            <span class="fa fa-star fa-2x"></span><br/>
            <?php echo CommentsModule::t('Comments {value}', array('{value}' => $rating['count'])); ?>
          </a>
        </li>
    </ul>
    <div  class="overview">
        <h2 class="view-info"><?php echo $model->description->title; ?></h2>
        <p> <?php echo $model->description->description; ?> </p>
        <?php if($model->description->description_near) { ?>
            <p><h4><?php echo ApartmentsModule::t('What is near?'); ?></h4></p>
            <p> <?php echo $model->description->description_near; ?> </p>  
        <?php } ?>
    </div>
</div>

<div class="well info full-page-ppp-navigation">
    <ul id="room_guide"   class="full-page-ppp-navigation-links">
        <li class="full-page-ppp-navigation-link overview  pull-left">
            <a href="#overview" class="full-page-ppp-section-link overview">
              <span class="fa fa-home fa-2x"></span><br/>
              <?php echo ApartmentsModule::t('Description apartment'); ?>
            </a>
        </li>
        <li class="full-page-ppp-navigation-link overview overview-link pull-left room-guide-link">
          <a href="#room_guide" class="full-page-ppp-section-link overview">
            <span class="fa fa-cog fa-2x"></span><br/>
            <?php echo ApartmentsModule::t('Service and conditions'); ?>
          </a>
        </li>
        <li class="full-page-ppp-navigation-link location-link overview  pull-left">
          <a href="#location" class="full-page-ppp-section-link overview">
            <span class="fa fa-globe fa-2x"></span><br/>
            <?php echo ApartmentsModule::t('Map'); ?>
            </a>
        </li>
        <li class="full-page-ppp-navigation-link overview pull-left ">
          <a href="#reviews" class="full-page-ppp-section-link ">
            <span class="fa fa-star fa-2x"></span><br/>
            <?php echo CommentsModule::t('Comments {value}', array('{value}' => $rating['count'])); ?>
          </a>
        </li>
    </ul>
    <div class="overview">
        <?php if(!empty($references)) { ?>
            <p class="view-info"><?php echo ApartmentsModule::t('Services apartment'); ?></p>
            <p>
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
            </p>
        <?php } ?>
        <?php if($model->services) { ?>
        <div class="about-rules clear">
          <p class="view-info"><?php echo ApartmentsModule::t('Rules title'); ?></p><br/>
          <ul>
            <?php if($model->services->start) { ?>
              <li>
                <div><?php echo ApartmentsModule::t('Time start'); ?>:</div>
                <div><?php echo $model->services->start; ?></div>
              </li> 
            <?php } ?>
            <?php if($model->services->end) { ?>
              <li>
                <div><?php echo ApartmentsModule::t('Time end'); ?>:</div>
                <div><?php echo $model->services->end; ?></div>
              </li>
            <?php } ?>  
            <?php if($model->services->max_berths > 0) { ?>        
              <li>
                <div><?php echo ApartmentsModule::t('Max berts places'); ?>:</div>
                <div><?php echo $model->services->max_berths; ?></div>
              </li>
            <?php } ?> 
            <li>
              <div><?php echo ApartmentsModule::t('Min period rent'); ?>:</div>
              <div>
                <?php echo numberReplacing($model->services->min_days, array(
                Yii::t('common','Night', array('{v}' => $model->services->min_days)), 
                Yii::t('common','Nights', array('{v}' => $model->services->min_days)), 
                Yii::t('common','Nights_', array('{v}' => $model->services->min_days)))); ?>
              </div>
            </li>
            <li>
              <div><?php echo ApartmentsModule::t('Allow childs'); ?>:</div>
              <div><?php echo $model->services->with_child ? ApartmentsModule::t('Allow') : ApartmentsModule::t('Forbidden'); ?></div>
            </li>
            <li>
              <div><?php echo ApartmentsModule::t('Allow animals'); ?>:</div>
              <div><?php echo $model->services->with_animals ? ApartmentsModule::t('Allow') : ApartmentsModule::t('Forbidden'); ?></div>
            </li>
          </ul>
          <ul>
            <li>
              <div><?php echo ApartmentsModule::t('Smoking'); ?>:</div>
              <div><?php echo $model->services->smoking ? ApartmentsModule::t('Allow') : ApartmentsModule::t('Forbidden'); ?></div>
            </li>
            <li>
              <div><?php echo ApartmentsModule::t('Transfer'); ?>:</div>
              <div><?php echo Services::returnTransfer($model->services->transfer); ?></div>
            </li>
            <li>
              <div><?php echo ApartmentsModule::t('Deposit'); ?>:</div>
              <div><?php echo Services::returnDeposit($model->services->deposit); ?></div>
            </li>
            <li>
              <div><?php echo ApartmentsModule::t('Docs'); ?>:</div>
              <div><?php echo Services::returnDeposit($model->services->docs); ?></div>
            </li>
            <li>
              <div><?php echo ApartmentsModule::t('Card'); ?>:</div>
              <div><?php echo Services::returnCard($model->services->card); ?></div>
            </li>
          </ul>
        </div>
        <?php } ?>
        <div class="clear"></div>
    </div>
</div>

<div  class="well info full-page-ppp-navigation">
    <ul id="location"  class="full-page-ppp-navigation-links">
        <li class="full-page-ppp-navigation-link overview  pull-left">
            <a href="#overview" class="full-page-ppp-section-link overview">
              <span class="fa fa-home fa-2x"></span><br/>
              <?php echo ApartmentsModule::t('Description apartment'); ?>
            </a>
        </li>
        <li class="full-page-ppp-navigation-link overview  pull-left room-guide-link">
          <a href="#room_guide" class="full-page-ppp-section-link overview">
            <span class="fa fa-cog fa-2x"></span><br/>
            <?php echo ApartmentsModule::t('Service and conditions'); ?>
          </a>
        </li>
        <li class="full-page-ppp-navigation-link location-link overview  overview-link pull-left">
          <a href="#location" class="full-page-ppp-section-link overview">
            <span class="fa fa-globe fa-2x"></span><br/>
            <?php echo ApartmentsModule::t('Map'); ?>
            </a>
        </li>
        <li class="full-page-ppp-navigation-link overview pull-left ">
          <a href="#reviews" class="full-page-ppp-section-link ">
            <span class="fa fa-star fa-2x"></span><br/>
            <?php echo CommentsModule::t('Comments {value}', array('{value}' => $rating['count'])); ?>
          </a>
        </li>
    </ul>
    <div class="overview location">
      
              <?php //if(Yii::app()->user->getState('isAdmin')) { ?>
                <!--div class="relatedApartments objects" id="related-apartments"></div>
                <div class="clear"></div-->
                <?php //} else {  ?>
                  <?php 
            if(($model->lat && $model->lng) || Yii::app()->user->getState('isAdmin')){
              if(param('useGoogleMap') == 1){ ?>
                  <div>
                    <div id="gmap">
                        <?php Yii::app()->gmap->actionGmap($model->id, $model, $this->renderPartial('backend/_marker', array('model' => $model), true)); ?>
                    </div>
                  </div>
              <?php } if(param('useYandexMap') == 1){ ?>
                      <div>
                        <div id="ymap">
                          <?php Yii::app()->ymap->actionYmap($model->id, $model, $this->renderPartial('backend/_marker', array('model' => $model), true)); ?>
                        </div>
                      </div>
              <?php } } ?>
                <?php //} ?>
    </div>
</div>
<div class="well info full-page-ppp-navigation">
    <ul id="reviews"  class="full-page-ppp-navigation-links">
        <li class="full-page-ppp-navigation-link overview  pull-left">
            <a href="#overview" class="full-page-ppp-section-link overview">
              <span class="fa fa-home fa-2x"></span><br/>
              <?php echo ApartmentsModule::t('Description apartment'); ?>
            </a>
        </li>
        <li class="full-page-ppp-navigation-link overview  pull-left room-guide-link">
          <a href="#room_guide" class="full-page-ppp-section-link overview">
            <span class="fa fa-cog fa-2x"></span><br/>
            <?php echo ApartmentsModule::t('Service and conditions'); ?>
          </a>
        </li>
        <li class="full-page-ppp-navigation-link location-link overview  pull-left">
          <a href="#location" class="full-page-ppp-section-link overview">
            <span class="fa fa-globe fa-2x"></span><br/>
            <?php echo ApartmentsModule::t('Map'); ?>
            </a>
        </li>
        <li class="full-page-ppp-navigation-link overview pull-left overview-link">
          <a href="#reviews" class="full-page-ppp-section-link overview">
            <span class="fa fa-star fa-2x"></span><br/>
            <?php echo CommentsModule::t('Comments {value}', array('{value}' => $rating['count'])); ?>
          </a>
        </li>
    </ul>
    <div class="overview review">
        <div id="list-comments" class="review-list">  
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
        <div class="review-common-rating">
            <div class="reviews-sidebar">
                <p class="view-info"><?php echo CommentsModule::t('Comments {value}', array('{value}' => $rating['count'])); ?></p>
                <ul>
                    <?php foreach(array('photos', 'clarity', 'service', 'location', 'price') as $value) { ?>
                        <li>
                            <span class="rating-label"><?php echo ApartmentsModule::t('rating_'.$value);  ?></span>
                            <div class="rate-middle">
                                <span style="width:<?php echo (isset($rating['main']['rating_'.$value]) ? Apartment::convertRating($rating['main']['rating_'.$value]/$rating['count']) : 0).'%'; ?>">
                                </span>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="clear"></div>
            <div class="add-button">
                 <?php   echo CHtml::link(CHtml::tag('button', array('class'=>'btn btn-info btn-large'), 
                                 CHtml::tag('i', array('class'=>'fa fa-comments'), '').' '.CommentsModule::t('Leave a Comment')), array('#'), array('rel' => 'nofollow')); 
                ?>  
            </div>
        </div>
        <div class="clear"></div>
</div>
</div>
<?php  Yii::app()->getClientScript()->registerScript(
            'add-comment',
            ' $(".add-button a").click(function() {
                if($("#Comment-form").length == 0){
                    $.ajax({
                        type: "post",
                        url: "'.Yii::app()->createUrl('comments/main/add', array('id' => $model->id)).'",
                        data: "apartment_id='.$model->id.'",
                        beforeSend: function(){ 
                           reloadApartment.resultBlock = "list-comments"; 
                           reloadApartment.loading();
                        },
                        success: function(html) {
                            $("#view-comments").before(html);
                        },
                        complete: function() {
                           $("#update_div, #update_img").remove();
                           $("#view-comments").hide();
                        }
                    })
                } else 
                    $("#Comment-form").show();
                 return false;
             });
            reloadApartment.modal();
             ',
             CClientScript::POS_END);

  /*if(Yii::app()->user->getState('isAdmin')) {
        Yii::app()->getClientScript()->registerScript(
            'related',
            '$(".references-list a").tooltip();
             function relatedOffers(distance) { 
               if(distance)
                distance = "&distance="+distance;
               $.ajax({
                   type: "post",
                   url: "'.Yii::app()->createUrl('relatedoffers/main').'",
                   data: "apartment_id='.$model->id.'&city_id='.$model->city_id.'"+distance,
                   beforeSend: function() {
                    reloadApartment.resultBlock = "related-apartments .row-fluid";
                    reloadApartment.loading();
                   },
                   success: function(html) {
                      if(html != ""){
                          $("div#related-apartments").html("<h3>'.ApartmentsModule::t('Related offers').'</h3>"+html).fadeIn("slow");
                      }
                   },
                   error: function() {
                      $("div.relatedApartments").remove()
                   },
                   complete: function() {
                      $("#update_div, #update_img").remove();
                      //$("div#related-apartments ul.related-objects li:first").trigger("click");
                   }
               })
              }
              relatedOffers();
        ',
        CClientScript::POS_END);
    }*/
?>
