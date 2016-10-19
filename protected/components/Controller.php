<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
define("DEFAULT_CURRENCY", "UAH");
define("DEFAULT_COUNTRY", "Ukraine");
class Controller extends CController
{

	   public $layout='//layouts/main';

        public $breadcrumbs=array();
        public $adminTitle = '';
        public $pageKeywords;
        public $pageDescription;
        public $infoPages = array();
        public $currencies;
        public $cities = array();
        public $geoCity;
        public $geoCountry;
        public $isMobile = false;
        public $languages = array();
        public $currentLang;
        public $menu = array();
        public $seoCity = null;
        public $cityUrl;
        public $scity;

        
        public $apInComparison = array();
        private $_assetsBase;
        
        public function filters()
        {
            return array(
                array(
                    'COutputCache',
                    'duration'=>100,
                    'varyByParam'=>array('id'),
                ),
            );
        }

        public function init() {
            parent::init();

header('Cache-Control: no-cache');
header('Pragma: no-cache');
           // $expires = 3600;  
            ///header("Content-Type: text/html; charset: UTF-8");
            //header("Cache-Control: max-age={$expires}, public, s-maxage={$expires}");
            //header("Pragma: ");
           // header('Expires: ' . gmdate('D, d M Y H:i:s', time() + $expires) . ' GMT');
            
            /*if(Yii::app()->request->getParam('mobile')) {
                Yii::app()->theme = 'mobile';
            }*/
             ///else {
            if(!$this->detectMobile()) {
                //if(!$this->isMobile){
                
            }
           // }
Yii::app()->bootstrap->registerCoreCss();
                Yii::app()->bootstrap->register();
            $this->initGeo();
            $this->pageTitle =  CHtml::encode(Yii::t('index', 'Title main'));
            Yii::app()->name =  CHtml::encode($this->pageTitle);
            $this->pageKeywords =  CHtml::encode(Yii::t('index', 'Meta keywords'));
            $this->pageDescription =  CHtml::encode(Yii::t('index', 'Meta description'));
            
            $this->currencies = $this->currencies();

            if(Yii::app()->user->getState('isAdmin')){
                $path = str_replace('.html','' , Yii::app()->request->requestUri);
            }
            // comparison list
            if (issetModule('comparisonList')) {
                if (!Yii::app()->user->isGuest) {
                    $resultCompare = ComparisonList::model()->findAllByAttributes(
                        array(
                            'user_id' => Yii::app()->user->id,
                        )
                    );
                     
                } else {
                    $resultCompare = ComparisonList::model()->findAllByAttributes(
                        array(
                            'session_id' => Yii::app()->session->sessionId,
                        )
                    );
                }

                if (!empty($resultCompare)) {
                    foreach($resultCompare as $item) {
                        $this->apInComparison[] = $item->apartment_id;
                    }
                }
            }
            $this->cities = City::model()->with('city_description')->cache(param('cachingTime', 1209600))->findAll(array('order'=>'name ASC'));
        }

