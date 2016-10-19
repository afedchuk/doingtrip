<?php

class Notifier {
	private $_adminRules;
	private $_userRules;
	private $init = 0;
	public $lang;
    private $sendToAdmin = false;

    private $_params = array();

	public function init(){
        Yii::import('application.modules.notifier.models.NotifierModel');

        $this->setLang();
		$this->_adminRules = array(
			'onNewUser' => array(
				'fields' => array('email', 'firstname'),
				'url' => array(
					'/user/backend/main/admin',
				),
				'active' => param('module_notifier_adminNewUser', 1),
			),
			'onNewUserActivate' => array(
				'fields' => array('email', 'firstname'),
				'url' => array(
					'/user/backend/main/admin',
				),
				'active' => param('module_notifier_userNewUser', 1),
			),
			'onNewContactform' => array(
				'fields' => array('name', 'email', 'phone', 'body'),
				'active' => param('module_notifier_adminNewContactform', 1),
			),
			'onOfflinePayment' => array(
				'fields' => array('amount', 'currency_charcode'),
				'active' => param('module_notifier_adminNewPayment', 1)
			),
			'onRequestProperty' => array(
				'fields' => array('senderName', 'senderEmail', 'senderPhone', 'body', 'ownerName', 'ownerEmail', 'apartmentUrl'),
				'active' => param('module_request_property_send_admin', 1),
			),
			'onNewComment' => array(
				'fields' => array('rating', 'user_email', 'body', 'user_name'),
				'active' => param('module_notifier_userNewComment', 1),
			),
			'onNewApartment' => array(
				'fields' => array('id'),
				'active' => param('module_notifier_adminNewApartment', 1),
			),
			'onNewComplain' => array(
				'fields' => array('apartment_id', 'email', 'name', 'body'),
				'active' => param('module_notifier_adminNewComplain', 1),
			),
			'onNewReview' => array(
				'fields' => array('name', 'body'),
				'active' => param('module_notifier_adminNewReview', 1),
			)
		);

		$this->_userRules = array(
            'onNewBooking' => array(
				'fields' => array('username', 'username_order', 'comment', 'title', 'book_unique', 'pin', 'useremail', 'phone', 'date_start', 'date_end', 'apartment_id', 'owner_email'),
				'active' => param('module_notifier_adminNewBooking', 1),
			),
			'onNewBookingSender' => array(
				'fields' => array('username', 'comment', 'title', 'book_unique', 'pin', 'user_email', 'phone_apartment', 'date_start', 'date_end', 'apartment_id'),
				'active' => param('module_notifier_adminNewBooking', 1),
			),
			'onNewUser' => array(
				'fields' => array('email', 'usrPassword', 'firstname'),
				'active' => param('module_notifier_userNewUser', 1),
			),
			'onNewUserActivate' => array(
				'fields' => array('email', 'usrPassword', 'firstname', 'activateUrl'),
				'active' => param('module_notifier_userNewUser', 1),
			),
			'onUserActivation' => array(
				'fields' => array(),
				'active' => param('module_notifier_userNewUser', 1),
			),
			'onRecoveryPassword' => array(
				'fields' => array('email', 'temprecoverpassword'),
				'active' => 1,
			),
            'onNewComment' => array(
                'fields' => array('rating', 'user_email', 'body', 'user_name'),
                'active' => param('module_notifier_adminNewComment', 1),
            ),
			'onRequestProperty' => array(
                'fields' => array('senderName', 'senderEmail', 'senderPhone', 'body', 'ownerName', 'apartmentUrl', 'ownerEmail'),
                'active' => param('module_request_property_send_user', 1),
            ),
			'onNewAgent' => array(
                'fields' => array('username', 'email', 'phone'),
                'active' => param('module_notifier_new_agent', 1),
            ),
            'deactivateApartment'=> array(
				'fields' => array('title', 'firstname'),
				'active' => 1,
				'view' => '__deactivation_apartment',
				'layout' => 'system_notification'
			),
			'notifyCompanyRegister' => array(
				'fields' => array('firstname'),
				'active' => 1,
				'view' => '__notify_company_to_register',
				'layout' => 'system_notification'
			)
    	);

        $this->init = 1;
	}

