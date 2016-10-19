    <div class="row">
      <div class="span4">...</div>
      <div class="span8">...</div>
    </div>
<?php 
$city = City::getCityName($apartment->city->id);
$body = 'BEGIN:VCARD
VERSION:4.0
N:'.$apartment->user->firstname.';'.$apartment->user->lastname.';;;
FN:'.$apartment->user->lastname.' '.$apartment->user->firstname.'
ORG:'.Yii::t('index','Short time').'
TITLE:'.$apartment->description->title.'
TEL;TYPE=work,voice;VALUE=uri:tel:'.$apartment->phone.'
TEL;TYPE=home,voice;VALUE=uri:tel:'.$apartment->phone_additional.'
ADR;TYPE=work;LABEL="'.$city.', '.$apartment->description->address.'"
:;;'.$apartment->description->address.';'.$city.'
EMAIL:'.$apartment->user->email.'
END:VCARD';

        $this->widget('application.extensions.qrcode.QRCodeGenerator',array('data' => $body,
                                                                            'subfolderVar' => true,
                                                                            'matrixPointSize' => 1,
                                                                            'filename' => md5(setTranslite($body)).'.png'
                                                                          )); 
     ?>