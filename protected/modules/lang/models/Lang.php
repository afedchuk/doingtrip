<?php

class Lang extends CActiveRecord
{

    private static $_activeLangs;
    private static $_activeLangsTranslated;
    private static $_activeLangsFull;
    private static $_mainLang;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Lang the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {

        return '{{language}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, code', 'required'),
	        array('default, active', 'safe'),

        );
    }

    public function i18nFields() 
    { 
        return array(
            'name' => 'varchar(100) not null'
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    { 
        return array(
            'name' => tt('Name'),
            'code' => tt('Code'),
            'active' => tt('Active'),
           
        );
    }


    public function beforeSave()
    {
        if ($this->isNewRecord) {
            $maxSorter = Yii::app()->db->createCommand()
                ->select('MAX(sorter) as maxSorter')
                ->from($this->tableName())
                ->queryScalar();
            $this->sorter = $maxSorter + 1;
        }

		if ($this->scenario == 'set_default') {
            $sql = "UPDATE " . $this->tableName() . " SET default=0 WHERE id!=" . $this->id;
            Yii::app()->db->createCommand($sql)->execute();
        }

	
        return parent::beforeSave();
    }

	public function afterSave(){
		if ($this->isNewRecord) {
			Yii::app()->cache->flush();
		}

		return parent::afterSave();
	}

	public function afterDelete() {
		Yii::app()->cache->flush();
		return parent::afterDelete();
	}

 
    public function beforeDelete()
    {
        if ($this->name == self::getDefaultLang() | $this->model()->count() <= 1) {
            return false;
        }

        return parent::beforeDelete();
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;


        $criteria->compare('name', $this->name, true);
        $criteria->order = 'sorter ASC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function getActiveLangs($full = false, $requery = false)
    {
    if (!isset(self::$_activeLangs) || $requery) {
            $sql = "SELECT *
                    FROM {{language}}
                    WHERE active=1
                    ORDER BY sorter ASC";
            $activeLangs = Yii::app()->db->createCommand($sql)->queryAll();

            // Загружаем данные актвных языков и определяем главный ( дефолтный )

            foreach ($activeLangs as $lang) {
                self::$_activeLangs[$lang['code']] = $lang['code'];
                self::$_activeLangsFull[$lang['code']] = $lang;
                self::$_activeLangsTranslated[$lang['code']] = $lang['name'];

                if ($lang['default']) {
                    self::$_mainLang = $lang['code'];
                }
            }

        }
        return $full ? self::$_activeLangsFull : self::$_activeLangs;

    }

    public static function getAdminMenuLangs()
    {
        $admLangs = array();
        if (!isset(self::$_activeLangsFull))
            self::getActiveLangs();

        $activeLangs = self::$_activeLangsFull;
        foreach ($activeLangs as $lang) {
            if (Yii::app()->language == $lang['code']) {
                $admLang = array(
                    'url' => '',
                    'label' => $lang['name'],
                    'icon' => $lang['code'], 'itemOptions' => array('class' => 'none'),
                    'linkOptions' => array('onclick' => 'return false;', 'class' => 'boldText')
                );
            } else {
                $admLang = array(
                    'label' => $lang['name'],
                    'url' => Yii::app()->controller->createLangUrl($lang['code']),
                    'icon' => $lang['code'], 'itemOptions' => array('class' => 'none')
                );
            }
            $admLangs[] = $admLang;
        }
        return $admLangs;
    }
    public static function getDefaultLang()
    {
        if (!isset(self::$_mainLang)) {
            $sql = "SELECT name FROM {{language}} WHERE active=1 AND default=1";
            self::$_mainLang = Yii::app()->db->createCommand($sql)->queryScalar();
        }
        return self::$_mainLang;
    }

    
    /*
     * Function For check lang by get request eq /hr/site/index
     * If language is by get request found in database and active langage will return current link eg /hr/site/active if your request is eg /fr/site/index
     * in this case will return /en/site/index while fr langage is not in database
     * @param cod varchar 2
     * @param route current action route
     * @param redirection default to true to redirect from eg /fr/ to /en/ while fr dont exists as language
     */
    public static function findByCode($cod, $route, $redirect = true)
    {
        $cod = substr($cod, 0, 2);
        $activeLangs = self::getActiveLangs();

        if (empty($activeLangs[$cod])) {
            $lang = self::getDefaultLang();
        } else {
            $lang = empty($activeLangs[$cod]);
        }

        if ($redirect == true) {
            if (preg_match("/index/", $route))
                Yii::app()->controller->redirect(Yii::app()->homeUrl . $lang . '/');
            else
                Yii::app()->controller->redirect(Yii::app()->homeUrl . $lang . '/' . $route);
        } else {
            return $lang;
        }
    }

	public static function getLangNameByCode($code)
    {
        $sql = "SELECT name FROM {{language}} WHERE code='".$code."'";
        return Yii::app()->db->createCommand($sql)->queryScalar();
    }
    
	public static function getDefaultLangId()
    {
        $sql = "SELECT id FROM {{language}} WHERE `default`=1";
        return Yii::app()->db->createCommand($sql)->queryScalar();
       
    }

}
	