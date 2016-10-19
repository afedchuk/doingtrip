<section class="main">
	<h1 class="main-title">4trip.com.ua</h1>
	<p class="main-text">
		<?php echo ApartmentsModule::t('Tip index title'); ?>
	    <?php $count_props = Apartment::getAllCountActive(). ' '.numberReplacing(Apartment::getAllCountActive(), array(ApartmentsModule::t('proposition single'), ApartmentsModule::t('proposition few'), ApartmentsModule::t('propositions'))); ?>
	    <?php $count_cities = City::getAllCount(). ' '.numberReplacing(City::getAllCount(), array(RegionsModule::t('city'), RegionsModule::t('cities'), RegionsModule::t('cities'))); ?>
		<?php echo ucfirst(Yii::t('index', 'Found propositions on site', array('{count}' =>  CHtml::link($count_props, Yii::app()->createAbsoluteUrl('/apartments')), '{cities}' => CHtml::link($count_cities, Yii::app()->createAbsoluteUrl('/sitemap'))))); ?>
	  
	</p>
		<?php $form=$this->beginWidget('CActiveForm', array(
                'enableAjaxValidation'=>false,
                'enableClientValidation'=>false,
                'clientOptions' => array(
                    'validateOnSubmit' => false,
                    'validateOnChange' => true,
                ),
                'htmlOptions' => array('class' => 'search-form', 'action' => '/')

             )); ?>
		<div class="container">
	        <div class="tabs">
	            <a class="tab-but tab-but-1 tab-active" href="#"><?php echo Yii::t('index', 'cities'); ?></a>
	            <a class="tab-but tab-but-2" href="#"><?php echo Yii::t('index', 'apartment'); ?></a>     
	        </div>
	        <div class="clearfix"></div>
	        <div class="tab-content tab-content-1">
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
		            		$("form.search-form input[name=city]").val(result[0]);
		            		$("form.search-form").attr("action", "'.Yii::app()->createAbsoluteUrl('main/search').'").submit();
					      	return result[1].replace(/<\/?[^>]+(>|$)/g, " ");
					    }',
		                'highlighter'=>'js:function(item) {
					      result = item.split("|")
					      return result[1];
					    }',
		            ),
		            'htmlOptions'=>array('class' => 'search__input','autocomplete' =>'off', 'placeholder'=>Yii::t('index', 'Holder search')), 
		        )); ?> 
	        </div>
	        <div class="tab-content tab-content-2" >
	            <?php $this->widget('bootstrap.widgets.TbTypeahead', array(
		            'name' => 'apartment_id',
		            'options'=>array(
		                'name'=>'typeahead',
		                'source'=>'js:function(query, process) {
					      $.ajax({url: "'.Yii::app()->createUrl('main/apartmentsSearch').'", data: {query: query}, dataType: "json" })
					      .done(function(data) {
					        return process(data);
					     })}',
		            	'updater'=>'js:function(item) {
		            	  result = item.split("|")
					      $("form.search-form input[name=apartment_id]").val(result[0]);
		            	  $("form.search-form").attr("action", "'.Yii::app()->createAbsoluteUrl('main/apartmentsSearch').'").submit();
					      return result[1].replace(/<\/?[^>]+(>|$)/g, " ");
					    }',
		                'highlighter'=>'js:function(item) {
		                  result = item.split("|")
					      return result[1];
					    }',
		            ),
		            'htmlOptions'=>array('class' => 'search__input','autocomplete' =>'off', 'placeholder'=>Yii::t('index', 'Holder search apartments')), 
		        )); ?> 
	        </div>  
	    </div>
	<?php $this->endWidget(); ?>
	<div class="footer-social">
	    <ul class="clearfix"><li>
	        <a target="_blank" rel="nofollow" href="https://www.facebook.com/house4trip" class="facebook"></a>
	        </li><li>
	        <a target="_blank" rel="nofollow" href="https://vk.com/house4trip" class="vk"></a>
	        </li><li>
	        <a target="_blank" rel="nofollow" href="https://plus.google.com/u/0/105002978878105654625/posts" class="gplus"></a>
	        </li><li>
	        <a target="_blank" rel="nofollow" href="https://twitter.com/house4trip" class="twitter"></a>
	        </li>
	    </ul>
	</div>
</section>
