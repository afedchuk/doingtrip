<div id="filters-list" class="filters-list grey-shadow-big">
    <div id="filters-content" class="filters-content row active">
            <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'Search-form',
                    'enableAjaxValidation'=>false,
                    'clientOptions' => array(
                        'validateOnSubmit' => false,
                    ),
                    'htmlOptions' => array('class' => 'filter-block span4 form-horizontal')

            )); ?>
            <div class="pull-right">
                <i class="icon-remove" onclick="$('.filters-wrap').removeClass('active');" style="opacity:0.7; cursor:pointer;"></i>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputType"><?php echo ApartmentsModule::t('Filter date'); ?></label>
                <span onclick="$('.hasDatepicker').toggle();" class="icon-calendar"></span>
                <div class="controls">
                    <?php echo $this->renderPartial('_search_apartments/_search_field_term', array(), true ); ?>
                </div>
            </div>
            <!--div class="control-group">
                <label class="control-label" for="inputType"><?php echo ApartmentsModule::t('Filter type'); ?></label>
                    <?php echo $this->renderPartial('_search_apartments/_search_field_obj_type', array(), true ); ?>
            </div-->
            <div class="control-group">
                <label class="control-label" for="inputType"><?php echo ApartmentsModule::t('Filter price apartment'); ?></label>
                <div class="controls">
                    <?php echo $this->renderPartial('_search_apartments/_search_field_price', array(), true ); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputType"><?php echo ApartmentsModule::t('Filter rooms'); ?></label>
                <div class="controls">
                    <?php echo $this->renderPartial('_search_apartments/_search_field_rooms', array(), true ); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputType"><?php echo ApartmentsModule::t('Filter square'); ?></label>
                <div class="controls">
                    <?php echo $this->renderPartial('_search_apartments/_search_field_square', array(), true ); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputType"><?php echo ApartmentsModule::t('Floor'); ?></label>
                <div class="controls">
                    <?php echo $this->renderPartial('_search_apartments/_search_field_floor', array(), true ); ?>
                </div>
            </div>
        <?php $this->endWidget(); ?>
    </div>
    <div class="reset-bottom">
        <a href="#"><i class="icon-refresh"></i> <?php echo ApartmentsModule::t('Reset filter'); ?></a>
    </div>
</div>
<?php 
Yii::app()->getClientScript()->registerScript('search',
'var sliderRangeFields = '.CJavaScript::encode(SearchForm::getSliderRangeFields()).';
 var search = {
    init: function(){
        if(sliderRangeFields){
            $.each(sliderRangeFields, function() {
                search.initSliderRange(this.params);
            });
        }
    },
    initSliderRange: function(sliderParams){
        $( "#slider-range-"+sliderParams.field ).slider({
            range: true,
            min: sliderParams.min,
            max: sliderParams.max,
            values: [ sliderParams.min_sel , sliderParams.max_sel ],
            step: sliderParams.step,
            slide: function( e, ui ) {
                $( "#"+sliderParams.field+"_min_val" ).html( ui.values[ 0 ] );
                $( "#property_search_"+sliderParams.field+"_min" ).val( ui.values[ 0 ] );
                $( "#"+sliderParams.field+"_max_val" ).html( ui.values[ 1 ] );
                $( "#property_search_"+sliderParams.field+"_max" ).val( ui.values[ 1 ] );
            },
            stop: function(e, ui) { 
                search.changeSearch();
            }
        });
    },
    changeSearch: function() {
        reloadApartment.reload(this, "'.Yii::app()->createUrl("apartments", isset($_GET['city']) ? array('city' => $_GET['city']) : array()).'",  $(".filter-block input").serializeArray()); 
    }
}
search.init();
',
CClientScript::POS_END); ?>
