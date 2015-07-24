<?php

namespace Frontend\FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BestSellersController extends Controller {

    public function sellerAction($id, $name) 
    {   
        $games = $this->getDoctrine()
        ->getRepository('FrontendFrontOfficeBundle:GameCatalog')
        ->getSellerGames($id);
        
        $infos_tmp = $this->getDoctrine()
        ->getRepository('FrontendFrontOfficeBundle:Seller')
        ->getSellerInfos($id);
        
        $infos = $infos_tmp[0];
        $infos['nb'] = count($games);
        
        return $this->container->get('templating')->renderResponse('FrontendFrontOfficeBundle:BestSellers:seller.html.twig', 
            array('games' => $games, 'infos' => $infos));
    }

}