<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <?php
    $cs = Yii::app()->clientScript;
    $baseUrl = Yii::app()->theme->getBaseUrl();
    ?>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="<?php echo Yii::app()->language; ?>" />
    <meta name="description" content="<?php echo CHtml::encode($this->pageDescription); ?>" />
    <meta name="keywords" content="<?php echo CHtml::encode($this->pageKeywords); ?>" />
    <link rel="icon" href="<?php echo Yii::app()->theme->getBaseUrl(); ?>/icons/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="/assets/7ae5fb0b/css/bootstrap.css" />
    <?php
   $cs->registerCoreScript('jquery');
    $cs->registerCoreScript('jquery.ui');
    $cs->registerCoreScript('rating');
    $cs->registerCssFile($baseUrl . '/css/jquery.bubble.popup.css');
    $cs->registerCssFile($baseUrl . '/css/jquery.nailthumb.min.css');
    $cs->registerCssFile($baseUrl . '/css/screen.css');
    $cs->registerCssFile(' http://cdn0.housetrip.com/assets/v4/application-685bbe56b8b348a0c8821d17319efdae.css');
    $cs->registerScriptFile($baseUrl . '/js/jquery.bubblepopup.min.js', CClientScript::POS_HEAD);
    $cs->registerScriptFile($baseUrl . '/js/jquery.ui.datepicker.js', CClientScript::POS_HEAD);
    $cs->registerScriptFile($baseUrl . '/js/jquery.ui.datepicker-'.Yii::app()->language.'.js', CClientScript::POS_HEAD);
    $cs->registerScriptFile($baseUrl . '/js/jquery.nailthumb.min.js', CClientScript::POS_HEAD);
    $cs->registerScriptFile($baseUrl . '/js/jquery.maskedinput.js', CClientScript::POS_HEAD);
    $cs->registerScriptFile($baseUrl . '/js/jquery.custom.js', CClientScript::POS_HEAD);
    ?>
   

     <link href="http://cdn1.housetrip.com/assets/whitey_header.css?1401367839" media="all" rel="stylesheet" type="text/css" />
</head>


<div class="ht-main">

<nav class="ht-header js-kissmetrics-layer navbar navbar-default" role="navigation">
<div class="ht-container">
<div class="navbar-header" itemscope="" itemtype="http://schema.org/Organization">
<button class="ht-navbar-toggle navbar-toggle" data-target=".ht-navbar-collapse" data-toggle="collapse" type="button">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a href="/" class="navbar-brand" itemprop="url"><img alt="HouseTrip" class="logo" itemprop="logo" src="http://cdn1.housetrip.com/images/v4/logo.svg?1398950426">
</a>
</div>
<div class="ht-navbar-collapse collapse navbar-collapse navbar-right">
<ul class="ht-navbar hidden-xs">
<li class="ht-currency-language-item">
<a class="ht-user-logged-out" data-toggle="dropdown" href="">
English / EUR
<b class="caret"></b>
</a>
<div class="ht-dropdown-menu">
<div class="arrow"></div>
<ul class="ht-currency-and-language-selector col-sm-6">
<li class="ht-dropdown-title">
Language
</li>
<li>
<a href="/" id="switch_to_en">English
</a></li>
<li>
<a href="http://www.housetrip.fr/" id="switch_to_fr">Français
</a></li>
<li>
<a href="http://www.housetrip.de/" id="switch_to_de">Deutsch
</a></li>
<li>
<a href="http://www.housetrip.es/" id="switch_to_es">Español
</a></li>
<li>
<a href="http://www.housetrip.it/" id="switch_to_it">Italiano
</a></li>
<li>
<a href="/pt" id="switch_to_pt">Português
</a></li>
</ul>
<ul class="ht-currency-and-language-selector col-sm-6">
<li class="ht-dropdown-title">
Currency
</li>
<li>
<a href="/?switch_currency=EUR" id="switch_to_EUR">€ EUR
</a></li>
<li>
<a href="/?switch_currency=GBP" id="switch_to_GBP">£ GBP
</a></li>
<li>
<a href="/?switch_currency=USD" id="switch_to_USD">$ USD
</a></li>
<li>
<a href="/?switch_currency=CHF" id="switch_to_CHF">CHF
</a></li>
</ul>

