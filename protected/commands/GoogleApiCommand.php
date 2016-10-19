<?php

class GoogleApiCommand extends CConsoleCommand {


	public function run($args) {

       // $user = new ProfileController();
        Yii::import('application.modules.user.controllers.ProfileController');
       $user = new ProfileController("Profile"); 
       

        var_dump($user->actionIndex()); die;
    }

}