<?php

class ActivateApartmentsCommand extends CConsoleCommand {

	public function run($args) {

        $apartments = Apartment::model()->with(array('description', 'images', 'user'))->findAll('active=0 AND owner_active=1 AND date_updated>:date_updated', 
            array(':date_updated' => strtotime(date("Y-m-d", time()).' - 4 months')));
        if(!empty($apartments)) {
            foreach($apartments as $apartment) {
                $this->__sendNotificationOwnerActive($apartment);
            }
        }
        die;
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
                        //$this->__sendNotification($result);
                    //}
                } 
            }
        }
    }

    private function __sendNotificationOwnerActive($apartment) {
        $notifier = new Notifier();
        if(!empty($apartment->images)) {
            $notifier->raiseEvent('activateApartment', $model, array(
                'title' => CHtml::link($model->description->title, $model->getUrl($model->id,  $model->description->title, $city->city_description->name)),
                'forceEmail' => $model->user->email,
                'firstname' => $model->user->firstname
            ));
            $update = Apartment::model()->updateByPk($apartment->id, array('active' => 1, 'last_notification' => time()));
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