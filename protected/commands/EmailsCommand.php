<?php

class EmailsCommand extends CConsoleCommand {

	private $url;
    private $urlSearch;
    private $service;
    private $userAgent = null;
    private $curl;
    private $ip = null;
    private $port = null;

	public function run($args) {
        $this->curl = Yii::app()->curl;
        if(!empty($args) && isset($args[0])) {
            $method = "__$args[0]Init";
            if(method_exists($this,$method)){

                if(call_user_func(array($this,$method), $args)) {
                    $this->curl->setOption(CURLOPT_USERAGENT, $this->userAgent)
                               ->setOption(CURLOPT_PROXY, $this->ip)
                               ->setOption(CURLOPT_PROXYPORT, $this->port);
                }

            }
            if(method_exists($this,$args[0]))
                call_user_func(array($this, $args[0]), $args);
        }
    }

    private function writeEmails($emails, $city = '') {
        foreach($emails as $value) {
            $duplicate = Yii::app()->db->createCommand('SELECT id FROM ore_services_emails WHERE email LIKE "%'.$value['email'].'%"')->queryScalar();
            if($duplicate == false) {
                $sql = "INSERT INTO ore_services_emails (city, email, service, name) values (:city, :email, :service, :name)";
                $parameters = array(":email"=>$value['email'], ":city" => (isset($value['city']) ? $value['city'] : $city), ":service" => $this->service, ":name" => $value['name']);
                Yii::app()->db->createCommand($sql)->execute($parameters);
            }
        }
    }

    private function chas($args) {
        $ct = $this->__chasGetRegions();
        if(!empty($ct)) {
            $cities = $this->__chasGetCities($ct);
            if(!empty($cities)) {
                foreach($cities as $url) {
                    $emails = array();
                    $this->__chasGetApartments($this->url.$url, $emails);
                    if(!empty($emails))
                        $this->writeEmails($emails, $this->url.$url);
                }
            }
        }
    }

    private function __chasGetApartments($url, &$emails) {
        $output = $this->curl->get($url, array()); 
        if(strlen($output) > 0) { 
            $dom = new DOMDocument();
            @$dom->loadHTML($output);
            $xpath = new DomXPath($dom);
            $results = $xpath->query("//ul[@class='viborArend group']/li/a");
            $urls = array();
            foreach($results as $element) {
                $apartment = $this->curl->get($this->url.$element->getAttribute('href'), array());  
                if(strlen($apartment) > 0) {
                    $dom = new DOMDocument();
                    @$dom->loadHTML($apartment);
                    $xpath = new DomXPath($dom);
                    $item = $xpath->query("//a[@id='board_user_email']"); 
                    $name = $xpath->query("//caption[@class='punki']");
                    $city = $xpath->query("//h2/a/span[@class='orangeField']");
                    if($item->item(0)->getAttribute('data-id')) {
                        $email = $this->curl->get($this->url.'/scripts/user_email.php?id='.$item->item(0)->getAttribute('data-id'), array());
                        $emails[] = array('city' => $city->item(0)->nodeValue,
                                          'name' => $name->item(0)->nodeValue,
                                          'email'=> trim($email));
                    }
                }
                
            }  
        }
    }

    private function __chasGetCities($ct) {
        $cities = array();
        foreach($ct as $region) {
            $output = $this->curl->get($this->url.'/scripts/map.php?region='.$region, array());
            if(strlen($output) > 0) {
                $dom = new DOMDocument();
                @$dom->loadHTML($output);
                $xpath = new DomXPath($dom);
                $elements = $xpath->query("//ul/li/a"); 
                foreach($elements as $element) {
                    $cities[] = $element->getAttribute('href');
                }
            }
        }
        return $cities;
    }

    private function __chasGetRegions() {
        $ct = array();
        $output = $this->curl->get($this->url, array());
        if(strlen($output) > 0) {
            $dom = new DOMDocument();
            @$dom->loadHTML($output);
            $xpath = new DomXPath($dom);
            $elements = $xpath->query("//ul[@class='listciti listciti_img listciti_list']/li/a"); 
            foreach($elements as $element) {
                $ct[] = $element->getAttribute('rel2');
            }
        }
        return $ct;
    }

