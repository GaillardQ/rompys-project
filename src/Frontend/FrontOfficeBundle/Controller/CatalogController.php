<?php

namespace Frontend\FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CatalogController extends Controller {

    public function indexAction(Request $request) 
    {    
        $search = $request->request->get('game-name');   
        
        $plateforms =  $this->get('Doctrine')
                            ->getRepository('FrontendFrontOfficeBundle:Plateform')
                            ->findAll();
                            
        $gameTypes =  $this->get('Doctrine')
                            ->getRepository('FrontendFrontOfficeBundle:GameType')
                            ->findAll();
                            
        $editors =  $this->get('Doctrine')
                            ->getRepository('FrontendFrontOfficeBundle:Editor')
                            ->findAll();
                            
        $gameStates =  $this->get('Doctrine')
                            ->getRepository('FrontendFrontOfficeBundle:GameState')
                            ->findAll();
         
        $games = array();                   
        if($search != null)
        {
            $games = $this->get('Doctrine')
                            ->getRepository('FrontendFrontOfficeBundle:GameCatalog')
                            ->searchGamesByName($search);
        }
        
                  
        return $this->container->get('templating')->renderResponse('FrontendFrontOfficeBundle:Catalog:index.html.twig', array(
            "games" => $games,
            "plateforms" => $plateforms,
            "game_types" => $gameTypes,
            "editors" => $editors,
            "game_states" => $gameStates
        ));
    }

}
