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
	public function getLastAdds($_nb = 5)
	{
        $qb = $this->createQueryBuilder("gc");
        
        $query = $qb->select("gc.id, g.name, p.value as plateform, gc.addedAt as added_at, gc.price, u.username, g.id as game_id, g.image_game, gc.language, gc.image_seller, gc.comment,st.id as state_id, st.value as state_value")
         ->leftJoin('gc.seller', 's')
         ->leftJoin('s.user', 'u')
         ->leftJoin('gc.game', 'g')
         ->leftJoin('g.plateform', 'p')
         ->leftJoin('g.game_type', 'gt')
         ->leftJoin('g.editor_1', 'e1')
         ->leftJoin('g.editor_2', 'e2')
         ->leftJoin('g.editor_3', 'e3')
         ->leftJoin('gc.state', 'st')
         ->OrderBy('gc.addedAt', 'DESC')
         ->setMaxResults( $_nb )
         ->getQuery();
         
        $last_adds = $query->getResult();
        
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
    
    public function searchGames($filters)
    {
        $qb = $this->createQueryBuilder("gc");
            
        $qb->select('g.id as game_id, g.image_game, gc.image_seller, g.name, g.released_year as year, s.value as serie, 
                              p.value as plateform, gt.value as game_type, e1.value as editor_1, e2.value as editor_2, e3.value as editor_3, 
                              MIN(gc.price) as min_price, count(se.id) as nb_sellers')
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
        ->where('g.id > 0');
        
        if(array_key_exists('name', $filters))
        {
            $name = $filters['name'];
            $qb->andwhere('(g.name LIKE \'%'.$name.'%\' OR gc.alternative_name LIKE \'%'.$name.'%\')');
        }
        if(array_key_exists('plateform', $filters) && $filters['plateform'] != -5)
        {
            $plateform = $filters['plateform'];
            $qb->andwhere('p.id = '.$plateform);
        }
        if(array_key_exists('gametype', $filters) && $filters['gametype'] != -5)
        {
            $gametype = $filters['gametype'];
            $qb->andwhere('gt.id = '.$gametype);
        }
        if(array_key_exists('editor', $filters))
        {
            $editor = $filters['editor'];
            $qb->andwhere('(e1.value LIKE \'%'.$editor.'%\' OR e2.value LIKE \'%'.$editor.'%\' OR e3.value LIKE \'%'.$editor.'%\')');
        }
        if(array_key_exists('zone', $filters) && $filters['zone'] != -5)
        {
            $zone = $filters['zone'];
            $qb->andwhere('gt.id = '.$zone);
        }
        if(array_key_exists('state', $filters) && $filters['state'] != -5)
        {
            $state = $filters['state'];
            $qb->andwhere('st.id = '.$state);
        }
        if(array_key_exists('package', $filters) && $filters['package'] != -5)
        {
            $package = $filters['package'];
            $qb->andwhere('gc.game_package = '.$package);
        }
        if(array_key_exists('blister', $filters) && $filters['blister'] != -5)
        {
            $blister = $filters['blister'];
            $qb->andwhere('gc.blister = '.$blister);
        }
        if(array_key_exists('notice', $filters) && $filters['notice'] != -5)
        {
            $notice = $filters['notice'];
            $qb->andwhere('gc.notice = '.$notice);
        }
        if(array_key_exists('pricemin', $filters))
        {
            $pricemin = $filters['pricemin'];
            $qb->andwhere('gc.price >= '.$pricemin);
        }
        if(array_key_exists('pricemax', $filters))
        {
            $pricemax = $filters['pricemax'];
            $qb->andwhere('gc.price <= '.$pricemax);
        }
        
        $query = $qb->groupby('g.name')
                    ->orderby('g.name', 'DESC')
                    ->getQuery();
        
        $games = $query->getResult();
        return $games;
    }
    
    public function findFormatteGameCatalog($_id)
	{
	        $qb = $this->createQueryBuilder("gc");
/*
g.id as game_id, g.image_game, gc.image_seller, g.name, g.released_year as year, s.value as serie, p.value as plateform, gt.value as game_type, e1.value as editor_1, e2.value as editor_2, e3.value as editor_3, 
                                        gc.price, gc.comment, gc.alternative_name, gc.language, gc.game_package, gc.blister, gc.notice, st.value as state, gc.zone, u.id as user_id, u.username, u.email
*/            
                $query = $qb->select('g.id as game_id, gc.image_seller, gc.price, gc.alternative_name, gc.comment, gc.language, gc.game_package, gc.blister, gc.notice, st.value as state, st.id as state_id, gc.zone, u.id as user_id, u.username, u.email')
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
                 ->where('g.id='.$_id)
                 ->getQuery();
                 
                $games = $query->getResult();
                return $games;
	}
    
    /*
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
    */
}