    private function __chasInit($args) {
        if(!empty($args)) {
            $this->url = 'http://domnachas.com.ua';
            $this->service = $args[0];
        }
        return true;
    }

    private function sutkiua($args) {
        $ct = $this->__sutkiuaGetCities();
        if(!empty($ct)) {
            foreach($ct as $url) {
                $apartments = array(); $emails = array();
                $this->__sutkiuaGetApartments($this->url.$url, $apartments);
            }
        }
    }

    private function __sutkiuaGetCities() {
        $ct = array();
        $output = $this->curl->get($this->url.'/sitemap', array());
        if(strlen($output) > 0) {
            $dom = new DOMDocument();
            @$dom->loadHTML($output);
            $xpath = new DomXPath($dom);
            $elements = $xpath->query("//ul[@type='circle'][1]/li/a"); 
            foreach($elements as $element) {
                $ct[] = $element->getAttribute('href');
            }
            unset($ct[0], $ct[1]);
        }
        return $ct;
    }

    private function __sutkiuaGetApartments($url, &$aprtments) {
        $output = $this->curl->get($url, array());  
        if(strlen($output) > 0) {
            $dom = new DOMDocument();
            @$dom->loadHTML($output);
            $xpath = new DomXPath($dom);
            $last = $xpath->query("//div[@class='paginator']/a[last()]");
            $lastpage = 1;
            if($last->length > 0) {
                $last = parse_url($last->item(0)->getAttribute('href'));
                parse_str($last['query'], $query);
                $lastpage = $query['page'];
            }
            for($i = 1; $i <= $lastpage; $i++) {
                $output = $this->curl->get($url.'?page='.$i, array());  
                if(strlen($output) > 0) {
                    $dom = new DOMDocument();
                    @$dom->loadHTML($output);
                    $xpath = new DomXPath($dom);
                    $elements = $xpath->query("//div[@class='list_item_image_place ']/a"); 
                    $city = $xpath->query("//div[@class='breadcrumbs']/span[3]/a[@class='navigation']/span[@itemprop='title']");
                    if(!empty($elements)) {
                        foreach($elements as $element) {
                            $this->__sutkiuaEmailApartment($city->item(0)->nodeValue, $element->getAttribute('href'));
                        }

                    }
                }
            }  
        }
    }

    private function __sutkiuaEmailApartment($city, $url) {
        $emails = array();
        $output = $this->curl->get($this->url.$url, array());

        if(strlen($output) > 0) {
            $dom = new DOMDocument();
            @$dom->loadHTML($output);
            $xpath = new DomXPath($dom);
            $name = $xpath->query("//div[@style='padding: 4px;']");
            $email = $xpath->query("//div[@style='padding: 1px; color: #0A6081;']");
            if(!empty($email->item(0)->nodeValue)) {
                $emails[] = array('city' => $city,
                                  'name' => $name->item(0)->nodeValue,
                                  'email'=> trim($email->item(0)->nodeValue));
            }

            if(!empty($emails))
                $this->writeEmails($emails);
        }
        
    }

    private function __sutkiuaInit($args) {
        if(!empty($args)) {
            $this->url = 'http://sutki.ua';
            $this->service = $args[0];
        }
        return true;
    }


    private function sutka($args) {
        $ct = $this->__sutkaGetCities();
        if(!empty($ct)) {
            foreach($ct as $url) {
                $output = $this->curl->get($this->url.$url, array());  
                $apartments = array(); $emails = array();
                if(strlen($output) > 0) {
                    $this->__sutkaGetApartments($output, $apartments);
                    if(!empty($apartments)) {
                        foreach($apartments as $apartment)
                            $this->__sutkaEmailApartment($apartment, $emails);
                    }
                }

                if(!empty($emails))
                    $this->writeEmails($emails, $this->url.$url);
            }
        }

    }

