<?php
$this->pageTitle = ArticlesModule::t('Faq') .' - '. $this->pageTitle;
$this->breadcrumbs=array(
    ArticlesModule::t('Faq'),
);
?>
<div class="mrgT15 relative">
    <div id="right">
        <div class="well">
            <div class="header-title">
                     <h2><?php echo ArticlesModule::t('Faq'); ?></h2>
            </div>
            <div class="faq-list">
                <?php if ($articles) { ?>  
                    <ol>
                        <?php $i=0; foreach ($articles as $article) { ?>
                            <li class="faq-item">
                                <span class="faq-qv"><a href="#qw-<?php echo $article['id']; ?>"><?php echo $article['page_title']; ?></a></span>
                                <div <?php if($i>0) {?>style="display:none;"?<?php } ?>  class="faq-an" id="qw-<?php echo $article['id']; ?>">
                                    <p>
                                        <?php echo $article['page_body']; ?>
                                    </p>
                                </div>
                            </li>
                    <?php $i++; } ?>
                    </ol>
                <?php } else { ?>
                            <p><?php echo ArticlesModule::t('Faq list is empty' ); ?></p>
                <?php } ?>
            </div>
            		
		</div>
	</div>
    <?php echo $this->renderPartial('user.views.user.menu');?>
</div>
<!--div class=" span3 faqForm " >
                        <h1><?php echo ArticlesModule::t('Create question'); ?></h1>
			<?php $form=$this->beginWidget('CActiveForm', array(
                                'id'=>'faq-form',
                                'enableClientValidation'=>false,
                        ));
                        ?>
		    	
                        <?php echo $form->labelEx($model,'username'); ?>
                        <?php echo $form->textField($model,'username') ?>
                        <div class="error">
                            <?php echo $form->error($model,'username'); ?>
                        </div>

                        <?php echo $form->labelEx($model,'phone'); ?>
                        <?php echo $form->textField($model,'phone', array('class'=>'phone')) ?>
                        <div class="error">
                            <?php echo $form->error($model,'phone'); ?>
                        </div>

                        <?php echo $form->labelEx($model,'email'); ?>
                        <?php echo $form->textField($model,'email') ?>
                        <div class="error">
                            <?php echo $form->error($model,'email'); ?>
                        </div>

                        <?php echo $form->labelEx($model,'page_title'); ?>
                        <?php echo $form->textArea($model,'page_title', array('style'=>'width:88%;')) ?>
                        <div class="error">
                            <?php echo $form->error($model,'page_title'); ?>
                        </div>
                        <div class="gb">
                                <?php echo $form->labelEx($model,'verifyCode'); ?>
                                <?php echo $form->textField($model,'verifyCode', array('id'=>'captcha')); ?>
                                <div><?php $this->widget('CCaptcha'); ?></div>

                                <div class="error">
                                    <?php echo $form->error($model,'verifyCode'); ?>
                                </div>	
                        </div>
                        <button class="yt-uix-button yt-uix-button-default">
                            <span class="yt-uix-button-content">
                                    <span class="addto-label"><?php echo ArticlesModule::t('Send'); ?></span>
                            </span>
                        </button>
			<?php $this->endWidget(); ?>
		</div-->
<script type="text/javascript">
var hash = window.location.hash.substring(1);
if(hash.strlen > 0) {
    $('html, body').animate({scrollTop: $('#'+hash).offset().top}, 800);
}
$("li.faq-item span").click(function() {
	if($(this).next().is(':hidden'))
		$(this).next().slideDown(200);
	else
		$(this).next().slideUp(200);
})
</script>