</div>
</li>

<li class="ht-nav-separator"></li>
<li class="ht-navigation-signedout-item">
<a href="/en/free-listing-on-housetrip" class="list_place">Become a Host</a>
</li>
<li class="ht-nav-separator"></li>
<li class="ht-navigation-signedout-item">
<a href="#" class="js-authentication-trigger join-today-header" data-authentication-source="Global header" data-authentication_modal="{&quot;default_component&quot;:&quot;sign_up&quot;,&quot;render_options&quot;:{&quot;sign_in&quot;:{&quot;title&quot;:&quot;Sign in to HouseTrip&quot;},&quot;sign_up&quot;:{&quot;title&quot;:&quot;Join HouseTrip today&quot;},&quot;forgotten_password&quot;:{&quot;title&quot;:&quot;Forgotten your password?&quot;},&quot;check_email&quot;:{&quot;title&quot;:&quot;Email has been sent&quot;},&quot;contest&quot;:{&quot;title&quot;:&quot;Register for a chance to win a holiday in Sardinia&quot;}}}"><span class="glyphicon ht-icon-pen"></span>Join today</a>
</li>
<li class="ht-nav-separator"></li>
<li class="ht-navigation-signedout-item ht-last-item">
<a href="#" class="js-authentication-trigger sign-in-header" data-authentication-source="Global header" data-authentication_modal="{&quot;default_component&quot;:&quot;sign_in&quot;,&quot;render_options&quot;:{&quot;sign_in&quot;:{&quot;title&quot;:&quot;Sign in to HouseTrip&quot;},&quot;sign_up&quot;:{&quot;title&quot;:&quot;Join HouseTrip today&quot;},&quot;forgotten_password&quot;:{&quot;title&quot;:&quot;Forgotten your password?&quot;},&quot;check_email&quot;:{&quot;title&quot;:&quot;Email has been sent&quot;},&quot;contest&quot;:{&quot;title&quot;:&quot;Register for a chance to win a holiday in Sardinia&quot;}}}"><span class="glyphicon ht-icon-login"></span>Sign in</a>
</li>

</ul>
<ul class="ht-navbar visible-xs">
<li class="ht-navigation-signedout-item">
<a href="#" class="js-authentication-trigger join-today-header" data-authentication-source="Global header" data-authentication_modal="{&quot;default_component&quot;:&quot;sign_up&quot;,&quot;render_options&quot;:{&quot;sign_in&quot;:{&quot;title&quot;:&quot;Sign in to HouseTrip&quot;},&quot;sign_up&quot;:{&quot;title&quot;:&quot;Join HouseTrip today&quot;},&quot;forgotten_password&quot;:{&quot;title&quot;:&quot;Forgotten your password?&quot;},&quot;check_email&quot;:{&quot;title&quot;:&quot;Email has been sent&quot;},&quot;contest&quot;:{&quot;title&quot;:&quot;Register for a chance to win a holiday in Sardinia&quot;}}}"><span class="glyphicon ht-icon-pen"></span>Join today</a>
</li>
<li class="ht-navigation-signedout-item">
<a href="#" class="js-authentication-trigger sign-in-header" data-authentication-source="Global header" data-authentication_modal="{&quot;default_component&quot;:&quot;sign_in&quot;,&quot;render_options&quot;:{&quot;sign_in&quot;:{&quot;title&quot;:&quot;Sign in to HouseTrip&quot;},&quot;sign_up&quot;:{&quot;title&quot;:&quot;Join HouseTrip today&quot;},&quot;forgotten_password&quot;:{&quot;title&quot;:&quot;Forgotten your password?&quot;},&quot;check_email&quot;:{&quot;title&quot;:&quot;Email has been sent&quot;},&quot;contest&quot;:{&quot;title&quot;:&quot;Register for a chance to win a holiday in Sardinia&quot;}}}"><span class="glyphicon ht-icon-login"></span>Sign in</a>
</li>
<li class="ht-navigation-signedout-item">
<a href="/en/free-listing-on-housetrip" class="list_place"><span class="glyphicon ht-icon-house"></span>
Become a Host
</a></li>
<li class="ht-mobile-localization-item">
<span class="glyphicon ht-icon-globe"></span>
<select data-type="locale-selector">
<option selected="selected" value="/">
English
</option>
<option value="http://www.housetrip.fr/">
Français
</option>
<option value="http://www.housetrip.de/">
Deutsch
</option>
<option value="http://www.housetrip.es/">
Español
</option>
<option value="http://www.housetrip.it/">
Italiano
</option>
<option value="/pt">
Português
</option>
</select>
</li>
<li class="ht-mobile-localization-item">
<span class="glyphicon ht-icon-money"></span>
<select data-type="currency-selector">
<option selected="selected" value="/?switch_currency=EUR">
EUR
</option>
<option value="/?switch_currency=GBP">
GBP
</option>
<option value="/?switch_currency=USD">
USD
</option>
<option value="/?switch_currency=CHF">
CHF
</option>
</select>
</li>