    private function __sutkaInit($args) {
        if(!empty($args)) {
            $this->url = 'http://sutka.com.ua';
            $this->service = $args[0];
        }
        return true;
    }

    private function __sutkaGetCities() {
        $ct = array();
        $output = $this->curl->get($this->url, array());
        if(strlen($output) > 0) {
            $dom = new DOMDocument();
            @$dom->loadHTML($output);
            $xpath = new DomXPath($dom);
            $elements = $xpath->query("//div[@class='styp4']/a"); 
            foreach($elements as $element) {
                $ct[] = $element->getAttribute('href');
            }
        }
        return $ct;
    }

    private function __sutkaGetApartments($output, &$aprtments) {
        $dom = new DOMDocument();
        @$dom->loadHTML($output);
        $xpath = new DomXPath($dom);

        $elements = $xpath->query("//a[@class='fahref']"); 
        if(!empty($elements)) {
            foreach($elements as $element) {
                $aprtments[] = $element->getAttribute('href');
            }
        }
    }

    private function __sutkaEmailApartment($url, &$emails) {
        $output = $this->curl->get($url, array());
        if(strlen($output) > 0) {
            $dom = new DOMDocument();
            @$dom->loadHTML($output);
            $xpath = new DomXPath($dom);
            $elements = $xpath->query("//div[@id='cnt5']");
            $name = $xpath->query("//div[@id='cnt4']");
            if(!empty($elements->item(0)->nodeValue))
                $emails[] = array('name' => str_replace('Контактна особа: ', '', $name->item(0)->nodeValue),
                                  'email'=> trim($elements->item(0)->nodeValue));
        }
    }

    private function karpaty($args) {
        $ct = $this->__karpatyGetCities();
        if(!empty($ct)) {
            foreach($ct as $url) {
                $output = $this->curl->get($url, array());
                if(strlen($output) > 0) {
                    $this->_karpatyGetApartmentsUrl($output);
                }
            }
        }

    }

    private function _karpatyGetApartmentsUrl($output) {
        $dom = new DOMDocument();
        @$dom->loadHTML($output);
        $xpath = new DomXPath($dom);
        $t = $xpath->query("//div[@class='uheader3']"); 
        $elements = $xpath->query("//div[@class='AllOneTypeObjectHeader']/text()[.='Готелі, хостели, бази відпочинку, санаторії']"); 
        var_dump($elements);
        /*foreach($elements as $element) {
            
        }*/
     
    }

    private function __karpatyInit($args) {
        if(!empty($args)) {
            $this->url = 'http://www.karpaty.info/ua/uk/';
            $this->service = $args[0];
        }
        return true;
    }

    private function __karpatyGetCities() {
        $ct = array();
        $output = $this->curl->get($this->url, array());
        if(strlen($output) > 0) {
                $dom = new DOMDocument();
                @$dom->loadHTML($output);
                $xpath = new DomXPath($dom);
                $elements = $xpath->query("//div[@id='Menu2sl']/a"); 
                foreach($elements as $element) {
                        $cities = $this->curl->get('http://www.karpaty.info'.$element->getAttribute('href'), array());
                        if(strlen($cities) > 0) {
                            $dom = new DOMDocument();
                            @$dom->loadHTML($cities);
                            $xpath = new DomXPath($dom);
                            $elements = $xpath->query("//div[@id='Menu2tl']/a"); 
                            foreach($elements as $city) {
                                $ct[] = 'http://www.karpaty.info'.$city->getAttribute('href');
                            }
                        }
                        
                }
        }
        return $ct;
    }

    // Parse emails from vlasne.ua
    private function vlasne($args) {
        $getListOfApartments = array();
        $listCitiesUls = $this->__vlasneGetUrlsCities();
        if(!empty($listCitiesUls)) {
            foreach($listCitiesUls as $city=>$url) {
                $emails = array(); $apartments = array(); 
                $this->__vlasneGetProposalsCity($url, $apartments);
                if(!empty($apartments)) {
                    foreach($apartments as $info) {
                        $this->__vlasneGetInfoApartment($info, $emails); 
                        
                    }
                }

                if(!empty($emails))
                    $this->writeEmails($emails, $city);

                unset($emails);
                unset($apartments);
            }
        }
    }

