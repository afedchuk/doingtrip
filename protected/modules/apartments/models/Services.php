<?php

class Services extends CActiveRecord {

	public $start;
	public $end;

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{apartment_services}}';
                
	}

	public function afterFind() {
		$time = explode('/', $this->time_race);
		$this->start = isset($time[0]) ? $time[0] : null;
		$this->end = isset($time[1]) ? $time[1] : null;
	}

	public function beforeSave(){
		if($this->start && $this->end){
			$this->time_race = $this->start.'/'.$this->end;
		}
		return parent::beforeSave();
	}
        
    public function rules() {
		return array(
			array('time_race, max_berths, min_days, with_child, with_animals, smoking, transfer, deposit, docs, card', 'safe'),
            array('max_berths, min_days, with_child, with_animals, smoking', 'numerical', 'integerOnly' => true),
			array('start, end, max_berths, min_days, with_child, with_animals, smoking', 'required', 'on' => 'step_third'),
		);
	}
    
    public function getMinMax($filter, $type) {
        
        $criteria=new CDbCriteria;
        $criteria->select = $type.'('.$filter.') AS '.$filter;
        $row = $this->model()->find($criteria);
        return  $row[$filter];
    }
    
    public function attributeLabels() {
	return array(
		'time_race' => ApartmentsModule::t('Race time'),
		'start' => ApartmentsModule::t('Time start'),
		'end' => ApartmentsModule::t('Time end'),
		'max_berths' => ApartmentsModule::t('Max berths'),
		'min_days' => ApartmentsModule::t('Min days'),
		'with_child' => ApartmentsModule::t('With childs'),
        'with_animals' => ApartmentsModule::t('With animals'),
        'smoking' => ApartmentsModule::t('Smoking'),
        'transfer' => ApartmentsModule::t('Transfer'),
        'deposit' => ApartmentsModule::t('Deposit'),
        'docs' => ApartmentsModule::t('Docs'),
        'card' => ApartmentsModule::t('Card'),
	);
	}

	public static function returnTransfer($value) {
		if($value == 0)
			return ApartmentsModule::t('No available');
		elseif($value == 1)
			return ApartmentsModule::t('Available');
		elseif($value == 2)
			return ApartmentsModule::t('Additional price');
		return '-';
	}

	public static function returnDeposit($value) {
		if($value == '0')
			return ApartmentsModule::t('Not necessarily');
		elseif($value == '1')
			return ApartmentsModule::t('Necessarily');
		else
			return '-';
	}

	public static function returnCard($value) {
		if($value == '0')
			return ApartmentsModule::t('Forbidden');
		elseif($value == '1')
			return ApartmentsModule::t('Allow');
		else
			return '-';
	}

}