</ul>

</div>
</div>
</nav>



<section class="hero js-kissmetrics-layer">
<div class="hero-background js-fader" data-images="[&quot;http://cdn0.housetrip.com/images/v4/home/hero_desktop_1.jpg?1400772223&quot;,&quot;http://cdn1.housetrip.com/images/v4/home/hero_desktop_2.jpg?1400772223&quot;,&quot;http://cdn1.housetrip.com/images/v4/home/hero_desktop_3.jpg?1400772223&quot;,&quot;http://cdn1.housetrip.com/images/v4/home/hero_desktop_4.jpg?1400772223&quot;]"></div>
<div class="container">
<div class="hero-strapline js-ie-sensitive">
<h1 class="hero-strapline__title">Book a whole home</h1>
<h2 class="hero-strapline__subtitle">for less than the price of a hotel room</h2>
</div>
<div class="hero-search ht-search-box active" data-type="search-form">
<div class="row">
<div class="col-xs-12">
<form action="/en/search-holiday-apartments" autocomplete="off" class="new_property_search" id="new_property_search" method="get">
<div class="ht-search-field">
<div class="search-input" data-countries="Countries" data-districts="Districts" data-locations="Cities" data-regions="Regions" data-validation="Start typing to see the complete list">
<input class="js-ie-sensitive text_field" id="property_search_destination_name" name="property_search[destination_name]" placeholder="e.g. Paris, London, Tuscany" size="30" type="text">
<input value="" id="property_search_destination_id" name="property_search[destination_id]" type="hidden">
<ul style="display: none;" class="destination-results"></ul>
<input value="searchbox" name="origin" id="search_origin" type="hidden"></div>
<div class="search-button">
<button class="btn" id="search_now">
<span class="glyphicon ht-icon-search"></span>
</button>
</div>

<div class="search-guests">
<input id="property_search_number_of_guests" name="property_search[number_of_guests]" value="4" type="hidden">
<span class="glyphicon ht-icon-user"></span>
<div class="guests-actions">
<div style="display: none;" class="decrement">
<span class="glyphicon glyphicon-minus"></span>
</div>
<div class="guest-number">4</div>
<div style="display: none;" class="increment">
<span class="glyphicon glyphicon-plus"></span>
</div>
</div>
</div>
<div class="ht-separator"></div>

