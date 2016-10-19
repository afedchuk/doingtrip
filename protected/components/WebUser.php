<?php


class WebUser extends CWebUser
{

    public function userId() {
		return $this->getState('id');
	}

}