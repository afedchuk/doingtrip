<?php


class NewsWidget extends CWidget {

	public $usePagination = 1;

	public function getViewPath($checkTheme=false){
		return Yii::getPathOfAlias('application.modules.news.views');
	}

	public function run() {
		$news = new News;
		$result = $news->getAllWithPagination();
		
		$this->render('widgetNews_list', array(
			'news' => $result['items'],
			'pages' => $result['pages'],
		));
	}
}