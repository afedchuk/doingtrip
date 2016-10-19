<?php


class langFieldWidget extends CWidget {
	public $model;
	public $modelName;
	public $field;
	public $form;

	public $type = 'string';

	public $htmlOption;

	public $useTranslate = false;
	private $fieldIdArr = array();
	private $_activeLang;

	public $row_id = '';

	private static $_publishAsset;

	public $useCopyButton = false;

	public $note;

	private $uniqueKey;

	public function getViewPath($checkTheme = false) {
		return Yii::getPathOfAlias('application.modules.lang.views');
	}

	public function run() {
		$this->modelName = get_class($this->model);

		$this->uniqueKey = rand(1, 99999);

		$this->_activeLang = Lang::getActiveLangs(true);

		$countActiveLang = count($this->_activeLang);

		if ($countActiveLang <= 1 || in_array($this->type, array('text-editor'))) {
			$this->useTranslate = false;
		}
		if ($countActiveLang <= 1) {
			$this->useCopyButton = false;
		}

		if (($this->useTranslate || $this->useCopyButton) && !isset(self::$_publishAsset)) {
			self::$_publishAsset = true;
			$this->publishAssets();
		}

		$postfix = '_' . $this->uniqueKey . $this->field;

		$tabs = array();
	    $i = 1; $activeI = 0;
	    foreach ($this->_activeLang as $lang) {
	        $tabs[] = array(
	            'active'=>$activeI,
	            'label'=>$lang['name'],
	            'content'=> $this->genContentTab($this->field, $lang['code'], $this->form, $this->model, $lang)
	            //'content'=> $this->genContentTab($this->field, $lang['code'])
	        );
	        if ($lang['code'] == Yii::app()->language) {
				$activeI = $i;
			}
			$i++;
	    }
		$this->widget("bootstrap.widgets.TbTabs", array(
		    "type" => "tabs",
		    "tabs" => $tabs,
		 
		)); 
		//$this->widget('CTabView', $tabs);
	}

	private function genContentTab($field, $lang, $form = null, $model = null, $language = array()) {
		$isCKEditor = ($this->type == 'text-editor') ? 1 : 0;

		$fieldId = 'id_' . $this->modelName . $this->field . '_' . $lang;

		$html = '';

		if ($this->useTranslate) {
			$html .= '<div class="translate_button" >';
			$html .= '<span class="t_loader_' . $this->modelName . $this->field . '" style="display: none;"><img src="' . Yii::app()->request->baseUrl . '/images/ajax-loader.gif" alt="Переводим"></span>';
			$html .= CHtml::button(tc('Translate'), array(
				'onClick' => "translateField('{$this->field}', '{$lang}', '{$isCKEditor}', '" . $this->modelName . "')"
			));
			$html .= '</div>';
		}

		if ($this->useCopyButton) {
			$html .= '<div class="copylang_button">';
			$html .= CHtml::button(tc('Copy to all languages'), array(
				'onClick' => "copyField('{$this->field}', '{$lang}', '{$isCKEditor}', '" . $this->modelName . "')"
			));
			$html .= '</div>';
		}

		$html .= '<div class="conatiner">';
		$html .= CHtml::activeLabel($this->model, $this->field, array('required' => $this->model->isLangAttributeRequired($this->field)));

		if ($this->note) {
			$html .= CHtml::tag('p', array('class' => 'note'), $this->note);
		}

		switch ($this->type) {
			case 'string':
				$html .= CHtml::activeTextField($this->model, $field, array(
					'class' => 'span5',
					'maxlength' => 255,
					'id' => $fieldId
				));
				break;

			case 'text':
				$html .= CHtml::activeTextArea($this->model, $field, array(
					'class' => 'span1',
					'id' => $fieldId
				));
				break;

			case 'text-editor':
				$html .= '<div class="clear"></div>';

				$options = array();

				if (Yii::app()->user->getState('isAdmin')) { // if admin - enable upload image
					$options = array(
						'filebrowserUploadUrl' => CHtml::normalizeUrl(array('/site/uploadimage?type=imageUpload'))
					);
				}

				$html .= $this->widget('application.extensions.ckeditor.CKEditor', array(
					'model' => $this->model,
					'attribute' => $field,
					'language' => '' . Yii::app()->language . '',
					'editorTemplate' => 'advanced', /* full, basic */
					'skin' => 'kama',
					'toolbar' => array(
						array('Source', '-', 'Bold', 'Italic', 'Underline', 'Strike'),
						array('Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'),
						array('NumberedList', 'BulletedList', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'),
						array('Styles', 'Format', 'Font', 'FontSize', 'TextColor', 'BGColor'),
						array('Image', 'Link', 'Unlink', 'SpecialChar'),
					),
					'options' => $options,
					'htmlOptions' => array('id' => $fieldId)
				), true);
				break;
		}

		$html .= CHtml::error($this->model, $field);
		$html .= '</div>';

		$this->fieldIdArr[$lang] = $fieldId;

		return $html;
	}

	public function publishAssets() {
		$assets = dirname(__FILE__) . '/../assets';
		$baseUrl = Yii::app()->assetManager->publish($assets);

		if (is_dir($assets)) {
			Yii::app()->clientScript->registerCoreScript('jquery');
			Yii::app()->clientScript->registerScript(__CLASS__, "
			var activeLang = " . CJavaScript::encode(Lang::getActiveLangs()) . ";
			var baseUrl = '" . Yii::app()->request->baseUrl . "';
			var errorNoFromLang = '" . Yii::t('module_lang', 'Enter a value for this language') . "';
			var errorTranslate = '" . Yii::t('module_lang', 'Error translate') . "';
			var successTranslate = '" . Yii::t('module_lang', 'Success translate') . "';
			var successCopy = '" . Yii::t('module_lang', 'Success copy') . "';
		", CClientScript::POS_END);

			Yii::app()->clientScript->registerScriptFile($baseUrl . '/translate.js', CClientScript::POS_END);
		} else {
			throw new Exception(Yii::t('common', 'Lang - Error: Couldn\'t find assets folder to publish.'));
		}
	}

}