<div class="control-group form-search">
    <div class="controls filter-block input-append">
        <?php echo CHtml::textField('property_search[apId]', (isset($this->apId) && $this->apId) ? CHtml::encode($this->apId) : '', array(
				'class' => 'span3 search-input-new search-query',
				'placeholder' => ApartmentsModule::t('Filter id'),
				'onchange' => 'search.changeSearch();'

			)); 
			$this->widget('bootstrap.widgets.TbButton', array(
				'label'=> '',
				'buttonType' => 'submit',
				'icon' => 'search',
				'type'=>'default',
				'size'=>'small',
			)); 
		?>
    </div>
</div>
