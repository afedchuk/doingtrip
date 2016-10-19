<?php
class MainController extends ModuleUserController {
    public function actionIndex()
    { 
        Yii::app()->getModule('apartments');
        Yii::app()->getModule('regions');
        
        $url = array();
        if(isset($_POST['city']) && $_POST['city']) { 
            $model = City::model()->with(array('city_description' => array('resetScope'=>true)))->find('city_description.name=:name', array(':name' => $_POST['city']));
            if(!$model)
                $this->redirect(Yii::app()->request->urlReferrer);
            if(isset($_POST['dates']) && $_POST['dates']) {
                $check_dates = explode('-', $_POST['dates']);
                $url['check_in'] = isset($check_dates[0]) ? date("Y-m-d", strtotime($check_dates[0])) : 0;
                $url['check_out'] = isset($check_dates[1]) ? date("Y-m-d", strtotime($check_dates[1])) : 0;
                
            }
            $this->redirect(Yii::app()->createUrl('apartments', array('city' => $model->url, 'property_search' => $url)));
        }

        $special = Apartment::model()->with(array('description','images'))->find('is_special_offer=:is_special_offer',array(':is_special_offer' => 1));
  
        $criteria = new CDbCriteria();
        $criteria->condition = "apartments.owner_active = 1 AND apartments.active = 1";
        $city = City::model()->with(array('apartments','city_description'))->cache(param('cachingTime', 1209600))->findAll($criteria, array('order'=>'name ASC'));
        $this->render('index', array('city' => $city, 'item' => $special));
    }

    public function actionShow() {
        Yii::app()->request->cookies['mobile'] = new CHttpCookie('mobile', false);
        $this->redirect(Yii::app()->request->urlReferrer);
    }

    
    public function actionSearch($query = '') {
      if (Yii::app()->request->isAjaxRequest && trim($query) != '') {
            $lang = 'en';
            if(($encode = mb_detect_encoding($query )) && $encode == 'UTF-8')
                $lang = Yii::app()->language;
            $cities = Yii::app()->db->createCommand()
                    ->join('{{city}} city', 'city.id=city_id')
                    ->select('name, city_id')
                    ->from('{{city_description}}')
                    ->where('lang=:lang AND (name LIKE :match OR city.url LIKE :match)') //where($condition, $params)
                    ->bindValue(":lang", $lang)  
                    ->bindValue(":match", $query . '%')  
                    ->queryAll();

            $result = array();
            if(!empty($cities)) {
                foreach ($cities as $key => $value) {
                    $result[] = $value['city_id'].'|'.$value['name'];
                }
            }

            Yii::trace(print_r(CJSON::encode($result, JSON_UNESCAPED_UNICODE), true));
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            Yii::app()->end();
      }

      if(isset($_POST['city']) && $_POST['city']) {
            $city = City::model()->findByPk($_POST['city_id']);
            if($city != false){ $url =[];
                if(isset($_POST['dates']) && $_POST['dates']) {
                    $dates = explode(' - ', $_POST['dates']); 
                    if($dates[0])
                         $url['check_in'] = date("Y-m-d", strtotime($dates[0]));
                    if($dates[1])
                         $url['check_out'] = date("Y-m-d", strtotime($dates[1]));
                }
                $this->redirect(Yii::app()->createUrl('apartments', (!empty($url) ? array('city' => $city->url, 'property_search' => $url) : array('city' => $city->url))));
            } else
                $this->redirect(Yii::app()->request->urlReferrer);
        }

      echo '0';
    }

