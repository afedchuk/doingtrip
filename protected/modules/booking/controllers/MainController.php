<?php
class MainController extends ModuleUserController{
    public $modelName = 'Booking';

    protected function beforeAction($action) {
        if(Yii::app()->request->isAjaxRequest){
            Yii::app()->clientScript->scriptMap['bootstrap.css'] = false;
            Yii::app()->clientScript->scriptMap['bootstrap.min.css'] = false;
            Yii::app()->clientScript->scriptMap['bootstrap.min.js'] = false;
            Yii::app()->clientscript->scriptMap['jquery.js'] = false;
            Yii::app()->clientscript->scriptMap['jquery.min.js'] = false;
            //Yii::app()->clientscript->scriptMap['jquery-ui.min.js'] = false;
            //Yii::app()->clientscript->scriptMap['jquery-ui-i18n.min.js'] = false;
        }
        return parent::beforeAction($action);
    }
    public function actionBookingform(){
        if(!Yii::app()->request->isAjaxRequest && empty($_POST))
            $this->redirect(Yii::app()->createUrl('apartments/'));
        Yii::app()->getModule('apartments');
        $this->modelName = 'Apartment';
        $apartment = Apartment::model()->with(array('city', 'description'))->findByPk($_GET['id']);
        $this->modelName = 'Booking';
        $isGuest = false;
        if(Yii::app()->user->isGuest)
            $isGuest = true;

        $booking = new Booking();
        $booking->scenario = 'bookingform';
        if(isset($_POST['Booking'])){
            $booking->attributes=$_POST['Booking'];
            $booking->apartment_id = $apartment->id;
            if($booking->validate() && !isset($_POST['ajax'])){
                if(Yii::app()->user->isGuest)  
                    $user = $this->createUser($booking->useremail, $booking->firstname, $booking->lastname,  $booking->phone);
                else  {
                    $user = User::model()->findByPk(Yii::app()->user->id);
                    $user->type = 1;
                    $user->save(false);
                }

                if($isGuest){
                    $activation_url = Yii::app()->createAbsoluteUrl('/user/activation/activation',array("activkey" => $user['activkey']));
                    $notifier = new Notifier();
                    $notifier->raiseEvent('onNewUserActivate', User::model()->findByPk($user['id']), array(
                        'forceEmail' => $user['email'],
                        'usrPassword' => $user['password'],
                        'activateUrl' => $activation_url,
                    )); 
                }

                $booking->user_id = $apartment->user_id;
                $booking->sender_id = $user['id'];
                if($booking->save(false)){
                    unset($booking->useremail);
                    $user_request = User::model()->findByPk($apartment->user_id);
                    if($user_request) {
                        $notifier = new Notifier();
                        $notifier->raiseEvent('onNewBooking', $booking, array(
                            'username' => $user_request->firstname, 'apartment_id' => $apartment->id, 'phone' => $booking->phone,
                            'forceEmail' => $user_request->email, 'username_order' => $user['firstname'], 'owner_email' => $user['email'],
                            'title' => $apartment->description->title,
                        ));
                        unset($notifier);

                        if(strstr($user['email'], '@null.io') == false) {
                            $notifier = new Notifier();
                            $notifier->raiseEvent('onNewBookingSender', $booking, array(
                                'username' => $user['firstname'], 'apartment_id' => $apartment->id, 'phone_apartment' => implode(', ',array($apartment->phone, $apartment->phone_additional)),
                                'forceEmail' =>  $user['email'], 'user_email' => $user_request->email,
                                'title' => $apartment->description->title,
                            ));
                        }

                    }
                    Yii::app()->user->setFlash('success',  BookingModule::t('Operation successfully complete.'). ' '.BookingModule::t('Booking peding'));
                    $this->redirect($apartment->getUrl(null, 0 , $apartment->city->id));
                }
             }
            echo CActiveForm::validate($booking);
            Yii::app()->end();
        }
    
        if(Yii::app()->request->isAjaxRequest){
            $this->renderPartial('bookingform', array(
                'apartment' => $apartment,
                'model' => $booking,
                'isGuest' => $isGuest,

            ), false, true);
        } else
            throw new CHttpException(404);
        
    }

    public function actionChange($id) {
        if($id && !Yii::app()->user->isGuest) {
            $booking = Booking::model()->with('description')->find('t.id=:id AND t.sender_id=:sender_id', array(':id' => $id, ':sender_id' => Yii::app()->user->id));
            if($booking != false) {
                if(isset($_POST['Booking'])){
                    $booking->scenario = 'bookingform';
                    $booking->attributes=$_POST['Booking'];
                    if($booking->validate()) {
                        $booking->save(false);
                        Yii::app()->user->setFlash('success',  BookingModule::t('Booking changed'));
                        $this->redirect(Yii::app()->createUrl('/user/profile'));
                    }
                    echo CActiveForm::validate($booking);
                    Yii::app()->end();
                }
                if(Yii::app()->request->isAjaxRequest){
                    $this->renderPartial('changedates', array('model' => $booking), false, true);
                }
            }
        }
    }

