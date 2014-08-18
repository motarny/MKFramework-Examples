<?php
namespace model;

class PersonsTablesCreator extends ModelAbstract
{

    public function createPersonsTree($personsLimit)
    {
        $this->createTablePersons($personsLimit);
        
        //$this->createPersonsConnections();
    }

    private function createTablePersons($personsLimit)
    {
        $sql = "TRUNCATE TABLE persons_connections";
        $this->getDb()->query($sql);
        
        $sql = "TRUNCATE TABLE persons";
        $this->getDb()->query($sql);
       
        for ($cnt = 1; $cnt <= $personsLimit; $cnt ++) {
            $this->createRandomUser($cnt);
        }
    }

    public function createRandomUser($parentsLimit)
    {
        $sql = "SELECT Name FROM tmp_names ORDER BY RAND()";
        $stmt = $this->getDb()->query($sql);
        $getEl = $stmt->fetch();
        $name = $getEl['Name'];
        
        $sql = "SELECT Surname FROM tmp_surnames ORDER BY RAND()";
        $stmt = $this->getDb()->query($sql);
        $getEl = $stmt->fetch();
        $surname = $getEl['Surname'];
        
        $newPerson = new PersonModel(array(
            'name' => $name,
            'surname' => $surname
        ));
        
        $newPerson->addPersonToTree(rand(1, $parentsLimit - 1));
    }
    
    
    public function createPersonsConnections()
    {
        PersonModel::makeConnection(0, 1);
            PersonModel::makeConnection(1, 2);
            PersonModel::makeConnection(1, 3);
                PersonModel::makeConnection(3, 4);
                PersonModel::makeConnection(3, 5);
                PersonModel::makeConnection(3, 8);
                    PersonModel::makeConnection(8, 10);
                    PersonModel::makeConnection(8, 9);

        
        PersonModel::makeConnection(0, 6);
            PersonModel::makeConnection(6, 7);
                PersonModel::makeConnection(7, 11);
                PersonModel::makeConnection(7, 12);
                    PersonModel::makeConnection(12, 15);
            PersonModel::makeConnection(6, 13);
            PersonModel::makeConnection(6, 14);
        
    }
    
    
}
