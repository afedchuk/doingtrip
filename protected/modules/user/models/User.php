<?php
class User extends ParentModel
{
	const STATUS_NOACTIVE=0;
	const STATUS_ACTIVE=1;
	const STATUS_BANED=-1;
        
    public $verifyLicense = 0;
    public $active;
    public $password_repeat;
    public $old_password;
	
	/**
	 * The followings are the available columns in table 'users':
	 * @var integer $id
	 * @var string $username
	 * @var string $password
	 * @var string $email
	 * @var string $activkey
	 * @var integer $createtime
	 * @var integer $lastvisit
	 * @var integer $superuser
	 * @var integer $status
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return Yii::app()->getModule('user')->tableUsers;
	}

	public function behaviors(){
		return array(
			'AutoTimestampBehavior' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
				'createAttribute' => 'createtime',
				'updateAttribute' => 'lastvisit',
			),
		);
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		
		return ((Yii::app()->getModule('user')->isAdmin())?array(
			array('password', 'length', 'max'=>128, 'min' => 4,'message' => UserModule::t("Incorrect password (minimal length 4 symbols).")),
			array('email', 'email'), 
            array('firstname, lastname, email, phone', 'required'),
            array('password, password_repeat', 'required', 'on' => 'changePass, changeAdminPass'),
            array('password', 'compare', 'on' => 'changePass, backend, changeAdminPass',
				'message' => tt('Passwords are not equivalent! Try again.', 'usercpanel')),
            array('old_password', 'required', 'on' => 'changeAdminPass'),
			array('email', 'unique', 'message' => UserModule::t("This user's email address already exists.")),
			array('status', 'in', 'range'=>array(self::STATUS_NOACTIVE,self::STATUS_ACTIVE,self::STATUS_BANED)),
			array('superuser', 'in', 'range'=>array(0,1)),
			array('email, createtime, lastvisit, superuser, status', 'required'),
			array('createtime, lastvisit, superuser, status', 'numerical', 'integerOnly'=>true),
            array('phone, password_repeat, username, unique_id, activkey, phone_additional, website, viber, skype', 'safe'),
		):array(
            array('firstname, lastname, email, phone, verifyLicense', 'required', 'on' => 'step_one'),
            array('verifyLicense', 'compare', 'compareValue' => 1, 'message' => UserModule::t('You should accept term to use our service'), 'on' => 'step_one'),
            array('user_image', 'file', 'types'=>'jpg, gif, png', 'allowEmpty' => true, ),
			array('firstname, lastname, email', 'required'),
			array('email', 'email'),
            array('phone, username, unique_id, activkey, phone_additional, website, skype, viber, last_ip, default_lang, default_currency, type', 'safe'),
			array('email', 'unique', 'message' => UserModule::t("This user's email address already exists.")),
		));
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		$relations = array(
			 //'social' => array(self::HAS_ONE, 'UserSocial', '', 'on'=> 't.id  = social.user_id')
		);
                
		if (isset(Yii::app()->getModule('user')->relations)) $relations = array_merge($relations,Yii::app()->getModule('user')->relations);
		return $relations;
	}
    
    protected function beforeSave() {
        if($this->isNewRecord){
            $this->unique_id = rand(10000,999999);
            $this->firstname = trim($this->firstname);
            $this->username = setTranslite( mb_substr(trim($this->firstname), 0, 1, 'UTF-8')
                    .mb_substr(trim($this->lastname), 0, strlen($this->lastname), 'UTF-8'));
            if(!$this->activkey)
            	$this->activkey=UserModule::encrypting(microtime().$this->password);
        }
		return parent::beforeSave();
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
                    'firstname'=>  UserModule::t("Firstname"),
                    'lastname'=>  UserModule::t("Lastname"),
                    'username' => UserModule::t("username"),
                    'phone' => UserModule::t("Telephone"),
                    'phone_additional' => UserModule::t("Telephone additional"),
                    'website' => UserModule::t("Website"),
                    'skype' => UserModule::t("Skype"),
                    'password'=>UserModule::t("password"),
                    'password_repeat'=>UserModule::t("Retype Password"),
                    'email'=>UserModule::t("E-mail"),
                    'verifyCode'=>UserModule::t("Verification Code"),
                    'verifyPassword' =>UserModule::t("Retype Password"),
                    'id' => UserModule::t("Id"),
                    'activkey' => UserModule::t("activation key"),
                    'createtime' => UserModule::t("Registration date"),
                    'lastvisit' => UserModule::t("Last visit"),
                    'superuser' => UserModule::t("Superuser"),
                    'default_lang' => UserModule::t("Default Lang"),
                    'default_currency' => UserModule::t("Default Currency"),
                    'status' => UserModule::t("Status"),
                    'verifyLicense' => UserModule::t("License"),
		);
	}
	
	public function scopes(){
        return array(
            'active'=>array(
                'condition'=>'status='.self::STATUS_ACTIVE,
            ),
            'notactvie'=>array(
                'condition'=>'status='.self::STATUS_NOACTIVE,
            ),
            'banned'=>array(
                'condition'=>'status='.self::STATUS_BANED,
            ),
            'superuser'=>array(
                'condition'=>'superuser=1',
            ),
            'notsafe'=>array(
                'select' => 'id, password, email, activkey, createtime, lastvisit, superuser, status, type',
            ),
        );
    }
	
	public function defaultScope(){
        return array(
            'select' => 'id, username, firstname, lastname, user_image, phone, phone_additional, website, skype, viber, email, createtime, lastvisit, superuser, status, type, default_lang, default_currency',
        );
    }
        
    public static function hashPassword($password) {
		return md5($password);
	}

	public function validatePassword($password) {
		return self::hashPassword($password) === $this->password;
	}
    
	public function setPassword($password = null){
		
		if($password == null){
			$password = $this->password;
		}
		$this->password = md5( $password);
	}
        
    public function randomString($length = 10){
		$chars = array_merge(range(0,9), range('a','z'), range('A','Z'));
		shuffle($chars);
		return implode(array_slice($chars, 0, $length));
	}
    
    static function getAdminName(){
		$sql = 'SELECT username FROM {{users}} WHERE superuser=1 LIMIT 1';
		return Yii::app()->db->createCommand($sql)->queryScalar();
	}

    public static function updateUserSession() {
		if (!Yii::app()->user->isGuest) {
			$id = Yii::app()->user->id;
			$sessionId = Yii::app()->session->sessionId;

			if ($id && $sessionId) {
				Yii::app()->db->createCommand()->update('{{users_sessions}}',array(
					'user_id'=>$id
				),'id=:sessionId',array(':sessionId'=>$sessionId));
			}
		}
	}
    
    public static function getModeListShow(){
		$modeInState = Yii::app()->user->getState('type_view');
		$settingsMode = param('type_view', 'list');

		$modeInState = $modeInState ? $modeInState : $settingsMode;

		$modeInGet = Yii::app()->request->getCParam('type_view', 'property_search', $modeInState);
		if($modeInGet != $modeInState){
			Yii::app()->user->setState('type_view', $modeInGet);
			$modeInState = $modeInGet;
		}
		return $modeInState;
	}

    
	public static function itemAlias($type,$code=NULL) {
		$_items = array(
			'UserStatus' => array(
				self::STATUS_NOACTIVE => UserModule::t('Not active'),
				self::STATUS_ACTIVE => UserModule::t('Active'),
				self::STATUS_BANED => UserModule::t('Banned'),
			),
			'AdminStatus' => array(
				'0' => UserModule::t('No'),
				'1' => UserModule::t('Yes'),
			),
		);
		if (isset($code))
			return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
		else
			return isset($_items[$type]) ? $_items[$type] : false;
	}
        
    public function search() {

		$criteria = new CDbCriteria;
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('email',$this->email,true);
        $criteria->compare('phone',$this->phone,true);

		if ($this->active != 'all')
		    $criteria->compare('active', $this->active);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			'sort'=>array('defaultOrder'=>'id DESC'),
			'pagination'=>array(
				'pageSize'=>param('adminPaginationPageSize', 20),
			),
		));
	}

	public static function getRandomWord($size = 0){
		$word = md5(microtime(true));
		if (!$size)
			return $word;
		$subword = substr($word, $size*-1);
		return $subword;
	}

	public static function getRandomEmail(){
		$email = self::getRandomWord(8)."@null.io";
		return $email;
	}

	public static function getIdByUid($uid = false, $service = false) {
		$id = false;
		if ($uid) {
			$serviceCond = '';
			if ($service) { $serviceCond = ' AND service = "'.$service.'" '; }
			$id = Yii::app()->db->createCommand()
						->select('user_id')
						->from('{{users_social}}')
						->where('uid = "'.$uid.'" '.$serviceCond.'')
						->queryScalar();
		}
		return $id;
	}

	public static function setSocialUid($user_id, $uid, $service = '') {
		if ($user_id && $uid) {
			Yii::app()->db->createCommand()
					->insert('{{users_social}}', array(
						'user_id' => $user_id,
						'uid' => $uid,
						'service' => $service
					));
			return true;
		}
		return false;
	}

	public static function createUser($attributes, $isSocAuth = false) {

        $model = new User;
        $model->attributes = $attributes;

        $password = $model->randomString();
        $model->setPassword($password);
		
		if ($isSocAuth) {
			$model->active = 1;
			$model->type = 1;
		}

        if ($model->save()) {
            return array(
                'id' => $model->id,
                'email' => $model->email,
                'username' => $model->username,
                'password' => $password,
                'active' => $model->active,
                'activkey' => $model->activkey,
                'userModel' => $model,
            );
        } else {
			if ($isSocAuth) {
				return $model->getErrors();
			} else
            return false;
        }
    }

    public static function destroyUserSession($userId = null) {
		if (Yii::app()->user->getState("isAdmin")) {
			if ($userId) {
				Yii::app()->db->createCommand()->delete('{{users_sessions}}','user_id=:userId',array(':userId'=>$userId));
			}
		}
	}

	public static function getOnlineUser($id) {
        $sql = "SELECT session.user_id, users.username FROM {{session}} session LEFT JOIN {{users}} users ON users.id=session.user_id WHERE users.id=$id";
        $command = Yii::app()->db->createCommand($sql);

        return !empty($command->queryAll()) ? true : false;
    }

    public function getFullName() {
	    return implode(' ', array($this->firstname, $this->lastname));
	}

	public function getSuggest($q) {
	    $c = new CDbCriteria();
	    $c->addSearchCondition('firstname', $q, true, 'OR');
	    $c->addSearchCondition('lastname', $q, true, 'OR');
	    return $this->findAll($c);
	}
}