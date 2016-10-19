<?php

class MainController extends ModuleUserController {
	public $modelName = 'Article';

	public function actions()
	{
		return (isset($_POST['ajax']) && $_POST['ajax']==='faq-form')?array():array(
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xF9F9F9,
                                'foreColor' => 0x555555,
                                'height' => 40,
			),
		);
	}

	public function actionIndex(){

        $model = new Article();
        $model->scenario = 'add';

        if (isset($_POST['Article'])) {
        	$model->attributes = $_POST['Article'];
        	$model->lang = Yii::app()->language;
        	$model->active =0;

        	if($model->validate()) {
        		$model->save(false);
        		Yii::app()->user->setFlash('success',ArticlesModule::t('Success message sent' ));

        	} else {
        		Yii::app()->user->setFlash('warning',ArticlesModule::t("Error check all fields"));
        	}
        }

		/*if(Yii::app()->user->getState('isAdmin')){
			$this->redirect(array('/articles/backend/main/index'));
		}*/

		$criteria=new CDbCriteria;
		$criteria->order = 'sorter';
		$criteria->condition = 'active=1';


		$articles = Article::model()->lang()->active()->cache(param('cachingTime', 1209600), Article::getCacheDependency())->findAll($criteria);
		
		$this->render('/index',array(
			'articles' => $articles,  'model' => $model
		));
	}

	public function actionView($id){
		/*if(Yii::app()->user->getState('isAdmin')){
			$this->redirect(array('/articles/backend/main/view', 'id' => $id));
		}*/

		$criteria=new CDbCriteria;
		$criteria->order = 'sorter';
		$criteria->condition = 'active=1';

		$articles = Article::model()->cache(param('cachingTime', 1209600), Article::getCacheDependency())->findAll($criteria);
	    
		$this->render('view',array(
			'model'=>$this->loadModel($id), 'articles' => $articles
		));
	}
}