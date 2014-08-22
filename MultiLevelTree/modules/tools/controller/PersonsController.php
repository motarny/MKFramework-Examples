<?php

class PersonsController extends MKFramework\Controller\ControllerAbstract
{

    protected function preLauncher()
    {
        // $this->view->disable();
    }
    
    protected function createPersonsJob()
    {
        $this->view->info = "Przygotowuje bazę osób";

        $creator = new model\PersonsTablesCreator();
        
        //$results = $creator->createPersonsTree(10);

    }
    
    
    protected function createAwardsBundleJob()
    {
        $limit = $this->getParams('limit');
        
        $creator = new model\PersonsTablesCreator();
        
        //$creator->createAwards($limit);
        
        $this->view->limit = $limit;
        
    }
    
    

}
