<?php
namespace model;

use MKFramework\Director;

class ModelAbstract
{
    
    public function __construct()
    {
    }
    

    protected function getDb()
    {
        return Director::getDbalSupport();
    }
    
}
