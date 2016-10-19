<table cellspacing="0" cellpadding="0px" style="font:12px Arial;line-height:1.4em;width:100%">
    <tbody>
        <tr>
            <td>
                <div style="color:#d44b38;font-size:18px;padding-bottom:10px"><?php echo Yii::t('common', 'Registration welcome {user}', array('{user}' => $firstname)); ?></div>
                <div style="color:#333;font-size:12px">
                    <?php echo Yii::t('common', 'Booking tip {prop} {user} {url}', array('{prop}' => $title,'{user}' => $name, '{url}' => Yii::app()->createAbsoluteUrl('/user/login'))); ?>
                </div><br/>
                <div style="color:#000;font-size:12px">
                    <b><?php echo Yii::t('common', 'Booking detail'); ?>:</b>
                    <p style="color:#333;">
                    <div><?php echo BookingModule::t('Book unique'); ?>: <i><?php echo $book_unique; ?></i></div>
                    <div><?php echo BookingModule::t('Pin'); ?>: <i><?php echo $pin; ?></i></div>
                    <div><?php echo UserModule::t('Telephone'); ?>: <i><?php echo $phone; ?></i></div>
                    <div><?php echo UserModule::t('E-mail'); ?>: <i><?php echo $email; ?></i></div>
                    <div><?php echo BookingModule::t('Check-in date'); ?>: <i><?php echo $date_from; ?></i></div>
                    <div><?php echo BookingModule::t('Check-out date'); ?>: <i><?php echo $date_to; ?></i></div>
                    <?php if($comment) { ?>
                        <br/>
                        <?php echo $comment; ?>
                    <?php } ?>
                    </p>
                </div>
            </td>
            
        </tr>
    </tbody>
</table>