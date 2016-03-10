<?php

namespace Frontend\FrontOfficeBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * DailyStatsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DailyStatsRepository extends EntityRepository
{
    public function findYesterday()
    {
        $d1 = new \DateTime('-1 day');
        $d1->setTime(0, 0, 0);
        
        $d2 = new \DateTime();
        $d2->setTime(0, 0, 0);
        
        $qb = $this->createQueryBuilder("d");

        $query = $qb->select("d.nbRegistrations")
                ->where('d.addedAt >= :date1')
                ->setParameter('date1', $d1)
                ->andWhere('d.addedAt < :date2')
                ->setParameter('date2', $d2)
                ->getQuery();

        $lastRegistrations = $query->getResult();
        
        if(count($lastRegistrations) > 0)
        {
            return $lastRegistrations[0]["nbRegistrations"];
        }
        else
        {
            return 0;
        }
    }
    
    public function findTrendsByDays()
    {
        return $this->findDataByDays(array("users" => "nbUsers", "games" => "nbGames"));
    }
    
    public function findNewsByDays()
    {
        $this->findDataByDays(array("users" => "nbRegistrations", "games" => "nbNewGames"));
    }
    
    public function findDataByDays($ar_col)
    {
        $qb = $this->createQueryBuilder("d");
        
        $s = "";
        foreach($ar_col as $k=>$v)
        {
            $s .= "d.$v as $k, ";
        }

        $query = $qb->select("$s d.addedAt as day")
                ->orderBy("day")
                ->getQuery();
        
        return $query->getResult();
    }
}
