<table cellspacing="0" cellpadding="0px" style="font:12px Arial;line-height:1.4em;width:100%">
    <tbody>
        <tr>
            <td>
                <div style="color:#333;font-size:12px">
                    <?php echo Yii::t('common', 'Booking restore tip'); ?>
                </div><br/>
                <br/>
                <div style="color:#000;font-size:12px">
                    <b><?php echo Yii::t('common', 'Booking detail'); ?>:</b>
                    <p style="color:#333;">
                        <div><?php echo BookingModule::t('Book unique'); ?>: <i><?php echo $book_unique; ?></i></div>
                        <div><?php echo BookingModule::t('Pin'); ?>: <i><?php echo $pin; ?></i></div>
                    </p>
                </div>
            </td>
            
        </tr>
    </tbody>
</table>