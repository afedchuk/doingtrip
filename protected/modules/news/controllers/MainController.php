<?php


class MainController extends ModuleUserController{
	public $modelName = 'News';

	public function actionIndex(){
            
        Yii::app()->getModule('apartments');
        Yii::app()->getModule('regions');
        
		$model = new $this->modelName;
		$result = $model->getAllWithPagination();
                
        if(Yii::app()->request->isAjaxRequest){
        	if(isset($_GET['page'])){
                if($result['pages']->pageCount < $_GET['page']){
                    throw new CHttpException(404,'No More results');
                }
            }
        	$this->renderPartial('_item_news', array('items' => $result['items'], 'pages' => $result['pages']));
        } else {
			$this->render('index', array('items' => $result['items'],'pages' => $result['pages']));
		}
	}
}