<?php

class ApartmentAdditional extends CActiveRecord {

	public $upload_ics;
	public $type_ics;

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{apartment_additional}}';       
	}

	public function rules() {
		return array(
			array('upload_ics, ics_calendar, google_calendar, flickr_photoset', 'safe'),
			array('ics_calendar','required','on'=>'url'),
			array('upload_ics','required','on'=>'upload'),
			array('google_calendar','required','on'=>'google'),
			array('ics_calendar', 'url'),
			array('google_calendar', 'match', 'pattern' => '/[-0-9a-zA-Z.+_]+@+group.calendar.google.com/', 'message' => ApartmentsModule::t('Incorrect ID Google calendar')),
			array('apartment_id', 'required')
		);
	}

	public function afterFind() {
        parent::afterFind();
    }

    protected function beforeSave() {
	    return parent::beforeSave();
	}

	public function attributeLabels() {
		return array(
            'ics_calendar' => ApartmentsModule::t('Calendar'),
            'google_calendar' => ApartmentsModule::t('Google calendar'),
			'flickr_photoset' => ApartmentsModule::t('Flickr photoset')
		);
	}
}