
<?php if(!empty($cities)) : ?>
    <ul class="regions-parent">
        <li>
        <?php   $i=0;  $str =''; 
                foreach(alphabet() as $result){ $label = true;  ?>
                    <?php if($i%5 == 0 && $i != 0) { ?>
                        </li><li>
                    <?php } ?>
                        <?php if(isset($cities[$result])) {  ?>
                        <?php if($i%5 == 0 && $i != 0) { ?>
                        <div class="clear"></div>
                        <?php $i=0;} ?>
                            <ul>
                                <?php $j=0; foreach ($cities[$result] as $key=>$value){ ?> 
                                        <?php if(strtoupper(substr(trim($value['name']), 0, (Yii::app()->language == 'en' ? 1 : 2))) == $result) { ?>
                                             <?php if($label == true) { ?>
                                                 <li class="abs letter"><?php echo $result ?></li>
                                             <?php $label = false; } ?>
                                             <?php if(isset($cookie['city']) && $cookie['city'] == $value['id']): ?>
                                                 <span class="active"><?php echo $value['name']; ?></span>
                                             <?php else: ?>
                                             <li>
                                                 <?php echo CHtml::link($value['name'], Yii::app()->createUrl('apartments', array('city' => $value['url']))
                                                               )
                                                  ?>
                                             </li>
                                             <?php endif; ?>                                      
                                     <?php   $j++; $str = strtoupper(substr(trim($value['name']), 0, (Yii::app()->language == 'en' ? 1 : 2))); } ?>
                                <?php  } ?>
                             </ul>
                         <?php } ?>
        <?php  $i++; }?>
    </ul>
<?php else: ?>
    <h2><?php echo RegionsModule::t('Result search'); ?></h2>
<?php endif; ?>

<div class="clear"></div>
