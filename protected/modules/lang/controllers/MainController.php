<?php

class MainController extends ModuleUserController {

	public $modelName = 'Lang';

    public function actionAjaxTranslate(){
        if(!Yii::app()->request->isAjaxRequest){
            throw404();
        }

        $fromLang = Yii::app()->request->getPost('fromLang');
        $fields = Yii::app()->request->getPost('fields');
        if(!$fromLang || !$fields){
            throw new CException('Lang no req data');
        }

        $translate = new GoogleTranslater();
        $fromVal = $fields[$fromLang];

        $translateField = array();
        foreach($fields as $lang=>$val){
            if($lang == $fromLang){
                continue;
            }
            $translateField[$lang] = $translate->translateText($fromVal, $fromLang, $lang);
        }

        echo json_encode(array(
            'result' => 'ok',
            'fields' => $translateField
        ));
        Yii::app()->end();
    }
}