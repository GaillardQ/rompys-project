<?php

namespace Backend\WsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class GameCatalogController extends Controller
{
    public function deleteGameCatalogAction($id, $hash)
    {
        $salt = $this->container->getParameter('secret');
        if($hash != md5($id."_".$salt))
        {
            $code = 404;
        }
        else
        {
            $em = $this->get('doctrine')->getManager();
            $gameCatalog = $em->getRepository('FrontendFrontOfficeBundle:Game')->find($id);
            
            $img = $gameCatalog->getImage();
            
            if($gameCatalog == null)
            {
                $code = 404;
            }
            else
            {
                
                $em->remove($gameCatalog);
                $em->flush();
                
                unlink(__DIR__.'/../../../../web/public/pictures/'.$img);
                
                $code = 200;
            }
        }
        
        $return = array();
        $response = new Response();
        $response->setStatusCode($code);
        $response->headers->set("Content-Type", "application/json; charset=UTF-8");
        $response->setContent(json_encode($return));
        return $response;
        
    }
}
