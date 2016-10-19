<?php

class MainController extends ModuleUserController {

    public $modelName = 'Page';
    
    public function actionView($id) {

            $page = Page::model()
                    ->cache(param('cachingTime', 1209600), Page::getDependency())
                    ->find('page_id=:page_id', array(':page_id' => $id));
            
            
            if(is_null($page)) {
                Yii::app()->user->setFlash('warning',  PagesModule::t('Warning not found page'));
                $this->redirect(Yii::app()->homeUrl);
            }

            $this->render('index', array('model' => $page));
    }
}