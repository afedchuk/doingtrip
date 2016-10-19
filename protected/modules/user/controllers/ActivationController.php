<?php

class ActivationController extends Controller
{
	public $defaultAction = 'activation';
    
	public function actionActivation () {  
        if(isset($_GET['activkey'])) {
            $activkey = $_GET['activkey'];
            if ($activkey) {
                $find = User::model()->find('activkey=:activkey', array(':activkey'=>$activkey)); 
                if(!is_null($find)) { 
                    if ((int)$find->status == 1) {
                        if (Yii::app()->user->isGuest) {
                            Yii::app()->user->setFlash('warning', UserModule::t("You account is active."). '. '. UserModule::t('Please enter your login or email addres.'));
                            $this->redirect(Yii::app()->createAbsoluteUrl('user/login'));
                        } else {
                            Yii::app()->user->setFlash('warning', UserModule::t("You account is active."));
                            $this->redirect(Yii::app()->createAbsoluteUrl('user/profile'));
                        }
                    } elseif((int)$find->status == 0) {
                        $find->activkey = UserModule::encrypting(microtime());
                        $find->status = 1;
                        if($find->save(false)) {
                            $notifier = new Notifier();
                            $notifier->raiseEvent('onUserActivation', $find, array(
                                'forceEmail' => $find->email
                            )); 
                            Yii::app()->user->setFlash('success', UserModule::t("You account is activated."). '. '. UserModule::t('Please enter your login or email addres.'));
                        }
                        
                    } 
                }
                $this->redirect(Yii::app()->createAbsoluteUrl('user/login'));
            } else {
                $this->redirect(Yii::app()->createAbsoluteUrl('apartments'));
            }
        }
	}

}