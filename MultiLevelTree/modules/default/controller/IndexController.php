<?php

use MKFramework\Front;
class IndexController extends MKFramework\Controller\ControllerAbstract
{

    protected function preLauncher()
    {
        // $this->view->disable();
    }
    
    protected function indexJob()
    {
        
        $this->view->zmienna150 = 150;
        $this->view->zmienna250 = 250;
        
        $this->view->loopCount = 10;
        
        $this->layout->bigMenu = "BIG MENU";
        
      
        $testingModel = new TestingModel();
        
        $getPersons = $testingModel->testDoctrine();
        
        $this->view->Persons = $getPersons;
        
        
    }

    protected function testJob()
    {
        echo 'akcja Test';
    }
}

?>