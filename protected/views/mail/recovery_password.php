<table cellspacing="0" cellpadding="0px" style="font:12px Arial;line-height:1.4em;width:100%">
    <tbody>
        <tr>
            <td>
                <div style="color:#d44b38;font-size:18px;padding-bottom:10px"><?php echo Yii::t('common', 'Registration welcome {user}', array('{user}' => $firstname)); ?></div>
                <div style="color:#333;font-size:12px">
                    <?php echo Yii::t('common', 'Recovery tip'); ?>
                </div><br/>
                 <div style="color:#000;">
                    <a href="<?php echo Yii::app()->createAbsoluteUrl('user/login'); ?>">
                        <?php echo Yii::app()->createAbsoluteUrl('user/login'); ?>
                    </a>
                 </div>
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