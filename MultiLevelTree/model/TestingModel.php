<?php

use MKFramework\Director;

class TestingModel 
{
    private $db;
    
    
    public function __construct()
    {
        $this->db = Director::getDbSupport();
    }
    
    
    
    public function testDoctrine()
    {
        $sql = "SELECT * FROM AssetsToPersons ORDER BY AssetName";
        $stmt = $this->db->query($sql); 
        
        return $stmt->fetchAll();
        
    }
    
    
    
}

?>