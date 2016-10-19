<?php


class Settings extends CActiveRecord
{
        protected $tbl_prefix = null;
        protected $tbl_settings = 'configuration';

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
               
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
            if ($this->tbl_prefix === null)
            {
                $this->tbl_prefix = Yii::app()->params['tablePrefix'];
            }

            return ($this->tbl_prefix . $this->tbl_settings);
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('value', 'required'),
		);
	}

        public static function config($key = '') {

            $model = self::model()->cache(1209600)->findAll();
            
            $arr = array();
            foreach($model as $value) {
                Yii::app()->params[$value->name] = $value->value;
                $arr[$value->name] = $value->value;
            }
            
            if(is_null($model))
               return false;

            return $key && isset($arr[$key]) ? $arr[$key] : Yii::app()->params;
        }

	

}