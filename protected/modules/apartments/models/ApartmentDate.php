<?php

class ApartmentDate extends CActiveRecord {
    public $check_in = null;
    public $check_out = null;
    
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{apartment_availability}}';       
	}
        
    public function rules() {
		return array(
			array('check_in, check_out, apartment_id' , 'required', 'on' => 'check'),
			array('check_out, check_in', 'safe'),
		);
	}

    public function defaultScope()
    {
        return array(
            'condition'=>"date>'".date("Y-m-d")."'",
        );
    }
    
    public function checkDates($check_in, $check_out, $id)
    {
        $model = $this->findAll('apartment_id=:apartment_id AND date>=:check_in AND date<=:check_out',
                array(':apartment_id'=>$id, ':check_in' => $check_in, ':check_out' => $check_out));

        $check_in = strtotime($check_in);
        $check_out = strtotime($check_out);
        if(!is_null($model)) {
            foreach($model as $value) {
                $date = strtotime($value['date']);
                if(($date >= $check_in) && ($date <= $check_out))
                    return false;
            }
        }
        return true;
    }

}