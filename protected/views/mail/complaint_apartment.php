<table cellspacing="0" cellpadding="0px" style="font:12px Arial;line-height:1.4em;width:100%">
    <tbody>
        <tr>
            <td>
                <div style="color:#d44b38;font-size:18px;padding-bottom:10px"><?php echo Yii::t('common', 'Registration welcome {user}', array('{user}' => $firstname)); ?></div>
                <div style="color:#333;font-size:12px">
                    <?php echo Yii::t('common', 'Complaint tip {user} {url}', array('{user}' => $user, '{url}' => Yii::app()->createAbsoluteUrl('/user/login'))); ?>
                </div><br/>
                <div style="color:#000;font-size:12px">
                    <?php echo Yii::t('common', 'Complaint text'); ?>:<br/>
                    <p style="color:#333;"><?php echo $text; ?></p>
                </div>
                <div style="color:#000;font-size:12px">
                   <?php echo Yii::t('common', 'Tip administration'); ?>:
                   <a href="<?php echo Yii::app()->createAbsoluteUrl('/contacts')?>"><?php echo Yii::app()->createAbsoluteUrl('/contacts')?></a>
                </div>
            </td>
            
        </tr>
    </tbody>
</table>