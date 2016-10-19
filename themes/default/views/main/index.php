<script type="text/javascript">
	var cur = -1, prv = -1;
	$(document).click(function(e) { 
		var target = $(e.target);
		if(!target.hasClass('icon-calendar')) {
			if (!target.parents('.range-datapicker').length) {
			   //$('.hasDatepicker').css('display', 'none');
			}
		}
	});
    <?php $city_name = City::getCityName($item->city_id);
        $image = Images::getMainThumb(210, 200, $item->images);
        //var_dump($image['link']);
    ?>
    //$('body').css({'background': 'url("<?php echo $image['link'] ?>") no-repeat fixed 0 0 / cover '});
</script>

<div class="main hero-unit">
	<div class="hero-strapline">
		<h1 class="hero-strapline-title"><?php echo Yii::t('index','Book a whole home'); ?></h1>
        <?php $count_props = Apartment::getAllCountActive(). ' '.numberReplacing(Apartment::getAllCountActive(), array(ApartmentsModule::t('proposition single'), ApartmentsModule::t('proposition few'), ApartmentsModule::t('propositions'))); ?>
        <?php $count_cities = City::getAllCount(). ' '.numberReplacing(City::getAllCount(), array(RegionsModule::t('city'), RegionsModule::t('cities'), RegionsModule::t('cities'))); ?>
		<h2 class="hero-strapline-subtitle"><?php echo Yii::t('index', 'Found propositions on site', array('{count}' =>  $count_props, '{cities}' => $count_cities)); ?></h2>
	</div>
	<form class="form-search form-horizontal text-center" method="post" action="<?php echo Yii::app()->createUrl('main/search') ?>">
	  <div class="hero-search input-append">
	  	<?php $this->widget('bootstrap.widgets.TbTypeahead', array(
            'name' => 'city',
            'model' => $city,
            'attribute'=>'id',
            'options'=>array(
                'name'=>'typeahead',
                'source'=>'js:function(query, process) {
			      $.ajax({url: "'.Yii::app()->createUrl('main/search').'", data: {query: query}, dataType: "json" })
			      .done(function(data) {
			        return process(data);
			     })}',
            	'updater'=>'js:function(item) {
                    result = item.split("|")
                    $("input[name=city_id]").val(result[0]);
			        return result[1];
			    }',
                'highlighter'=>'js:function(item) {
                    result = item.split("|")
			        return result[1];
			    }',
            ),
            'htmlOptions'=>array('class'=>'search-input', 'autocomplete' =>'off', 'type' => 'seacrh', 'placeholder'=>Yii::t('index', 'Holder search')), 
        )); ?> 
        <div class="search-calendar">
        	<!--div class="ht-separator"></div>
        	<span class="icon-calendar" onclick="$('.hasDatepicker').toggle();"></span-->
        	<input type="text" class="range-dates" name="dates"  onclick="$('.hasDatepicker').toggle();"/>
            <div class="icon-calendar hero-date" onclick="$('.hasDatepicker').toggle();"></div>
        	<?php 
            $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                'name'=>'datepicker-Inline',
                'flat'=>true,
                'themeUrl' => Yii::app()->baseUrl . '/css',
                'theme' => 'default',
                'options'=>array(
                    'showAnim'=>'slide',
                    'dateFormat' => 'yy-mm-dd',
                    'minDate' => date("Y-m-d"),
                    'maxDate' => date("Y-m-d", strtotime(date("Y-m-d")." +60 day")),
                    'onSelect'=> "js:function ( dateText, inst ) {
	                  var d1, d2;
	                  prv = cur;
	                  cur = (new Date(inst.selectedYear, inst.selectedMonth, inst.selectedDay)).getTime();
	                  if ( prv == -1 || prv == cur ) {
	                     prv = cur;
	                     $('input.range-dates').val( dateText );
                  	   } else {
	                     d1 = $.datepicker.formatDate( 'mm/dd/yy', new Date(Math.min(prv,cur)), {} );
	                     d2 = $.datepicker.formatDate( 'mm/dd/yy', new Date(Math.max(prv,cur)), {} );
	                     $('input.range-dates').val( d1+' - '+d2 );
                         $('.icon-calendar').trigger('click');
	                  }
	                }",
                    'beforeShowDay' => "js:function ( date ) {
                  		return [true, ( (date.getTime() >= Math.min(prv, cur) && date.getTime() <= Math.max(prv, cur)) ? 'ui-state-active' : '')];
                  	}"
                ),
                'htmlOptions' => array('class' => 'range-datapicker')
                
            ));
        ?>
        <input type="hidden" name="city_id"/>
        <button type="submit" class="btn btn-info">
            <i class="icon-search icon-white icon-large"></i> 
        </button>
        </div>
	  </div> 
	</form>
    <div class="owners-login">
        <p><?php echo Yii::t('common','Enter index', array('{link}' => Chtml::link(Yii::t('common','login form'), Yii::app()->createUrl('user/main/login')))); ?></p>
        <div class="login-container">
            <div class="socials-login-wrap">
                <a class="socials-button socials-button_vk" href="<?php echo Yii::app()->createUrl('user/main/login', array('service' => 'vkontakte')); ?>">
                    <span class="socials-button__icon"><i class=" fa fa-vk"></i></span>
                    <span class="socials-button__text">Вконтакте</span>
                </a>
                <a class="socials-button socials-button_fb" href="<?php echo Yii::app()->createUrl('user/main/login', array('service' => 'facebook')); ?>">
                    <span class="socials-button__icon"><i class="fa fa-facebook"></i></span>
                    <span class="socials-button__text">Facebook</span>
                </a>
            </div>
            <p class="login__notice"><?php echo Yii::t('common', 'Tip login index'); ?></p>
        </div>
    </div>
</div>
