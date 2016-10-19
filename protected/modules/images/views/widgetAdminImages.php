<?php

	


    echo '<div class="clear mrgT15"></div><p class="input-desc">'.ApartmentsModule::t('Tip photo {size}{ext}', array('{size}' => bytesToSize(Images::getMaxSizeLimit()), '{ext}' => implode(', ', param('allowedImgExtensions', array('jpg', 'jpeg', 'gif', 'png'))))).'</p><br/>';

    echo '<div class="images-area-admin">';
	if($this->images){ 
		
		$this->widget('application.modules.images.components.AdminViewImagesWidget', array(
			'objectId' => $this->objectId,
			'images' => $this->images,
			'withMain' => $this->withMain,
		));
	} else {
		echo '<strong>'.tc('Photo gallery is empty.').'</strong>';
	}
	echo '</div><div class="mrgT35"></div> ';


	$this->widget('ext.EAjaxUpload.EAjaxUpload',
	array(
		'id'=>'uploadFile',
		'config'=>array(
			'action' => Yii::app()->createUrl('/images/main/upload', array('id' => $this->objectId, 'tmp' => $tmp ? 1 : 0)),
			'allowedExtensions'=> param('allowedImgExtensions', array('jpg', 'jpeg', 'gif', 'png')),
			'sizeLimit' => Images::getMaxSizeLimit(),
			'minSizeLimit' => param('minImgFileSize', 5*1024),
			'multiple' => true,

			'onComplete'=>"js:function(id, fileName, responseJSON){ reloadImagesArea(); }",
			/*'onSubmit' => 'js:function(id, fileName){  }',*/
			'messages'=>array(
				'typeError'=>ImagesModule::t("{file} has invalid extension. Only {extensions} are allowed."),
				'sizeError'=>ImagesModule::t("{file} is too large, maximum file size is {sizeLimit}."),
				'minSizeError'=>ImagesModule::t("{file} is too small, minimum file size is {minSizeLimit}."),
				'emptyError'=>ImagesModule::t("{file} is empty, please select files again without it."),
				'onLeave'=>ImagesModule::t("The files are being uploaded, if you leave now the upload will be cancelled."),
			),
		)
	));

	$this->widget('ext.charcounter.CharCounter', array(
		'target' => '.image-comment-input > textarea',
		'count' => 255,
		'config' => array(
			'container' => '<div></div>',
			'format' => CJavaScript::quote(ImagesModule::t('Characters left')).': %1',
		),
	));

	Yii::app()->clientScript->registerScript('images-reloader', '
		function reInitJs(){
			$(".images-area-admin .fancy").fancybox();
			$(".image-comment-input > textarea").charCounter(255, {
				container: "<div></div>",
				format: "'.CJavaScript::quote(ImagesModule::t('Characters left')).': %1"
			});
			if($(".images-area").find(".image-item").length == 0){
				$(".images-area-admin").html("'.CJavaScript::quote(ImagesModule::t('Photo gallery is empty.')).'");
			}
		}

		$(".setAsMainLink").live("click", function(){
			var id = $(this).closest(".set-main").attr("link-id");
			$.ajax({
				url: "'.Yii::app()->controller->createUrl('/images/main/setMainImage').'?id="+id,
				success: function(data){
					$(".set-main", ".images-area").html("<a class=\"setAsMainLink\" href=\"#\">'.ImagesModule::t('Set as main photo').'</a>");
					$(".set-main[link-id=\'" + id + "\']").html("'.CJavaScript::quote(ImagesModule::t('Main photo')).'");
				}
			});
			return false;
		});

		$(".deleteImageLink").live("click", function(){
			var id = $(this).attr("link-id");
			$.ajax({
				url: "'.Yii::app()->controller->createUrl('/images/main/deleteImage').'?id="+id,
				success: function(result){
					$("#image_"+id).remove();
					if(result){
						$(".set-main[link-id=\'" + result + "\']").html("'.CJavaScript::quote(ImagesModule::t('Main photo')).'");
					}
					reInitJs();
				}
			});
			return false;
		});

		function reloadImagesArea(){
			$.ajax({
				url: "'.Yii::app()->controller->createUrl('/images/main/getImagesForAdmin', array('id' => $this->objectId, 'tmp' => $tmp)).'",
				success: function(data){
                    $(".images-area-admin").html(data)
					
					reInitJs();
				}
			});
		}
	', CClientScript::POS_END);
