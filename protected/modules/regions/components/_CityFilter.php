<?php

class CityFilter extends CWidget {

    public function init()
    {

        parent::init();
    }

	public function run() {
        $model = new City();
        $this->render('cityFilter', array('cities' => City::sitemap(), 'model'=>$model));
	}
}