    private function __vlasneGetUrlsCities() {
        $cities = array();
        if(!is_null($this->userAgent)) {
            $output = $this->curl->get($this->url, array());
            if(strlen($output) > 0) {
                $dom = new DOMDocument();
                @$dom->loadHTML($output);
                $xpath = new DomXPath($dom);
                $elements = $xpath->query("//*/div[@class='c']/a"); 

                if($elements->length > 0) {
                    foreach($elements as $link)
                        if(preg_match('[city]', $link->getAttribute('href')))
                            $cities[$link->nodeValue] = $link->getAttribute('href');
                }
            }
        }
        return $cities;
    }

    private function __vlasneGetProposalsCity($url, &$apartments) {
        $reault = $this->curl->get($this->url.$url, array());
        if(strlen($reault) > 0) {
            $dom = new DOMDocument();
            @$dom->loadHTML($reault); 
            $xpath = new DomXPath($dom);
            $pageUrl = $xpath->query("//*/a[@class='blue_arrow']/@href");
            foreach($xpath->query("//*/div[@class='image']/a/@href") as $city) {
                if(preg_match('[realt]', $city->nodeValue)) {
                    $apartments[] = $city->nodeValue;
                }
            }
            $elements = $xpath->query("//*/a[@class='blue_arrow']/@href");
            if($elements->length > 0) {
                $this->__vlasneGetProposalsCity($elements->item(0)->nodeValue, $apartments);
            }
        }
    }

    private function __vlasneGetInfoApartment($url, &$emails = array()) {
        $output = $this->curl->get($url, array());
        if(strlen($output) > 0) {
            $dom = new DOMDocument;
            @$dom->loadHTML($output);
            $xpath = new DomXPath($dom);
            $elements = $xpath->query("//*/li[@class='mail']/a");
            $href = $xpath->query("//*/li[@class='mail']/a/@href");
            $nameTmp = $this->curl->get($href->item(0)->nodeValue, array());
            $dom = new DOMDocument();
            @$dom->loadHTML($nameTmp);
            $xpath = new DomXPath($dom);
            $name = $xpath->query("//div[@class='container']/div/div[@class='grey']");
            foreach($elements as $element) {
                $emails[base64_encode(trim($element->nodeValue))] = array('name' => (isset($name->item(0)->nodeValue) ? trim($name->item(0)->nodeValue) : ''),
                                                                          'email'=>trim($element->nodeValue));
            }
        }
    }

    private function __vlasneInit($args) {
        if(!empty($args)) {
            $this->url = 'http://vlasne.ua';
            $this->service = $args[0];
            $this->ip = '107.151.152.218';
            $this->port = 80;
            $this->userAgent = 'Mozilla/5.0 (Linux; U; Android 4.0.3; ko-kr; LG-L160L Build/IML74K) AppleWebkit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30';
        }
        return true;
    }

    // Parse emails from mirkvartir.ua
    private function mirkvartir($args) {
        $this->__mirkvartirInit($args);
        $list = $this->__mirkvartirGetList($this->url);
        if(!empty($list)) { 
            $emails = array();
            foreach($list as $p) {
                $output = Yii::app()->curl->get($p, array());
                if(strlen($output) > 0) {
                    $dom = new DOMDocument();
                    @$dom->loadHTML($output);
                    $xpath = new DomXPath($dom);
                    $apList = $xpath->query('//td[@class="desc"]/strong/a');
                    foreach($apList as $ap) {
                        $this->__mirkvartirGetApartments('http://mirkvartir.ua'.$ap->getAttribute('href'), $emails);
                    }
                }

                if(!empty($emails))
                    $this->writeEmails($emails, '');
                $emails = array();
            }
        }
    }

