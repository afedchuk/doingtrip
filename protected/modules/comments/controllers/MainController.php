<?php


class MainController extends ModuleUserController{
	public $modelName = 'Comment';

	public function actionIndex(){
		$model = new $this->modelName;
		$model = $model->resetScope();
		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actions() {
		return (isset($_POST['ajax']) && $_POST['ajax']==='Comment-form')?array():array(

			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xF5F4F4,
                'foreColor' => 0x555555,
                'height' => 40,
			),
		);

	}

	protected function beforeAction($action) {
        if(Yii::app()->request->isAjaxRequest){
            Yii::app()->clientScript->scriptMap['bootstrap.css'] = false;
            Yii::app()->clientScript->scriptMap['bootstrap.min.css'] = false;
            Yii::app()->clientScript->scriptMap['bootstrap-responsive.min.css'] = false;
            Yii::app()->clientscript->scriptMap['bootstrap.min.js'] = false;
            Yii::app()->clientScript->scriptMap['jquery.rating.css'] = false;
            Yii::app()->clientscript->scriptMap['jquery.js'] = false;
            Yii::app()->clientscript->scriptMap['jquery.metadata.js'] = false;
            Yii::app()->clientscript->scriptMap['jquery.min.js'] = false;
            Yii::app()->clientscript->scriptMap['jquery-ui.min.js'] = false;
            Yii::app()->clientscript->scriptMap['jquery-ui-i18n.min.js'] = false;
        }
        return parent::beforeAction($action);
    }

	public function actionAdd() {
        $model = new Comment();
        $model->scenario = 'insert';
        if(isset($_POST['Comment'])){ 
           $model->attributes=$_POST['Comment'];
           $model->apartment_id = Yii::app()->getRequest()->getQuery('id');
           if($model->validate() && !isset($_POST['ajax'])){
               if($model->save(false)) {
                   Yii::app()->user->setFlash('success', CommentsModule::t('Comment successfully added.'));
                   $this->redirect(Yii::app()->request->urlReferrer);
               }
           }
           if(Yii::app()->request->isAjaxRequest){
                echo CActiveForm::validate($model);
                Yii::app()->end();
           } else {
               Yii::app()->user->setFlash('warning', CommentsModule::t('Check all necessary files'));
               $this->redirect(Yii::app()->request->urlReferrer);
           }
       }
       $this->renderPartial('backend/_form', array('model' => $model, 'id' => Yii::app()->getRequest()->getQuery('id')), false, true);
       
    }
	public function actionUserComment(){
            
            Yii::app()->getModule('user');

            if(isset($_POST['apartment_id']) && isset($_POST['comment']) && $_POST['apartment_id'] && $_POST['comment']) {
                
                $user = UserModule::user(); 
                $comment = new Comment();
                $comment->apartment_id = $_POST['apartment_id'];
                $comment->name = $user->profile->firstname.' '.$user->profile->lastname;
                $comment->email = $user->email;
                $comment->body = $_POST['comment'];
                $comment->active = Comment::STATUS_APPROVED;
                
                if($comment->save())
                    Yii::app()->user->setFlash('success', tt('Comment successfully added.'));
                
            } else {
                Yii::app()->user->setFlash('warning', tt('Check all necessary files'));
            }
            
            
	}

    public  function actionApartmentComments($id) {
        Yii::app()->getModule('apartments');
        $comments = Comment::model()->findAll('apartment_id=:apartment_id AND active=1', array(':apartment_id' => $id));
        
        if(Yii::app()->request->isAjaxRequest){
                $this->renderPartial('apartmnetComments', array(
                    'comments' =>$comments
                ), false, true);
        }
    }

	public function actionView($id){
		$this->redirect(array('index'));
	}

}
