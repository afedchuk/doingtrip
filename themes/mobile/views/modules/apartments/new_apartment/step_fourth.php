<div class="items-references">
<?php  if(Apartment::getReferences(NULL)){
                $count = count(Apartment::getReferences(NULL)); $i = 0; ?>
                <ul class="span3">
                <?php  foreach(Apartment::getReferences(NULL) as $reference){ ?>
                    <?php if(round($count/2) == $i): $i =0; ?>
                        </ul><ul class="span2">
                    <?php endif; ?>
                        <li>
                            <?php echo CHtml::checkBox('reference_value_id[]', ((isset($_POST['reference_value_id']) && in_array($reference['reference_id'], $_POST['reference_value_id'])) || in_array($reference['reference_id'], $references)) ? true : false, array('value'=>$reference['reference_id'])); ?>
                            <span><?php echo $reference['title']; ?></span>
                        </li>
                <?php $i++; }
        }
?></ul>
</div>
<div class="clear"></div>
<div class="mrgT35"></div> 
<a class="btn btn-info btn-large" href="#3">
    <?php echo ApartmentsModule::t('Back'); ?>
</a>
<a class="btn btn-info btn-large pull-right next" href="#5">
    <?php echo ApartmentsModule::t('Next'); ?>
</a>

