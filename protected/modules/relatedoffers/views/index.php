<?php 
    if(count($apartments) > 0): ?>
    <div class="row-fluid">
        <div class="span4">
            <div class="km">
                <label>на відстані</label>
                <?php echo CHtml::activeRadioButtonList( $model, 'km', array(1 => ApartmentsModule::t('km', array('{v}' => 1)), 
                2 => ApartmentsModule::t('km', array('{v}' => 2)), 3 => ApartmentsModule::t('km', array('{v}' => 3)), 4 => ApartmentsModule::t('km', array('{v}' => 4)),
                5 => ApartmentsModule::t('km', array('{v}' => 5))), array('separator'=>'' ,'onclick' => 'relatedOffers($(this).val());')); ?>
            </div>
             <ul class="related-objects">
                <?php foreach($apartments as $apartment): ?>
                    <?php $city_name = City::getCityName($apartment['city_id']); ?>
                    <li onclick="widgetlist.newmarker($(this), '<?php echo $apartment['id'] ?>', '<?php echo $apartment['lat']; ?>', '<?php echo $apartment['lng']; ?>', '<?php echo $model->km?>')">
                        <div class="note">
                            <div class="note_adess">
                                <?php echo getSnippet($apartment['title'], 80); ?>                                
                            </div>
                            <p><?php echo implode(', ', array($city_name, $apartment['address'])); ?></p>
                        </div>
                        <div class="money">                                
                            <?php echo ApartmentsModule::t('Price {value} doba', array('{value}' => CurrencymanagerModule::convertcurrency($apartment['price'])));?>
                        </div>
                        <div class="description">
                            <?php echo CHtml::link('До оголошення <i class="fa fa-angle-double-right" ></i>', 
                                    $model->getUrl($apartment['id'], $apartment['title'],  $city_name ), array('class' => 'btn btn-large btn-default'));  ?>
                         
                            <p>
                                <?php echo getSnippet($apartment['description'], 280); ?>
                            </p>
                            <?php $res = Images::getMainThumb(210, 140, array(), $apartment['id'], true);
                                  $img = CHtml::image($res['thumbUrl'], $apartment['title'], array('class' => 'img-polaroid'));
                                  echo $img;

                            ?>
                            <a class="to-photo-link" data-toggle='modal' data-width='570' data-height='610' href="<?php echo Yii::app()->createAbsoluteUrl('/booking/main/showphotos', array('id' => $apartment['id'], 'ap' => true)); ?>">
                                <i class="fa fa-camera"></i><span>Фото</span>
                            </a>
                            <ul class="attr-apartment">
                                <li><?php echo ApartmentsModule::t('Type'); ?>:<span><?php echo $model::getNameByType($apartment['type']); ?></span></li>
                                <li><?php echo ApartmentsModule::t('Rooms'); ?>:<span><?php echo $apartment['num_of_rooms']; ?></span></li>
                                <li><?php echo ApartmentsModule::t('Square'); ?>:<span><?php echo ApartmentsModule::t('Square {value}', array('{value}' => $apartment['square'])); ?></span></li>
                                <li><?php echo ApartmentsModule::t('Number of berths'); ?>:<span><?php echo $apartment['berths']; ?></span></li>
                                <li><?php echo ApartmentsModule::t('Floor'); ?>:<span><?php echo implode('/', array($apartment['floor'], $apartment['floor_total'])); ?></span></li>
                            </ul>
                        </div>
                    </li>
                <?php endforeach; ?>
             </ul>
        </div>
        <div class="span5">
            <div id="gmap">
              <?php Yii::app()->gmap->actionGmap($model->id, $model, $this->renderPartial('application.modules.apartments.views.backend._marker', array('model' => $model), true)); ?>
            </div>
        </div>
        <div class="span3 desc"></div>
    </div>
<?php else: ?>
<?php endif; ?>
<?php Yii::app()->getClientScript()->registerScript(
            'related',
            'widgetlist.circle(markersGMap['.$model->id.'], '.$model->km.');
        ',
        CClientScript::POS_READY);
?>