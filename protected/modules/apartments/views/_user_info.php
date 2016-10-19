<div class="contact-info-detail">
    <table>
        <tbody>
            <tr>
                <td>
                    <?php if(!$user->user_image) { ?>
                        <i class="fa fa-user fa-16x" style="color: #999;font-size: 92px; width: 90px;"></i>
                    <?php } else { ?>
                        <img alt="<?php echo $user->firstname; ?>" src="<?php echo Yii::app()->getBaseUrl(true).'/uploads/users/'.$user->user_image; ?>" class="thumbnail" width="90">
                    <?php } ?>
            </td>
            <td>
                <div><?php echo $user->username; ?></div>
                <h3><?php echo implode(" ", array($user->firstname, $user->lastname))?></h3>
                <span class="status<?php if($this->user_online) { ?> online<?php }?>"><br/>
                  <i class="fa fa-circle"></i> <?php echo ($this->user_online == true ? UserModule::t('User online') : UserModule::t('User offline')); ?>
                </span>
                <span class="date">(<?php echo UserModule::t('Registration date') . ': '. date("Y/m/d", $user->createtime); ?>)</span>
                <?php if($user->lastvisit > 0) { ?>
                    <span class="date">(<?php echo UserModule::t('Last visit') . ': '. date("Y/m/d", $user->lastvisit); ?>)</span>
                <?php } ?>
            </td>
        </tr>
        </tbody>
    </table> <br/>
    <table class="table table-hover">
        <tbody>
        <tr>
            <td><strong><?php echo ApartmentsModule::t('Email'); ?>:</strong></td>
            <td>
                <img rel="nofollow" src="<?php echo Yii::app()->controller->createAbsoluteUrl('/apartments/main/generatephone', array('lang' => 'en', 'id' => $user->id, 'text'=>base64_encode($user->email), 'width' => 200, 'font' => 2, 'height' => 25)); ?>"/>
            </td>
        </tr>
        <?php if($user->website) {?>
            <tr>
                <td><strong><?php echo UserModule::t('Website'); ?>:</strong></td>
                <td><span><a target="_blank" href="<?php echo addhttp($user->website); ?>"><?php echo addhttp($user->website); ?></a></span></td>
            </tr>
        <?php } ?>
        <?php if($user->skype) {?>
            <tr>
               <td><strong><?php echo UserModule::t('Skype'); ?>:</strong></td>
                <td><span><?php echo $user->skype; ?></span></td>
            </tr>
        <?php } ?>
        <?php if($user->viber) {?>
            <tr>
               <td><strong><?php echo UserModule::t('Viber'); ?>:</strong></td>
                <td><span><?php echo $user->viber; ?></span></td>
            </tr>
        <?php } ?>
        <tr>
            <td><strong><?php echo UserModule::t('Telephone'); ?>:</strong></td>
            <td>
                <img rel="nofollow" src="<?php echo Yii::app()->controller->createAbsoluteUrl('/apartments/main/generatephone', array('lang' => 'en', 'id' => $user->id, 'text'=>base64_encode(Apartment::codePhone($user->phone).':'.Apartment::codePhone($user->phone_additional)))); ?>"/>
            </td>
        </tr>
         </tbody>
     </table>
    <br/>  
</div>
