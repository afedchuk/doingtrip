<div id="sendRequest" class="hidden gb8">
    <div class="c12">
    <fieldset class="request-form">
        <legend><?php echo ApartmentsModule::t('Request title'); ?></legend>
        <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'request-form',
                        'action' => Yii::app()->createAbsoluteUrl('apartments/view'),
                        'enableAjaxValidation'=>true,
                )); ?>
        <div class="gb6 fi li">
            <p class="tip"><?php echo ApartmentsModule::t('Tip request'); ?></p>
        </div>
        <div class="clear"></div><br/>

        <div class="gb3 fi">
        <?php echo $form->labelEx($request,'user'); ?>
        <?php echo $form->textField($request,'user'); ?>
            <div class="error">
                <?php echo $form->error($request,'user'); ?>
            </div>
        </div>

        <div class="clear"></div>
        <div class="gb3 fi">
            <?php echo $form->labelEx($request,'date_from'); ?>
            <?php echo $form->textField($request,'date_from', array('class'=>'dateinput')); ?>
            <div class="error">
                <?php echo $form->error($request,'date_from'); ?>
            </div>
        </div>


        <div class="gb3 li">
            <?php echo $form->labelEx($request,'date_to'); ?>
            <?php echo $form->textField($request,'date_to', array('class'=>'dateinput')); ?>
            <div class="error">
                <?php echo $form->error($request,'date_to'); ?>
            </div>
        </div>
        <div class="clear"></div>
        <div class="gb3 fi">
            <?php echo $form->labelEx($request,'email'); ?>
            <?php echo $form->textField($request,'email'); ?>
            <div class="error">
                <?php echo $form->error($request,'email'); ?>
            </div>
        </div>

        <div class="gb3 li">
            <?php echo $form->labelEx($request,'phone'); ?>
            <?php echo $form->textField($request,'phone', array('class'=>'phone')); ?>
            <div class="error">
                <?php echo $form->error($request,'phone'); ?>
            </div>
        </div>
        <div class="clear"></div><br/><br/>
        <div class="gb6 fi">
            <?php echo $form->labelEx($request,'message'); ?>
            <?php echo $form->textArea($request,'message'); ?>
            <div class="error">
                <?php echo $form->error($request,'message'); ?>
            </div>
        </div>
        <div class="clear"></div>
        <div class="gb6 fi">
            <button class="yt-uix-button yt-uix-button-default" onclick="$('form#request-form').submit();">
                <span class="yt-uix-button-content"><?php echo ApartmentsModule::t('Send'); ?></span>
            </button>
        </div>

        <?php $this->endWidget(); ?>
    </fieldset>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        $(".dateinput").datepicker();
    });

</script>