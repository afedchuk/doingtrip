<?php
/**
 * CmsBlock class file.
 * @author Christoffer Niska <christoffer.niska@nordsoftware.com>
 * @copyright Copyright &copy; 2011, Nord Software Ltd
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package cms.widgets
 */

/**
 * Widget that renders the node with the given name.
 */
class GetCurrencyDropdown extends CWidget
{
	/**
	 * @property string the content name.
	 */
	public $reloadgrid=false;
	public $filterzeros = true;
	/**
	 * Runs the widget.
	 */
	public function run()
	{
		

        //get all active curriencies
        $criteria = new CDbCriteria();
        if($this->filterzeros){
        	$criteria->condition = 'active=:active and conversion_rate>:conversion_rate';
        	$criteria->params = array(':active'=>1,':conversion_rate'=>0);
        }else{
        	$criteria->condition = 'active=:active';
        	$criteria->params = array(':active'=>1);
        }
        $model=Currency::model()->findAll($criteria);

        $this->render('_select',array('model'=>$model,'reloadgrid'=>$this->reloadgrid));
	}
}
