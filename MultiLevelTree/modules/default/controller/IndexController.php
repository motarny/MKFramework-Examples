<?php

class IndexController extends MKFramework\Controller\ControllerAbstract
{
    
    private $_router;

    protected function preLauncher()
    {
        // $this->view->disable();
        $this->_router = MKFramework\Director::getRouter(); 
    }
    
    protected function indexJob()
    {
        
        echo $this->_router->getParams('balfa');       
        
    }


}

?>