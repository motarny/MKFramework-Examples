<?php
namespace model;

define('FORCE_FULLCALCULATION', true);

/**
 * @Entity @Table(name="persons_points")
 */
class PersonPoints
{

    /**
     * @Id @Column(type="integer")
     */
    protected $personid;

    /**
     * @Column(type="decimal") *
     */
    protected $myPoints;

    /**
     * @Column(type="decimal") *
     */
    protected $groupPoints;

    protected $sumPoints;

    private $_calculated_MyPoints = null;

    private $_calculated_GroupPoints = null;

    function __construct($personId)
    {
        $orm = \MKFramework\Director::getOrmSupport();
        
        $this->personid = $personId;
        $this->myPoints = 0;
        $this->groupPoints = 0;
        
        $orm->persist($this);
        $orm->flush();
        
        return $this;
    }

    public function getMyPoints($forceCalculation = false)
    {
        if ($forceCalculation) {
            return $this->getMyPoints_FullCalculation();
        }
        return $this->myPoints;
    }

    public function getGroupPoints($forceCalculation = false)
    {
        if ($forceCalculation) {
            return $this->getGroupPoints_FullCalculation();
        }
        return $this->groupPoints;
    }

    public function getSumPoints($forceCalculation = false)
    {
        if ($forceCalculation) {
            return $this->getSumPoints_FullCalculation();
        }
        return $this->getMyPoints() + $this->getGroupPoints();
    }

    private function getMyPoints_FullCalculation()
    {
        return "recalc MyPoints dla {$this->personid}";
    }

    private function getGroupPoints_FullCalculation()
    {
        return "recalc GroupPoints dla {$this->personid}";
    }

    private function getSumPoints_FullCalculation()
    {
        return "recalc SumPoints dla {$this->personid}";
    }


    static function countAwards()
    {
        $db = \MKFramework\Director::getDbalSupport();
        $sql = "SELECT COUNT(*) as cntAwards FROM awards";
        $stmt = $db->executeQuery($sql);
        $results = $stmt->fetchAll();
        return $results[0]['cntAwards'];
    }
    
    static function countPoints()
    {
        $db = \MKFramework\Director::getDbalSupport();
        $sql = "SELECT SUM(points) as sumPoints FROM awards";
        $stmt = $db->executeQuery($sql);
        $results = $stmt->fetchAll();
        return $results[0]['sumPoints'];
    }
    
}

?>