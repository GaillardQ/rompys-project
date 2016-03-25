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

        $query = $qb->where('d.addedAt >= :date1')
                ->setParameter('date1', $d1)
                ->andWhere('d.addedAt < :date2')
                ->setParameter('date2', $d2)
                ->getQuery();

        $data = $query->getResult();
        
        return $data;
    }
    
    public function findTrendsByDays()
    {
        return $this->findDataByDays(array("users" => "nbUsers", "games" => "nbGames"));
    }
    
    public function findNewsByDays()
    {
        return $this->findDataByDays(array("users" => "nbRegistrations", "games" => "nbNewGames"));
    }
    
    public function findPricesByDays()
    {
        return $this->findDataByDays(array("price" => "averagePrice"));
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
