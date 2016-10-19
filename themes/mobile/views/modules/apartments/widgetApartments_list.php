<?php  
$this->breadcrumbs=array(
        ApartmentsModule::t('Apartments catalog'),
);

$this->pageTitle = !is_null($scity) ? Yii::t('index', 'Title {value}', array('{value}'=> $scity)) . ' - '.$this->pageTitle : $this->pageTitle;
$this->pageKeywords = Yii::t('index', 'Meta keywords {value}', array('{value}'=>(isset($this->city) && $this->city ? $this->city : ApartmentsModule::t('All cities'))));
$this->pageDescription =  Yii::t('index', 'Meta description {value}', array('{value}'=>$this->city));
?>
<?php 
if($apartments){ ?>
       <?php $countc = $count. ' '.numberReplacing($count, array(ApartmentsModule::t('proposition single'), ApartmentsModule::t('proposition few'), ApartmentsModule::t('propositions'))); ?>     
    <!--div class="sort-wrap">
        <ul>
            <?php  
                if($sorterLinks){
                    foreach($sorterLinks as $link){
                            echo '<li>'.$link.'</li>';
                    }
                }
            ?>
    </div-->
    <div class="grey-background">
        <div class="catalog-heading">
            <p class="results" style="display: block;">
                <?php echo ApartmentsModule::t('Serach results', array('{count}' => $count)); ?>
            </p>
            <div class="more-search-options-button">
                <a data-showed="no" class="more-link">
                    <?php echo ApartmentsModule::t('Apply filter'); ?>
                    <span></span>
                </a>
            </div>
        </div>
    </div>
    <?php  $this->renderPartial('_search_form', array()); ?>
    <div id="appartment-box">
        <ul class="mb-catalog row">
        <?php $i =0; foreach ($apartments as $item){
                                    $this->renderPartial('widgetApartments_list_item', array(
                                            'item' => $item,
                                            'count' => $count,
                                            'criteria' => $criteria,
                                            'city' => isset($city) && !is_null($city) ? strtolower($city->url) : null,
                                            'i' => $i
                                    ));
                                    $i++;
                                    if($i == 2) $i =0;
                            } ?>
        </ul>
    </div>
    <?php $this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
                                'contentSelector' => '#appartment-box',
                                'itemSelector' => 'ul.mb-catalog',
                                'loadingText' => Yii::t('index', 'Loading...'),
                                'donetext' => Yii::t('index', 'No records'),
                                'pages' => $pages,
                                'contentLoadedCallback' => 'function( newElements ) {
                                   
                                }',
                            )); 
    ?>
<?php } else { ?>
    <h4><?php echo Yii::app()->getModule('apartments')->t('Apartments list is empty.') ?></h4>
    <?php if( $this->city_description) { ?>
        <div class="no-result">
            <h2><?php echo ApartmentsModule::t('Seo title {city}', array('{city}' => $scity))?></h2>
            <?php echo $this->city_description; ?>
        </div>
    <?php } ?>
<?php } ?>
<?php 
$params = $_GET; unset($params['lang'], $params['city']);
Yii::app()->clientScript->registerScript('search', '
$.extend( search.houseProperty, '.json_encode($params).');',
    CClientScript::POS_READY);
?>
