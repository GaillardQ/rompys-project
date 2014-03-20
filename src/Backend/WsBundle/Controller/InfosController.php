<?php

namespace Backend\WsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class InfosController extends Controller
{
    public function createGameAction()
    {
        $allEditors = $this->get('doctrine')->getManager()->getRepository('FrontendFrontOfficeBundle:Editor')->array_findAll();
        $allGameStates = $this->get('doctrine')->getManager()->getRepository('FrontendFrontOfficeBundle:GameState')->array_findAll();
        $allPlateforms = $this->get('doctrine')->getManager()->getRepository('FrontendFrontOfficeBundle:Plateform')->array_findAll();
        $allSeries = $this->get('doctrine')->getManager()->getRepository('FrontendFrontOfficeBundle:Series')->array_findAll();
        
        $code = 200;
        if(count($allEditors) == 0 || count($allGameStates) == 0 || count($allPlateforms) == 0 || count($allSeries) == 0)
        {
            $code = 404;
        }
        
        $return = array();
        $return["editors"] = $allEditors;
        $return["gameStates"] = $allGameStates;
        $return["plateforms"] = $allPlateforms;
        $return["series"] = $allSeries;
        
        $response = new Response();
        $response->setStatusCode($code);
        $response->headers->set("Content-Type", "application/json; charset=UTF-8");
        $response->setContent(json_encode($return));
        return $response;
        
    }
}
