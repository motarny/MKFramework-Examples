<?php
namespace model;

class PersonModel extends ModelAbstract
{

    protected $_personId;

    protected $_name;

    protected $_surname;

    function __construct(array $personData)
    {
        $this->setName($personData['name']);
        $this->setSurname($personData['surname']);
        
        return $this;
    }

    public function getId()
    {
        return $this->_personId;
    }

    public function setName($value)
    {
        $this->_name = $value;
        return $this;
    }

    public function getName()
    {
        return $this->_name;
    }

    public function setSurname($value)
    {
        $this->_surname = $value;
        return $this;
    }

    public function getSurame()
    {
        return $this->_surname;
    }

    public function addPersonToTree($przodek)
    {
        // add person to persons table
        $insertData = array(
            'name' => $this->getName(),
            'surname' => $this->getSurame()
        );
        $this->getDb()->insert('persons', $insertData);
        $this->_personId = $this->getDb()->lastInsertId();
        
        // create person connections
        $this->connectToParent($przodek);
    }

    
    public function connectToParent($przodek)
    {
        $potomek = $this->getId();

        $this->makeConnection($przodek, $potomek);        
    }
    
    

    // Connects two persons using <B>Closure Table</B> Model (Tabela domknięcia)
    static function makeConnection($przodek, $potomek)
    {
        $db = \MKFramework\Director::getDbSupport();
        
        if ($przodek == '0') 
        {
            $sql = "INSERT INTO persons_connections (przodek, potomek, poziom, sciezka) VALUES ('{$potomek}', '{$potomek}', '0', '{$potomek}')";
            $db->query($sql);
        }
        
        if ($przodek != '0')
        {
            $sql = "
            INSERT INTO persons_connections (przodek, potomek, poziom, sciezka)
                SELECT s.przodek, {$potomek}, s.poziom + 1, CONCAT(s.sciezka, '/', {$potomek}) 
                FROM persons_connections AS s
                WHERE (s.potomek = {$przodek})
                UNION ALL
                SELECT {$potomek}, {$potomek}, 0, '{$potomek}'
            ";
             
            $db->query($sql);
        
        }
    }
    
    
    
    static function getPersonFullTree($przodek)
    {
        $db = \MKFramework\Director::getDbSupport();
        
        $sql = "
            SELECT * FROM persons as p 
                LEFT JOIN persons_connections as pc
                ON p.PersonID = pc.potomek
                WHERE p.PersonID IN 
                        (SELECT potomek from persons_connections WHERE pc.przodek = '{$przodek}' and pc.potomek <> '{$przodek}' order by pc.sciezka)
            ;
            ";
        
        $stmt = $db->query($sql);
        
        return $stmt->fetchAll();
        
    }
    
    
    static function getConnectionsTree($przodek)
    {
        $db = \MKFramework\Director::getDbSupport();
        $sql = "SELECT * from persons_connections WHERE przodek = '{$przodek}' and potomek <> '{$przodek}' order by sciezka";
        
        $stmt = $db->query($sql);
        
        return $stmt->fetchAll();
    } 
    
    
    // public function save()
    // {
    
    // }
}

