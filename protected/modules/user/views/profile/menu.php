<div class="span3">
    <div class="sidebar-nav">
        <?php if(Yii::app()->user->getState('isAdmin') && !Yii::app()->request->getQuery('user_id')) { ?>
            <?php  
            $countApartmentModeration = Apartment::getCountModeration();
            $bageListings = ($countApartmentModeration > 0) ? "&nbsp<span class=\"badge\">{$countApartmentModeration}</span>" : '';

            if(issetModule('payment')){
                $countPaymentWait = Payments::getCountWait();
                $bagePayments = ($countPaymentWait > 0) ? "&nbsp<span class=\"badge\">{$countPaymentWait}</span>" : '';
            }

            $countCommentPending = Comment::getCountPending();
            $bageComments = ($countCommentPending > 0) ? "&nbsp<span class=\"badge\">{$countCommentPending}</span>" : '';

            $countComplainPending = Complaint::getCountPending();
            $bageComplain = ($countComplainPending > 0) ? "&nbsp<span class=\"badge\">{$countComplainPending}</span>" : '';
            $baseUrl = Yii::app()->getBaseUrl();
            $this->widget('bootstrap.widgets.TbMenu', array(
                        'type' => 'list',
                        'encodeLabel' => false,
                        'items' => array(
                            array('label' => tc('Listings')),
                            array('label' => tc('Listings') . $bageListings, 'icon' => 'icon-list-alt', 'url' => Yii::app()->createAbsoluteUrl('/user/profile'), 'active' => $this->action->id == 'profile' ? true : false),
                            array('label' => tc('List your property'), 'icon' => 'icon-plus-sign', 'url' =>Yii::app()->createAbsoluteUrl('/user/profile/createApartment'), 'active' => $this->action->id == 'createApartment' ? true : false),
                            array('label' => tc('Comments') . $bageComments, 'icon' => 'icon-list-alt', 'url' => $baseUrl . '/comments/backend/main/admin', 'active' => isActive('comments')),
                            array('label' => tc('Complains') . $bageComplain, 'icon' => 'icon-list-alt', 'url' => $baseUrl . '/booking/backend/complaint/admin', 'active' => isActive('apartmentsComplain')),

                            array('label' => tc('Users')),
                            array('label' => tc('Users'), 'icon' => 'icon-list-alt', 'url' => $baseUrl . '/user/backend/main/admin', 'active' => isActive('user') && $this->action->id == 'admin' ? true : false),
                            //array('label' => tt('Add user', 'users'), 'icon' => 'icon-plus-sign', 'url' => $baseUrl . '/users/backend/main/create', 'active' => isActive('users.create')),


                            array('label' => tc('Content')),
                            array('label' => tc('News'), 'icon' => 'icon-file', 'url' => $baseUrl . '/news/backend/main/admin', 'active' => isActive('news')),
                            //array('label' => tc('Top menu items'), 'icon' => 'icon-file', 'url' => $baseUrl . '/menumanager/backend/main/admin', 'active' => isActive('menumanager')),
                            array('label' => tc('Q&As'), 'icon' => 'icon-file', 'url' => $baseUrl . '/articles/backend/main/admin', 'active' => isActive('articles')),

                            //array('label' => tc('MODULE of Payments & Payment systems ')),
                            //array('label' => tc('Paid services'), 'icon' => 'icon-shopping-cart', 'url' => $baseUrl . '/paidservices/backend/main/admin', 'active' => isActive('paidservices')),
                            //array('label' => tc('Manage payments') , 'icon' => 'icon-shopping-cart', 'url' => $baseUrl . '/payment/backend/main/admin', 'active' => isActive('payment')),
                            //array('label' => tc('Payment systems'), 'icon' => 'icon-wrench', 'url' => $baseUrl . '/payment/backend/paysystem/admin', 'active' => isActive('payment.paysystem')),

                            array('label' => tc('References')),
                            array('label' => tc('Categories of references'), 'icon' => 'icon-asterisk', 'url' => $baseUrl . '/referencecategories/backend/main/admin', 'active' => isActive('referencecategories')),
                            array('label' => tc('Values of references'), 'icon' => 'icon-asterisk', 'url' => $baseUrl . '/referencevalues/backend/main/admin', 'active' => isActive('referencevalues')),
                            //array('label' => tc('Reference "View:"'), 'icon' => 'icon-asterisk', 'url' => $baseUrl . '/windowto/backend/main/admin', 'active' => isActive('windowto')),
                            //array('label' => tc('Reference "Check-in"'), 'icon' => 'icon-asterisk', 'url' => $baseUrl . '/timesin/backend/main/admin', 'active' => isActive('timesin')),
                            //array('label' => tc('Reference "Check-out"'), 'icon' => 'icon-asterisk', 'url' => $baseUrl . '/timesout/backend/main/admin', 'active' => isActive('timesout')),
                            //array('label' => tc('Reference "Property types"'), 'icon' => 'icon-asterisk', 'url' => $baseUrl . '/apartmentObjType/backend/main/admin', 'active' => isActive('apartmentObjType')),
                            array('label' => tc('Reference "City/Cities"'), 'icon' => 'icon-asterisk', 'url' => $baseUrl . '/regions/backend/main/admin', 'active' => isActive('apartmentCity')),

                            array('label' => tc('Settings')),
                            array('label' => tc('Settings'), 'icon' => 'icon-wrench', 'url' => $baseUrl . '/configuration/backend/main/admin', 'active' => isActive('configuration')),
                            array('label' => tc('Templates of letters'), 'icon' => 'icon-wrench', 'url' => $baseUrl . '/notifier/backend/main/admin', 'active' => isActive('notifier')),
                            array('label' => tc('Images'), 'icon' => 'icon-wrench', 'url' => $baseUrl . '/images/backend/main/index', 'active' => isActive('images')),
                            array('label' => tc('Change admin password'), 'icon' => 'icon-wrench', 'url' => $baseUrl . '/adminpass/backend/main/index', 'active' => isActive('adminpass')),
                            //array('label' => tc('Seo settings'), 'icon' => 'icon-wrench', 'url' => $baseUrl . '/seo/backend/main/admin', 'active' => isActive('seo')),
                            array('label' => tc('Site service '), 'icon' => 'icon-wrench', 'url' => $baseUrl . '/service/backend/main/admin', 'active' => isActive('service'), 'visible' => issetModule('service')),
                            array('label' => tc('Authentication services'), 'icon' => 'icon-wrench', 'url' => $baseUrl . '/socialauth/backend/main/admin', 'active' => isActive('socialauth'), 'visible' => issetModule('socialauth')),

                            array('label' => tc('Languages and currency')),
                            array('label' => tc('Languages'), 'icon' => 'icon-globe', 'url' => $baseUrl . '/lang/backend/main/admin', 'active' => isActive('lang')),
                            //array('label' => tc('Translations'), 'icon' => 'icon-wrench', 'url' => $baseUrl . '/translateMessage/backend/main/admin', 'active' => isActive('translateMessage')),
                            array('label' => tc('Currencies'), 'icon' => 'icon-wrench', 'url' => $baseUrl . '/currencymanager/backend/main/admin', 'active' => isActive('currency')),

                            //array('label' => tc('Modules')),
                            //array('label' => tc('Slide-show on the Home page'), 'icon' => 'icon-circle-arrow-right', 'url' => $baseUrl . '/slider/backend/main/admin', 'active' => isActive('slider')),
                            //array('label' => tc('Import / Export'), 'icon' => 'icon-circle-arrow-right', 'url' => $baseUrl . '/iecsv/backend/main/admin', 'active' => isActive('iecsv')),
                            //array('label' => tc('Advertising banners'), 'icon' => 'icon-circle-arrow-right', 'url' => $baseUrl . '/advertising/backend/advert/admin', 'active' => isActive('advertising')),

                            //array('label' => tc('Other')),
                            
                        ),
                    ));
            ?><br/>
            <div class="well">
                <?php Yii::app()->counter->refresh();?>
                <i><?php echo UserModule::t('Users online'). ': </i>'.Yii::app()->counter->getOnline(); ?><br />
                <i><?php echo UserModule::t('Users today'). ': </i>'.Yii::app()->counter->getToday(); ?><br />
                <i><?php echo UserModule::t('Users yesterday'). ': </i>'.Yii::app()->counter->getYesterday(); ?><br />
                <i><?php echo UserModule::t('Users total'). ': </i>'.Yii::app()->counter->getTotal(); ?><br />
                <i><?php echo UserModule::t('Users maximum'). ': </i>'.Yii::app()->counter->getMaximal(); ?><br />
                <i><?php echo UserModule::t('Users date for maximum'). ': </i>'.date('d.m.Y', Yii::app()->counter->getMaximalTime()); ?><br />
            </div>
            <?php  }  else { ?>
                <?php $user = User::model()->find('id=:id', array(':id'=>Yii::app()->user->id)); ?>
                <?php $this->widget('bootstrap.widgets.TbMenu', array(
                    'type'=>'list', 
                    'encodeLabel' => false,
                    'stacked'=>false, 
                    'items'=>array(
                        array('label' => (Yii::app()->user->getState('type') == 1 ? tc('Booking') : tc('Listings'))),
                        array('label'=> (Yii::app()->user->getState('type') == 1 ? tc('Booking') : tc('Listings')), 'icon' => 'home','url'=>Yii::app()->createUrl('/user/profile'), 'active'=> $this->action->id == 'profile' ? true : false),
                        array('label'=>UserModule::t('Complaint'), 'icon' => 'comment', 'url'=>Yii::app()->createUrl('/user/profile/complaints'), 'active' => $this->action->id == 'complaints' ? true : false, 'visible' => !Yii::app()->user->getState('type') ? true : false),
                        array('label'=>UserModule::t('Requests').(Yii::app()->getModule('booking')->getCountUnreadedBookings(Yii::app()->user->getId()) ? ' <span class="badge badge-inverse"> +'.Yii::app()->getModule('booking')->getCountUnreadedBookings(Yii::app()->user->getId()).'</span>' : '  '), 'icon' => 'list-alt', 'url'=>Yii::app()->createUrl('/user/profile/requests'), 'active' => $this->action->id == 'requests' ? true : false, 'visible' => !Yii::app()->user->getState('type') ? true : false),
                        array('label'=>UserModule::t('Create apartment'), 'icon' => 'ok-circle','url'=>Yii::app()->createUrl('/user/profile/createApartment'), 'active' => $this->action->id == 'createApartment' ? true : false, 'visible' => !Yii::app()->user->getState('type') ? true : false),
                        array('label' => UserModule::t('Profile')),
                        array('label'=>UserModule::t('Edit'), 'url'=>Yii::app()->createUrl('/user/profile/edit'), 'icon' => 'edit', 'active' => $this->action->id == 'edit' ? true : false),
                        array('label'=>UserModule::t('Change password'), 'icon' => 'cog','url'=>Yii::app()->createUrl('/user/profile/changepassword'), 'active' =>$this->action->id == 'changepassword' ? true : false),
                        array('label'=>UserModule::t('Logout'), 'icon' => 'off', 'url'=>array('/user/main/logout')),
                        array('label' => MessageModule::t('Messages')),
                        array('label'=>MessageModule::t("Inbox"), 'url'=>Yii::app()->createUrl('/message/inbox'), 'icon' => 'inbox', 'active' => $this->action->id == 'inbox' ? true : false),
                        array('label'=>MessageModule::t("Sent"), 'url'=>Yii::app()->createUrl('/message/sent'), 'icon' => 'share', 'active' => $this->action->id == 'sent' ? true : false),
                        array('label'=>MessageModule::t('Compose New Message'), 'url'=>Yii::app()->createUrl('/message/compose'), 'icon' => 'envelope', 'active' => $this->action->id == 'compose' ? true : false),
                    ),
                    'htmlOptions' => array('class' => 'profile-navbar')
                )); ?>

                <div class="well mrgT35">
                <?php $this->widget('application.extensions.fbLikeBox.fbLikeBox', array(
        'likebox' => array(
        'url'=>'https://facebook.com/house4trip',
        'header'=>'false',
        'width'=>'200',
        'height'=>'300',
        'layout'=>'light',
        'show_post'=>'false', 
        'show_faces'=>'true',
        'show_border'=>'false',
     )
    ));?></div>
            <?php  } ?>
    </div>
</div>

<?php   Yii::app()->getClientScript()->registerScript(
            'changeAvatar',
            'reloadApartment.modalContainer = "#contain";
             reloadApartment.modalTmp = ".modal-tmp";
            reloadApartment.modalCss = {"width":"310px"};
            reloadApartment.modal();',
        CClientScript::POS_END);
?>