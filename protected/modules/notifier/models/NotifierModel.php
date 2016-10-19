<?php

/**
 * This is the model class for table "{{notifier}}".
 *
 * The followings are the available columns in table '{{notifier}}':
 * @property integer $id
 * @property integer $status
 * @property string $event
 * @property string $subject_ru
 * @property string $subject_en
 * @property string $subject_de
 * @property string $body_ru
 * @property string $body_en
 * @property string $body_de
 */
class NotifierModel extends ParentModel
{
    const STATUS_NO_SEND = 0;
    const STATUS_SEND_ADMIN = 1;
    const STATUS_SEND_USER = 2;
    const STATUS_SEND_ALL = 3;

    public static $_statuses;

    public static function getStatusList(){
        if(!isset(self::$_statuses)){
            self::$_statuses = array(
                self::STATUS_NO_SEND => NotifierModule::t('anyone'),
                self::STATUS_SEND_ADMIN => NotifierModule::t('administrator'),
                self::STATUS_SEND_USER => NotifierModule::t('user'),
                self::STATUS_SEND_ALL => NotifierModule::t('and the user, and the administrator'),
            );
        }

        return self::$_statuses;
    }

    public function defaultScope() {
            return array(
                    'condition'=>'lang = "'.Yii::app()->language.'"',
            );
    }

    public function getStatusName() {
        self::getStatusList();

        if($this->onlyAdmin){
            return tt('Only admin');
        }
        return isset(self::$_statuses[$this->status]) ? self::$_statuses[$this->status] : '';
    }

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{notifier}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('id, letter_id, status', 'numerical', 'integerOnly'=>true),
			array('event', 'length', 'max'=>50),
            array($this->getI18nFieldSafe(), 'safe'),
            array('subject, body, body_admin, status', 'safe'),
			array('id, status, event', 'safe', 'on'=>'search'),
		);
	}


    public function i18nFields(){
        return array(
            'subject' => 'varchar(255) not null',
            'body' => 'text not null',
            'body_admin' => 'text not null',
        );
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
		);
	}

    public function scopes(){
        return array(
            'active' => array(
                'condition' => 'status > 0',
            ),
        );
    }

    public function beforeSave(){
        if($this->isNewRecord && $this->scenario == 'create'){
            $letter_id = Yii::app()->db->createCommand()
                ->select('MAX(letter_id) as letter_id')
                ->from($this->tableName())
                ->queryScalar();
            $this->letter_id = $letter_id+1;
        }

        return parent::beforeSave();
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'status' => NotifierModule::t('Status'),
			'event' => NotifierModule::t('Event'),
			'subject' =>  NotifierModule::t('Subject'),
			'body' => NotifierModule::t('Body'),
            'body_admin' => NotifierModule::t('Body admin'),
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;


		$criteria->compare('id',$this->id);
		$criteria->compare('status',$this->status);
		$criteria->compare('event',$this->event,true);

		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('body',$this->body,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination' => array(
                'pageSize' => param('adminPaginationPageSizeBig', 60),
            ),
		));
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function canSendAdmin() {
        return in_array($this->status, array(self::STATUS_SEND_ADMIN, self::STATUS_SEND_ALL));
    }

    public function canSendUser() {
        return in_array($this->status, array(self::STATUS_SEND_USER, self::STATUS_SEND_ALL));
    }

}
