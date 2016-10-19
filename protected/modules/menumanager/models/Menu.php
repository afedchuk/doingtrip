<?php
/**********************************************************************************************
*                            CMS Open Real Estate
*                              -----------------
*	version				:	1.4.2
*	copyright			:	(c) 2012 Monoray
*	website				:	http://www.monoray.ru/
*	contact us			:	http://www.monoray.ru/contact
*
* This file is part of CMS Open Real Estate
*
* Open Real Estate is free software. This work is licensed under a GNU GPL.
* http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*
* Open Real Estate is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
* Without even the implied warranty of  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
***********************************************************************************************/

class Menu extends ParentModel{
	public $title;

	const LINK_NEW_MANUAL = 1;
	const LINK_NEW_AUTO = 2;
	const LINK_DROPDOWN = 3;
	const LINK_DROPDOWN_MANUAL = 4;
	const LINK_DROPDOWN_AUTO = 5;

	public static function model($className=__CLASS__){
		return parent::model($className);
	}

	public function tableName(){
		return '{{menu}}';
	}

	public static function getMenuItems(){
        $sql = 'SELECT id, type, title_'.Yii::app()->language.' AS title, page_title_'.Yii::app()->language.' AS page_title, widget, subitems, href, special
                FROM {{menu}}
                WHERE active = 1
                ORDER BY sorter';

        // TODO: Сделать мультиязычный кеш
		// $menu = Yii::app()->cache->get('menu');
        $menu = false;

		if($menu === false){
			$menuItems = Yii::app()->db->createCommand($sql)->queryAll();

			foreach($menuItems as $item){
				if($item['special']){
					$item['href'] = array($item['href']);
				}

				if($item['type'] == self::LINK_NEW_MANUAL){
					$menu[] = array(
						'label' => $item['title'],
						'url' => $item['href'],
					);
				}
				if($item['type'] == self::LINK_NEW_AUTO){
					$menu[] = array(
						'label' => $item['title'],
						'url' => self::getUrlById($item['id']),
					);
				}

				if($item['type'] == self::LINK_DROPDOWN){
					$subitems = array();
					foreach($menuItems as $tmpItem){
						if($tmpItem['subitems'] == $item['id']){
							if($tmpItem['type'] == self::LINK_DROPDOWN_MANUAL){
								if($tmpItem['special']){
									$tmpItem['href'] = array($tmpItem['href']);
								}
								$subitem = array(
									'label' => $tmpItem['title'],
									'url' => $tmpItem['href'],
								);

								$subitems[] = $subitem;
							}
							if($tmpItem['type'] == self::LINK_DROPDOWN_AUTO){
								$subitem = array(
									'label' => $tmpItem['title'],
									'url' => self::getUrlById($tmpItem['id']),
								);

								$subitems[] = $subitem;
							}
						}
					}
					if($subitems){
						$menu[] = array(
							'label' => $item['title'],
							'submenuOptions'=>array(
								'class'=>'sub_menu_dropdown'
							),
							'url'=>array(''),
							'linkOptions'=>array('onclick'=>'return false;'),
							'items' => $subitems,
						);


					}
				}

			}
			//Yii::app()->cache->set('menu', $menu);
		}
		if(!$menu){
			return array();
		}

		return $menu;
	}

	public function rules(){
		return array(
			array('type', 'required'),

			array('href, subitems', 'required', 'on' => 'insert, update'),
			array('title', 'i18nRequired', 'on' => 'insert, update'),
			array('href', 'required', 'on' => 'link_'.self::LINK_NEW_MANUAL),
			array('title', 'i18nRequired', 'on' => 'link_'.self::LINK_NEW_MANUAL),
			array('href, subitems', 'required', 'on' => 'link_'.self::LINK_DROPDOWN_MANUAL),
			array('title', 'i18nRequired', 'on' => 'link_'.self::LINK_DROPDOWN),
			array('title', 'i18nRequired', 'on' => 'link_'.self::LINK_DROPDOWN_MANUAL),
			array('title', 'i18nRequired', 'on' => 'special'),
			array('widget', 'safe'),
			array($this->getI18nFieldSafe(), 'safe'),

			/*array('name_ru', 'length', 'max'=>255),
			array('id, name_ru, date_updated', 'safe', 'on'=>'search'),
			array('class, coords', 'safe'),*/
		);
	}

    public function i18nFields(){
        return array(
            'title' => 'varchar(255) not null',
            'page_title' => 'varchar(255) not null',
            'page_body' => 'text not null'
        );
    }

	public function seoFields() {
		return array(
			'fieldTitle' => 'page_title',
			'fieldDescription' => 'page_body'
		);
	}

    public function getPage_title(){
        return $this->getStrByLang('page_title');
    }

    public function getPage_body(){
        return $this->getStrByLang('page_body');
    }

	public function relations(){
		return array(
		);
	}

	public function attributeLabels(){
		return array(
			'title' => tt('Text links'),
			'active' => tc('Status'),
			'type' => tt('Type of link'),
			'href' => tt('Link'),
			'subitems' => tt('The drop-down list to contain'),
			'page_title' => tt('Page Title'),
			'page_body' => tt('The text on the page'),
			'widget' => tt('Display the bottom of the page'),
		);
	}

