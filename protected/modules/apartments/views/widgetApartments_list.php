<?php
     /*if (!defined('_SAPE_USER')){
        define('_SAPE_USER', '0092ed3d9f3e8a8d7cc462f4056e0a4e');
     }
     require_once(realpath($_SERVER['DOCUMENT_ROOT'].'/'._SAPE_USER.'/sape.php'));
     $sape = new SAPE_client();*/
?>
<?php 
Yii::app()->clientScript->registerScriptFile($this->assetsBase  . '/js/jquery.lazyload.min.js', CClientScript::POS_END); 
if($scity)
    $this->breadcrumbs=array(
            ApartmentsModule::t('Apartments catalog') => Yii::app()->createAbsoluteUrl('/apartments'),
            ApartmentsModule::t('Seo title {city}', array('{city}'=> $scity))
    );
else
   $this->breadcrumbs=array(
         Yii::t('index','Short time')
); 
$this->pageTitle = $this->city ? Yii::t('index', 'Title {value}', array('{value}'=> $this->city)) . ' - '.$this->pageTitle : Yii::t('index', 'Title');
$this->pageKeywords = isset($this->city) && $this->city ? Yii::t('index', 'Meta keywords {value}', array('{value}'=> $this->city)) :  Yii::t('index', 'Meta keywords');
$this->pageDescription =  isset($this->city) && $this->city ? Yii::t('index', 'Meta description {value}', array('{value}'=>$this->city)) : Yii::t('index', 'Meta description');
if(isset($scity))
  $this->scity = $scity;
