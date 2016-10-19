<?php if(isset($this->breadcrumbs) && !empty($this->breadcrumbs)):?>
        <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                'links'=>$this->breadcrumbs,
                'separator'=> '<span>/</span>',
                'htmlOptions'=>array('class'=>'breadcrumb'),
        )); ?>
<?php endif?>
