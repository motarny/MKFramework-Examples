<?php

class PersonsController extends MKFramework\Controller\ControllerAbstract
{

    protected function preLauncher()
    {
        // $this->view->disable();
    }
    
    protected function preparedbJob()
    {
        $this->view->info = "Przygotowuje bazę osób";

        $creator = new model\PersonsTablesCreator();
        
        $results = $creator->createPersonsTree(10);
        
        
        
    }
    
    

}
