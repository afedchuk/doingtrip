<div id="left">
    <div class="categories">
      <ul class="nav nav-pills">
        <?php if (Yii::app()->user->isGuest){ ?>
            <li <?php echo $this->route == 'user/main/login' ? 'class="active"' : null; ?>>
                <?php echo CHtml::link(UserModule::t("Login"), Yii::app()->createAbsoluteUrl('user/main/login')); ?>
            </li>
            <li <?php echo $this->route == 'user/main/registration' ? 'class="active"' : null; ?>><?php echo CHtml::link(UserModule::t("Register"), Yii::app()->createAbsoluteUrl('user/main/registration') ); ?></li>
            <li <?php echo $this->route == 'user/main/recovery' ? 'class="active"' : null; ?>><?php echo CHtml::link(UserModule::t("Lost Password?"),Yii::app()->createAbsoluteUrl('user/main/recovery')); ?></li>
        <?php } else { ?>
            <li <?php echo Yii::app()->controller->module->id == 'news' ? 'class="active"' : null; ?>>
                <?php echo CHtml::link(Yii::t('index', 'News'),Yii::app()->createUrl('news')); ?>
            </li>
            <li <?php echo Yii::app()->controller->module->id == 'articles' ? 'class="active"' : null; ?>><?php echo CHtml::link(Yii::t('index', 'Faq'),Yii::app()->createUrl('articles')); ?></li>
            <li <?php echo $this->action->controller->id == 'apartments' ? 'class="active"' : null; ?>><?php echo CHtml::link(Yii::t('index', 'Add proposition'),Yii::app()->createAbsoluteUrl('apartments/main/new')); ?></li>
        <?php } ?>
        <li <?php echo $this->route == 'contactform/main/index' ? 'class="active"' : null; ?>><?php echo CHtml::link(Yii::t('index', 'Contact'),Yii::app()->createAbsoluteUrl('contactform')); ?></li>
        <?php if($this->module->getName() == 'pages') { ?>
            <?php  $all = Page::model()
                            ->cache(param('cachingTime', 1209600), Page::getDependency())
                            ->findAll('is_published=:is_published', array(':is_published' => 1)); ?>
            <?php  foreach ($all as $value) : ?>
            <li class="link-window-open <?php if($_GET['id'] == $value->page_id):?> active<?php endif;?>">
                <a href="<?php echo Page::getUrl($value->page_id); ?>"><?php echo $value->page_title; ?></a>
            </li>
            <?php endforeach; ?>
        <?php } ?>
      </ul>
    </div>
</div>
