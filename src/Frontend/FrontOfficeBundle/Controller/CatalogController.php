<?php

namespace Frontend\FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CatalogController extends Controller {

    public function indexAction(Request $request) 
    {    
        $plateforms =  $this->get('Doctrine')
                            ->getRepository('FrontendFrontOfficeBundle:Plateform')
                            ->findAllOrdered();
                            
        $gameTypes =  $this->get('Doctrine')
                            ->getRepository('FrontendFrontOfficeBundle:GameType')
                            ->findAllOrdered();
                            
        $editors =  $this->get('Doctrine')
                            ->getRepository('FrontendFrontOfficeBundle:Editor')
                            ->findAll();
                            
        $gameStates =  $this->get('Doctrine')
                            ->getRepository('FrontendFrontOfficeBundle:GameState')
                            ->findAll();
                            
        $name       = $request->request->get('name-input');
        $plateform  = $request->request->get('plateform-input');
        $gametype   = $request->request->get('gametype-input');
        $editor     = $request->request->get('editor-input');
        $zone       = $request->request->get('zone-input');
        $state      = $request->request->get('state-input');
        $blister    = $request->request->get('blister-input');
        $notice     = $request->request->get('notice-input');
        $pricemin   = $request->request->get('pricemin-input');
        $pricemax   = $request->request->get('pricemax-input');
        
        $filters = array();
        if($name != '')                             $filters["name"]        = $name;
        if($plateform != -5 && $plateform != '')    $filters["plateform"]   = $plateform;   else $filters["plateform"]  = -5;
        if($gametype != -5 && $gametype != '')      $filters["gametype"]    = $gametype;    else $filters["gametype"]   = -5;
        if($editor != '')                           $filters["editor"]      = $editor;
        if($zone != -5 && $zone != '')              $filters["zone"]        = $zone;        else $filters["zone"]       = -5;
        if($state != -5 && $state != '')            $filters["state"]       = $state;       else $filters["state"]      = -5;
        if($blister != -5 && $blister != '')        $filters["blister"]     = $blister;     else $filters["blister"]    = -5;
        if($notice != -5 && $notice != '')          $filters["notice"]      = $notice;      else $filters["notice"]     = -5;
        if($pricemin != '')                         $filters["pricemin"]    = $pricemin;
        if($pricemax != '')                         $filters["pricemax"]    = $pricemax;
        
        $games = array();  
        if($name != null || $plateform != null || $gametype != null || $editor != null || $zone != null || $state != null || $blister != null || $notice != null || $pricemin != null || $pricemax != null)
        {
            $games = $this->get('Doctrine')
                            ->getRepository('FrontendFrontOfficeBundle:GameCatalog')
                            ->searchGames($filters);
        }
                  
        return $this->container->get('templating')->renderResponse('FrontendFrontOfficeBundle:Catalog:index.html.twig', array(
            "games" => $games,
            "plateforms" => $plateforms,
            "game_types" => $gameTypes,
            "editors" => $editors,
            "game_states" => $gameStates,
            "filters" => $filters
        ));
    }
    
    public function gameAction($id, $name)
    {
        $game = $this->get('Doctrine')
                            ->getRepository('FrontendFrontOfficeBundle:Game')
                            ->findFormattedGameInfos($id);
        $gamesCatalog = $this->get('Doctrine')
                            ->getRepository('FrontendFrontOfficeBundle:GameCatalog')
                            ->findFormatteGameCatalog($id);
        $sum = 0;                 
        $nb = 0;
        $min = -1;
        $avg = 0;
        foreach($gamesCatalog as $k=>$v)
        {
            $nb++;
            $p = $v["price"];
            if($min == -1 || $p < $min)
            {
                $min = $p;
            }
            $sum += $p;
        }
        if($nb != 0)
        {
            $avg = round($sum / $nb, 2);
        }
        $stats = array(
            "nb"  => $nb,
            "min" => $min,
            "avg" => $avg,
        );

        return $this->container->get('templating')->renderResponse('FrontendFrontOfficeBundle:Catalog:game_card.html.twig', array(
            "name" => $name,
            "games_catalog"=> $gamesCatalog,
            "game" => $game,
            "stats"=>$stats
        ));
    }

}
