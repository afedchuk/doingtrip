<?php


class LoginWidget extends CWidget
{
    
    
    public function run()
    {

        $module  =  Yii::app()->getModule('user');
       
        $view = 'login_box';
        
        if (Yii::app()->user->isGuest) {
            
            $model =  new UserLogin;   
            
            
        } else {
            
            $model = User::model()->cache(param('cachingTime', 1209600))->find('id=:id', array(':id'=>Yii::app()->user->id));
            $view = 'login_box_done';
   
        }
        $this->render($view, array('model' => $model));
    }
}

?>