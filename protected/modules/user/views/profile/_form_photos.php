<div> 
    <?php 
            $this->widget('application.modules.images.components.AdminImagesWidget', array(
                'images' => $model->images,
                'objectId' => $model->id,
            ));
    ?>
</div>