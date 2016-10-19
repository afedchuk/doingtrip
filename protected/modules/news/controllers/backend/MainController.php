<?php

class MainController extends ModuleAdminController{
	public $modelName = 'News';

    public function actionProduct(){

        //NewsProduct::getProductNews();
        Yii::app()->user->setState('menu_active', 'news.product');

        $model = NewsProduct::model();
      		$result = $model->getAllWithPagination();

      		$this->render('news_product', array(
      			'items' => $result['items'],
      			'pages' => $result['pages'],
      		));
    }
}