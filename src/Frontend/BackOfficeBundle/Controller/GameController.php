<?php

namespace Frontend\BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GameController extends Controller
{
    public function indexAction()
    {
        $allGames = $this->get('doctrine')->getManager()->getRepository('FrontendFrontOfficeBundle:Game')->findAllArray();
        
        $salt = $this->container->getParameter('secret');
        
        foreach($allGames as $k=>$v)
        {
            $hash = md5($allGames[$k]["id"]."_".$salt);
            $allGames[$k]["hash"] = $hash;
        }
        
        return $this->render('FrontendBackOfficeBundle:Game:index.html.twig', array(
            "games" => $allGames
        ));
    }
}
