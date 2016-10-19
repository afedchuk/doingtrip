<?php

class MainController extends ModuleUserController{

	protected function beforeAction($action) {
        if(Yii::app()->request->isAjaxRequest){
            Yii::app()->clientscript->scriptMap['bootstrap.min.js'] = false;
            Yii::app()->clientscript->scriptMap['jquery.min.js'] = false;
        }
        return parent::beforeAction($action);
    }
    
	public function actionIndex(){
            Yii::app()->getModule('apartments');
            Yii::app()->getModule('booking');
            if(Yii::app()->request->isAjaxRequest){
                $apartments = array();
                $apartment = Apartment::model()->findByPk($_POST['apartment_id']);
                if($apartment) {
                    $apartment->km = 5;
                    if(isset($_POST['distance']) && in_array($_POST['distance'], range(1,5)))
                        $apartment->km = $_POST['distance'];
                    $minmax  = Apartment::model()->getNearby($apartment->lat, $apartment->lng, $apartment->km);
                    $apartments= Yii::app()->db->createCommand('select image.*, description.*, geo.* from {{apartment}} as geo 
                                                            LEFT JOIN {{apartment_description}} AS description ON (geo.id = description.apartment_id) 
                                                            LEFT JOIN {{images}} AS image ON (image.id_object = geo.id) 
                                                            WHERE (geo.lat BETWEEN '.str_replace(',', '.', $minmax['min_latitude']).' AND '.str_replace(',', '.', $minmax['max_latitude']).')
                                                            AND (geo.lng BETWEEN '.str_replace(',', '.', $minmax['min_longitude']).' AND '.str_replace(',', '.', $minmax['max_longitude']).') AND geo.id != '.$apartment->id.' AND description.lang="'.Yii::app()->language.'" AND image.is_main = 1  AND geo.active = 1 ORDER BY RAND() LIMIT 5')
                                            ->query();
                                           
                    if(empty($apartments)){
                        return 0;
                        Yii::app()->end();
                    }
                }

                Yii::app()->clientScript->scriptMap['bootstrap.css'] = false;
                Yii::app()->clientScript->scriptMap['bootstrap.min.css'] = false;
                Yii::app()->clientscript->scriptMap['jquery.js'] = false;
                Yii::app()->clientscript->scriptMap['jquery-ui.min.js'] = false;
                Yii::app()->clientscript->scriptMap['jquery-ui-i18n.min.js'] = false;
                
                $this->renderPartial('index', array(
                    'apartments' => $apartments,
                    'model' => $apartment
                ), false, true);
            }
	}
}