<div class="search-calendar js-search-calendar" data-translations="{&quot;calendar&quot;:{&quot;days_of_week_short&quot;:[&quot;Sun&quot;,&quot;Mon&quot;,&quot;Tue&quot;,&quot;Wed&quot;,&quot;Thu&quot;,&quot;Fri&quot;,&quot;Sat&quot;],&quot;months_short&quot;:[&quot;Jan&quot;,&quot;Feb&quot;,&quot;Mar&quot;,&quot;Apr&quot;,&quot;May&quot;,&quot;Jun&quot;,&quot;Jul&quot;,&quot;Aug&quot;,&quot;Sep&quot;,&quot;Oct&quot;,&quot;Nov&quot;,&quot;Dec&quot;]},&quot;inputs&quot;:{&quot;nights&quot;:&quot;{{= nights }} nights&quot;,&quot;night&quot;:&quot;{{= nights }} night&quot;},&quot;clearNotice&quot;:&quot;I don't know my dates yet&quot;}">
<div class="glyphicon ht-icon-calendar js-toggle"></div>
<input style="display: none;" class="start-date date-display js-start-date-to-show" id="date_picker_property_search_from_date_pretty" name="date_picker_property_search[from_date_pretty]" placeholder="Check in" value="" type="text">
<input style="display: none;" class="end-date date-display js-end-date-to-show" id="date_picker_property_search_end_date_pretty" name="date_picker_property_search[end_date_pretty]" placeholder="Check out" value="" type="text">
<input class="js-start-date-to-submit" id="property_search_from_date" name="property_search[from_date]" type="hidden">
<input class="js-end-date-to-submit" id="property_search_to_date" name="property_search[to_date]" type="hidden">
<div class="js-remove-dates glyphicon ht-icon-remove"></div>
<span style="display: none;" class="js-number-of-nights number-of-nights">0 nights</span>
<div class="ht-loading-indicator"></div>
</div>
<div class="ht-separator"></div>

</div>

</form>
</div>
</div>
</div>
<div class="ht-join-today hidden-xs">
<a href="#" class="js-authentication-trigger ht-join-today-button" data-authentication-source="Home page hero contest" data-authentication_modal="{&quot;default_component&quot;:&quot;contest&quot;,&quot;render_options&quot;:{&quot;sign_in&quot;:{&quot;title&quot;:&quot;Sign in to HouseTrip&quot;},&quot;sign_up&quot;:{&quot;title&quot;:&quot;Join HouseTrip today&quot;},&quot;forgotten_password&quot;:{&quot;title&quot;:&quot;Forgotten your password?&quot;},&quot;check_email&quot;:{&quot;title&quot;:&quot;Email has been sent&quot;},&quot;contest&quot;:{&quot;title&quot;:&quot;Register for a chance to win a holiday in Sardinia&quot;}}}"><span class="ht-title ht-contest">Win a holiday in Sardinia</span><span class="ht-subtitle ht-contest">Join today <span class="glyphicon glyphicon-chevron-right"></span></span></a>
</div>
</div>
<section class="ht-join-today-mobile js-kissmetrics-layer visible-xs">
<a href="#" class="js-authentication-trigger ht-join-today-button" data-authentication-source="Home page hero contest" data-authentication_modal="{&quot;default_component&quot;:&quot;contest&quot;,&quot;render_options&quot;:{&quot;sign_in&quot;:{&quot;title&quot;:&quot;Sign in to HouseTrip&quot;},&quot;sign_up&quot;:{&quot;title&quot;:&quot;Join HouseTrip today&quot;},&quot;forgotten_password&quot;:{&quot;title&quot;:&quot;Forgotten your password?&quot;},&quot;check_email&quot;:{&quot;title&quot;:&quot;Email has been sent&quot;},&quot;contest&quot;:{&quot;title&quot;:&quot;Register for a chance to win a holiday in Sardinia&quot;}}}"><span class="ht-title ht-contest">Win a holiday in Sardinia</span><span class="ht-subtitle ht-contest">Join today <span class="glyphicon glyphicon-chevron-right"></span></span></a>
</section>
</section>



</div>


</html>
