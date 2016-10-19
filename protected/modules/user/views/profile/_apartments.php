<?php if(!empty($model['apartments'])):  ?>
   <table class="table  table-striped">
   
    <tbody>
        <?php  foreach($model['apartments'] as $value) { if(isset($value->description)) { ?>
        <tr>
            
            <td>
                <?php
                   $res = Images::getMainThumb(140, 100, $value->images);
                   $img = CHtml::image($res['thumbUrl'], $res['comment'], array('class' => 'thumbnail'));
                   echo $img;
                ?>
            </td>
                        <td>
              <a href="<?php echo $value->getUrl($value->id, $value['description']['title'], City::getCityName($value['city']['id'])); ?>" class="some_link"><?php echo $value['description']['title']; ?></a>
            </td>
            <td>
                <div class="apartament-description"><?php  echo isset($value->description->description) ? getSnippet($value->description->description, 150) : ''; ?></div>
            </td>
            <!--td>
                <img src="/images/calendar-icon.png"  data-toggle="tooltip" data-title="<?php echo ApartmentsModule::t('Google calendar tip'); ?>"/>
            </td>
            <td>Google календрар <small><?php if($value->eg_cal) { ?>(синхронізовано) <?php } else { ?> (не синхронізовано) <?php } ?></small></td-->
            <td>
              <?php $comments = Comment::model()->with('apartment')->findAll('apartment_id=:apartment_id', array(':apartment_id'=>$value->id));  $count = count($comments); ?>
              <?php 
                    $this->widget('bootstrap.widgets.TbMenu', 
                            array(
                                'htmlOptions'=>array('class'=>'btn-group'),
                                'items'=>array(
                                    array('label'=>UserModule::t('Action'), 'url'=>Yii::app()->createAbsoluteUrl('user/main/registration'), 'itemOptions' => array('class' => 'btn'), 'icon' => 'cog', 'items' => array(   
                                          array('label'=>UserModule::t('Free dates'), 'url'=>Yii::app()->createAbsoluteUrl('user/profile/servicesApartment', array('id'=>$value->id)), 'icon' => 'time'),
                                          array('label'=>UserModule::t('Update User'), 'url'=>Yii::app()->createAbsoluteUrl('user/profile/editApartment', array('id'=>$value->id)), 'icon' => 'edit'),
                                          array('label'=>UserModule::t('Delete User'), 'url'=>Yii::app()->createAbsoluteUrl('user/profile/deleteApartment', array('id'=>$value->id)), 'itemOptions' => array('onclick' => 'if(!confirm("'.UserModule::t('Are you sure that you want to delete proposition?').'")) { return false; }'), 'icon'=>'trash'),
                                          array('label'=>CommentsModule::t('Comments'), 'url'=>Yii::app()->createAbsoluteUrl('comments/main/apartmentComments', array('id' => $value->id)), 'itemOptions' => array('data-toggle' => 'modal'), 'icon' => 'cog'),
                                          //array('label'=>UserModule::t('Free dates'), 'url'=>Yii::app()->createAbsoluteUrl('user/profile/freedates', array('id' => $value->id)), 'itemOptions' => array('data-toggle' => 'modal'), 'icon' => 'time'),
                                          array('label'=>($value->owner_active == 1) ? UserModule::t('Deactivate') : UserModule::t('Activate'), 'url'=>Yii::app()->createAbsoluteUrl('user/profile/activateApartment', array('id'=>$value->id)), 'icon' => ($value->owner_active == 1) ? 'eye-close' : 'eye-open'),
                                         ),
                                    )
                                ),
                            )
                    );  
              ?>
            </td>
        </tr>
        <?php } } ?>
    </tbody>
  </table>
<?php endif; ?>