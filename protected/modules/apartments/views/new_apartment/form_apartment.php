<?php 
$this->pageTitle .= ' - '.  ApartmentsModule::t("Create apartment");
?>
<?php $tabs = array('step_two', 'step_third', 'step_fourth', 'step_five');
                      if(Yii::app()->user->isGuest)
                        array_unshift($tabs, 'step_one');
                ?>
<div class="mrgT55 span8 add">
        <div class="authorization well">
                <?php if(Yii::app()->user->getState('isAdmin')){ ?>

                <?php } ?>
                <nav class="progressive-bar-orange step-<?php echo sizeof($tabs);?>">
                    <?php for($i=0; $i<5; $i++) { ?>
                        <?php if(isset($tabs[$i])) { $c = $i; ?>
                            <a href="javascript:void(0)" class="item-tab <?php if($i== 0) { ?>active<?php }?>">
                                <span class="text-progressive-bar">
                                    <span class="step"><?php echo Yii::t('index','Step').' '.++$c; ?> </span> <br/>
                                    <?php echo ApartmentsModule::t($tabs[$i]); ?>
                                </span>
                            </a>
                        <?php }?>
                    <?php } ?>
                </nav>
                <div class="blocks-tmenu">
                    <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'Apartment-create-form',
                        'enableAjaxValidation'=>true,
                        'htmlOptions' => array('class' => 'form-horizontal', 'onsubmit' => '$("#submit-button").addClass("disabled"); $("#submit-button").text("'.Yii::t('common','Button waiting').'")')
                        )
                    );
                    ?>
                    <?php 
                    $tabs = array(); $active = true;
                    if(Yii::app()->user->isGuest){ 
                        $active = false;
                        $tabs['tabs'] = array(
                            'label' => ApartmentsModule::t('step_one'),
                            'content'=> $this->renderPartial('new_apartment/step_one', array('form' => $form,'user'=>$user,  'model'=>$model, 'references' => isset($references) ? $references : array()), true ),
                            'active' => true
                            );
                    }

                    $tabs['tabs'] = array_merge($tabs, array(
                        array(
                            'label' => ApartmentsModule::t('step_two'),
                            'content' => $this->renderPartial('new_apartment/step_two', array('form' => $form, 'user'=>$user,  'model'=>$model, 'references' => isset($references) ? $references : array()), true ),
                            'active' => $active
                           
                        ),
                        array(
                            'label' => ApartmentsModule::t('step_third'),
                            'content' => $this->renderPartial('new_apartment/step_third', array('form' => $form, 'user'=>$user,'model'=>$model, 'references' => isset($references) ? $references : array()), true ),
                        ),
                        array(
                            'label' => ApartmentsModule::t('step_fourth'),
                            'content' => $this->renderPartial('new_apartment/step_fourth', array('form' => $form, 'user'=>$user, 'model'=>$model, 'references' => isset($references) ? $references : array()), true ),
                        ),
                        array(
                            'label' => ApartmentsModule::t('step_five'),
                            'content' => $this->renderPartial('new_apartment/step_five', array('form' => $form, 'user'=>$user, 'model'=>$model, 'img' => $img), true ),
                        )
                    ));

                    $this->widget('bootstrap.widgets.TbTabs', array(
                                'type'=>'tabs',
                                'placement'=>'above', 
                                'tabs' => $tabs['tabs']
                            ));?>
                </div>
                <?php $this->endWidget(); ?>
        </div>
</div>
<br/><br/>
<script type="text/javascript">
    var anc = window.location.hash.replace("#","");
    if(anc.length > 0) {
        $('.progressive-bar-orange a').removeClass('active');
        $('.progressive-bar-orange a').eq(anc-1).addClass('active');
        $('div.tab-pane').removeClass('active in');
        $('div.tab-pane').eq(anc-1).addClass('active in');
    }
    $('a.btn:not(.last)').click(function() {
        var pos = $('.progressive-bar-orange a.active').index();
        $('div.tab-pane').eq(pos).removeClass('active in');
        $('a.item-tab').removeClass('active');
        if($(this).hasClass('pull-right'))
            pos++;
        else
            pos--;
        $('a.item-tab').eq(pos).addClass('active');
        $('div.tab-pane').eq(pos).addClass('active in')
    })
</script>
