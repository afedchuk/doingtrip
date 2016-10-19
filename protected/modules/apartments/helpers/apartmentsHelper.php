<?php

class apartmentsHelper {
    
       public static function getUserApartments($user_id) {
            
                Yii::app()->getModule('regions');
                
                if(!$user_id)
                    return false;
                
                $count = 0; $apartments = array();
                
                $criteria = new CDbCriteria;
                $criteria->condition = "user_id=:user_id";
                $criteria->params = array(':user_id' => $user_id);
                
                $count = Apartment::model()->count($criteria);
                
                $apartments = Apartment::model()
                    ->cache(param('cachingTime', 1209600), Apartment::getImagesDependency())
                    ->with(array('images', 'description', 'user', 'city'))
                    ->findAll($criteria);
                
                return array('count' => $count,
                             'apartments' => $apartments);
        }
        
        public function getApartmentsSpecial() {
            
            $apartments = Apartment::model()
			->cache(param('cachingTime', 1209600), Apartment::getDependency())
			->with(array('images', 'description'))
			->findAll();
            
            return $apartments;
        }
}
