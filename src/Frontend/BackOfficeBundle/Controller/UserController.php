<?php

namespace Frontend\BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    public function indexAction()
    {
        $allUsers = $this->get('doctrine')->getManager()->getRepository('FrontendFrontOfficeBundle:User')->findAllArray();
        
        $salt = $this->container->getParameter('secret');
        
        foreach($allUsers as $k=>$v)
        {
            $hash = md5($allUsers[$k]["id"]."_".$salt);
            $allUsers[$k]["hash"] = $hash;
        }
        
        return $this->render('FrontendBackOfficeBundle:User:index.html.twig', array(
            "users" => $allUsers
        ));
    }
}
