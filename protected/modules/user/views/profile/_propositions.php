<?php if(!empty($model['apartments'])):  ?>
    <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Пропозиція</th>
                        <th>Користувач</th>
                        <th>Контакти</th>
                        <th>Дата заїзду</th>
                        <th>Дата виїзду</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php foreach($$model['apartments'] as $value) { ?>
                       
                        <tr>
                          <td>
                            <h4 class="title">
                 <a href="<?php echo $value->getUrl($value->id, $value['description']['title'], $value['city']['name']); ?>" class="some_link"><?php echo $value['description']['title']; ?></a>
             </h4>
                          </td>
                         
                        </tr>
                        <?php } ?>
                                            </tbody>
                  </table>
<?php  foreach($model['apartments'] as $value): ?>
 <div  class="user-apartment-block">
         <div class="thumb-with-price">
             <div class="public_ad_img">
                 <?php
                       $res = Images::getMainThumb(180, 150, $value->images);
                       $img = CHtml::image($res['thumbUrl'], $res['comment']);
                       echo $img;
                  ?>
             </div>
         </div>
         <div class="apartament-details">
             <h4 class="title">
                 <a href="<?php echo $value->getUrl($value->id, $value['description']['title'], $value['city']['name']); ?>" class="some_link"><?php echo $value['description']['title']; ?></a>
             </h4>
             <div class="apartament-description"><?php echo isset($value->description->description) ? getSnippet($value->description->description, 250) : ''; ?></div>
             <?php $comments = Comment::model()->with('apartment')->findAll('apartment_id=:apartment_id', array(':apartment_id'=>$value->id));  $count = count($comments); ?>
             <?php $this->widget('bootstrap.widgets.TbButtonGroup', array(
                        'type' => 'info',
                        'size' => 'small',
                        'buttons'=>array(
                           array('label'=>'Коментарів ('.$count.')', 'url'=>'javascript:void(0);', 'htmlOptions' => array('onclick' => 'if($(this).is(\':visible\')) { $(this).parents(\'.apartament-details\').find(\'.comments\').slideDown(); } else { $(this).parents(\'.apartament-details\').find(\'.comments\').slideUp(); }')),
                           array('label'=>'Редагувати', 'url'=>Yii::app()->createAbsoluteUrl('user/profile/editApartment', array('user'=>$value['user']['username'],'id'=>$value->id))),
                           array('label'=>'Видалити', 'url'=>Yii::app()->createAbsoluteUrl('user/profile/deleteApartment', array('user'=>$value['user']['username'],'id'=>$value->id)), 'htmlOptions' => array('onclick' => 'if(!confirm("'.UserModule::t('Are you sure that you want to delete proposition?').'")) { return false; }')),
                           array('label'=>($value->active == 1) ? 'Деактивувати' : 'Активувати', 'url'=>Yii::app()->createAbsoluteUrl('user/profile/activateApartment', array('id'=>$value->id)), 'toggle'=>true),
                         ),
                   )); ?>
             <div class="clear"></div>
             <?php if(!empty($comments)) {
                     ?>
                     <div class="user-block-comments">
                             <div class="comments">
                                 <ul>
                                     <?php  foreach($comments as $comment) { ?>
                                             <li><strong><?php echo $comment->name; ?></strong><br/> <?php echo $comment->body, 80; ?><a class="response"></a></li>
                                     <?php } ?>
                                 </ul>
                             </div>
                     </div>
                     <?php } ?>
         </div>
     <div class="clear"></div>
 </div>
<?php endforeach; ?>
<?php endif; ?>
