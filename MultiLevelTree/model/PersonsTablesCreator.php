<?php
namespace model;

class PersonsTablesCreator extends ModelAbstract
{

    public function createPersonsTree($personsLimit)
    {
        // $sql = "TRUNCATE TABLE persons_connections";
        // $this->getDb()->query($sql);
        
        // $sql = "TRUNCATE TABLE persons";
        // $this->getDb()->query($sql);
        
        // $sql = "TRUNCATE TABLE awards";
        // $this->getDb()->query($sql);
        
        // $this->createTablePersons($personsLimit);
        // $this->createAwards($personsLimit * 5);
        
        // $this->createPersonsConnections();
    }

    public function addNewPersons($personsLimit, $parentId)
    {
        $sql = "select name FROM tmp_names ORDER BY rand() LIMIT {$personsLimit}";
        $getNames = $this->getDb()
            ->query($sql)
            ->fetchAll();
        
        $sql = "select surname FROM tmp_surnames ORDER BY rand() LIMIT {$personsLimit}";
        $getSurnames = $this->getDb()
            ->query($sql)
            ->fetchAll();
        
        $newPersons = array();
        
        for ($cnt = 0; $cnt <= $personsLimit - 1; $cnt ++) {
            $newPersons[] = $this->createNewPerson($getNames[$cnt]['name'], $getSurnames[$cnt]['surname'], $parentId);
        }
        
        return $newPersons;
    }

    private function createNewPerson($name, $surname, $parentId)
    {
        if ($parentId == 0) {
            $max = PersonModel::countPersons();
            $parentId = rand(1, $max);
        }
        
        $newPerson = new PersonModel(array(
            'name' => $name,
            'surname' => $surname
        ));
        
        $newPerson->connectToParent($parentId);
        
        return $newPerson;
    }

    public function createAwards($limit, $ownerId)
    {
        // check person max id
        $sql = "SELECT COUNT(PersonId) as cnt FROM persons";
        $getCnt = $this->getDb()
            ->query($sql)
            ->fetch();
        $personsCnt = $getCnt['cnt'];
        
        $person = $ownerId;
        
        $newAwards = array();
        
        for ($l = 1; $l <= $limit; $l ++) {
            unset($temp);
            if ($ownerId == null) {
                $person = rand(1, $personsCnt);
            }
            $points = rand(100, 25000) / 100;
            $sql = "INSERT INTO awards (PersonId, Points) VALUES ({$person}, {$points})";
            $this->getDb()->query($sql);
            
            $temp['ownerId'] = $person;
            $temp['points'] = $points;
            
            $newAwards[] = $temp;
        }
        
        return $newAwards;
    }
}
