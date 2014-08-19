<?php

use model\PersonModel;
class PersonController extends MKFramework\Controller\ControllerAbstract
{

    protected function preLauncher()
    {
        // $this->view->disable();
    }
    
    protected function indexJob()
    {
        
        $personTree = PersonModel::getPersonFullTree(100);
        
        $this->view->personsTree = $personTree;
        
        
    }


}

?>