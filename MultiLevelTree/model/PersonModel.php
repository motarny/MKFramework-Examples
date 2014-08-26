<?php
namespace model;

/**
 * @Entity @Table(name="persons")
 */
class PersonModel extends ModelAbstract
{

    /**
     * @Id @Column(type="integer") @GeneratedValue *
     */
    protected $personid;

    /**
     * @Column(type="string") *
     */
    protected $name;

    /**
     * @Column(type="string") *
     */
    protected $surname;

    /**
     * @OneToOne(targetEntity="model\PersonPoints", mappedBy="personid")
     * @JoinColumn(name="personid", referencedColumnName="personid")
     *
     * @var PersonsPoints
     *
     */
    protected $points;

    protected $parentId;

    function __construct(array $personData)
    {
        $orm = \MKFramework\Director::getOrmSupport();
        
        $this->setName($personData['name']);
        $this->setSurname($personData['surname']);
        
        $orm->persist($this);
        $orm->flush();
        
        $this->points = new PersonPoints($this->getId());
        
        return $this;
    }

    public function getId()
    {
        return $this->personid;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function setSurname($surname)
    {
        $this->surname = $surname;
        return $this;
    }

    public function getPoints()
    {
        return $this->points;
    }

    public function getParentId()
    {
        if (empty($this->parentId)) {
            $db = \MKFramework\Director::getDbalSupport();
            
            $sql = "SELECT przodek FROM persons_connections WHERE potomek = {$this->getId()} AND poziom = 1";
            $stmt = $db->query($sql);
            
            $result = $stmt->fetch();
            
            $this->parentId = $result['przodek'];
        }
        
        return $this->parentId;
    }

    static function countPersons()
    {
        $db = \MKFramework\Director::getDbalSupport();
        
        $sql = "SELECT COUNT(*) as cntPersons FROM persons";
        $stmt = $db->executeQuery($sql);
        
        $results = $stmt->fetchAll();
        
        return $results[0]['cntPersons'];
    }

    static function checkPersonExists($personId)
    {
        $db = \MKFramework\Director::getDbalSupport();
        
        $sql = "SELECT personid FROM persons WHERE personid = ?";
        $stmt = $db->executeQuery($sql, array(
            $personId
        ));
        
        return count($stmt->fetchAll()) == 1 ? true : false;
    }

    static function getPersonFullTree($przodek, $doPoziomu = 999)
    {
        $db = \MKFramework\Director::getDbalSupport();
        
        $sql = "
        SELECT p.personid as i, name as n, surname as s, przodek as pr, potomek as po, poziom as l, sciezka as r, pts.MyPoints as ptsm, pts.GroupPoints as ptsg
        FROM persons as p
        LEFT JOIN persons_points as pts
        ON p.personid = pts.personid
        LEFT JOIN persons_connections as pc
        ON p.personid = pc.potomek
        WHERE p.PersonId IN
        (SELECT potomek from persons_connections WHERE pc.przodek = '{$przodek}' and pc.potomek <> '{$przodek}' and pc.poziom <= '{$doPoziomu}')
        ORDER BY pc.sciezka
        ;
        ";
        
        $stmt = $db->query($sql);
        
        return $stmt->fetchAll();
    }

    public function connectToParent($przodek)
    {
        $potomek = $this->getId();
        
        self::makeConnection($przodek, $potomek);
    }
    
    // Connects two persons using <B>Closure Table</B> Model (Tabela domknięcia)
    static function makeConnection($przodek, $potomek)
    {
        $db = \MKFramework\Director::getDbalSupport();
        
        if ($przodek == '0') {
            $sql = "INSERT INTO persons_connections (przodek, potomek, poziom, sciezka) VALUES ('{$potomek}', '{$potomek}', '0', '{$potomek}')";
            $db->query($sql);
        }
        
        if ($przodek != '0') {
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
    
    
    
    static function getMaxConnectionLevel()
    {
        $db = \MKFramework\Director::getDbalSupport();
        $sql = "select MAX(poziom) as maxLevel FROM persons_connections";
        $stmt = $db->executeQuery($sql);
        $results = $stmt->fetchAll();
        return $results[0]['maxLevel'];
    }
    
    
    static function getConnectionLevel($przodek, $potomek)
    {
        
    }
    
    
}
