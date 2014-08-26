<?php
use model\PersonModel;

class PersonController extends MKFramework\Controller\ControllerAbstract
{

    protected $_orm;
    
    protected function preLauncher()
    {
        $this->_orm = \MKFramework\Director::getOrmSupport();
    }

    protected function indexJob()
    {
        $personTree = PersonModel::getPersonFullTree(1, 1);
        $this->view->setView('person', 'show');        
        $this->view->personsTree = $personTree;
    }

    protected function showJob()
    {
        $personId = $this->getParams('personid');
        
        // get PersonInfo
        $personObj = $this->_orm->find('model\PersonModel', $personId);
        
        // get ParentInfo
        $parentId = $personObj->getParentId();
        $parentObj = $this->_orm->find('model\PersonModel', $parentId);

                
        // add both to view
        $this->view->personObj = $personObj;
        $this->view->parentObj = $parentObj;
        
        
        // get Tree
        $personTree = PersonModel::getPersonFullTree($personId);
        $this->view->personsTree = $personTree;
    }
    
    protected function fulltreeJob()
    {
        $personTree = PersonModel::getPersonFullTree(1);
        
        $this->view->setView('person', 'show');
        $this->view->personsTree = $personTree;
    }
    
    
    
    
    
    
}
