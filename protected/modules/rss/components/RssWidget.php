<?php

class RssWidget extends CWidget {
	public $criteria;


	public function getViewPath($checkTheme=false){
		return Yii::getPathOfAlias('application.modules.rss.views');
	}

	public function run() {

		if(!$this->criteria){
			throw404();
		}

		$subCriteria = clone $this->criteria;
		$subCriteria->select = 'MAX(t.date_created) as date_created';

		$maxDateUpdated = Apartment::model()->find($subCriteria);
		$maxDateUpdated = $maxDateUpdated->date_created;

		header('Content-type: text/xml');
		header('Pragma: public');
		header('Cache-control: private');
		header('Expires: -1');

		$xmlWriter = new XMLWriter();
		$xmlWriter->openMemory();
		$xmlWriter->setIndent(true);
		$xmlWriter->startDocument('1.0', 'UTF-8');
		$xmlWriter->startElement('rss');
		$xmlWriter->writeAttribute('version', '2.0');
		$xmlWriter->startElement("channel");

		$xmlWriter->writeElement('title', CHtml::encode(Yii::app()->name));
		$xmlWriter->writeElement('link', Yii::app()->getBaseUrl(true));
		$xmlWriter->writeElement('description', tt('Rss description'));
		$xmlWriter->writeElement('lastBuildDate', $this->getDateFormat(strtotime($maxDateUpdated)));

		$this->prepareItems($xmlWriter);

		$xmlWriter->endElement(); // end channel
		$xmlWriter->endElement(); // end rss
		echo $xmlWriter->outputMemory();

		Yii::app()->end();
	}

	private function prepareItems($xmlWriter = null) {
		$this->criteria->limit = param('module_rss_itemsPerFeed', 20);
		$this->criteria->order = Apartment::model()->getTableAlias().'.date_created DESC';
		$items = Apartment::model()->with(array('description', 'city', 'images'))->findAll($this->criteria);

		if($items){
			foreach($items as $item){
				$city_name = City::getCityName($item->city_id);
				$xmlWriter->startElement("item");
				$xmlWriter->writeElement('title', CHtml::encode($item->description->title));
				$xmlWriter->writeElement('link',  $item->getUrl($item->id, $item->description->title,  $city_name));
				$xmlWriter->writeElement('description', $this->getDescription($item));
				$xmlWriter->writeElement('pubDate', $this->getDateFormat(strtotime($item->date_created)));
				$xmlWriter->endElement(); // end item
			}
		}
	}

	private function getDescription($item = null) {
		if ($item) {
			return $this->render('_description', array('item' => $item), true);
		}
		return false;
	}

	private function getDateFormat($date = null) {
		if (!$date)
			$date = date("r");

		return  date('D, d M Y H:i:s O', $date);
	}
}