<li class="col-1-2">
        <?php $city_name = ($item->city_id ? City::getCityName($item->city_id) : '');
              $res = Images::getMainThumb(400, 200, $item->images, null, true);
              $img = CHtml::image($res['thumbUrl'], $res['comment']);
              $title = getSnippet($item['description']['title'], 100);
              //echo CHtml::link($title, $item->getUrl($item->id, $item->description->title,  $city_name ), array('class' => 'title')); 
        ?>

        <div class="property-mask">
              <figure class="pimage">
                <a href="<?php echo $item->getUrl($item->id, $item->description->title,  $city_name ); ?>">
                  <?php echo $img; ?>
                </a>
                <figcaption>
                  <a href="<?php echo $item->getUrl($item->id, $item->description->title,  $city_name ); ?>">
                  <i class="fa fa-link fa-lg"></i></a>
                </figcaption>
                <h4> 
                  <a rel="tag" href="<?php echo $item->getUrl($item->id, $item->description->title,  $city_name ); ?>"><?php echo  CurrencymanagerModule::convertcurrency($item['price']); ?></a>
                </h4>                        
              </figure>
        </div>
        <div class="property-info">
          <span><i data-toggle="tooltip" title="<?php echo ApartmentsModule::t('Square'); ?>" class="fa fa-expand"></i><?php echo ApartmentsModule::t('Square {value}', array('{value}' => $item->square)); ?></span>        
          <span><i data-toggle="tooltip" title="<?php echo ApartmentsModule::t('Type'); ?>" class="fa fa-building-o"></i><?php echo $item::getNameByType($item->type); ?></span>       
          <span><i data-toggle="tooltip" title="<?php echo ApartmentsModule::t('Number of berths'); ?>"  class="fa fa-male"></i><?php echo $item->berths; ?></span> 
          <span><i data-toggle="tooltip" title="<?php echo ApartmentsModule::t('Rooms'); ?>" class="fa fa-cubes"></i> <?php echo $item->num_of_rooms; ?></span>
        </div>
      <div class="property-desc">
        <h4>
          <a href="<?php echo $item->getUrl($item->id, $item->description->title,  $city_name ); ?>">
            <?php echo $title; ?>
          </a>
          </h4>
          <p>
            <?php  echo  $city_name .', '.$item['description']['address']?>
          </p>
      
      </div>
</li>
<?php if($i==1) { ?> </ul><ul class="mb-catalog row">  <?php  } ?>
