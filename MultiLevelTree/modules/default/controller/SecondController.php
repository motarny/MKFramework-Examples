<?php

class SecondController extends MKFramework\ControllerAbstract
{

    public function indexAction()
    {
        echo __CLASS__ . " AKCJA INDEX!";
    }

    public function testAction()
    {
        echo __CLASS__ . " TEST AKCJA";
    }
}

?>