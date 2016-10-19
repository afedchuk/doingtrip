<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Requests");
$this->breadcrumbs=array(
	UserModule::t("Profile") => array('/user/profile'),
	UserModule::t("Requests"),
);
Yii::app()->clientScript->registerScript('actionsBooking', '
    $(".dropdown-menu a:first-child").live("click", function(e) {
      $.get($(this).attr("href"), {}, function() {
          window.location.reload();
      });
      return false;
    });', CClientScript::POS_END, array(), true);
?>

<div class="contain row-fluid profile-wrapper">
    <div class="span9">
        <?php if(empty($model)) { ?>
        <div class="well">
            <div class="hero-strapline">
              <div class="page-header">
                  <h4><?php echo UserModule::t('You dont have requests {s}'); ?></h4>
              </div>
              <a href="<?php echo Yii::app()->createUrl('/user/profile'); ?>" class="btn btn-large btn-info">
                  <i class="icon-home icon-white"></i> <?php echo UserModule::t('Cabinet of user'); ?>
              </a>
            </div>
        </div>
        <?php } else { ?>
        <div class="well"> 
                <div class="page-header">
                    <h4><?php echo UserModule::t("Requests"); ?></h4>
                </div>
                <p class="alert alert-info"><?php echo BookingModule::t('Tip booking aprove'); ?></p>
                <div class="profile-edit">
                    <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Пропозиція</th>
                        <th>Користувач</th>
                        <th>Контакти</th>
                        <th><?php echo BookingModule::t('Check-in date'); ?></th>
                        <th><?php echo BookingModule::t('Check-out date'); ?></th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php foreach($model as $apartment) { ?>
                        <?php $title = Apartment::model()->getStrByLang($apartment->apartment->id); 
                        $city_name = City::getCityName($apartment->apartment->city_id);
                        ?>
                        <tr>
                          <td><?php if($apartment->status == 0) { 
                                    $this->widget('bootstrap.widgets.TbBadge', array(
                                        'type'=>'success',
                                        'label'=>$apartment->id,
                                    ));  

                                    } else { 
                                         echo $apartment->id;
                                    }
                                ?>
                          </td>
                          <td><a href="<?php echo Apartment::model()->getUrl($apartment->apartment->id, $title, $city_name); ?>"><?php echo $title; ?></a></td>
                          <td>
                              <?php echo $apartment->user->firstname; ?>
                          </td>
                          <td>
                              <?php echo $apartment->user->phone; ?><br/>
                              <?php echo $apartment->user->email; ?>
                          </td>
                          <td>
                              <?php echo date("d.m.y", strtotime($apartment->date_start)); ?>
                          </td>
                          <td>
                              <?php echo date("d.m.y", strtotime($apartment->date_end)); ?>
                          </td>
                          <td>
                              <?php 
                                    $this->widget('bootstrap.widgets.TbMenu', 
                                            array(
                                                'htmlOptions'=>array('class'=>'pull-right'),
                                                'items'=>array(
                                                    array('label'=>'Дії', 'url'=>Yii::app()->createAbsoluteUrl('user/main/registration'), 'items' => array(
                                                          array('label'=>Yii::t('user', 'Підтвердити бронювання'), 'url'=>Yii::app()->createAbsoluteUrl('booking/main/aprove/', array('id' => $apartment->id)), 'icon' => 'ok', 'visible' => ($apartment->status == 0 ? true : false)),
                                                          array('label'=>Yii::t('user', 'Надіслати лист'), 'url'=>Yii::app()->createAbsoluteUrl('booking/main/response/', array('id' => $apartment->id, 'user_id'=>$apartment->user_id)), 'itemOptions'=>array('data-toggle' => 'modal'), 'icon' => 'envelope')
                                                         ),
                                                    )
                                                ),
                                            )
                                    ); 
                              ?>
                          </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                  </table>
                </div>
                </div>
            <?php } ?>
            </div>
            <?php echo $this->renderPartial('profile/menu'); ?>       
</div>