<div class="wide-folio cities-map">  
	<?php foreach(alphabet() as $result){  ?>
            <?php if(isset($cities[$result])) {  ?>
                <?php foreach ($cities[$result] as $key=>$value){ ?>    
                <?php if($value['count'] > 0 && file_exists(Yii::getPathOfAlias('webroot').'/'.Images::UPLOAD_DIR.'/cities/'.$value['url'].'.jpg')) { ?>
	            <div class="wide-item">
	                <div class="wide-item-titles">
	                    <h4><?php echo $value['name']; ?></h4>
	                    <p><?php echo UserModule::t('Proposition {value}', array('{value}' => $value['count'])); ?></p>
	                    <?php if(strlen($value['description']) > 0) { ?>
		                    <p class="city-description">
		                    	<?php echo getSnippet(strip_tags($value['description']), 250) ; ?> 
		                    	<span><?php echo CHtml::link(ApartmentsModule::t('Show full text'), Yii::app()->createAbsoluteUrl('apartments', array('city' => $value['url'])), array('title' => $value['name'])); ?></span>
		                    </p>
	                    <?php } ?>
	                </div>
	                <a href="#" class="wide-image">
	                    <img alt="img" src="<?php echo Yii::app()->request->getBaseUrl().'/'.Images::UPLOAD_DIR.'/cities/'.$value['url'].'.jpg'; ?> " class="responsive-image">
	                </a>
	            </div>
            	<?php  }} ?>
           <?php } ?>
     <?php }?> 
     <div class="clearfix"></div>   
</div>