    public function actionCancelBooking($id) {
        if($id && !Yii::app()->user->isGuest) {
            $booking = Booking::model()->with('description')->find('t.id=:id AND t.sender_id=:sender_id', array(':id' => $id, ':sender_id' => Yii::app()->user->id));
            if($booking != false) {
                if(isset($_POST['Booking']['confirm'])){
                    $booking->canceled = 1;
                    $booking->save(false);
                    Yii::app()->user->setFlash('success',  BookingModule::t('Booking changed'));
                }
                if(Yii::app()->request->isAjaxRequest){
                    $this->renderPartial('cancelbooking', array('model' => $booking), false, true);
                }
            }
        }
    }

    public function actionShowMap($id, $ap = false) {
        if($id && Yii::app()->request->isAjaxRequest) {
            if(!$ap) {
                $model = Booking::model()->with('apartment', 'description')->find('t.id=:id AND t.sender_id=:sender_id', array(':id' => $id, ':sender_id' => Yii::app()->user->id));
                if($model == false)
                    return false;
                $marker = $this->renderPartial('apartments.views.backend._marker', array('model' => $model->apartment));
                $this->renderPartial('showmap', array('model' => $model->apartment, 'description' => $model->description,  'marker' => $marker), false, true);
            } else  {
                $model = Apartment::model()->with('description')->find('t.id=:id', array(':id' => $id));
                $marker = $this->renderPartial('apartments.views.backend._marker', array('model' => $model));
                $this->renderPartial('showmap', array('model' => $model, 'description' => $model->description, 'marker' => $marker), false, true);
            }
        }
    }

    public function actionShowPhotos($id, $ap = false) {
        if($id && !Yii::app()->user->isGuest) {
            if($ap) {
                $model = Apartment::model()->with('description','images')->findByPk($id);
            } else {
                $booking = Booking::model()->find('t.id=:id AND t.sender_id=:sender_id', array(':id' => $id, ':sender_id' => Yii::app()->user->id));
                if($booking) {  
                    $model = Apartment::model()->with('description','images')->findByPk($booking->apartment_id);     
                }
            }

            if(Yii::app()->request->isAjaxRequest){
                $this->renderPartial('showphotos', array('model' => $model), false, true);
            } 
        }
    }

    public function actionComplaintApartment() {
            if(!Yii::app()->request->isAjaxRequest && !isset($_POST['Complaint']))
                $this->redirect(Yii::app()->createUrl('apartments/'));
            Yii::app()->getModule('apartments');
            Yii::app()->getModule('user');
            
            $this->modelName = 'Apartment';
            $apartment = Apartment::model()->with(array('city'))->findByPk($_GET['id']);
            $complaint = new Complaint();
            if(isset($_POST['Complaint'])){
                $complaint->attributes=$_POST['Complaint'];
                if(isset(Yii::app()->user->id) && Yii::app()->user->id) {
                        $model = User::model()->findByPk (Yii::app()->user->id);
                        if(!is_null($model)) {
                            $complaint->username = $model->username;
                            $complaint->email = $model->email;
                            $complaint->phone = $model->phone;
                        }
                }
                
                $complaint->apartment_id = $apartment->id;
                if($complaint->validate() && !isset($_POST['ajax'])) {
                    if($complaint->save(false)) {
                        $user = Apartment::model()->with(array('user'))->findByPk($apartment->id);

                        $message = new YiiMailMessage();          
                        $message->subject = BookingModule::t('Title complaint');
                        $message->view ='complaint_apartment';
                        $message->setBody(array('firstname' => $user->user->firstname,
                                                'user' => $complaint->username,
                                                'text' => $complaint->message,
                                                ),'text/html', 'utf-8');
                        $message->from = param('adminEmail', 'noreply@orenda.co.ua');
                        $message->setTo($user->user->email); 
                        Yii::app()->mail->send($message);
                        Yii::app()->user->setFlash('success', BookingModule::t('Success sent complaint'));
                        
                    }
                } 
                
                echo CActiveForm::validate($complaint);
                Yii::app()->end();
            }

            if(Yii::app()->request->isAjaxRequest){
                $this->renderPartial('complaintform', array(
                    'apartment' => $apartment,
                    'model' => $complaint,
                ), false, true);
            }

    }

    public function dateRange($first, $last, $step = '+1 day', $format = 'd/m/Y' ) { 
        $dates = array();
        $current = strtotime($first);
        $last = strtotime($last);
        while( $current <= $last ) { 

            $dates[] = date($format, $current);
            $current = strtotime($step, $current);
        }
        return $dates;
    }