    public function actionapArtmentsSearch($query = '') {
        if (Yii::app()->request->isAjaxRequest && trim($query) != '') {
            $lang = 'en';
            if(($encode = mb_detect_encoding($query )) && $encode == 'UTF-8')
                $lang = Yii::app()->language;

            $apartments = Yii::app()->db->createCommand()
                    ->join('{{apartment_description}} description', 'description.apartment_id=apartment.id')
                    ->join('{{city_description}} city', 'city.city_id=apartment.city_id')
                    ->select('apartment.id, description.title, description.address, city.name')
                    ->from('{{apartment}} as apartment')
                    ->where('city.lang=:lang AND apartment.active=1 AND apartment.owner_active=1 AND description.lang=:lang AND (description.title LIKE :match)') 
                    ->bindValue(":lang", $lang)  
                    ->bindValue(":match", $query . '%')  
                    ->queryAll();

            $result = array();
            if(!empty($apartments)) {
                foreach ($apartments as $key => $value) {
                    $result[] = $value['id'].'|'.$value['title'].CHtml::tag('span', array(), $value['name'].', '.$value['address']);
                }
            }

            Yii::trace(print_r(CJSON::encode($result, JSON_UNESCAPED_UNICODE), true));
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            Yii::app()->end();
        }

        if(isset($_POST['apartment_id']) && $_POST['apartment_id']) {
            $apartment = Apartment::model()->isValidApartment($_POST['apartment_id']);
            if($apartment != false && $apartment > 0){
                $description = Description::model()->with(array('apartment'=>array('city')))->lang()->find('apartment_id=:apartment_id', array(':apartment_id' => $apartment));
                $this->redirect(Yii::app()->createAbsoluteUrl('/apartments/main/view', array(
                    'id' => $apartment,
                    'city' => $description->apartment->city['url'],
                    'title' => setTranslite($description['title'])
                )));
            } else
                $this->redirect(Yii::app()->request->urlReferrer);
        }

        echo '0';
    }
    
    public function actionSitemap() 
    {
        $model = new City();
       
        $this->pageTitle = Yii::t('index', 'Map site') . ' - '. $this->pageTitle; 
        $this->render('sitemap', array('cities' => City::sitemap(), 'model'=>$model));
    }
	
    public function actionSitemapxml() {
        $apartments = array(); $cities = array();
        $news = array(); $pages = array();

        // get cities 
        $result = City::model()->with('city_description')->cache(param('cachingTime', 1209600),  City::getDependency())->findAll();
        foreach($result as $city) {
            $cities[] = Yii::app()->createAbsoluteUrl('apartments', array('city' => $city->url));
           
        }

        // get apartments
        $result = Apartment::model()->with(array('description', 'city'))->findAll('active=1 AND owner_active=1', array('order' => 'date_created DESC'));

        foreach($result  as $apartment) {
            if(isset($apartment->city_id)) {
                $city_name = City::getCityName($apartment->city_id);
                if(isset($apartment->description->title)) {
                    $apartments[] = array('url' =>  $apartment->getUrl($apartment->id, $apartment->description->title,  $city_name),
                                          'lastmod' => $this->lastmod($apartment->date_updated));
                }
            }
        }

        // get news
        $result = News::model()->findAll();
        if($result !== false) {
            foreach($result as $new) {
                $news[] = array('url' => $new->getUrl(),
                                'lastmod' => $this->lastmod($apartment->date_updated));
            }
        }

        $result = Page::model()->findAll();
        if($result !== false) {
            foreach($result as $page) {
                $pages[] = array('url' => Page::getUrl($page->page_id),
                                'lastmod' => $this->lastmod($page->date_updated));
            }
        }

        header('Content-Type: application/xml');
        $this->renderPartial('sitemapxml',array('apartments'=>$apartments,
                                                'cities' => $cities,
                                                'news' => $news, 'pages' => $pages));
    }

    public function actionFeed() {
        $criteria = new CDbCriteria();
        $criteria->condition = "owner_active = 1 AND active = 1";
        $this->render('feed', array('criteria' => $criteria));
    }

    public function lastMod($date) {
        $lastmod = date('Y-m-d\TH:i:s',  strtotime($date)); 
        $tzd = date('Z'); 
        $lastmod .= ($tzd < 0)? "-".gmdate('H:i', -$tzd) : "+".gmdate('H:i', $tzd);
        return $lastmod;
    }

}

?>
