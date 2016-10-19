<?php

class DeactivateApartmentsCommand extends CConsoleCommand {

    public $month = 4;
    private $defaultLang = 'ru';

    public function init() {
        $this->confirm("Do you want to run deactivation apartments which older than 2 month?", "yes");
        Yii::app()->language = $this->defaultLang;
        
    }

	public function run($args) {
        $date = date("Y-m-d",strtotime(date("Y-m-d", time()).' - '.$this->month.' months'));
        if($date) {
            $criteria = new CDbCriteria;
            $criteria->addCondition('date_updated < "'.$date.'" ');
            $results = Apartment::model()->with(array('description', 'user'))->findAll($criteria);
            if(!empty($results)) {
                foreach($results as $result) {
                    //$update = Apartment::model()->updateByPk($result->id, array('owner_active' => 0));
                    //if($update) {
                        if(isset($result->user->defaultLang))
                            Yii::app()->language = $result->user->defaultLang;
                        $this->__sendNotification($result);
                    //}
                } 
            }
        }
    }

    private function __sendNotification($model) {
        $city = City::model()->with('city_description')->findByPk($model->city_id);
        $notifier = new Notifier();
        $notifier->raiseEvent('deactivateApartment', $model, array(
            'title' => CHtml::link($model->description->title, $model->getUrl($model->id,  $model->description->title, $city->city_description->name)),
            'forceEmail' => $model->user->email,
            'firstname' => $model->user->firstname
        ));
    }
}