	public function behaviors(){
		return array(
			'AutoTimestampBehavior' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
				'createAttribute' => 'date_updated',
				'updateAttribute' => 'date_updated',
			),
		);
	}

	public function search(){
		$criteria=new CDbCriteria;

		//$criteria->compare('subitems', 0);
		/*$criteria->compare('id',$this->id);*/
		//$criteria->compare('',$this->name_ru,true);
		/*$criteria->compare('date_updated',$this->date_updated,true);*/

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>param('adminPaginationPageSize', 20),
			),
			'sort'=>array(
				'defaultOrder'=>'sorter',
			)
		));
	}

	public function searchSubitems(){
		$criteria = new CDbCriteria;
		$criteria->compare('subitems', $this->id);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>param('adminPaginationPageSize', 20),
			),
			'sort'=>array(
				'defaultOrder'=>'sorter',
			)
		));
	}

	public function getTypes(){
		return array(
			self::LINK_NEW_MANUAL => tt('Simple link (set manually)'),
			self::LINK_NEW_AUTO => tt('A page with text'),
			self::LINK_DROPDOWN => tt('The drop-down list'),
			self::LINK_DROPDOWN_MANUAL => tt('Reference in the drop-down list (set manually)'),
			self::LINK_DROPDOWN_AUTO => tt('The page with the text in the drop-down list'),
		);
	}

	public function getForSubitems(){
		$sql = 'SELECT id, title_'.Yii::app()->language.' AS title
		        FROM {{menu}}
		        WHERE type="'.self::LINK_DROPDOWN.'" AND active';

		$return = CHtml::listData(Yii::app()->db->createCommand($sql)->queryAll(), 'id', 'title');

		if($this->special){
			return CMap::mergeArray(array('0' => tt('Not selected')), $return);
		} else {
			return $return;
		}
	}

	public function beforeSave(){
		if($this->isNewRecord){
			$this->active = 1;

			$maxSorter = Yii::app()->db->createCommand()
				->select('MAX(sorter) as maxSorter')
				->from('{{menu}}')
				->queryRow();
			$this->sorter = $maxSorter['maxSorter']+1;
		}
		Yii::app()->cache->delete('menu');

		if($this->special){
			if($this->subitems){
				$this->type = self::LINK_DROPDOWN_MANUAL;
			} else {
				$this->type = self::LINK_NEW_MANUAL;
			}
		}

		return parent::beforeSave();
	}

	public function beforeDelete(){
		$sql = 'UPDATE {{menu}} SET subitems=0 WHERE subitems=:subitems';
		Yii::app()->db->createCommand($sql)->execute(array(':subitems' => $this->id));

		if(issetModule('seo') && param('genFirendlyUrl')){
			$sql = 'DELETE FROM {{seo_friendly_url}} WHERE model_id="'.$this->id.'" AND model_name = "Menu"';
			Yii::app()->db->createCommand($sql)->execute();
		}

		return parent::beforeDelete();
	}

	public function getUrl(){
		return self::getUrlById($this->id);
	}

	public static function getUrlById($id) {
		if(issetModule('seo') && param('genFirendlyUrl')){
			$seo = SeoFriendlyUrl::getForUrl($id, 'Menu');

			if($seo){
				$field = 'url_'.Yii::app()->language;
				return Yii::app()->createAbsoluteUrl('/menumanager/main/view', array(
					'url' => $seo->$field . param('urlExtension'),
				));
			}
		}

		return Yii::app()->createAbsoluteUrl('/menumanager/main/view', array(
			'id'=>$id,
		));
	}

	public function getTitle(){
		$return = CHtml::encode($this->getStrByLang('title'));
		if(Yii::app()->user && Yii::app()->user->getState('isAdmin')){
			$href = array();
			switch ($this->id) {
				case 2:
					$href = array('/news/backend/main/admin');
					break;
				case 4:
					$href = array('/articles/backend/main/admin');
					break;
			}
			if($href){
				$return .= ' ['.CHtml::link(tt('Management section'), $href).']';
			}
		}

		if($this->type == self::LINK_DROPDOWN){
			if(!self::model()->countByAttributes(array('subitems' => $this->id))){
				$return .= '<br/> - '.tt('in this paragraph is not nested. The menu item will not be displayed.');
			}
		}

		return $return;
	}

	public static function getWidgetOptions(){
		$arrWidgets =  array(
			'' => tc('No'),
			'news' => tc('News'),
			'apartments' => tc('Listing'),
			'viewallonmap' => tc('Search for listings on the map'),
			'contactform' => tc('The form of the section "Contact Us"'),
			'randomapartments' => tc('Listing (random)'),
			'specialoffers' => tc('Special offers'),
		);

        if (issetModule('metrosearch')) {
            $arrWidgets['metrosearch'] = Yii::t('common', 'Search on map by metro station');
        }
        return $arrWidgets;
	}

	public static function getRel($id, $lang){
		$model = self::model()->resetScope()->findByPk($id);

		$title = 'title_'.$lang;
		$model->title = $model->$title;

		return $model;
	}

	public function afterSave() {
		if($this->type == 2){
			if(issetModule('seo') && param('genFirendlyUrl')){
				SeoFriendlyUrl::getAndCreateForModel($this);
			}
		}
		return parent::afterSave();
	}

}