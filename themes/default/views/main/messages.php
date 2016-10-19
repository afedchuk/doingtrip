<?php Yii::app()->bootstrap->register(); ?>

<div class="gb16">
    <?php $this->widget('bootstrap.widgets.TbAlert', array(
                'block'=>true,
                'fade'=>true,
                'alerts'=>array(
                     'success'=>array('block'=>true, 'fade'=>true),
                     'warning'=>array('block'=>true, 'fade'=>true),
                     'error'=>array('block'=>true, 'fade'=>true),
                ),
            )); ?>
</div>