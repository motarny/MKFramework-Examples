<?php

use model\PersonModel;
use model\PersonPoints;

class InfoController extends MKFramework\Controller\ControllerAbstract
{

    protected function indexJob()
    {
        $this->view->cntPersons = PersonModel::countPersons();
        $this->view->cntAwards = PersonPoints::countAwards();
        $this->view->maxLevel = PersonModel::getMaxConnectionLevel();
        $this->view->totalPoints = PersonPoints::countPoints();
    }
    
    protected function authorJob()
    {
        // dokument 'o autorze'
    }
    
    protected function mkframeworkJob()
    {
        // dokument 'o frameworku'
    }
}