    private function __mirkvartirGetList($url) {
        $output = Yii::app()->curl->get($url, array());
        if(strlen($output) > 0) {
            $dom = new DOMDocument();
            @$dom->loadHTML($output);
            $xpath = new DomXPath($dom);
            $last = $xpath->query('//ul[@class="pages"]/li[@class="last"]/a');
            $end = 0;
            foreach($last as $r)
                $end = substr($r->getAttribute('href'), strrpos($r->getAttribute('href'), '-') + 1, 4);
            $pages = array();
            if($end > 0) {
                for($i = 1; $i<=$end; $i++) {
                    $pages[] = 'http://mirkvartir.ua/offers/apartments-rent/2036/page-'.$i;
                }
                return $pages;
            }
        }
        return array();
    }

    private function __mirkvartirGetApartments($url, &$emails) {
        $output = Yii::app()->curl->get($url, array());
        if(strlen($output) > 0) {
            $dom = new DOMDocument();
            @$dom->loadHTML($output);
            $xpath = new DomXPath($dom);
            $email = $xpath->query('//ul[@class="extra-contacts"]/li[@class="mail"]/a');
            $name = $xpath->query('//ul[@class="contacts"]/li[3]');
            $city = $xpath->query('//ul[@class="path"]/li[2]');
            if($email->length > 0) {
                $emails[] = array('email' => $email->item(0)->nodeValue,
                                  'name' => ($name->length > 0  ? $name->item(0)->nodeValue : ''),
                                  'city' => ($city->length > 0  ? $city->item(0)->nodeValue : '')
                                  );
            }
        }
    }

    private function __mirkvartirInit($args) {
        if(!empty($args)) {
            $this->url = 'http://mirkvartir.ua/offers/apartments-rent/2036';
            $this->service = $args[0];
        }
    }

    // Parse emails from doba.ua
    private function doba($args) {
        $this->__dobaInit($args);
        $listCitiesUls = $this->__dobaGetUrlsCities();
        if($listCitiesUls) {  
            foreach($listCitiesUls as $city => $url) { 
                $emails = array(); $apartments = array(); 
                $this->__dobaGetProposalsCity($url, $apartments);
                if(!empty($apartments)) {
                    foreach($apartments as $urlCity)
                        $this->__dobaGetInfoApartment($urlCity, $emails); 

                    if(!empty($emails))
                        $this->writeEmails($emails, $city);

                    unset($emails);
                    unset($apartments);
                }
            }
        }
        
    }

    private function __dobaInit($args) {
        if(!empty($args)) {
            $this->url = 'http://doba.ua/';
            $this->service = $args[0];
        }
    }

    private function __dobaGetUrlsCities() {
        $output = Yii::app()->curl->get($this->url, array());
        $result = array();
        if(strlen($output) > 0) {
            $dom = new DOMDocument();
            @$dom->loadHTML($output);
            $cities = $dom->getElementsByTagName ('a');
            foreach($cities as $city) {
                if(($href = $city->getAttribute('href')) && preg_match('[cities]',$href)){
                    $result[$city->nodeValue] = $href;
                }   
            } 
        }
        return $result;
    }

    private function __dobaGetProposalsCity($url, &$apartments) {
        if($url) {
            $output = Yii::app()->curl->get($url, array());
            if(strlen($output) > 0) {
                $dom = new DOMDocument();
                @$dom->loadHTML($output);
                $xpath = new DomXPath($dom);
                $result = $xpath->query("//div[@class='flat-block-wrap']/a/@href"); 
                if($result->length > 0) {
                    foreach($result as $item)
                        $apartments[] = $item->nodeValue;
                }
            }
        }
    }

