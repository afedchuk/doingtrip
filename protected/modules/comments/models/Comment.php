<?php


class Comment extends ParentModel {
    
	const STATUS_PENDING=0;
	const STATUS_APPROVED=1;
	public $verifyCode;
	public $dateCreated;
	public $username;
	public $aprove;

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{apartment_comments}}';
	}

	public function rules() { 
		$rules = array(
            array('year, month, rating_photos, rating_clarity, rating_service, rating_location, rating_price, aprove', 'required',  'on' => 'insert'),
            array('rating_photos, rating_clarity, rating_service, rating_location, rating_price', 'numerical', 'min'=>1),
			array('name, email, phone, body', 'required'),
            array('aprove', 'compare', 'compareValue' => 1, 'message' => CommentsModule::t('You should aprove data correct')),
            array('email', 'email',),
			array('name, email', 'length', 'max' => 128),
			array('rating', 'safe'),
		);
    

		if (isset($_POST['ajax']) && $_POST['ajax']==='Comment-form') 
            return $rules;
		else 
			array_push($rules,array('verifyCode', 'captcha', 'allowEmpty'=>!Yii::app()->user->isGuest));
                
		return $rules;
	}

	public function relations() {
		Yii::import('application.modules.apartments.models.Apartment');
		return array(
			'apartment' => array(self::BELONGS_TO, 'Apartment', 'apartment_id'),
		);
	}

	public function behaviors(){
		return array(
			'AutoTimestampBehavior' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
				'createAttribute' => 'date_created',
				'updateAttribute' => 'date_updated',
			),
		);
	}
	
	public function attributeLabels() {
		return array(
			'id' => 'Id',
            'aprove' => CommentsModule::t('Aprove rating'),
			'body' => CommentsModule::t('Comment'),
            'rating_photos' => ApartmentsModule::t('rating_photos'),
            'rating_clarity' => ApartmentsModule::t('rating_clarity'),
            'rating_service' => ApartmentsModule::t('rating_service'),
            'rating_location' => ApartmentsModule::t('rating_location'),
            'rating_price' => ApartmentsModule::t('rating_price'),
			'rating' => CommentsModule::t('Rate'),
			'active' => CommentsModule::t('Status'),
			'date_created' => CommentsModule::t('Creation date'),
			'name' => CommentsModule::t('Name'),
			'email' => CommentsModule::t('Email'),
            'phone' => UserModule::t('Telephone'),
			'verifyCode' => CommentsModule::t('Verify code'),
		);
	}

    public static function getCountPending(){
        $sql = "SELECT COUNT(id) FROM {{apartment_comments}} WHERE active=".self::STATUS_PENDING;
        return (int) Yii::app()->db->createCommand($sql)->queryScalar();
    }
    
	private function _updateRating(){
		$sql = 'SELECT AVG(rating) FROM {{apartment_comments}}
			WHERE apartment_id = "'.$this->apartment_id.'" AND active = "'.Comment::STATUS_APPROVED.'" AND rating > -1';
		$rating = Yii::app()->db->createCommand($sql)->queryScalar();

		$sql = 'UPDATE {{apartment}} SET rating = "'.$rating.'" WHERE id = "'.$this->apartment_id.'"';
		Yii::app()->db->createCommand($sql)->execute();
	}

	public function search(){
		$criteria = new CDbCriteria(array('order'=>'id DESC',
			    ));

		$criteria->compare('name',$this->name, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>param('adminPaginationPageSize', 20),
			),
		));
	}

	protected function beforeValidate() {
        if(!Yii::app()->user->isGuest) {
            $user = User::model()->findByPk(Yii::app()->user->id);
            if($user != false) {
                $this->name = $user->firstname;
                $this->email = $user->email;
                $this->phone = $user->phone;
            }
        }
        if($this->rating == -1) {
            $sum = 0;
            foreach(array('rating_photos', 'rating_service', 'rating_clarity', 'rating_price', 'rating_location') as $rating)
                $sum+=$this->{$rating};
                $this->rating = round($sum/5, 2);
        }
        return parent::beforeValidate();
    }

	protected function beforeSave() {
		if ($this->isNewRecord && Yii::app()->user->isGuest) {
			if (param('commentNeedApproval', 1)){
				$this->active = Comment::STATUS_PENDING;
			} else {
				$this->active = Comment::STATUS_APPROVED;
			}

                        
			$notifier = new Notifier;
			$notifier->raiseEvent('onNewComment', $this);
		}
		return parent::beforeSave();
	}

	protected function afterSave(){
		if ($this->active == Comment::STATUS_APPROVED){
			$this->_updateRating();
		}
		return parent::afterSave();
	}

	public function afterDelete(){
		if ($this->active == Comment::STATUS_APPROVED){
			$this->_updateRating();
		}
		return parent::afterDelete();
	}
	
	protected function afterFind() {
		$dateFormat = param('commentModule_dateFormat', 0) ? param('commentModule_dateFormat') : param('dateFormat', 'd.m.Y H:i:s');
		$this->dateCreated = date($dateFormat, strtotime($this->date_created));

		return parent::afterFind();
	}

    public static function getUserEmailLink($data) {
        return "<a href='mailto:".$data->email."'>".$data->name."</a>";
    }

}