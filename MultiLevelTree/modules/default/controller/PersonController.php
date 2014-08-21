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
        $personTree = PersonModel::getPersonFullTree(1, 1);
        
        $this->view->personsTree = $personTree;
    }

    protected function treeJob()
    {
        $personId = $this->getParams('personid');
        
        $personTree = PersonModel::getPersonFullTree($personId);
        
        $this->view->personsTree = $personTree;
    }
    
    protected function fulltreeJob()
    {
        $personTree = PersonModel::getPersonFullTree(1);
        
        $this->view->setView('person', 'index');
        $this->view->personsTree = $personTree;
    }
    
}
