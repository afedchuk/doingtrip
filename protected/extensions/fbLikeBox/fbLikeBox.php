<?php
/**
 *fbLikeBox.php
 *
 * @author Rohit Suthar <rohit.suthar@gmail.com>
 * @copyright 2014 Rohit Suthar
 * @package fbLikeBox
 * @version 1.0
 * @Like Us on -  https://facebook.com/yiiexperts
 * @Follow Us on -  https://twitter.com/yiiexperts
 * @Mail -  yiiexpert@gmail.com
 * @For More Extension Visit -  www.yiiexpert.github.io
 */
 

class fbLikeBox extends CInputWidget
{
	
	/**
	 * @var array available for facebook like box
	 */	
			
	public $likebox = array(
			'url'=>'https://facebook.com/yiiexperts',  //http://www.facebook.com/fb_page
			'header'=>'true', //Display like box header - true, false 
			'width'=>'300', //Like box width
			'height'=>'500', //Like box height
			'layout'=>'light', //layout - light, dark
			'show_post'=>'true', //Display page post - true, false 
			'show_faces'=>'true', //Show user faces - true, false
			'show_border'=>'true', //Show box border - true, false
		  );


	/**
	 * The extension initialisation
	 *
	 * @return nothing
	 */

	public function init()
	{
		self::renderLikeBox();
	}


	/**
	 * Render like box extension
	 *
	 * @return nothing
	 */

	 private function renderLikeBox(){
		 
		  $rendered = array('url'=>$this->likebox['url'],
		  					'header'=>$this->likebox['header'],
							'width'=>$this->likebox['width'],
							'height'=>$this->likebox['height'],
							'layout'=>$this->likebox['layout'],
							'show_post'=>$this->likebox['show_post'],
							'show_faces'=>$this->likebox['show_faces'],
							'show_border'=>$this->likebox['show_border']
						);
		  
		echo $this->render('like', array('rendered'=>$rendered));
	}
}

?>
