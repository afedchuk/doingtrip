<table cellspacing="0" cellpadding="0px" style="font:12px Arial;line-height:1.4em;width:100%">
    <tbody>
        <tr>
            <td>
                <div style="font-size:16px;padding-bottom:10px"><?php echo Yii::t('common', 'Registration welcome {user}', array('{user}' => $firstname)); ?></div>
                <div style="color:#333;font-size:12px">
                    <?php echo isset($activation_url) ? Yii::t('common', 'Register tip activation header') : Yii::t('common', 'Register tip nonactivation header'); ?>
                </div><br/>
                <?php if(isset($activation_url)) {?>
                <div style="color:#000;">
                    <?php echo Yii::t('common', 'Register url activation'); ?>:<br/><a href="<?php echo $activation_url; ?>"><?php echo $activation_url; ?></a>
                </div>
                <?php } ?>
                <br/>
                <div style="color:#000;font-size:12px">
                    <?php echo Yii::t('common', 'Register data cabinet'); ?>:<br/>
                    <strong><?php echo UserModule::t('username') ?>:</strong> <?php echo $email; ?><br/>
                    <strong><?php echo UserModule::t('password') ?>:</strong> <?php echo $password; ?>
                </div>
            </td>
            
        </tr>
    </tbody>
</table>