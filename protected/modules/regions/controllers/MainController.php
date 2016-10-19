<?php

class MainController extends ModuleUserController {

	public $modelName = 'Apartment';
    public $with = array('city_description');

    public function actionCityRequest() {
        $this->renderPartial('city_request', array(), false, true);
    }
	public function actionLoadCity() {
            
        if(Yii::app()->request->isAjaxRequest) 
            if(isset($_GET['region_id'])) {
                $model = City::model()->cache(param('cachingTime', 1209600),  City::getDependency())->findAll('region_id=:region_id', array(':region_id'=>$_GET['region_id']));

                Yii::app()->getModule('apartments');

                $data[] = array('id' => 0,
                                'name'=> ApartmentsModule::t('--Select--'));

                foreach($model as $city) {
                    $data[] = array('id'=>$city->id,
                                    'name' => $city->name);
                }
                echo CJSON::encode($data);
                Yii::app()->end();
            } 
    }
      
    public function actionCities() {
        if(Yii::app()->request->isAjaxRequest){
            $model = City::model()->with(array('city_description','apartments') )->cache(param('cachingTime', 1209600),  City::getDependency())->findAll(array('order'=>'name ASC')); 
            Yii::app()->clientScript->scriptMap['bootstrap.css'] = false;
            Yii::app()->clientScript->scriptMap['bootstrap.min.css'] = false;
            Yii::app()->clientscript->scriptMap['jquery.js'] = false;
            Yii::app()->clientscript->scriptMap['jquery.min.js'] = false;
            Yii::app()->clientscript->scriptMap['jquery-ui.min.js'] = false;
            Yii::app()->clientscript->scriptMap['jquery-ui-i18n.min.js'] = false;
            $this->renderPartial('cities', array(
                'model' => $model,
            ), false, true);
        }
    }
    public function actionAutocomplete() {

        if(Yii::app()->request->isAjaxRequest)  {
             if (!empty($_GET['term'])) {
                    $sql = 'SELECT id, name FROM {{city}} WHERE name LIKE :qterm ORDER BY name ASC';
                    $command = Yii::app()->db->createCommand($sql);
                    $qterm = '%'.$_GET['term'].'%';
                    $command->bindParam(":qterm", $qterm, PDO::PARAM_STR);
                    $city = $command->queryAll();  $result = array();
                    if(!empty($city)) {
                        $i =0;
                        foreach($city as $value) {
                            $result[strtoupper(substr($value['name'], 0, 2))][$i] = array('id' => $value['id'],
                                                                                          'name' => $value['name']);
                            $i++;
                        }
                    }
              } else {
                    $city = City::model()->cache(param('cachingTime', 1209600))->findAll(array('order'=>'name ASC'));
                    $result = array();
                    if(!is_null($city)) {
                        $i =0;
                        foreach($city as $value) {
                            $result[strtoupper(substr($value->name, 0, 2))][$i] = array('id' => $value->id,
                                                                                        'name' => $value->name);
                            $i++;
                        }
                    }       
              }

              $this->renderPartial('regions.components.views.cityFilter', array('cities' => $result), false, true);   
        }
    }

}