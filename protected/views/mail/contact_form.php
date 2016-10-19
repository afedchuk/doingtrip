<table cellspacing="0" cellpadding="30px" style="color:#666;font:12px Arial;line-height:1.4em;border:solid 1px #dfdfdf;width:100%">
    <tbody>
        <tr>
            <td>
                <div style="color:#d44b38;font-size:22px;padding-bottom:10px">Вам відправлено повідомлення з сайту Подобової оренди нерухомості!</div>
                <div style="color:#777;font-size:14px"><?php echo $model->body; ?></div><br/>
                <div style="color:#000;font-size:12px">
                    Контактні дані<br/><br/>
                    <strong>Ім'я: </strong> <?php echo $model->name; ?><br/>
                    <strong>Електронна адреса: </strong> <?php echo $model->email; ?><br/>
                    <?php if($model->phone != '') { ?>
                        <strong>Телефон: </strong> <?php echo $model->phone; ?>
                    <?php } ?>
                </div>
            </td>
            
        </tr>
    </tbody>
</table>