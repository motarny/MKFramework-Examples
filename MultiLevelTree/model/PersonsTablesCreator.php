<?php
namespace model;

class PersonsTablesCreator extends ModelAbstract
{

    public function createPersonsTree($personsLimit)
    {
//         $sql = "TRUNCATE TABLE persons_connections";
//         $this->getDb()->query($sql);
        
//         $sql = "TRUNCATE TABLE persons";
//         $this->getDb()->query($sql);
        
//         $sql = "TRUNCATE TABLE awards";
//         $this->getDb()->query($sql);        
        
        $this->createTablePersons($personsLimit);
        $this->createAwards($personsLimit * 5);

        //$this->createPersonsConnections();
    }

    private function createTablePersons($personsLimit)
    {
        $sql = "select Name FROM tmp_names ORDER BY rand() LIMIT {$personsLimit}";
        $getNames = $this->getDb()->query($sql)->fetchAll();
        
        $sql = "select Surname FROM tmp_surnames ORDER BY rand() LIMIT {$personsLimit}";
        $getSurnames = $this->getDb()->query($sql)->fetchAll();
        
        for ($cnt = 0; $cnt <= $personsLimit - 1; $cnt ++) {
            $this->createNewPerson($getNames[$cnt]['Name'], $getSurnames[$cnt]['Surname']);
        }
    }

    public function createNewPerson($name, $surname)
    {
        $newPerson = new PersonModel(array(
            'name' => $name,
            'surname' => $surname
        ));

        $sql = "SELECT COUNT(PersonId) as cnt FROM persons";
        $getCnt = $this->getDb()->query($sql)->fetch();
        $personsCnt = $getCnt['cnt'];        
        
        $newPerson->addPersonToTree(rand(1, $personsCnt));
    }
    

    private function createAwards($limit)
    {
        // check person max id
        $sql = "SELECT COUNT(PersonId) as cnt FROM persons";
        $getCnt = $this->getDb()->query($sql)->fetch();
        $personsCnt = $getCnt['cnt'];
        
        for ($l = 1; $l <= $limit; $l++)
        {
            $person = rand (1, $personsCnt);
            $points = rand(100, 25000) / 100;
            $sql = "INSERT INTO awards (PersonId, Points) VALUES ({$person}, {$points})";
            $this->getDb()->query($sql);
        }       
        
        
    }
    
    
//     public function createPersonsConnections()
//     {
//         PersonModel::makeConnection(0, 1);
//             PersonModel::makeConnection(1, 2);
//             PersonModel::makeConnection(1, 3);
//                 PersonModel::makeConnection(3, 4);
//                 PersonModel::makeConnection(3, 5);
//                 PersonModel::makeConnection(3, 8);
//                     PersonModel::makeConnection(8, 10);
//                     PersonModel::makeConnection(8, 9);

        
//         PersonModel::makeConnection(0, 6);
//             PersonModel::makeConnection(6, 7);
//                 PersonModel::makeConnection(7, 11);
//                 PersonModel::makeConnection(7, 12);
//                     PersonModel::makeConnection(12, 15);
//             PersonModel::makeConnection(6, 13);
//             PersonModel::makeConnection(6, 14);
        
//     }
    
    
}