        public function decrypt($string = '') {
            if($string) {
                if(($key = pack("H*", param('hexKey', 1))) && ($iv =  pack("H*", param('hexIv', 1)))) {
                    return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, base64_decode($string), MCRYPT_MODE_CBC, $iv));
                }
            }
            return false;

        }


        public function getAssetsBase()
        {
                if ($this->_assetsBase === null) {
                        $this->_assetsBase = Yii::app()->assetManager->publish(
                                Yii::app()->theme->basePath."/assets/",
                                false,
                                -1,
                                defined('YII_DEBUG') && YII_DEBUG
                        );
                }
                return $this->_assetsBase;
        }


        private function initGeo() {
            $geoIp = new EGeoIP(); 
            $geoIp->locate($this->getIpAddress());

            if(!empty($geoIp)) {  
                $this->geoCountry = $geoIp->countryName;
                $this->geoCity = $geoIp->city;
                if(is_null(Yii::app()->session['currency'])) {
                    if(isset($geoIp->currencyCode) && !is_null($geoIp->currencyCode) && !isset(Yii::app()->session['currency'])) {
                        if(in_array($geoIp->currencyCode, array('UAH','USD','EUR')))
                            Yii::app()->session['currency'] = $geoIp->currencyCode;                        
                    } else
                        Yii::app()->session['currency'] = DEFAULT_CURRENCY;
                } 

            } 

            $this->updateCityUrl();   
        }

        protected function getIpAddress() {

            foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
                if (array_key_exists($key, $_SERVER) === true) {
                    
                    $tmp = explode(',', $_SERVER[$key]);
                    foreach ($tmp as $ip) {
                        if (filter_var($ip, FILTER_VALIDATE_IP) !== false) {
                            return $ip;
                        }
                    }
                }
            }
        }

        protected function updateCityUrl(){
            if(isset(Yii::app()->session['cityUrl']) && Yii::app()->session['cityUrl'])
                $this->cityUrl = Yii::app()->session['cityUrl'];
            return true;
        }
        
        private function currencies() { 
            $criteria = new CDbCriteria();
            $criteria->condition = 'active=:active';
            $criteria->params = array(':active'=>1);
            $result = Currency::model()->findAll($criteria);
            $currency = Yii::app()->session['currency'];
            $this->currentLang = Yii::app()->db->createCommand("SELECT name FROM {{language}} WHERE code='".Yii::app()->language."'")->queryScalar(); 
            $currencies = array('label' => Yii::t('index', $currency).' '.CurrencymanagerModule::t($currency). ' / ' .$this->currentLang, 'url' => '#');
            foreach($result as $row){
                if(($currency!=$row->currency_code))
                    $currencies['items'][] = array('label' => Yii::t('index', $row->currency_code).' '.CurrencymanagerModule::t($row->currency_code), 'url' => 'javascript:setcurrency("'.$row->currency_code.'");', 'itemOptions' => array('class' => 'none'));
            }
            $currencies['items'][] = '---';
            foreach(($this->languages = Lang::getActiveLangs(true)) as $lang) {
                if($lang['code'] != Yii::app()->language)
                    $currencies['items'][] = array('label' => $lang['name'], 'url' => Yii::app()->controller->createLangUrl($lang['code']), 'icon' => $lang['code'], 'itemOptions' => array('class' => 'none'));
            }
            return $currencies;
        }

        public function __construct($id,$module=null){
         
            parent::__construct($id,$module);
            // If there is a post-request, redirect the application to the provided url of the selected language 
            
            // Set the application language if provided by GET, session or cookie
            if(isset($_REQUEST['lang'])) {
                Yii::app()->language = $_REQUEST['lang'];
                Yii::app()->user->setState('_lang', $_REQUEST['lang']); 
                $cookie = new CHttpCookie('_lang', $_REQUEST['lang']);
                $cookie->expire = time() + (60*60*24*365); // (1 year)
                Yii::app()->request->cookies['_lang'] = $cookie; 
            }
            else if (Yii::app()->user->hasState('_lang'))
                Yii::app()->language = Yii::app()->user->getState('_lang');
            else if(isset(Yii::app()->request->cookies['_lang']))
                Yii::app()->language = Yii::app()->request->cookies['_lang']->value;

            $this->setLocale(); 
        }

        private function setLocale() {
            setlocale(LC_TIME, "");
            switch (Yii::app()->language) {
                case 'uk':
                    setlocale(LC_ALL,'uk_UA.utf8');
                    break;

                case 'ru':
                    setlocale(LC_ALL,'ru_RU.utf8');
                    break;

                default:
                    break;
            }
        }
        
        public static function getCurrentRoute(){
            $moduleId = isset(Yii::app()->controller->module) ? Yii::app()->controller->module->id.'/' : '';
            return trim($moduleId.Yii::app()->controller->getId().'/'.Yii::app()->controller->getAction()->getId());
        }
        
        
        public function createLangUrl($lang='en', $params = array()){
            if(issetModule('seo') && isset(SeoFriendlyUrl::$seoLangUrls[$lang])){
                if (count($params))
                    return SeoFriendlyUrl::$seoLangUrls[$lang].'?'.http_build_query($params);

                return SeoFriendlyUrl::$seoLangUrls[$lang];
            }

            $route = Yii::app()->urlManager->parseUrl(Yii::app()->getRequest());
            $params = array_merge($_GET, $params);
            $params['lang'] = $lang;
            return $this->createUrl('/'.$route, $params);
        }
        
        public function createMultilanguageReturnUrl($lang='en'){
            if (count($_GET)>0){
                $arr = $_GET;
                $arr['language']= $lang;
            }
            else 
                $arr = array('language'=>$lang);
            return $this->createUrl('', $arr);
        }

        public function detectMobile() { 
            $detect = Yii::app()->mobileDetect;
            $mobileSize = isset(Yii::app()->request->cookies['mobile']->value) ? Yii::app()->request->cookies['mobile']->value : true;
            if($mobileSize) {
                if($detect->isMobile() || $detect->isTablet() || $detect->isIphone()) {
                    $this->isMobile = true;
                   
                    Yii::app()->theme = 'mobile';
                    return true;
                }
            } else
                return false;
        }

        public static function returnStatusHtml($data, $tableId, $onclick = 0, $ignore = 0, $field = 'active'){
        if($ignore && ((is_array($ignore) && in_array($data->id, $ignore)) || $data->id == $ignore)){
            return '<div align="center">'.
                $img = CHtml::image(
                    Yii::app()->theme->getBaseUrl().'/assets/images/'.($data->{$field}?'':'in').'active_grey.png',
                    Yii::t('common', $data->active?'Active':'Inactive')).
                '</div>';
        }
        $url = Yii::app()->controller->createUrl("activate", array("id" => $data->id, 'action' => ($data->{$field}==1?'deactivate':'activate'), 'field'=>$field ));
        $img = CHtml::image(
                    Yii::app()->theme->getBaseUrl().'/assets/images/'.($data->{$field}?'':'in').'active.png',
                    Yii::t('common', $data->{$field}?'Active':'Inactive'),
                    array('title' => Yii::t('common', $data->{$field}?'Deactivate':'Activate'))
                );
        $options = array();
        
        if($onclick){
            $options = array(
                'onclick' => 'ajaxSetStatus(this, "'.$tableId.'"); return false;',
            );
        }
        return '<div align="center">'.CHtml::link($img,$url, $options).'</div>';
    }

    public static function returnControllerStatusHtml ($data, $tableId, $onclick = 0, $ignore = 0) {
        if (param('useUserads', 1)) {
            return self::returnModerationStatusHtml($data, $tableId, $onclick = 0, $ignore = 0);
        }
        return self::returnStatusHtml($data, $tableId, $onclick = 0, $ignore = 0);
    }

    public static function returnModerationStatusHtml($data, $tableId, $onclick = 0, $ignore = 0){
        $moderationStatuses = Apartment::getModerationStatusArray();

        if($data->user_id == 1){
            //unset($moderationStatuses[2]);
        }

        $items = CJavaScript::encode($moderationStatuses);

        /*$items = '{';
        if (is_array($moderationStatuses) && count($moderationStatuses) > 1) {
            $count = count($moderationStatuses);
            $i = 1;
            foreach ($moderationStatuses as $key => $value) {
                if ($i == $count) {
                    $items .= '\"'.$key.'\" : \"'.$value.'\"';
                }
                else {
                    $items .= '\"'.$key.'\" : \"'.$value.'\",';
                }
                $i++;
            }
        }
        $items .= '}';*/

        $options = array(
            'onclick' => 'ajaxSetModerationStatus(this, "'.$tableId.'", "'.$data->id.'", "'.$data->user_id.'", "'.$items.'"); return false;',
        );

        return '<div align="center" class="editable_select" id="editable_select-'.$data->id.'">'.CHtml::link($moderationStatuses[$data->active], '#' , $options).'</div>';

    }

}
