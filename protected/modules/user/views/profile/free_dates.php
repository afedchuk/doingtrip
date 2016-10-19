<?php 
$this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'modal-booking')); ?>
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>$this->modelName.'-form',
            'enableAjaxValidation'=>true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
            'htmlOptions' => array('class' => 'form-horizontal')

    )); ?>
        <div class="modal-header">
            <a class="close" data-dismiss="modal">&times;</a>
            <h2><?php echo ApartmentsModule::t('Calendar'); ?></h2>      
        </div>
      
        <div class="modal-body apartment-free-dates">
            <p class="tip">
                <?php echo ApartmentsModule::t('Free dates tip'); ?>
            </p>
            <p>
            <?php 
                    $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                        'name'=>'datepicker-Inline',
                        'flat'=>true,
                        'themeUrl' => Yii::app()->baseUrl . '/css',
                        'theme' => 'default',
                        'cssFile' => 'forms.css',
                        'options'=>array(
                            'showAnim'=>'slide',
                            'dateFormat' => 'yy-mm-dd',
                            'minDate' => date("Y-m-d"),
                            'maxDate' => date("Y-m-d", strtotime(date("Y-m-d")." +60 day")),
                            'beforeShowDay' => 'js:function(date){
                                var disabledDays = '.$model.'; 
                                var m = date.getMonth(), d = date.getDate(), y = date.getFullYear();
                                for (i = 0; i < disabledDays.length; i++) {
                                    if($.inArray(y + "-" + (m+1) + "-"+ d,disabledDays) != -1) {
                                        return [true, "ui-state-active", ""];
                                    }
                                }
                                return [true];
                            }',
                            'onSelect' => 'js: function(dateText, inst) {
                                inst.inline = false; operation = 0;
                                $(".ui-datepicker-calendar TBODY A").each(function(){
                                  if ($(this).text() == inst.selectedDay) {
                                    if($(this).parent().hasClass("ui-state-active") && !(operation = 0)) {
                                        $(this).parent().removeClass("ui-state-active");
                                    } else {
                                        operation = 1;
                                        $(this).parent().addClass("ui-state-active");
                                    }
                                  }
                                }); 
                                '.
                                CHtml::ajax(array('type'=>'POST','datatype'=>'html','url'=>array('module'=>'user', 'controller'=>'profile', 'action'=>'freedates'), // ur controller action
                                        'data'=>array('date'=>'js: dateText', 'type' =>'js:operation')
                                        )
                                ).
                            '}'
                        ),
                        'htmlOptions' => array()
                        
                    ));

            ?></p>

            <h5>
                <?php //echo ApartmentsModule::t('Free dates google tip'); ?>
            </h5>
            <!--img src="/images/calendar-icon.png"/--><?php //echo $form->textField($model,'date',array('class' => 'span2','maxlength'=>255)); ?>
        </div>
        <div class="modal-footer">
        </div>
    <?php $this->endWidget(); ?>
<?php $this->endWidget(); ?>