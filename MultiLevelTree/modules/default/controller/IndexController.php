<?php

class IndexController extends MKFramework\Controller\ControllerAbstract
{
    
    protected $_router;

    protected function preLauncher()
    {
        // $this->view->disable();
        $this->_router = MKFramework\Director::getRouter();
         
    }
    
    protected function indexJob()
    {
        
        //$navi = MKFramework\Director::getNavigation();
        
        
        
    }


    protected function postLauncher()
    {

    }
    
    
}
