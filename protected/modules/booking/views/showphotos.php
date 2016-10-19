<?php 
$this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'modal-booking')); ?>
        <div class="modal-header">
            <a class="close" data-dismiss="modal">&times;</a>
            <h2><?php echo $model->description->title; ?></h2>      
        </div>
        <div class="modal-body">
            <?php 
                if ($model->images && !empty($model->images)) {
                    $image = Images::getMainThumb(10, 200, $model->images);
                    $this->widget('application.modules.images.components.ImagesWidget', array(
                        'images' => $model->images,
                        'objectId' => $model->id,
                        'numThumbs' => 5,
                    ));
                }
            ?>
        </div>
<?php $this->endWidget(); ?>