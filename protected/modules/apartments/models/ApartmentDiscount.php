<?php

class ApartmentDiscount extends ParentModel {

	public $is_time = 0;

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{apartment_discount}}';
                
	}
        
    public function rules() {
		return array(
			array('apartment_id, title, value, date_start, date_finish', 'required'),
            array('status', 'safe')
			
		);
	}

    
    public function relations() {
		return array(
			'apartment' => array(self::BELONGS_TO, 'Apartment', 'apartment_id'),               
		);
	}

	

	public function beforeSave() {
		$this->date_start = strtotime($this->date_start);
		$this->date_finish = strtotime($this->date_finish);
		return parent::beforeSave();
	}
    
    /*public function scopes() {
        return array(
            'lang'=>array(
                'condition'=>$this->tableAlias.'.lang = "'.Yii::app()->language.'"',
            ),
        );
    }*/
        
    public function attributeLabels() {
		return array(
			'is_time' => ApartmentsModule::t('Time discount or count of nights?'),
			'apartment_id' => ApartmentsModule::t('Apartment discount'),
			'title' => ApartmentsModule::t('Apartment discount title'),
			'value' => ApartmentsModule::t('Apartment discount value'),
			'date_start' => ApartmentsModule::t('Apartment discount start'),
			'date_finish' => ApartmentsModule::t('Apartment discount finish'),
		);
	}


	 public static function getApartemnts(){
            $sql = 'SELECT  *
            FROM    {{apartment}} apartment,
                                {{apartment_description}} apartment_description
            WHERE   apartment.id = apartment_description.apartment_id
                                AND apartment_description.lang =  "'.Yii::app()->language.'" 
                                AND apartment.user_id = '.Yii::app()->user->id.' ORDER BY apartment_description.title';
               
            $results = Yii::app()->db->createCommand($sql)->queryAll();

            return  CHtml::listData($results, 'apartment_id', 'title');
    }

    public static function getDiscoutPrice($discount, $price) {
    	if($discount > 0 && $price > 0) {
	    	$price = $price - ($price * $discount / 100);
	    	return ApartmentsModule::t('Price {value} doba', array('{value}'=>  CurrencymanagerModule::convertcurrency($price)));
	    }

	    return false;
    }

    public function search() {

		$criteria = new CDbCriteria;
		$criteria->compare('apartment.user_id', Yii::app()->user->id);
		$criteria->with = array('apartment');

		return new CustomActiveDataProvider($this, array(
			'criteria' => $criteria,
			'pagination'=>array(
				'pageSize'=>param('adminPaginationPageSize', 20),
			),
		));
	}

}