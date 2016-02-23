<?php

namespace Backend\WsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class GameCatalogController extends Controller
{
    public function deleteGameCatalogAction($id)
    {
        $em = $this->get('doctrine')->getManager();
        $gameCatalog = $em->getRepository('FrontendFrontOfficeBundle:GameCatalog')->find($id);
        
        if($gameCatalog == null)
        {
            $code = 404;
        }
        else
        {
            
            $em->remove($gameCatalog);
            $em->flush();
            $code = 200;
        }
        
        $return = array();
        $response = new Response();
        $response->setStatusCode($code);
        $response->headers->set("Content-Type", "application/json; charset=UTF-8");
        $response->setContent(json_encode($return));
        return $response;
        
    }
}
