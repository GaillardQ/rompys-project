<?php

namespace Frontend\FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller {

    public function indexAction() 
    {                    
        return $this->container->get('templating')->renderResponse('FrontendFrontOfficeBundle:Home:index.html.twig', array());
    }
    
    public function displayCatalogAction()
    {
        $catalog  =  $this->get('Doctrine')
                            ->getRepository('FrontendFrontOfficeBundle:GameCatalog')
                            ->getAllGamesForSell();
        
        return $this->container->get('templating')->renderResponse('FrontendFrontOfficeBundle:Home:catalog.html.twig', array(
            "catalog" => $catalog    
        ));
        
    }
    
    public function ProfileSummaryAction()
    {
        $user = null;
        $token_user = $this->container->get('security.context')->getToken()->getUser();
        if($token_user != null)
        {
            $user = $token_user;
        }
        
        return $this->container->get('templating')->renderResponse('FrontendFrontOfficeBundle:Home:profile_summary.html.twig', array(
            'user' => $user
        ));
    }

}
