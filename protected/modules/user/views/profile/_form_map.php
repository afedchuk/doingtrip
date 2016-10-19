<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->getBaseUrl(). '/assets/js/jquery.amap.js', CClientScript::POS_HEAD);
if(!$model->isNewRecord  && (param('useGoogleMap', 1) || param('useYandexMap', 1))) {
    if(param('useGoogleMap', 1) || param('useYandexMap', 1)){
        echo '<p class="input-desc">'.UserModule::t('Click on the map to set the location of an object or move an existing marker.').'</p>';
    }
    if (param('useGoogleMap', 1)){
        ?>
        <div id="gmap">
            <?php echo $this->actionGmap($model->id); ?>
        </div>
        <?php
    } elseif (param('useYandexMap', 1)) {
        ?>
        <div id="ymap">
            <?php echo $this->actionYmap($model->id, $model); ?>
        </div>
        <?php
    }elseif (param('useOSMMap', 1)) {
        ?>
        <div id="osmap">
            <?php echo $this->actionOSmap($model->id, $model); ?>
        </div>
    <?php
    }?>
    <br/>
    <div class="form-inline">
        <div class="span9">
            <?php echo CHtml::textField('address_for_map', '', array('class' => 'span12')); ?>
        </div>
        <div class="span3">
            <?php $this->widget('bootstrap.widgets.TbButton',
                array(
                    'buttonType' => 'link',
                    'type'=>'info',
                    'size'=>'small',
                    'icon' => 'search white',
                    'label' => UserModule::t('Set a marker by address'),
                    'htmlOptions' => array(
                        'onclick' => "findByAddress(); return false;",
                    )
                ));
            ?>
        </div>
    </div>
<br/>
<?php } ?>
<?php 
	Yii::app()->clientScript->registerScript('gmap-init', '
		var useYandexMap = '.param('useYandexMap', 1).';
		var useGoogleMap = '.param('useGoogleMap', 1).';
            
		var lang = "'.Yii::app()->language.'";
		var address = "";

        function addAddressString(string){
            if(typeof string == "undefined" || string.length == 0){
                return "";
            }
            var sep = address.length > 0 ? ", " : "";
            return sep + string;
        }

		function reInitMap(){
		    address = "";
		    if($("#Apartment_city_id").length){
		        address += addAddressString($("#Apartment_city_id option:selected").html());
		    } 
			address += addAddressString($("#Description_"+lang+"_address").val());
			$("#address_for_map").val(address);
           
			// place code to end of queue
			if(useGoogleMap){
				setTimeout(function(){
					var tmpGmapCenter = mapGMap.getCenter();
					google.maps.event.trigger($("#googleMap")[0], "resize");
					mapGMap.setCenter(tmpGmapCenter);
                    markersGMap['.$model->id.'].setIcon("/images/house-hover.png");
				}, 0);
			}

			if(useYandexMap){
				setTimeout(function(){
					ymaps.ready(function () {
						globalYMap.container.fitToViewport();
						globalYMap.setCenter(globalYMap.getCenter());
					});
				}, 0);
			}
		}

		function findByAddress(){
			var address = $("#address_for_map").val();
			if(!address){
				error("'.tc('Please enter address').'");
				return false;
			}
			AGeoCoder.getDataByAddress(address, {
				success: function(){
					if(useGoogleMap && typeof markersGMap['.$model->id.'] !== "undefined" && typeof mapGMap !== "undefined"){
						var latLng = new google.maps.LatLng(AGeoCoder.geoData.lat, AGeoCoder.geoData.lng);
						markersGMap['.$model->id.'].setPosition(latLng);
						mapGMap.setCenter(latLng);
					}
					if(useYandexMap && typeof placemark !== "undefined" && typeof globalYMap !== "undefined"){
						placemark.geometry.setCoordinates([AGeoCoder.geoData.lng, AGeoCoder.geoData.lat]);
						globalYMap.setCenter([AGeoCoder.geoData.lng, AGeoCoder.geoData.lat]);
					}
					
					setMarker(AGeoCoder.geoData.lat, AGeoCoder.geoData.lng);
				}
			});
		}

		function setMarker(lat, lng){
			$.ajax({
				type:"POST",
				url:"'.Yii::app()->controller->createUrl('savecoords', array('id' => $model->id) ).'",
				data:({lat: lat, lng: lng}),
				cache:false
			})
		}
        
        $("#apartment-tab").on("shown", function (e) {
            google.maps.event.trigger(mapGMap, "resize");
        });
	', CClientScript::POS_END);
?>