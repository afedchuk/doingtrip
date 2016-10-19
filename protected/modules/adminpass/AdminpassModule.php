<?php

class AdminpassModule extends Module{

	public function beforeControllerAction($controller, $action){
		if(parent::beforeControllerAction($controller, $action)){
			return true;
		} else {
			return false;
		}
	}
}
