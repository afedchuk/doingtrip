<div class="span3">
    <div class="well sidebar-nav">
        <?php
        if(isFree()){
            $this->widget('bootstrap.widgets.TbMenu', array(
                'type' => 'list',
                'encodeLabel' => false,
                'items' => array(
                    array('label' => tc('Listings')),
                    array('label' => tc('Listings') . $bageListings, 'icon' => 'icon-list-alt', 'url' => $baseUrl . '/apartments/backend/main/admin', 'active' => isActive('apartments')),
                    array('label' => tc('List your property'), 'icon' => 'icon-plus-sign', 'url' => $baseUrl . '/apartments/backend/main/create', 'active' => isActive('apartments.create')),
                    array('label' => tc('Comments') . $bageComments, 'icon' => 'icon-list-alt', 'url' => $baseUrl . '/comments/backend/main/admin', 'active' => isActive('comments')),
                    array('label' => tc('Complains') . $bageComplain, 'icon' => 'icon-list-alt', 'url' => $baseUrl . '/booking/backend/complaint/admin', 'active' => isActive('apartmentsComplain')),

                    array('label' => tc('Users')),
                    array('label' => tc('Users'), 'icon' => 'icon-list-alt', 'url' => $baseUrl . '/user/backend/main/admin', 'active' => isActive('users')),
                    //array('label' => tt('Add user', 'users'), 'icon' => 'icon-plus-sign', 'url' => $baseUrl . '/users/backend/main/create', 'active' => isActive('users.create')),


                    array('label' => tc('Content')),
                    array('label' => tc('News'), 'icon' => 'icon-file', 'url' => $baseUrl . '/news/backend/main/admin', 'active' => isActive('news')),
                    array('label' => tc('Top menu items'), 'icon' => 'icon-file', 'url' => $baseUrl . '/menumanager/backend/main/admin', 'active' => isActive('menumanager')),
                    array('label' => tc('Q&As'), 'icon' => 'icon-file', 'url' => $baseUrl . '/articles/backend/main/admin', 'active' => isActive('articles')),

                    array('label' => tc('References')),
                    array('label' => tc('Values of references'), 'icon' => 'icon-asterisk', 'url' => $baseUrl . '/referencevalues/backend/main/admin', 'active' => isActive('referencevalues')),
                    array('label' => tc('Reference "View:"'), 'icon' => 'icon-asterisk', 'url' => $baseUrl . '/windowto/backend/main/admin', 'active' => isActive('windowto')),
                    array('label' => tc('Reference "Check-in"'), 'icon' => 'icon-asterisk', 'url' => $baseUrl . '/timesin/backend/main/admin', 'active' => isActive('timesin')),
                    array('label' => tc('Reference "Check-out"'), 'icon' => 'icon-asterisk', 'url' => $baseUrl . '/timesout/backend/main/admin', 'active' => isActive('timesout')),
                    array('label' => tc('Reference "Property types"'), 'icon' => 'icon-asterisk', 'url' => $baseUrl . '/apartmentObjType/backend/main/admin', 'active' => isActive('apartmentObjType')),
                    array('label' => tc('Reference "City/Cities"'), 'icon' => 'icon-asterisk', 'url' => $baseUrl . '/apartmentCity/backend/main/admin', 'active' => isActive('apartmentCity')),

                    array('label' => tc('Settings')),
                    array('label' => tc('Settings'), 'icon' => 'icon-wrench', 'url' => $baseUrl . '/configuration/backend/main/admin', 'active' => isActive('configuration')),
                    array('label' => tc('Images'), 'icon' => 'icon-wrench', 'url' => $baseUrl . '/images/backend/main/index', 'active' => isActive('images')),
                    array('label' => tc('Change admin password'), 'icon' => 'icon-wrench', 'url' => $baseUrl . '/adminpass/backend/main/index', 'active' => isActive('adminpass')),
                    array('label' => tc('Site service '), 'icon' => 'icon-wrench', 'url' => $baseUrl . '/service/backend/main/admin', 'active' => isActive('service'), 'visible' => issetModule('service')),
                    array('label' => tc('Authentication services'), 'icon' => 'icon-wrench', 'url' => $baseUrl . '/socialauth/backend/main/admin', 'active' => isActive('socialauth'), 'visible' => issetModule('socialauth')),

                    array('label' => tc('Languages and currency')),
                    array('label' => tc('Translations'), 'icon' => 'icon-wrench', 'url' => $baseUrl . '/translateMessage/backend/main/admin', 'active' => isActive('translateMessage')),

                    array('label' => tc('Other')),
                    
                ),
            ));
        } else {
                $this->widget('bootstrap.widgets.TbMenu', array(
                'type' => 'list',
                'encodeLabel' => false,
                'items' => array(
                    array('label' => tc('Listings')),
                    array('label' => tc('Listings') . $bageListings, 'icon' => 'icon-list-alt', 'url' => $baseUrl . '/apartments/backend/main/admin', 'active' => isActive('apartments')),
                    array('label' => tc('List your property'), 'icon' => 'icon-plus-sign', 'url' => $baseUrl . '/apartments/backend/main/create', 'active' => isActive('apartments.create')),
                    array('label' => tc('Comments') . $bageComments, 'icon' => 'icon-list-alt', 'url' => $baseUrl . '/comments/backend/main/admin', 'active' => isActive('comments')),
                    array('label' => tc('Complains') . $bageComplain, 'icon' => 'icon-list-alt', 'url' => $baseUrl . '/booking/backend/complaint/admin', 'active' => isActive('apartmentsComplain')),

                    array('label' => tc('Users')),
                    array('label' => tc('Users'), 'icon' => 'icon-list-alt', 'url' => $baseUrl . '/user/backend/main/admin', 'active' => isActive('users')),
                    //array('label' => tt('Add user', 'users'), 'icon' => 'icon-plus-sign', 'url' => $baseUrl . '/users/backend/main/create', 'active' => isActive('users.create')),


                    array('label' => tc('Content')),
                    array('label' => tc('News'), 'icon' => 'icon-file', 'url' => $baseUrl . '/news/backend/main/admin', 'active' => isActive('news')),
                    array('label' => tc('Top menu items'), 'icon' => 'icon-file', 'url' => $baseUrl . '/menumanager/backend/main/admin', 'active' => isActive('menumanager')),
                    array('label' => tc('Q&As'), 'icon' => 'icon-file', 'url' => $baseUrl . '/articles/backend/main/admin', 'active' => isActive('articles')),

                    array('label' => tc('MODULE of Payments & Payment systems ')),
                    array('label' => tc('Paid services'), 'icon' => 'icon-shopping-cart', 'url' => $baseUrl . '/paidservices/backend/main/admin', 'active' => isActive('paidservices')),
                    array('label' => tc('Manage payments') , 'icon' => 'icon-shopping-cart', 'url' => $baseUrl . '/payment/backend/main/admin', 'active' => isActive('payment')),
                    array('label' => tc('Payment systems'), 'icon' => 'icon-wrench', 'url' => $baseUrl . '/payment/backend/paysystem/admin', 'active' => isActive('payment.paysystem')),

                    array('label' => tc('References')),
                    array('label' => tc('Values of references'), 'icon' => 'icon-asterisk', 'url' => $baseUrl . '/referencevalues/backend/main/admin', 'active' => isActive('referencevalues')),
                    array('label' => tc('Reference "View:"'), 'icon' => 'icon-asterisk', 'url' => $baseUrl . '/windowto/backend/main/admin', 'active' => isActive('windowto')),
                    array('label' => tc('Reference "Check-in"'), 'icon' => 'icon-asterisk', 'url' => $baseUrl . '/timesin/backend/main/admin', 'active' => isActive('timesin')),
                    array('label' => tc('Reference "Check-out"'), 'icon' => 'icon-asterisk', 'url' => $baseUrl . '/timesout/backend/main/admin', 'active' => isActive('timesout')),
                    array('label' => tc('Reference "Property types"'), 'icon' => 'icon-asterisk', 'url' => $baseUrl . '/apartmentObjType/backend/main/admin', 'active' => isActive('apartmentObjType')),
                    array('label' => tc('Reference "City/Cities"'), 'icon' => 'icon-asterisk', 'url' => $baseUrl . '/apartmentCity/backend/main/admin', 'active' => isActive('apartmentCity')),

                    array('label' => tc('Settings')),
                    array('label' => tc('Settings'), 'icon' => 'icon-wrench', 'url' => $baseUrl . '/configuration/backend/main/admin', 'active' => isActive('configuration')),
                    array('label' => tc('Images'), 'icon' => 'icon-wrench', 'url' => $baseUrl . '/images/backend/main/index', 'active' => isActive('images')),
                    array('label' => tc('Change admin password'), 'icon' => 'icon-wrench', 'url' => $baseUrl . '/adminpass/backend/main/index', 'active' => isActive('adminpass')),
                    array('label' => tc('Seo settings'), 'icon' => 'icon-wrench', 'url' => $baseUrl . '/seo/backend/main/admin', 'active' => isActive('seo')),
                    array('label' => tc('Site service '), 'icon' => 'icon-wrench', 'url' => $baseUrl . '/service/backend/main/admin', 'active' => isActive('service'), 'visible' => issetModule('service')),
                    array('label' => tc('Authentication services'), 'icon' => 'icon-wrench', 'url' => $baseUrl . '/socialauth/backend/main/admin', 'active' => isActive('socialauth'), 'visible' => issetModule('socialauth')),

                    array('label' => tc('Languages and currency')),
                    array('label' => tc('Languages'), 'icon' => 'icon-globe', 'url' => $baseUrl . '/lang/backend/main/admin', 'active' => isActive('lang')),
                    array('label' => tc('Translations'), 'icon' => 'icon-wrench', 'url' => $baseUrl . '/translateMessage/backend/main/admin', 'active' => isActive('translateMessage')),
                    array('label' => tc('Currencies'), 'icon' => 'icon-wrench', 'url' => $baseUrl . '/currencymanager/backend/main/admin', 'active' => isActive('currency')),

                    array('label' => tc('Modules')),
                    array('label' => tc('Slide-show on the Home page'), 'icon' => 'icon-circle-arrow-right', 'url' => $baseUrl . '/slider/backend/main/admin', 'active' => isActive('slider')),
                    //array('label' => tc('Import / Export'), 'icon' => 'icon-circle-arrow-right', 'url' => $baseUrl . '/iecsv/backend/main/admin', 'active' => isActive('iecsv')),
                    array('label' => tc('Advertising banners'), 'icon' => 'icon-circle-arrow-right', 'url' => $baseUrl . '/advertising/backend/advert/admin', 'active' => isActive('advertising')),

                    array('label' => tc('Other')),
                    
                ),
            ));
        }

        ?>
    </div>
</div>