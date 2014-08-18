<?php

class IndexController extends MKFramework\Controller\ControllerAbstract
{

    protected function preLauncher()
    {
        // $this->view->disable();
    }
    
    protected function indexJob()
    {
        $this->view->info = "Narzêdzia";        
    }

}

?>