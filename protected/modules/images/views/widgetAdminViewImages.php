<?php if($this->images){ ?>
<div class="images-area">
	<?php $i = 1;
		foreach($this->images as $image){

			if(isset($image['is_main']) && ($this->withMain && $image['is_main'] || !$this->withMain && !$image['is_main'] || !$image['is_main'])){
				?>
				<div class="image-item" id="image_<?php echo $image['id']; ?>">
                    <div class="image-drag-area"></div>
                	<div class="image-link-item <?php echo $image['is_main'] ? "main-photo" : null; ?>">
						<?php
							$imgTag = CHtml::image(Images::getThumbUrl($image, 190, 120), Images::getAlt($image));
							echo CHtml::link($imgTag, Images::getFullSizeUrl($image), array(
								'class' => 'fancy',
								'rel' => 'gallery',
								'title' => Images::getAlt($image),
							));
						?>
						<span class="set-main" link-id="<?php echo $image['id']; ?>">
							<?php
								if($image['is_main']){
									echo ImagesModule::t('Main photo');
								} else {
									echo '<a class="setAsMainLink" href="#">'.ImagesModule::t('Set as main photo').'</a>';
								}
								?>
						</span>
                        <a class="deleteImageLink" link-id="<?php echo $image['id']; ?>" href="#"><?php echo Yii::t('index','Delete');?></a><br/>
					</div>
                    <div class="image-comment-input">
						<?php
							//echo tt('Comment', 'images').': <br />';
							//echo CHtml::textArea('photo_comment['.$image['id'].']', $image['comment']);
						?>
                    </div>
				</div>
				<?php  
			}
            if($i%3 == 0) { ?>
                <div class="clear mrgB40"></div>  
            <?php }
            $i++;
		}
	?>
	<div class="clear"></div>
</div>
<?php } ?>
