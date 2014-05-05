<?php

namespace Frontend\FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Frontend\FrontOfficeBundle\Entity\GameCatalog;
use Frontend\FrontOfficeBundle\Form\Type\GameCatalogFormType;

class CommonController extends Controller {
    public function getAllGamesAction()
    {
        $all_games = $this->getDoctrine()
        ->getRepository('FrontendFrontOfficeBundle:Game')
        ->findAllInArray();
        
        $ar_res = array();
        $ar_res["games"] = $all_games;
        
        $response = new Response();
        $response->setStatusCode(200);
        $response->headers->set('Content-Type', 'application/json');
        
        $response->setContent(json_encode($ar_res));
        
        return $response;
    }
}

