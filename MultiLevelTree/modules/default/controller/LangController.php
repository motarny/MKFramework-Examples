<?php
use \MKFramework\Director;

class LangController extends MKFramework\Controller\ControllerAbstract
{

    protected function preLauncher()
    {
        $this->view->disable();
        $this->layout->disable();
    }

    protected function setJob()
    {
        $router = Director::getRouter();
        $lang = $router->getParams('lang');
        
        $session = Director::getSession();
        $session->lang = '';
        
        $session->lang = $lang;

               
        Director::openUrl($this->view->helper->getUrl(array('controller' => 'index')));
        
    }
}
