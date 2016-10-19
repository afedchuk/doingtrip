<?php

class CustomUrlManager extends CUrlManager {

    private $ext = '';
    private $_secureMap;
    
    /**
     * @var string the host info used in non-SSL mode
     */
    public $hostInfo = 'http://localhost';
    /**
     * @var string the host info used in SSL mode
     */
    public $secureHostInfo = 'https://localhost';
    /**
     * @var array list of routes that should work only in SSL mode.
     * Each array element can be either a URL route (e.g. 'site/create') 
     * or a controller ID (e.g. 'settings'). The latter means all actions
     * of that controller should be secured.
     */
    public $secureRoutes = array();

    public function init() {
        $langs = Lang::getActiveLangs();

        $countLangs = count($langs);

        $langRoute = ($countLangs > 1 || ($countLangs == 1 && param('useLangPrefixIfOneLang'))) ? '<lang:'.implode('|',$langs).'>' : '';
        $rules = array(
            '<lang>/<module:\w+>/backend/<controller:\w+>/<action:\w+>'=>'<module>/backend/<controller>/<action>',
            $langRoute . '/page/<title:[-a-zA-Z0-9_+\.]{1,255}>-<id:\d+>'=>'pages/main/view',
            $langRoute . '/news'=>'news/main/index',
            $langRoute . '/rss'=>'main/feed',
            $langRoute . '/sitemap'=>'main/sitemap',
			$langRoute . '/sitemapxml'=>'main/sitemapxml',
            $langRoute . '/news/<title:[-a-zA-Z0-9_+\.]{1,255}>-<id:\d+>'=>'news/main/view',
            $langRoute . '/faq' => 'articles',
            $langRoute . '/contact-us' => 'contactform',
            $langRoute . '/cities'=>'regions/main/cities',
            $langRoute . '/apartments-page-<page:[-a-zA-Z0-9_+\.]{1,255}>'=>'apartments/main/index',
            $langRoute . '/<city:[-a-zA-Z0-9_+\.]{1,255}>/apartments-page-<page:[-a-zA-Z0-9_+\.]{1,255}>'=>'apartments/main/index',
            $langRoute . '/apartments/booking/detail'=>'booking/main/bookingdetail',
            $langRoute . '/apartments/booking/restore'=>'booking/main/bookingrestore',
            $langRoute . '/apartments/booking/<id:\d+>/user/<user_id:\d+>/response'=>'booking/main/response',
            $langRoute . '/apartments/booking/<title:[-a-zA-Z0-9_+\.]{1,255}>-<id:\d+>'=> 'booking/main/bookingform',
            $langRoute . '/apartments/complaint/<title:[-a-zA-Z0-9_+\.]{1,255}>-<id:\d+>' => 'booking/main/complaintapartment',
            //$langRoute . '/apartments/showphone/<id:\d+>/<text:[-a-zA-Z0-9_+\.]{1,255}>/<width:\d+>/<font:\d+>/<height:\d+>/<size:\d+>/<offset:\d+>' => 'apartments/main/generatephone',
            $langRoute . '/apartments/related'=>'relatedoffers/main',
            $langRoute . '/apartments/comparison' => 'comparisonList/main/index',
            $langRoute . '/apartments/avalibility' => 'apartments/main/avalibility',
            $langRoute . '/apartments/new' => 'apartments/main/new',
            $langRoute . '/apartments/print/<title:[-a-zA-Z0-9_+\.]{1,255}>-<id:\d+>'=>'apartments/main/print',
            $langRoute . '/<city:[-a-zA-Z0-9_+\.]{1,255}>/apartments/<title:[-a-zA-Z0-9_+\.]{1,255}>-<id:\d+>'=>'apartments/main/view',
            //$langRoute . '/'.ApartmentsModule::t('Seo url city catalog').'-<city:[-a-zA-Z0-9_+\.]{1,255}>'=> 'apartments/main/index',
            $langRoute . '/<city:[-a-zA-Z0-9_+\.]{1,255}>/apartments'=> 'apartments',
			$langRoute . '/comments/<id:\d+>/new'=> 'comments/main/add',
            $langRoute . '/message/<message_id:\d+>/view'=> 'message/view',
            $langRoute . '/auth/<service:[-a-zA-Z0-9_+\.]{1,255}>' => 'user/main/login',
            $langRoute . '/user/login' => 'user/main/login',

            $langRoute . '/user/logout' => 'user/main/logout',
            $langRoute . '/user/registration' => 'user/main/registration',
            $langRoute . '/user/recovery' => 'user/main/recovery',
            $langRoute . '/user/activation/<activkey:[-a-zA-Z0-9_+\.]{1,255}>' => 'user/activation/activation',
            
            $langRoute . '/cabinet' => 'user/profile',
            $langRoute . '/cabinet/update' => 'user/profile/edit',
            $langRoute . '/cabinet/changepassword' => 'user/profile/changepassword',
            $langRoute . '/cabinet/free/<id:\d+>' => 'user/profile/freedates',
            $langRoute . '/cabinet/comments/<id:\d+>' => 'comments/main/apartmentComments',
            $langRoute . '/cabinet/requests' => 'user/profile/requests',
            $langRoute . '/cabinet/complaints' => 'user/profile/complaints',
            $langRoute . '/cabinet/apartment/new' => 'user/profile/createApartment',
            $langRoute . '/cabinet/apartment/update/<id:\d+>' => 'user/profile/editApartment',
            $langRoute . '/cabinet/apartment/services/<id:\d+>' => 'user/profile/servicesApartment',
            $langRoute . '/cabinet/apartment/remove/<id:\d+>' => 'user/profile/deleteApartment',
            $langRoute . '/cabinet/apartment/activate/<id:\d+>' => 'user/profile/activateApartment',
            $langRoute . '/cabinet/apartment/top/<title:[-a-zA-Z0-9_+\.]{1,255}>-<id:\d+>' => 'user/profile/toTop',
            $langRoute . '/cabinet/booking/change-booking-<id:\d+>'=>'booking/main/change',
            $langRoute . '/cabinet/booking/show-map-<id:\d+>'=>'booking/main/showmap',
            $langRoute . '/cabinet/booking/show-photos-<id:\d+>'=>'booking/main/showphotos',
            $langRoute . '/cabinet/booking/cancel-booking-<id:\d+>'=>'booking/main/cancelbooking',
            $langRoute . '/images/upload-<id:\d+>-<tmp:\d+>'=>'images/main/upload',
            $langRoute . '/images/get-images-<id:\d+>-<tmp:\d+>'=>'images/main/getImagesForAdmin',
            $langRoute . '/images/delete-image-<id:\d+>'=>'images/main/deleteImage',
            $langRoute . '/<_m>/<_c>/<_a>*' => '<_m>/<_c>/<_a>',
            $langRoute . '/<_c>/<_a>*' => '<_c>/<_a>',
            $langRoute . '/<_c>' => '<_c>'

        );

        if($langRoute){
            $rules[$langRoute] = '';
        }

        $this->addRules($rules);
        return parent::init();
    }

