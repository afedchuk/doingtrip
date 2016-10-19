<?php

class WebApplicationEndBehavior extends CBehavior 
{


    private $_endName;

    public function getEndName()
    {
        return $this->_endName;
    }
    
    
    public function runEnd($name)
    {
        Settings::config();
        
        $this->_endName = $name;
        $this->onModuleCreate = array($this, 'changeModulePaths');
        $this->onModuleCreate(new CEvent ($this->owner));
        
        $this->owner->run();		
    }
    
   
    public function onModuleCreate($event)
    {
        $this->raiseEvent('onModuleCreate', $event);		
    }
    
   
    protected function changeModulePaths($event)
    {
        
        $event->sender->controllerPath .= DIRECTORY_SEPARATOR.$this->_endName;
 
        if ($event->sender->theme !== null)
            $event->sender->viewPath = $event->sender->theme->basePath.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.$this->_endName;
        else
            $event->sender->viewPath = DIRECTORY_SEPARATOR.$this->_endName;
            
    }	
        
}
?>
