<?php

namespace Frontend\FrontOfficeBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * GameCatalogRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class GameCatalogRepository extends EntityRepository
{
	public function getAllGamesForSellByAnUser($_user_id)
	{
                $qb = $this->createQueryBuilder("gc");
            
                $query = $qb->select('gc.id, g.name, p.value as plateform, gt.value as game_type, e1.value as editor_1, e2.value as editor_2, e3.value as editor_3, gc.price')
                 ->leftJoin('gc.seller', 's')
                 ->leftJoin('gc.game', 'g')
                 ->leftJoin('g.plateform', 'p')
                 ->leftJoin('g.game_type', 'gt')
                 ->leftJoin('g.editor_1', 'e1')
                 ->leftJoin('g.editor_2', 'e2')
                 ->leftJoin('g.editor_3', 'e3')
                 ->where('s.user = '.$_user_id)
                 ->orderBy('g.name', 'ASC')
                 ->addOrderBy('g.released_year', 'DESC')
                 ->getQuery();
                 
                $all_games = $query->getResult();
                return $all_games;
	}
	
	public function getAllGamesForSell()
	{
                $qb = $this->createQueryBuilder("gc");
            
                $query = $qb->select('gc.id, g.name, p.value as plateform, gt.value as game_type, e1.value as editor_1, e2.value as editor_2, e3.value as editor_3, gc.price')
                 ->leftJoin('gc.seller', 's')
                 ->leftJoin('gc.game', 'g')
                 ->leftJoin('g.plateform', 'p')
                 ->leftJoin('g.game_type', 'gt')
                 ->leftJoin('g.editor_1', 'e1')
                 ->leftJoin('g.editor_2', 'e2')
                 ->leftJoin('g.editor_3', 'e3')
                 ->orderBy('g.name', 'ASC')
                 ->addOrderBy('g.released_year', 'DESC')
                 ->getQuery();
                 
                $all_games = $query->getResult();
                return $all_games;
	}
	
	public function findFormatteGameCatalog($_id)
	{
	        $qb = $this->createQueryBuilder("gc");
            
                $query = $qb->select('g.id as game_id, g.image_1, g.image_2, g.image_3, g.name, g.released_year as year, s.value as serie, p.value as plateform, gt.value as game_type, e1.value as editor_1, e2.value as editor_2, e3.value as editor_3, 
                                        gc.price, gc.comment, gc.alternative_name, gc.language, gc.game_package, gc.blister, gc.notice, st.value as state, gc.zone, u.id as user_id, u.username, u.email')
                 ->leftJoin('gc.game', 'g')
                 ->leftJoin('g.serie', 's')
                 ->leftJoin('gc.seller', 'se')
                 ->leftJoin('se.user', 'u')
                 ->leftJoin('g.plateform', 'p')
                 ->leftJoin('g.game_type', 'gt')
                 ->leftJoin('g.editor_1', 'e1')
                 ->leftJoin('g.editor_2', 'e2')
                 ->leftJoin('g.editor_3', 'e3')
                 ->leftJoin('gc.state', 'st')
                 ->where('gc.id='.$_id)
                 ->getQuery();
                 
                $all_games = $query->getResult();
                return $all_games;
	}
	
	public function getLastAdds($_nb = 5)
	{
        $qb = $this->createQueryBuilder("gc");
        
        $query = $qb->select("gc.id, g.name, p.value as plateform, gc.addedAt, gc.price, u.username")
         ->leftJoin('gc.seller', 's')
         ->leftJoin('s.user', 'u')
         ->leftJoin('gc.game', 'g')
         ->leftJoin('g.plateform', 'p')
         ->leftJoin('g.game_type', 'gt')
         ->leftJoin('g.editor_1', 'e1')
         ->leftJoin('g.editor_2', 'e2')
         ->leftJoin('g.editor_3', 'e3')
         ->OrderBy('gc.addedAt', 'DESC')
         ->setMaxResults( $_nb )
         ->getQuery();
         
        $last_adds = $query->getResult();
        
        /* Inutile pour le moment, la date n'est plus affichée
        foreach($last_adds as $k=>$v)
        {
            $d = $v["addedAt"];
            $str_d = $d->format('d-m-Y');
            $last_adds[$k]["addedAt"] = $str_d;
        }
        */
        
        return $last_adds;
	}
	
	public function getGameBestSellers($limit)
    {
        $qb = $this->createQueryBuilder("gc");
        
        $query = $qb->select("u.username, u.id, count(gc.id) as nb")
         ->leftJoin('gc.seller', 's')
         ->leftJoin('s.user', 'u')
         ->GroupBy('u.id')
         ->OrderBy('nb', 'DESC')
         ->setMaxResults( $limit )
         ->getQuery();
         
        $sellers = $query->getResult();
        
        return $sellers;
    }
}
