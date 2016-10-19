<?php


class ParentModel extends CActiveRecord
{
    public $WorkItemsSelected;

    private $_cacheRules;

    public function i18nFields(){
        return NULL;
    }

    public function resetScope(){
       $this->_c=new CDbCriteria();
       return $this;
    }

    public function getI18nFieldSafe(){
        $i18nFields = array_keys($this->i18nFields());
        $activeLangs = Lang::getActiveLangs();
        $i18nSafeArr = array();
        foreach($activeLangs as $lang){
            foreach($i18nFields as $field){
                $i18nSafeArr[] = $field.'_'.$lang;
            }
        }
        return implode(', ', $i18nSafeArr);
    }

    public function i18nRules($field){
        if(!isset($this->_cacheRules[$field])){
            $this->_cacheRules[$field] = self::i18nGenFields($field);
        }
        return $this->_cacheRules[$field];
    }

    public static function i18nGenFields($field){
        $activeLangs = Lang::getActiveLangs();
        $i18nRuleArr = array();
        foreach($activeLangs as $lang){
            $i18nRuleArr[] = $field.'_'.$lang;
        }
        return implode(', ', $i18nRuleArr);
    }

    public function afterDelete(){
        if(isset($this->sorter)){
            $sql = "SELECT id FROM ".$this->tableName()." ORDER BY sorter ASC";
            $ids = Yii::app()->db->createCommand($sql)->queryColumn();
            $i = 1;
            foreach($ids as $id){
                $sql = "UPDATE ".$this->tableName()." SET sorter=$i WHERE id=$id";
                Yii::app()->db->createCommand($sql)->execute();
                $i++;
            }
        }
        return parent::afterDelete();
    }

    public function getStrByLang($str){
   		$str .= '_'.Yii::app()->language;
   		return $this->$str;
   	}
	
	public function setStrByLang($str, $value){
   		$str .= '_'.Yii::app()->language;
   		$this->$str = $value;
   	}
	
	protected function isEmpty($value,$trim=false)
	{
		return $value===null || $value===array() || $value==='' || $trim && is_scalar($value) && trim($value)==='';
	}
	
	
	public function isLangAttributeRequired($attribute)
	{
		foreach($this->getValidators($attribute) as $validator)
		{
			
			if($validator instanceof CInlineValidator && $validator->method == 'i18nRequired')
				return true;
		}
		return false;
	}
	
	public function i18nRequired($attribute, $params) {
		$label = $this->getAttributeLabel($attribute);
		$activeLangs = Lang::getActiveLangs(true);
		
        foreach($activeLangs as $lang){
            $attr = $attribute.'_'.$lang;
            if($this->isEmpty($this->$attr,true))
                $this->addError($attr, Yii::t('common','{label} cannot be blank.', array('{label}'=>$label)));
        }
	}
	
	public function i18nLength($attribute, $params)
	{
		$label = $this->getAttributeLabel($attribute);
		
		$activeLangs = Lang::getActiveLangs(true);
		
        foreach($activeLangs as $lang){
            $attr = $attribute.'_'.$lang;
			
			$value=$this->$attr;

			if(function_exists('mb_strlen'))
				$length=mb_strlen($value, Yii::app()->charset);
			else
				$length = utf8_strlen($value);

			if(isset($params['min']) && $length<$params['min'])
			{
                $this->addError($attr, Yii::t('common','{label} is too short (minimum is {min} characters).',
                    array('{label}'=>$label, '{lang}'=>$lang, '{min}'=>$params['min'])));
			}
			if(isset($params['max']) && $length>$params['max'])
			{
                $this->addError($attr, Yii::t('common','{label} is too long (maximum is {max} characters).',
                    array('{label}'=>$label, '{max}'=>$params['max'])));
			}
			if(isset($params['is']) && $length!==$params['is'])
			{
                $this->addError($attr, Yii::t('common','{label} is of the wrong length (should be {length} characters).',
                    array('{label}'=>$label, '{length}'=>$params['is'])));
			}
		}
	}

    public function getDateTimeInFormat($field = 'date_created')
    {
        $dateFormat = param('dateFormat', 'd.m.Y H:i:s');
        return date($dateFormat, strtotime($this->$field));
    }
	
}
