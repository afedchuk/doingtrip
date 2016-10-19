<?php
class MainController extends ModuleAdminController{
	public $modelName = 'NotifierModel';
	public $reset = false;


    public function actionView($id){
        $this->redirect(array('admin'));
    }

    private function saveDescriptionItems($id, $description, $data) { 
        if(!empty($data)) {  
           foreach(Lang::getActiveLangs() as $lang) { 
               if(isset($data[$lang])) {

                   $description[$lang]->setAttributes($data[$lang]);

                   if($description[$lang]->isNewRecord) {
                       $description[$lang]->letter_id = $id;
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

    public function actionCreate() {
    	$model = new NotifierModel();
    	$model->scenario = 'create';
    	if(isset($_POST['NotifierModel'])) {
    		$model->setAttributes($_POST['NotifierModel']);
    		$model->lang = Yii::app()->language;
    		if($model->save()) {
    			$letter_id = $model->letter_id;
    			foreach(Lang::getActiveLangs() as $lang) {
    				if(Yii::app()->language != $lang) {
	    				$description = new NotifierModel();
	    				$description->setAttributes($_POST['NotifierModel']);
	    				$description->letter_id = $letter_id;
	    				$description->lang = $lang;
	    				$description->save();
	    			}
    			}
    			Yii::app()->user->setFlash('success', Yii::t('common','Your information updated'));
			    $this->redirect(Yii::app()->createAbsoluteUrl('/notifier/backend/main/update', array('id' =>$letter_id)));
    		}
    	}
    	$this->render('create',
                array('model' => $model)
        );
    }

    public function actionUpdate($id){
        $description = array();
        foreach(Lang::getActiveLangs() as $lang) {
            $result = NotifierModel::model()->resetScope()->find('letter_id=:letter_id AND lang=:lang', array(':letter_id' => $id, ':lang' => $lang));
            if($result === null)
                $description[$lang] = new NotifierModel();
            else
                $description[$lang] = $result;
        }

        if(isset($_POST['NotifierModel'])){
            if($this->saveDescriptionItems($id, $description, $_POST['NotifierModel'])) {
                Yii::app()->user->setFlash('success', ApartmentsModule::t('Your information updated'));
                Yii::app()->controller->refresh();
            }
        }
        $this->render('update',
                array('description' => $description)
        );
    }

}