?>
<?php if($apartments){ ?>
 <?php if(Yii::app()->user->getState('isAdmin')) { ?>

    <div id="narrow-down-area" class="narrow-down-area">
        <!--div class="util-clearfix" id="filter">
            <div class="keyword-ipt" id="keyword-ipt-c">
                    <label class="ui-label">Ключевые слова:</label>
                    <input type="text" maxlength="50" autocomplete="off" name="SearchText" id="ipt-kwd" class="ui-textfield ui-textfield-system">
                </div>
        </div>
        <div id="filter-options">
            <?php foreach(Apartment::getTypesArray() as $key=>$type) : ?>
                <a class="sel-free filter-item" href="javascript:;" id="link<?php echo $key; ?>"><span><?php echo $type; ?></span></a>
                <input type="hidden" value="<?php echo $key; ?>" name="isFavorite" id="isFavorite">
            <?php endforeach; ?>
                           
            
        </div-->
        <div id="view-filter" class="view-filter util-clearfix" data-widget-cid="widget-19">
    <span class="view-btn">     <span>Вид:</span> 
        <a href="http://ru.aliexpress.com/w/wholesale-%25D1%2581%25D0%25B0%25D1%2583%25D0%25BD%25D0%25B0.html?isrefine=y&amp;site=rus&amp;g=y&amp;SearchText=%D1%81%D0%B0%D1%83%D0%BD%D0%B0&amp;CatId=202002489&amp;initiative_id=AS_20160120131145&amp;shipCountry=UA&amp;isFreeShip=y" title="галерея" rel="nofollow" id="view-thum"></a> 
        <a href="javascript:void(0);" title="список" rel="nofollow" id="view-list"></a>
    </span>

        <?php $sort = is_null($sort) ? 'date_updated' : $sort;
              foreach(array('date_updated','price', 'square', 'rating') as $attribute) {
                    echo CHtml::tag('div', array('class' => 'narrow-down-bg'), CHtml::link(CHtml::tag('span', array('class' =>  ($sort == $attribute ? 'best-match-on' : 'narrow-down')), 
                        Yii::app()->getModule('apartments')->t('Sorting by '.$attribute)), 
                        Yii::app()->createAbsoluteUrl('apartments/', array('sortType' => $attribute)),array()
                    )); 
              } 
        ?>
       
</div>
    </div><br/>
    <?php } ?>
  
<div class="well relative">
    <div id="<?php if($typeView == 'grid') {?>right-wide<?php } else { ?>right<?php }?>"  class="<?php if($typeView != 'grid') {?>apartments-page<?php } ?>">
    <?php if($user_id === null) { ?>
        <div class="header-list-apartments">
            <?php $countc = $count. ' '.numberReplacing($count, array(ApartmentsModule::t('proposition single'), ApartmentsModule::t('proposition few'), ApartmentsModule::t('propositions'))); ?>
            <?php if($this->city): ?>
                <h4 class="titlePropos"> 
                    <?php  echo Yii::app()->getModule('apartments')->t('Result apartments {value}{city}', array('{city}' => ($scity ? '<span rel="'.$this->pageKeywords.'" href="'.Yii::app()->createAbsoluteUrl('regions/main/cities').'" data-toggle="modal">'.$scity.'</span>' : ApartmentsModule::t('All cities'))))?>
                </h4>
            <?php else: ?>
                <h4 class="titlePropos"><?php  echo ApartmentsModule::t('Result apartments {value} {filter}',array('{filter}' => Yii::app()->createAbsoluteUrl('regions/main/cities'))); ?></h4>
            <?php endif; ?>
            <em><?php echo $countc; ?></em>
            <div class="positionView">
                <div class="switch-page-structure">
                    <a data="grid" rel="nofollow" class="type-view switch-to-grid<?php if ($typeView == 'grid' || empty($typeView)) { echo ' active'; } ?>" href="<?php echo Yii::app()->createAbsoluteUrl('apartments', $this->city ? array('city' => $url) : array()) ; ?>" id="switch-to-grid"></a> 
                    <a data="list" rel="nofollow" class="type-view switch-to-list<?php if ($typeView == 'list') { echo ' active'; } ?>" href="<?php echo Yii::app()->createAbsoluteUrl('apartments', $this->city ? array('city' => $url) : array()) ; ?>" id="switch-to-list"></a>
                </div>
            </div>
            <div class="filters-wrap">
                <div class="sort-wrap">
                    <ul>
                        <li><span class="icon-chevron-<?php echo $this->order == 'desc' ? 'down' : 'up'; ?>"></span> <?php echo ApartmentsModule::t('Sort'); ?>:</li>
                        <?php  
                            if($sorterLinks){
                                foreach($sorterLinks as $link){
                                        echo '<li>'.$link.'</li>';
                                }
                            }
                        ?>
                    </ul>
                </div>
                <a rel="nofollow" id="filters-toggle" class="filters-toggle">
                   <?php echo ApartmentsModule::t('Filter'); ?>
                </a>
                <?php  $this->renderPartial('_search_apartments/search_form', array()); ?>
            </div>
        </div>
    <?php } ?>
    <div id="appartment_box"> 
        <?php  
            if($apartments){ $i =1;
                    foreach ($apartments as $item){
                        $icon = new EGMapMarkerImage("/images/house.png");
                        if(isset($item->description->title)) {
                            $this->renderPartial('widgetApartments_'.$typeView.'_item', array(
                                    'item' => $item,
                                    'count' => $count,
                                    'criteria' => $criteria,
                                    'city' => isset($city) && !is_null($city) ? strtolower($city->url) : null,
                                    'i' => $i
                            ));
                            $i++;
                        }

                    }

                    
            }    
        ?> 
    </div>
    <div class="clear"></div>
    <?php $this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
                                'contentSelector' => '#appartment_box',
                                'itemSelector' => 'div.blockApartments',
                                'loadingText' => Yii::t('index', 'Loading...'),
                                'donetext' => Yii::t('index', 'No records'),
                                'pages' => $pages,
                                'contentLoadedCallback' => 'function( newElements ) {
                                    widgetlist.apply();
                                    widgetlist.markers(newElements);
                                    loadSidebar();
                                }',
                            )); 
    ?>
    <div class="clear"></div>

    <?php if($user_id === null) { ?>
        <?php if( $this->city_description) { ?>
            <h2><?php echo ApartmentsModule::t('Seo title {city}', array('{city}' => $scity))?></h2>
            <div class="desc">
                <?php echo $this->city_description; ?>
            </div>
        <?php } else { ?>
            <?php if(isset($scity) && $scity) { ?>
                <h2><?php echo ApartmentsModule::t('Seo title {city}', array('{city}' => $scity)); ?></h2>
            <?php } else { ?>
                <h2><?php echo ApartmentsModule::t('Seo title')?></h2>
                <div class="desc">
                    <?php echo ApartmentsModule::t('Main description'); ?>
                </div>
            <?php } ?>
        <?php } ?>
    <?php } ?>
    </div>
    <?php  if($typeView == 'list') { ?>
        <div id="left">
            <?php if($user_id === null) { 
                $ids = array();
                foreach($apartments as $apartment){
                    if(isset($apartment->description->title)) {
                        $ids[] = $apartment->id;
                    }
                }
                $criteriaForMap = new CDbCriteria();
                $criteriaForMap->addInCondition(Apartment::model()->getTableAlias().'.id', $ids); ?>
                
                <div class="apartments-list-map" id="sidebar">
                    <?php echo $this->renderPartial('_search_apartments/_search_field_by_id', array(), true); ?>
                   
                    <?php if(count($ids) > 1)
                        $this->widget('application.modules.viewallonmap.components.ViewallonmapWidget', array('criteria' => $criteriaForMap, 'filterOn' => false, 'withCluster' => false)); ?>
                </div>
                
            <?php  } else {
                 echo $this->renderPartial('_user_info', array('user' => $user), true);
            } ?>
        </div>
    <?php } ?>
    <div class="clear"></div>
<?php

    Yii::app()->clientScript->registerScript('ajaxMapSetStatus', "        
        widgetlist.apply();
        reloadApartment.modal();  
    ",
    CClientScript::POS_END);
?>
<?php } else { ?>
    <div class="no-results well">
        <h4><?php echo Yii::app()->getModule('apartments')->t('Apartments list is empty.') ?></h4>
        <?php if( $this->city_description) { ?>
            <div class="well-no-result">
                <h3><?php echo ApartmentsModule::t('Seo title {city}', array('{city}' => $scity))?></h3>
                <?php echo $this->city_description; ?>
            </div>
        <?php } ?>
        <?php $this->widget('application.extensions.fbLikeBox.fbLikeBox', array(
            'likebox' => array(
            'url'=>'https://facebook.com/house4trip',
            'header'=>'false',
            'width'=>'620',
            'height'=>'200',
            'layout'=>'light',
            'show_post'=>'false', 
            'show_faces'=>'true',
            'show_border'=>'false',
         )
        ));?>
    </div>
<?php } ?>
<?php
    //echo $sape->return_links();
?>
</div>
