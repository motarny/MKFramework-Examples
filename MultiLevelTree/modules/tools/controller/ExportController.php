<?php

class ExportController extends MKFramework\Controller\ControllerAbstract
{

    protected $_orm;
    
    protected function preLauncher()
    {
        $this->_orm = \MKFramework\Director::getOrmSupport();
    }    
    
    protected function csvJob()
    {
        $this->view->personId = $this->getParams('personId');   // może być przekazane w linku
        
        if ($this->isPostRequest()) {
            // validate
            $validate = true;
            
            $personId = (int) $this->getFormData('personId');
            if (! model\PersonModel::checkPersonExists($personId)) {
                $validate = false;
                $this->view->error_invalidPersonId = true;
            }
            
            if ($validate) {
                $this->doExport('csv', $personId);            
            }
        }

    }

    protected function xmlJob()
    {
        $this->view->personId = $this->getParams('personId');   // może być przekazane w linku
        
        if ($this->isPostRequest()) {
            // validate
            $validate = true;
            
            $personId = (int) $this->getFormData('personId');
            if (! model\PersonModel::checkPersonExists($personId)) {
                $validate = false;
                $this->view->error_invalidPersonId = true;
            }
            
            if ($validate) {
                $this->doExport('xml', $personId);            
            }
        }
    }
    
    
    
    
    protected function doExport($fileType, $personId)
    {
        $this->view->setView('Export', $fileType . 'template');
        $this->layout->disable();
        
        // get PersonInfo
        $personObj = $this->_orm->find('model\PersonModel', $personId);
        
        // add both to view
        $this->view->personObj = $personObj;
        
        // get Tree
        $personTree = \model\PersonModel::getPersonFullTree($personId);
        $this->view->personTree = $personTree;

        
        $fileOutput = \MKFramework\Render\Factory::getRenderer('file');
        
        $fileOutput->setFileName("export_{$personId}." . $fileType);
        $fileOutput->setHeaderContentType('application/' . $fileType);
        
        $fileOutput->render();
    }
    

    
    
}
