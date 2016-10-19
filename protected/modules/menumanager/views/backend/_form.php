<div class="form">
	<?php
	Yii::app()->clientScript->registerScript('selectFieldsReady', '
		selectFields($("#Menu_type").val());
	', CClientScript::POS_READY);


	if($model->special){
		$js = '
			hideAll();
			$("#menu_type").hide();
			$("#menu_title").show();

		';
		if($model->id == 1){
			$js .= '
				$("#menu_page_title").show();
				$("#menu_page_body").show();
				$("#menu_widget").show();
			';
		} else {
			$js .= '
				$("#menu_subitems").show();
			';
		}
		Yii::app()->clientScript->registerScript('selectSpecial', $js, CClientScript::POS_READY);
	}



	Yii::app()->clientScript->registerScript('selectFields', '
		function hideAll(){
			$("#menu_title").hide();
			$("#menu_href").hide();
			$("#menu_subitems").hide();
			$("#menu_page_title").hide();
			$("#menu_page_body").hide();
			$("#menu_seo").hide();
			$("#menu_widget").hide();
		}

		function selectFields(type){
			hideAll();
			if(type == '.Menu::LINK_NEW_MANUAL.'){
				$("#menu_title").show();
				$("#menu_href").show();
			}

			if(type == '.Menu::LINK_NEW_AUTO.'){
				$("#menu_title").show();
				$("#menu_page_title").show();
				$("#menu_page_body").show();
				$("#menu_seo").show();
				$("#menu_widget").show();
			}

			if(type == '.Menu::LINK_DROPDOWN.'){
				$("#menu_title").show();
			}

			if(type == '.Menu::LINK_DROPDOWN_MANUAL.'){
				$("#menu_title").show();
				$("#menu_href").show();
				$("#menu_subitems").show();
			}

			if(type == '.Menu::LINK_DROPDOWN_AUTO.'){
				$("#menu_title").show();
				$("#menu_subitems").show();

				$("#menu_page_title").show();
				$("#menu_page_body").show();
				$("#menu_seo").show();
				$("#menu_widget").show();
			}
		}
	', CClientScript::POS_END);

	$form=$this->beginWidget('CustomForm', array(
		'id'=>$this->modelName.'-form',
		//'enableAjaxValidation'=>true,
	)); ?>

		<p class="note"><?php echo Yii::t('common', 'Fields with <span class="required">*</span> are required.'); ?></p>

		<?php echo $form->errorSummary($model); ?>

		<div class="rowold" id="menu_type">
			<?php echo $form->labelEx($model,'type'); ?>
			<?php echo $form->dropDownList($model,'type', $model->getTypes(), array(
				'class'=>'width450',
				'onChange' => 'js: selectFields(this.value);',
			)); ?>
			<?php echo $form->error($model,'type'); ?>
		</div>

		<div class="rowold" id="menu_subitems">
			<?php echo $form->labelEx($model,'subitems'); ?>
			<?php echo $form->dropDownList($model,'subitems', $model->getForSubitems(), array('class'=>'width450')); ?>
			<?php echo $form->error($model,'subitems'); ?>
		</div>

        <?php
        $this->widget('application.modules.lang.components.langFieldWidget', array(
                'model' => $model,
                'field' => 'title',
                'type' => 'string',
                'row_id' => 'menu_title'
            ));
        ?>

		<div class="rowold" id="menu_href">
			<?php echo $form->labelEx($model,'href'); ?>
			<?php echo $form->textField($model,'href',array('size'=>60,'maxlength'=>255)); ?>
			<?php echo $form->error($model,'href'); ?>
		</div>

        <div class="rowold" id="menu_page_title">
        <?php
        $this->widget('application.modules.lang.components.langFieldWidget', array(
                'model' => $model,
                'field' => 'page_title',
                'type' => 'string',
            ));
        ?>
        </div>

        <div class="rowold" id="menu_page_body">
        <?php
        $this->widget('application.modules.lang.components.langFieldWidget', array(
                'model' => $model,
                'field' => 'page_body',
                'type' => 'text-editor',
            ));
        ?>
        </div>

		<div class="rowold" id="menu_widget">
			<?php echo $form->labelEx($model,'widget'); ?>
			<?php echo $form->dropDownList($model,'widget', Menu::getWidgetOptions()); ?>
			<?php echo $form->error($model,'widget'); ?>
		</div>


        <div class="clear"></div>
        <br>

        <div class="rowold buttons">
            <?php $this->widget('bootstrap.widgets.TbButton',
                        array('buttonType'=>'submit',
                            'type'=>'primary',
                            'icon'=>'ok white',
                            'label'=> $model->isNewRecord ? tc('Add') : tc('Save'),
                        )); ?>
        </div>

	<?php $this->endWidget(); ?>

	<?php if(issetModule('seo') && !$model->isNewRecord && in_array($model->type, array(Menu::LINK_NEW_AUTO, Menu::LINK_DROPDOWN_AUTO))): ?>
	<div id="menu_seo">
		<div class="clear"></div>
		<?php
			$this->widget('application.modules.seo.components.SeoWidget', array(
				'model' => $model,
			));
		?>
    </div>
	<?php endif; ?>

</div><!-- form -->