<div class="input-desc"><?php echo ApartmentsModule::t('Tip services'); ?></div>
<div class="control-group services">
    <div class="controls">
        <?php 
                if($categories){
                        $count = count($categories); $i = 0; ?>
                        <div class="span6">
                        <?php  foreach($categories as $reference){ ?>
                            <?php if(round($count/2) == $i): $i =0; ?>
                                </div><div class="span6">
                            <?php endif; ?>
                            <label class="checkbox">
                                <?php echo CHtml::checkBox('reference_value_id[]', (isset($_POST['reference_value_id']) && in_array($reference['reference_id'], $_POST['reference_value_id']) || (isset($selected) && in_array($reference['reference_id'], $selected))) ? true : false, array('value'=>$reference['reference_id'])); ?>
                                <?php echo $reference['title']; ?>
                            </label>   
                        <?php $i++; }
                }
        ?>
    </div>
</div>
</div>