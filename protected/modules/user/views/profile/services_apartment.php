<?php 
$this->pageTitle=Yii::app()->name . ' - '.UserModule::t('Edit profile');
$this->breadcrumbs=array(
        UserModule::t("Profile")=>array('profile'),
        UserModule::t('Services apartment'),
);
?>

<div class="row-fluid profile-wrapper">
    <div class="span9">
        <div class="well">
            <div class="profile-edit">
                <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'service-form',
                        'enableAjaxValidation'=>true,
                        'htmlOptions' => array('enctype'=>'multipart/form-data', 'class' => 'form-horizontal'),
                )); ?>
                            <div class="control-group">
                                <label class="control-label tip"><br/><br/>
                                    <?php echo ApartmentsModule::t('Free dates tip'); ?><br/><br/>
                                    <?php echo ApartmentsModule::t('Free dates google tip'); ?>
                                </label>
                                <div class="controls">
                                <?php echo $form->labelEx($additional,'ics_calendar'); ?>
                                <?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
                                        'name'=>'booking-dates',
                                        'flat'=>true,
                                        'themeUrl' => Yii::app()->baseUrl . '/css',
                                        'theme' => 'default',
                                        'cssFile' => 'forms.css',
                                        'options'=>array(
                                            'title'=>'xx',
                                            'showAnim'=>'slide',
                                            'dateFormat' => 'yy-mm-dd',
                                            'minDate' => date("Y-m-d"),
                                            'maxDate' => date("Y-m-d", strtotime(date("Y-m-d")." +90 day")),
                                            'beforeShowDay' => 'js:function(date){
                                                var disabledDays = '.$avalibility.'; 
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
                                                CHtml::ajax(array('type'=>'POST','datatype'=>'html','url'=>Yii::app()->createAbsoluteUrl('/user/profile/freedates', array('id' => $model->id)),
                                                        'data'=>array('date'=>'js: dateText', 'type' =>'js:operation')
                                                        )
                                                ).
                                            '}'
                                        ),
                                        'htmlOptions' => array()
                                        
                                    ));

                                ?> 
                                <div class="calendar-info">
                                <span><i class="fa fa-square"></i> - <?php echo ApartmentsModule::t('Not available dates label'); ?></span>
                                <span><i class="fa fa-square-o"></i> - <?php echo ApartmentsModule::t('Free dates label'); ?></span>
                            </div>
                            <?php echo $form->radioButton($additional,'type_ics',array('onClick'=>'showConfiguration(this);', 'value' => 0)). CHtml::tag('label', array('class'=>'list'), ApartmentsModule::t('Calendar file type')); ?>
                            <div class="clear"></div>
                            <div id="block-0" class="configurelist<?php if(!$additional->ics_calendar) {?> hide<?php } ?>">
                                <div class="tip">
                                    <?php echo ApartmentsModule::t('Tip local or remote calendar')?>
                                </div>
                                <?php echo $form->textField($additional,'ics_calendar',array('class'=>'span11', 'placeholder' => ApartmentsModule::t('Calendar file'))); ?>
                                <?php echo $form->error($additional,'ics_calendar'); ?>
                            </div>   
                            <?php echo $form->radioButton($additional,'type_ics',array('value' => 2, 'onClick'=>'showConfiguration(this);', 'uncheckValue'=>null)). CHtml::tag('label', array('class'=>'list'), ApartmentsModule::t('Calendar google type')); ?>
                            <div class="clear"></div>
                            <div id="block-2" class="configurelist<?php if(!$additional->google_calendar) {?> hide<?php } ?>">
                                <?php echo $form->textField($additional,'google_calendar',array('class'=>'span11', 'placeholder' => ApartmentsModule::t('Google calendar ID'))); ?>
                                <?php echo $form->error($additional,'google_calendar'); ?>
                                <div class="tip">
                                    <?php echo UserModule::t('Tip google calendar')?>
                                    <a href="<?php echo Yii::app()->createAbsoluteUrl('faq').'#qw-21'; ?>"><?php echo UserModule::t('Tip google calendar ID')?></a>
                                </div>
                            </div>
                            <?php echo $form->radioButton($additional,'type_ics',array( 'value' => 1, 'onClick'=>'showConfiguration(this);', 'uncheckValue'=>null)). CHtml::tag('label', array('class'=>'list'), ApartmentsModule::t('Calendar remote type')); ?>
                            <div class="clear"></div>
                            <div id="block-1" class="configurelist hide">
                                <div class="tip">
                                    <?php echo ApartmentsModule::t('Tip local calendar')?>
                                </div>
                                <?php echo $form->hiddenField($additional,'upload_ics'); ?>
                                <?php $this->widget('ext.EAjaxUpload.EAjaxUpload',
                                array(
                                    'id'=>'upload_ics',
                                    'config'=>array(
                                        'action' => Yii::app()->createAbsoluteUrl('/user/profile/servicesApartment', array('id' => $model->id)),
                                        'allowedExtensions'=> param('allowedImgExtensions', array('ics')),
                                        'sizeLimit' => Images::getMaxSizeLimit(),
                                        'multiple' => false,
                                        'onComplete'=>"js:function(id, fileName, responseJSON){
                                            $('#ApartmentAdditional_upload_ics').val(responseJSON.filename);
                                        }",
                                        'messages'=>array(
                                            'typeError'=>ImagesModule::t("{file} has invalid extension. Only {extensions} are allowed."),
                                            'sizeError'=>ImagesModule::t("{file} is too large, maximum file size is {sizeLimit}."),
                                            'minSizeError'=>ImagesModule::t("{file} is too small, minimum file size is {minSizeLimit}."),
                                            'emptyError'=>ImagesModule::t("{file} is empty, please select files again without it."),
                                            'onLeave'=>ImagesModule::t("The files are being uploaded, if you leave now the upload will be cancelled."),
                                        ),
                                    )
                                )); ?>
                                <?php echo $form->error($additional,'upload_ics'); ?>
                            </div>
                        </div>
                    </div>
                    <!--div class="control-group">
                        <?php echo $form->labelEx($model,'flickr_gallery', array('class'=>'control-label')); ?>
                        <div class="controls">
                            <?php echo $form->textField($model,'flickr_gallery',array('class'=>'span11', 'placeholder' => ApartmentsModule::t('Flickr gallery ID'))); ?>
                            <?php echo $form->error($model,'flickr_gallery'); ?>
                            <div class="tip">
                                <?php echo UserModule::t('Tip flickr gallery')?>
                                <a href="<?php echo Yii::app()->createAbsoluteUrl('faq').'#qw-22'; ?>"><?php echo UserModule::t('Tip flickr gallery ID')?></a>
                            </div>
                        </div>
                    </div-->
                    <div class="control-group">
                        <div class="controls">
                            <?php $this->widget('bootstrap.widgets.TbButton', array(
                                'type'=>'info',
                                'size' => 'large',
                                'buttonType' => 'submit',
                                'encodeLabel' => false,
                                'label'=> '<i class="fa  fa-floppy-o"></i> '.Yii::t('index', 'Save'),
                                'htmlOptions'=>array('onclick' => "$('form#service-form').submit();"),
                            )); ?>&nbsp;&nbsp;&nbsp;
                             <?php $this->widget('bootstrap.widgets.TbButton', array(
                                'type'=>'default',
                                'size' => 'large',
                                'encodeLabel' => false,
                                'buttonType' => 'link',
                                'label'=>  '<i class="fa fa-sign-out"></i> '.Yii::t('common', 'Cancel'),
                                'url' => Yii::app()->createAbsoluteUrl('/user/profile')
                            )); ?>
                        </div>
                    </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
<?php echo $this->renderPartial('profile/menu'); ?> 
</div>
<script type="text/javascript">
    $('input[name="ApartmentAdditional[type_ics]"]:checked').trigger('click');
    function showConfiguration(item) {
        var val = $(item).val();
        if(val.length > 0) {
            $('.configurelist').addClass('hide');
            $('#block-'+val).removeClass('hide');
        }  
    }
</script>