    public function actionBookingdetail() {
        if(!Yii::app()->request->isAjaxRequest && empty($_POST))
            $this->redirect(Yii::app()->createUrl('apartments/'));
        $booking = new Booking(); $model = null;
        if(isset($_POST['Booking'])) {
            $data  = Yii::app()->request->getPost('Booking');
            $model = new Booking();
            $model->scenario = 'detail';
            if(!is_null($data['book_unique']) && !is_null($data['pin'])) {
                $model->attributes = $data;
                if($model->validate() && isset($_GET['checked']) && $_GET['checked'] == true) {
                    $model = Booking::model()->find('book_unique=:book_unique AND pin=:pin', 
                                         array(':book_unique' =>$data['book_unique'], ':pin' => $data['pin']));
                    $apartment = Apartment::model()->with('description')->findByPk($model->apartment_id);
                    $range = count($this->dateRange($model->date_start, $model->date_end));
                    $this->renderPartial('_detail', array('booking' => $booking, 'model' => $model, 'nights' => $range,  'apartment' => $apartment), false, true);
                    Yii::app()->end();  
                }            
            }
            echo CActiveForm::validate($model);
            Yii::app()->end();
       }
       $this->renderPartial('bookingdetail', array('booking' => $booking, 'model' => $model), false, true);
    }

    public function actionBookingRestore() {
        Yii::app()->clientscript->scriptMap['jquery.yiiactiveform.js'] = false;
        $booking = new Booking();
        $booking->scenario = 'restore';
        if(isset($_POST['Booking'])) { 
            $data  = Yii::app()->request->getPost('Booking');
            $userEmail = User::model()->findByAttributes(array('email' => $data['useremail']));
            if($userEmail && $userEmail->id) { 
                $booking->setAttribute('user_id', $userEmail->id);
            }
            echo CActiveForm::validate($booking);
            Yii::app()->end();
        }
        $this->renderPartial('_bookingrestore', array('booking' => $booking), false, true);
    }

    public function actionAprove($id) {
        if(Yii::app()->request->isAjaxRequest){
            $aproveRecord = Booking::model()->findByPk($id);
            if($aproveRecord) {
                $aproveRecord->status = 1; 
                if($aproveRecord->save(false))
                     Yii::app()->user->setFlash('success', BookingModule::t('Success aprove'));
            }  
        }
    }

    public function actionResponse($id, $user_id) {
        Yii::app()->getModule('apartments');
       
        $response = new Booking();
        $response->scenario = 'response';
        $booking = Booking::model()->with('apartment')->findByPk($id);
        $apartment = Apartment::model()->with(array('user', 'description', 'city'))->findByPk($booking->apartment_id);
        if(isset($_POST['Booking'])) {
            $response->attributes = $_POST['Booking'];
            if($response->validate()) { 
                if(!isset($_POST['ajax'])) {
                    $apartment = Apartment::model()->with(array('user', 'description', 'city'))->findByPk($booking->apartment_id);
                    $data = $apartment->attributes;
                    if(isset($apartment->user) && !is_null( $apartment->user))
                        $data = array_merge($apartment->attributes,  $apartment->user->attributes);

                    $data = array_merge(array_merge($data, $apartment->description->attributes), $booking->attributes);
                    $notifier = new Notifier;
                    
                    $notifier->_processEventData($user_id, $response->attributes, array('subject' => tt('New message from user', 'notifier'),
                                                                                        'template' => 'bookingResponse',
                                                                                        'href' => Apartment::model()->getUrl($apartment->id, $apartment->description->title, $apartment->city->name),
                                                                                        'apartment' =>  $data));
                    Yii::app()->user->setFlash('success', BookingModule::t('Success sent booking response'));
                    $this->redirect(Yii::app()->createUrl('/user/profile/requests', array('user'=>Yii::app()->user->username)));
                }
            }
            echo CActiveForm::validate($response);
            Yii::app()->end();
        }

        if(Yii::app()->request->isAjaxRequest){
                
                $this->renderPartial('response', array(
                    'model' => $response,
                    'apartment' => $apartment
                ), false, true);
        } 
            
    }

	public function createUser($email, $firstname = '',  $lastname = '', $phone = ''){
            
		$model = new User;
		$model->email = $email;
		if($firstname){
			$model->firstname = $firstname;
		}
                if($lastname){
			$model->lastname = $lastname;
		}
		if($phone){
			$model->phone = $phone;
		}
		$password = $model->randomString();
		$model->setPassword($password);
		$return = array();
		if($model->save()){
			$return = array(
                'type' => 1,
				'email' => $model->email,
				'firstname' => $model->firstname,
                'lastname' => $model->lastname,
				'password' => $password,
				'id' => $model->id,
                'activkey' => $model->activkey
			);
		}
		return $return;
	}

	public function getTimesIn(){    
		$sql = 'SELECT id, title FROM {{apartment_times_in}} WHERE lang="'.Yii::app()->language.'"';
		$results = Yii::app()->db->createCommand($sql)->queryAll();
		$return = array();
		if($results){
			foreach($results as $result){
				$return[$result['id']] = $result['title'];
			}
		}
		return $return;
	}

	public function getTimesOut(){
            
		$sql = 'SELECT id, title FROM {{apartment_times_out}} WHERE lang="'.Yii::app()->language.'"';

		$results = Yii::app()->db->createCommand($sql)->queryAll();
		$return = array();
		if($results){
			foreach($results as $result){
				$return[$result['id']] = $result['title'];
			}
		}
		return $return;
	}

	public function getExistRooms(){
		return Apartment::getExistsRooms();
	}

}
