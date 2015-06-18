<?php

namespace Frontend\FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Frontend\FrontOfficeBundle\Entity\GameCatalog;
use Frontend\FrontOfficeBundle\Form\Type\GameCatalogFormType;

class CommonController extends Controller {
    public function getAllGamesAction(Request $request)
    {
        $start =  $request->query->get('start');
        
        $all_games = $this->getDoctrine()
        ->getRepository('FrontendFrontOfficeBundle:Game')
        ->findStartWithInArray("%$start%");

        $ar_res = array();
        $ar_res["games"] = $all_games;
        
        $response = new Response();
        $response->setStatusCode(200);
        $response->headers->set('Content-Type', 'application/json');
        
        $response->setContent(json_encode($ar_res));
        
        return $response;
    }
    
    public function getGameInfoAction(Request $request)
    {
        $id =  $request->query->get('id');
        
        $game = $this->getDoctrine()
        ->getRepository('FrontendFrontOfficeBundle:Game')
        ->findFormattedGameInfos($id);

        $ar_res = array();
        $ar_res["game"] = $game;
        
        $response = new Response();
        
        if($game != null)
        {
            $response->setStatusCode(200);
        }
        else
        {
            $response->setStatusCode(404);
        }
        
        $response->headers->set('Content-Type', 'application/json');
        
        $response->setContent(json_encode($ar_res));
        
        return $response;
    }
    
    public function getGameCatalogInfoAction(Request $request)
    {
        $id =  $request->query->get('id');
        
        $game = $this->getDoctrine()
        ->getRepository('FrontendFrontOfficeBundle:GameCatalog')
        ->findFormatteGameCatalog($id);

        $ar_res = array();
        $ar_res["game"] = $game;
        
        $response = new Response();
        
        if($game != null)
        {
            $response->setStatusCode(200);
        }
        else
        {
            $response->setStatusCode(404);
        }
        
        $response->headers->set('Content-Type', 'application/json');
        
        $response->setContent(json_encode($ar_res));
        
        return $response;
    }
    
    public function getLastAddGamesAction(Request $request)
    {
        try {
            $output = $request->request->get('output');
            $limit = $request->request->get('limit');
            
            $games = $this->getDoctrine()
            ->getRepository('FrontendFrontOfficeBundle:GameCatalog')
            ->getLastAdds($limit);
            
            if($output == 'home')
            {
                
                return $this->container->get('templating')->renderResponse('FrontendFrontOfficeBundle:Home:home_last_adds_data.html.twig', array(
                    'games' => $games
                ));
            }
            else
            {
                $response = new Response();
                $response->headers->set('Content-Type', 'application/json');
                
                $response->setContent(json_encode($games));
                
                return $response;
            }
        }
        catch(\Exception $e)
        {
            $response = new Response();
            $response->headers->set('Content-Type', 'application/json');
            $response->setStatusCode(500);
            $response->setContent(json_encode(array("error" => $e->getMessage())));
            
            return $response;
        }
    }
    
    public function getBestSellersAction(Request $request)
    {
        try {
            $output = $request->request->get('output');
            $limit = $request->request->get('limit');
            
            $sellers = $this->getDoctrine()
            ->getRepository('FrontendFrontOfficeBundle:GameCatalog')
            ->getGameBestSellers($limit);
            
            if($output == 'home')
            {
                
                return $this->container->get('templating')->renderResponse('FrontendFrontOfficeBundle:Home:home_best_sellers_data.html.twig', array(
                    'sellers' => $sellers
                ));
            }
            else
            {
                $response = new Response();
                $response->headers->set('Content-Type', 'application/json');
                
                $response->setContent(json_encode($games));
                
                return $response;
            }
        }
        catch(\Exception $e)
        {
            $response = new Response();
            $response->headers->set('Content-Type', 'application/json');
            $response->setStatusCode(500);
            $response->setContent(json_encode(array("error" => $e->getMessage())));
            
            return $response;
        }
    }
}

