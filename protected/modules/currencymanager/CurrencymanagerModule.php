<?php

class CurrencymanagerModule extends Module
{

	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'currencymanager.models.*',
			'currencymanager.components.*',
            'currencymanager.messages.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
    
    public static function t($str='',$params=array(),$dic='currencymanager') {
        return Yii::t("CurrencymanagerModule.".$dic, $str, $params);
    }

    public static function convertcurrency($price,  $short = 0, $to = 'UAH'){
        //find the to conversion rate
        if(isset(Yii::app()->session['currency'])) 
                $to = Yii::app()->session['currency'];
        $model = Currency::model()->findByAttributes(array('currency_code'=>$to, 'active'=>1));
        
        return CurrencymanagerModule::t(!$short ? $to.'_s' : ($short == 2 ? '{v}' : strtolower($to)), array('{v}' => round($model->conversion_rate*$price,0))) ;
    }
    
     public static function getRealIpAddr()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))
            //check ip from share internet
        {
            $ip=$_SERVER['HTTP_CLIENT_IP'];
        }
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
            //to check ip is pass from proxy
        {
            $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
            $ip=$_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

	public function setdefaultcurrency($currency=''){ 
        if(!Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404);
        $currency = strtoupper($currency);
        if($currency==''){
            Yii::import('application.modules.currencymanager.extensions.EGeoIP.EGeoIP');
            $geoIp = new EGeoIP();
            $userip = self::getRealIpAddr();
            $geoIp->locate($userip);
            if($geoIp->currencyCode!='' || $geoIp->currencyCode!=false || $geoIp->currencyCode!=null)
                Yii::app()->session['currency'] = $geoIp->currencyCode;
            else
                Yii::app()->session['currency'] = 'USD';
        }elseif($currency!=''){
            Yii::app()->session['currency'] = $currency;
            Yii::app()->user->setFlash('warning', CurrencymanagerModule::t('Currency changed meessage'));
        }
        return true;
    }
}
