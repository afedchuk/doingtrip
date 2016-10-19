<?php

class langSelectorWidget extends CWidget
{
    public $languages;

    public function getViewPath($checkTheme = false)
    {
        return Yii::getPathOfAlias('application.modules.lang.views');
    }

    public function run()
    {
        $this->render('langSelectorFormWidget', array(
                'currentLang' => Yii::app()->language,
                'languages' => ($this->languages) ? $this->languages : Lang::getActiveLangs(true),
            )
        );
    }
}
?>