    /**
     * @param string the URL route to be checked
     * @return boolean if the give route should be serviced in SSL mode
     */
    protected function isSecureRoute($route)
    {
        if ($this->_secureMap === null) {
            foreach ($this->secureRoutes as $r) {
                $this->_secureMap[strtolower($r)] = true;
            }
        }
        $route = strtolower($route);
        if (isset($this->_secureMap[$route])) {
            return true;
        } else {
            return ($pos = strpos($route, '/')) !== false 
                && isset($this->_secureMap[substr($route, 0, $pos)]);
        }
    }

    public function createUrl($route, $params = array(), $ampersand = '&') {
        
        $langs = Lang::getActiveLangs();
        $countLangs = count($langs);
        if(Yii::app()->user->getState('isAdmin')) {
            if(is_array($params) && !empty($params)) {
                $requestParams = explode('?', Yii::app()->request->url);
                if(isset($requestParams[1])) {
                    $requestParams = explode('&', $requestParams[1]);
                    foreach ($requestParams as $key => $value) {
                        $params = array_merge(array_combine(array(explode('=', $value)[0]), array(explode('=', $value)[1])), $params);
                    }
                }
            }
        }

        if (empty($params['lang']) && ($countLangs > 1 || ($countLangs == 1 && param('useLangPrefixIfOneLang')))) {
            $params['lang'] = Yii::app()->language;
        }
        
        $url = parent::createUrl($route, $params, $ampersand);

        if (strpos($url, 'http') === 0) {
            return $url;  
        }
        
        $secureRoute = $this->isSecureRoute($route);
        if (Yii::app()->request->isSecureConnection) {
            return $secureRoute ? $url : $this->hostInfo . $url;
        } else {
            return $secureRoute ? $this->secureHostInfo . $url : $url;
        }
    }
}
