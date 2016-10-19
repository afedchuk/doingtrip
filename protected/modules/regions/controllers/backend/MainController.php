<?php


class MainController extends ModuleAdminController{
	public $modelName = 'City';

	public function actionView($id){
		$this->redirect(array('admin'));
	}
	public function actionIndex(){
		$this->redirect(array('admin'));
	}

    private function saveDescriptionItems($id, $description, $data) { 
        if(!empty($data)) {  
           foreach(Lang::getActiveLangs() as $lang) { 
            
               if(isset($data[$lang])) {
                   $description[$lang]->setAttributes($data[$lang]);
                   if($description[$lang]->isNewRecord) {
                       $description[$lang]->city_id = $id;
                       $description[$lang]->lang = $lang;
                   }
                   if($description[$lang]->validate())
                       $description[$lang]->save(false);
                   else
                       echo CActiveForm::validate(array($description[$lang]));
               }
           }
        }
        return true;
    }

    private function getDescriptions($id) {
        $description = array();
        foreach(Lang::getActiveLangs() as $lang) {
            $result = CityDescription::model()->resetScope()->find('city_id=:city_id AND lang=:lang', array(':city_id' => $id, ':lang' => $lang));
            if($result === null)
                $description[$lang] = new CityDescription();
            else
                $description[$lang] = $result;
        }
        return $description;
    }

	public function actionAdmin(){
		$this->getMaxSorter();
		parent::actionAdmin();
	}

    public function actionUpdate($id){
        $model = City::model()->findByPk($id);
        $description = $this->getDescriptions($id);
        if(isset($_POST['City'])){
            $model->attributes = $_POST['City'];
            $validate = $model->validate();
            if($validate && $this->saveDescriptionItems($id, $description, $_POST['CityDescription'])) {
                $model->save(false);
                Yii::app()->user->setFlash('success', ApartmentsModule::t('Your information updated'));
                Yii::app()->controller->refresh();
            }
        }
        $this->render('update',
                array('model'=>$model, 'description' => $description)
        );
    }

    public function actionCreate() {
        $model =  new City();
        if(isset($_POST['City'])){
            $model->attributes = $_POST['City'];
            if($model->validate()) { 
                $model->save(); 
                Yii::app()->user->setFlash('success', ApartmentsModule::t('Your information updated'));
                $this->redirect(Yii::app()->createAbsoluteUrl('/regions/backend/main/update', array('id' =>$model->id)));
            }
        }
        $this->render('create',
                array('model'=>$model, 'description' => array())
        );
    }

    public function actionDelete($id){
        if(City::model()->count() <= 1){
            if(!isset($_GET['ajax'])){
                Yii::app()->user->setFlash('error', tt('You can not delete the last city'));
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            }else{
                echo "<div class='flash-error'>".tt('You can not delete the last city')."</div>";
            }
            Yii::app()->end();
        }

        parent::actionDelete($id);
    }
}
