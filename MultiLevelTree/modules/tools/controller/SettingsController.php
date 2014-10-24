<?php

class SettingsController extends MKFramework\Controller\ControllerAbstract
{

    
    /*
     * Narzędzia
     */
    protected function indexJob()
    {
        $isMemcachedEnabled = \MKFramework\Director::getSession()->isMemcachedEnabled;
        
        $this->view->isMemcachedEnabled = $isMemcachedEnabled;

        
        if ($this->getParams('memcached'))
        {
            if ($this->getParams('memcached') == 'enable')
            {
                \MKFramework\Director::getSession()->isMemcachedEnabled = true;
            } else {
                \MKFramework\Director::getSession()->isMemcachedEnabled = false;
            }

            \MKFramework\Director::openUrl($this->view->helper->getUrl(array('module' => 'tools', 'controller' => 'settings')));        
        }
        
    }

}
