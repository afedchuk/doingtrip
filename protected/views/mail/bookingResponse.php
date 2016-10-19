<div>
    <?php echo Yii::t('module_notifier', 'Message response body {name}{title}{date_start}{date_end}{href}{body}', 
              array('{name}' => $apartment['firstname'], 
                    '{href}' => Yii::app()->getBaseUrl(true).$href,
                    '{title}' => $apartment['title'],
                    '{date_start}' => date('m.d.Y', strtotime($apartment['date_start'])),
                    '{date_end}' => date('m.d.Y', strtotime($apartment['date_end']))
                  )
            ); 
    ?>
    <p><?php echo $comment; ?></p>
    <p>
        <?php echo  Yii::t('module_notifier','User contacts'); ?><br/>
        <?php echo Yii::t('module_notifier', 'Phone {phone}', array('{phone}' => implode(',', array($apartment['phone'], $apartment['phone_additional']))));?><br/>
        <?php echo Yii::t('module_notifier', 'User email {email}', array('{email}' =>  $apartment['email']));?>
    </p>
</div>