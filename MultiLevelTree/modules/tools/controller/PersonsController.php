<?php
use model\PersonModel;

class PersonsController extends MKFramework\Controller\ControllerAbstract
{

    protected function preLauncher()
    {
        // $this->view->disable();
    }

    protected function createPersonsJob()
    {
        if ($this->isPostRequest()) {
            // validate
            $validate = true;
            
            $newPersonsCount = (int) $this->getFormData('newPersonsCount');
            $formPersonsCount = $newPersonsCount;
            if (($newPersonsCount < 1) || ($newPersonsCount > 1000)) {
                $validate = false;
                $this->view->error_newPersonsCount = true;
                $formPersonsCount = null;
            }
            
            $parentId = $this->getFormData('parentId');
            
            if (! model\PersonModel::checkPersonExists($parentId) && ($parentId != "")) {
                $validate = false;
                $this->view->error_invalidParentId = true;
            }
            
            // display results
            if ($validate) {
                $this->view->parentId = $parentId;
                $this->view->setView('persons', 'createpersonsdone');
                
                // add persons
                $creator = new model\PersonsTablesCreator();
                $newPersons = $creator->addNewPersons($newPersonsCount, $parentId);
                
                $this->view->newPersons = $newPersons;
            }
            
            $this->view->formPersonsCount = $formPersonsCount;
        }
        
        $this->view->countPersons = model\PersonModel::countPersons();
    }

    protected function createAwardsBundleJob()
    {
        if ($this->isPostRequest()) {
            // validate
            $validate = true;
            
            $newAwardsCount = (int) $this->getFormData('newAwardsCount');
            $formAwardsCount = $newAwardsCount;
            if (($newAwardsCount < 1) || ($newAwardsCount > 1000)) {
                $validate = false;
                $this->view->error_newAwardsCount = true;
                $formAwardsCount = null;
            }
            
            $ownerId = $this->getFormData("ownerId");
            
            if (! model\PersonModel::checkPersonExists($ownerId) && ($ownerId != "")) {
                $validate = false;
                $this->view->error_invalidOwnerId = true;
            }
            
            // display results
            if ($validate) {
                $this->view->ownerId = $ownerId;
                $this->view->setView('persons', 'createawardsdone');
                
                // add awards
                $creator = new model\PersonsTablesCreator();
                $newAwards = $creator->createAwards($newAwardsCount, $ownerId);                
                
                $this->view->newAwards = $newAwards;
            }
            
            $this->view->$formAwardsCount = $formAwardsCount;
        }
        
        $this->view->countPersons = model\PersonModel::countPersons();
    }
}