	public function setLang(){
		if($this->lang)
			Yii::app()->setLanguage($this->lang);
	}

    public static function getRules(){
        $notify = new Notifier();
        $notify->init();

        return array(
            'admin' => $notify->_adminRules,
            'user' => $notify->_userRules,
        );
    }

	public function raiseEvent($eventName, $model, $params = array()){
        Yii::import('application.modules.notifier.models.NotifierModel');

        if($this->init == 0){
            $this->init();
        }

        $notifyModel = NotifierModel::model()->findByAttributes(array('event' => $eventName));

        if(!$notifyModel){
            return false;
        }

        $this->_params = $params;

        $forceEmail = $this->getFromParam('forceEmail');

        $to = '';
        if ($forceEmail) {
            $to = $forceEmail;
        } else {
           /* $user = $this->getFromParam('user');
            if ($user){
                $to = $user->email;
            }*/
        }
        if(isset($this->_userRules[$eventName]) && $to){
            $rules = $this->_userRules[$eventName];

            $rules['subject'] = $notifyModel->subject;
            $rules['body'] = $notifyModel->body;

            if($rules['active']){
                $this->_processEvent($rules, $model, $to, $params);
            }
            unset($notifyModel);
        }
        return true;
	}

    private function getFromParam($key){
        return isset($this->_params[$key]) ? $this->_params[$key] : NULL;
    }

	private function _processEvent($rule, $model, $to, $params = array()){
        $user = $this->getFromParam('user');
		$lang = 'admin';
		$body = '';
		if(isset($rule['body'])){
			$body = $rule['body'];
			$body = str_replace('{host}', Yii::app()->request->hostInfo, $body);
			$body = str_replace('{fullhost}', Yii::app()->getBaseUrl(true), $body);
			if(isset($rule['url']) && $model){
				$params = array();
				if(isset($rule['url'][1])){
					foreach($rule['url'][1] as $param){
						$params[$param] = $model->$param;
					}
					$params['lang'] = $lang;
				}
				$url = Yii::app()->controller->createUrl($rule['url'][0], $params);
				$body = str_replace('{url}', $url, $body);
			}

			if(isset($rule['fields']) && $model){
				foreach($rule['fields'] as $field){
                    $val = isset($model->$field) ? $model->$field : (isset($params[$field]) ? $params[$field] : '');//tc('No information');
                    $body = str_replace('{'.$field.'}', $val, $body);
				}
			}

			if(isset($rule['i18nFields']) && $model){
				foreach($rule['i18nFields'] as $field){
					$field_val = $model->$field;
					$body = str_replace('{'.$field.'}', (isset($field_val[$lang]) ? CHtml::encode($field_val[$lang]) : ''/*tc('No information')*/), $body);
				}
			}
			$body = str_replace("\n.", "\n..", $body);
		}

        if($body){
	        $mailer = Yii::app()->mailer;

            if (param('mailUseSMTP', 0)) {
	            $mailer->IsSMTP();
				$mailer->SMTPAuth = true;
           		$mailer->SMTPSecure='ssl';

	            $mailer->Host = param('mailSMTPHost', 'localhost');
	            $mailer->Port = param('mailSMTPPort', 25);

	            $mailer->Username = param('mailSMTPLogin');  // SMTP login
	            $mailer->Password = param('mailSMTPPass'); // SMTP password
            }

            $mailer->setFrom(param('systemEmail'), "4trip.com.ua");
		    $mailer->AddAddress($to);

            if(isset($rule['subject']))
	            $mailer->Subject = $rule['subject'];

	        if(isset($rule['view']))
	        	$mailer->Body = $mailer->getView($rule['view'], array('body' => $body), isset($rule['layout']) ? $rule['layout'] : null);
	        else
	        	$mailer->Body = $body;
	        $mailer->CharSet = 'UTF-8';
	        $mailer->IsHTML(true);
            if (!$mailer->Send()){
                throw new CHttpException(503, tt('message_not_send', 'notifier') . ' ErrorInfo: ' . $mailer->ErrorInfo);
                //showMessage(tc('Error'), tt('message_not_send', 'notifier'));
            }
            unset($mailer);
        }
	}

}