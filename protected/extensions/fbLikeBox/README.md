fbLikeBox
==========

Yii extension for facebook Like box with custom attributes like - show header, post, user faces, layout etc.


Requirements
============

Tested with Yii 1.1.14


Installation
============

- Download the latest release package
- Unpack it in /protected/extensions/ folder


Usage
=====

Paste the code into your main.php page or also you can use this code as per your requirement on any page.

~~~
$this->widget('application.extensions.fbLikeBox.fbLikeBox', array(
        'likebox' => array(
		'url'=>'https://facebook.com/yiiexperts',
		'header'=>'true',
		'width'=>'300',
		'height'=>'500',
		'layout'=>'light',
		'show_post'=>'false', 
		'show_faces'=>'true',
		'show_border'=>'true',
	 )
  ));
~~~


Yii Extension
=============

http://www.yiiframework.com/extension/fb-like-box/



Usual parameters to be adjusted
===============================

- url: Your facebook page link (url: http://www.facebook.com/fb_page)
- header: Display like box header (header: **true**, false)
- width: Like box width (in digit: **300**)
- height: Like box height (in digit: **500**)
- layout: Like box layout background (layout: **light**, dark)
- post/stream: Display page post (show_post: **true**, false)
- faces: Show user faces (show_faces: **true**, false)
- border: show box border (show_border: **true**, false)
