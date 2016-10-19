<?php

class NotifyCompanyRegisterCommand extends CConsoleCommand {

	public function run($args) {
        if(isset($args[0])) {
            $emails = Yii::app()->db->createCommand('SELECT * FROM ore_services_emails WHERE service="'.$args[0].'" AND sent=0 LIMIT 1')->queryAll();
            if(!empty($emails)) {
                foreach($emails as $company) {
                    $result = $this->__sendNotification($company, $args);
                    if($result === true)
                        $update = Yii::app()->db->createCommand()->update('ore_services_emails', array('sent'=>1),'id=:id',array(':id'=>$company['id']));
                    //sleep(5);
                }
            }
        }  
    }

    private function __sendNotification($model, $args) {
        $notifier = new Notifier(); 
        if(isset($args[1]) && strlen($args[1]) == 2)
            $notifier->lang  = $args[1];
        $name = null;
        $tmp = isset($model['name']) && !empty($model['name']) ? explode(" ", $model['name']) : null;
        if(!is_null($tmp))
            $name = isset($tmp[0]) ? $tmp[0] : null;
      
        $notifier->raiseEvent('notifyCompanyRegister', $model, array(
            'forceEmail' => $model['email'],
            'firstname' => (!is_null($name) ? (mb_strtoupper(mb_substr(strtolower($name), 0, 1)).mb_substr($name, 1)) : '')
        ));

        return true;
    }
}