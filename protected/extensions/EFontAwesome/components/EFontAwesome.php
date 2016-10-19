<?php

/**
 * EFontAwesome loader class file.
 * @author Jorge Mariani <jorgemariani@gmail.com>
 * @license http://creativecommons.org/licenses/by/3.0/ CC BY 3.0
 * Font Awesome - http://fortawesome.github.com/Font-Awesome
 */

/**
 * Bootstrap application component.
 */
class EFontAwesome extends CApplicationComponent {

    protected $_assetsUrl;

    /**
     * Initializes the component.
     */
    public function init() {
        if (Yii::getPathOfAlias('efontawesome') === false)
            Yii::setPathOfAlias('efontawesome', realpath(dirname(__FILE__) . '/..'));

        // Prevents the extension from registering scripts and publishing assets when ran from the command line.
        if (Yii::app() instanceof CConsoleApplication)
            return;
        Yii::app()->getClientScript()->registerCssFile($this->getAssetsUrl() . "/css/font-awesome.css"); //, $media);

        parent::init();
    }

    /**
     * Returns the URL to the published assets folder.
     * @return string the URL
     */
    public function getAssetsUrl() {
        if (isset($this->_assetsUrl))
            return $this->_assetsUrl;
        else {
            $assetsPath = Yii::getPathOfAlias('efontawesome.assets');
            $assetsUrl = Yii::app()->assetManager->publish($assetsPath, false, -1, YII_DEBUG);
            return $this->_assetsUrl = $assetsUrl;
        }
    }
}
