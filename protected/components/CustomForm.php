<?php

Yii::import('bootstrap.widgets.TbActiveForm');

class CustomForm extends TbActiveForm {
    public $htmlOptions = array();

    public function init(){
        $this->htmlOptions = array_merge(array('class'=>'well'), $this->htmlOptions);
        parent::init();
    }

}