    private function __dobaGetInfoApartment($url, &$emails = array()) {
        $output = Yii::app()->curl->get($url, array());
        if(strlen($output) > 0) {
            $dom = new DOMDocument;
            $dom->loadHTML($output);
            $a = $dom->getElementsByTagName('a');
            $xpath = new DomXPath($dom);
            $name = $xpath->query("//div[@class='user-info']/h2"); 
            foreach($a as $anchor) {
               if ($anchor->hasAttribute('href')) {
                  $href = trim($anchor->getAttribute('href'));
                  if (substr($href, 0, 7) == 'mailto:') {
                        $emails[base64_encode(str_replace("mailto:", "", $href))] = array('name' => $name->item(0)->nodeValue,
                                                                                          'email'=>str_replace("mailto:", "", $href));
                  } 
               }
            }
        }
        
    }

    // Parse emails from domik.ua
    private function domik($args) {
        $this->__domikInit($args);
        $getListOfApartments = array();
        $listCitiesUls = $this->__domikGetUrlsCities();
        if($listCitiesUls) {  
            foreach($listCitiesUls as $city) { 
                $emails = array(); $apartments = array();
                $this->__domikGetProposalsCity(str_replace('{city}', $city, $this->urlSearch), $apartments);
                if(!empty($apartments)) {
                    foreach($apartments as $info) {
                        $this->__domikGetInfoApartment($this->url.$info, $emails); 
                    }
                }

                if(!empty($emails))
                    $this->writeEmails($emails, $city);

                unset($emails);
                unset($apartments);
            }
        }
    }



    private function __domikInit($args) {
        if(!empty($args)) {
            $this->url = 'http://domik.ua/';
            $this->urlSearch = 'http://domik.ua/nedvizhimost/{city}/snyat-dom-posutochno.html';
            $this->service = $args[0];
        }
    }

    private function __domikGetInfoApartment($url, &$emails = array()) {
        $output = Yii::app()->curl->get($url, array());
        if(strlen($output) > 0) {
            $dom = new DOMDocument();
            @$dom->loadHTML($output);
            $hDiv = $dom->getElementById('hContacts');  $item = '';
            $name = ucfirst($hDiv->childNodes->item(1)->childNodes->item(0)->nodeValue);
            if($hDiv->childNodes->item(3)->childNodes->item(0)->getAttribute('class') == 'url')
                $item = $hDiv->childNodes->item(3)->childNodes->item(1)->nodeValue;
            else {
                $item = $hDiv->childNodes->item(3)->childNodes->item(0)->nodeValue;
            }
            if(!in_array($item, array('Добавить отзыв о продавце'))) {
                $mail = str_replace(array('E-Mail: '), "", $item);
                $emails[base64_encode($mail)] = array('name' => $name,
                                                      'email'=>$mail);
            }
        }
        
    }

    private function __domikGetProposalsCity($url, &$apartments) {
        if($url) {
            $output = Yii::app()->curl->get($url, array());
            if(strlen($output) > 0) {
                $dom = new DOMDocument();
                @$dom->loadHTML($output);
                $xpath = new DomXPath($dom);
                $result = $xpath->query("//p[@class='tittle_obj']/a/@href"); 
                if($result->length > 0) {
                    foreach($result as $item)
                        $apartments[] = $item->nodeValue;
                }
                $elements = $xpath->query("//div[@class='sort_panel']/div[@class='fl_r']/p/a[@class='prev_next_text' and position()=last()]/@href"); 
                if(isset($elements->item(0)->nodeValue)) {
                    $this->__domikGetProposalsCity($this->url.$elements->item(0)->nodeValue, $apartments);
                }
            }
        }
    }


    private function __domikGetUrlsCities() {
    	$cities = array();
		$output = Yii::app()->curl->get($this->url.'nedvizhimost/', array());
        
		if(strlen($output) > 0) {

			$dom = new DOMDocument();
			@$dom->loadHTML($output);

			$xpath = new DomXPath($dom);
			$elements = $xpath->query("//table[@class='fin_table']/tbody/tr/td/a/@href"); 
			if($elements->length > 0) {
				foreach($elements as $link) {
					$cities[] = basename($link->nodeValue, '.html');
				}
			}
		}
    	return $cities;
    }

    
}
