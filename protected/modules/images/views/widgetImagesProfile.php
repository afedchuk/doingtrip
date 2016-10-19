<?php if($this->images) : ?>
            <ul class="">
                <?php foreach($this->images as $image) : ?>
                    <li>
                        <?php
                            $imgTag = CHtml::image(Images::getThumbUrl($image, 280, 270), Images::getAlt($image));
                            echo CHtml::link($imgTag, Images::getFullSizeUrl($image), array(
                                'title' => Images::getAlt($image),
                            ));
                        ?>

                <?php endforeach; ?>
            </ul> 
<?php endif; ?>   