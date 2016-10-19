<div id="update-block">
    <div id="check-avalibility" class="well info booking-bar">
        <?php $form = $this->beginWidget('CActiveForm', array(
             'id'=>'check-avalibility',
             'method' => 'POST',
             'htmlOptions' => array('class'=>'')
         )); ?>
            <div class="container">
                <?php  $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                     'model'=>$avalibility,
                     'attribute'=>'check_in',
                     'themeUrl' => Yii::app()->baseUrl . '/css',
                     'language' => Yii::app()->language,
                     'htmlOptions' => array( 'placeholder' => BookingModule::t('Check-in date')),
                     'options'=>array(
                         'dateFormat'=>'yy-mm-dd',
                         'minDate'=>'new Date()',
                     ),
                 )); ?>
             </div>
             <div class="container">
                 <?php  $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                     'model'=>$avalibility,
                     'attribute'=>'check_out',
                     'themeUrl' => Yii::app()->baseUrl . '/css',
                     'language' => Yii::app()->language,
                     'htmlOptions' => array( 'placeholder' => BookingModule::t('Check-out date')),
                     'options'=>array(
                         'dateFormat'=>'yy-mm-dd',
                         'minDate'=>'new Date()',
                     ),
                 )); ?>
             </div>
            <?php echo $form->hiddenField($model,'id'); ?>
            <div class="order-info-row dbv_apt_price_total_text">
                <div><span class="dbv_rent_nights"></span></div>
            </div>


                <div class="pull-right">
                    <span class="dbv_price dbv_apt_price_current price">
                        <?php echo CurrencymanagerModule::convertcurrency($model->price);?>
                    </span>
                    <?php echo CHtml::ajaxSubmitButton(
                                ApartmentsModule::t('Check availability'),
                                array('/apartments/main/avalibility/'),
                                    array(  
                                        'beforeSend' => 'function(){ 
                                            $(".avalibility-message").remove();
                                            reloadApartment.resultBlock = "update-block"; 
                                            reloadApartment.loading(); 
                                        }',
                                        'complete'=>'js:function(){
                                             $("#update_div, #update_img").remove();
                                        }',
                                        'success'=>'function(data){  
                                            var obj = $.parseJSON(data); 
                                            if(obj.status == "fail"){
                                                $("#check-avalibility").after("<div class=\"avalibility-message alert alert-error\">"+obj.message+"</div>");
                                             } else {
                                                $("span.dbv_rent_nights").html(obj.details.nights)
                                                $("span.dbv_price").html(obj.details.total)
                                                $("div.order-info").show();
                                                $("#check-avalibility").after("<div class=\"avalibility-message alert alert-info\">"+obj.message+"</div>");
                                             }
                                         }'),
                                array("class" => "btn btn-warning btn-large")      
                    ); ?>

                </div> 

       <?php $this->endWidget(); ?>
    </div>
</div>