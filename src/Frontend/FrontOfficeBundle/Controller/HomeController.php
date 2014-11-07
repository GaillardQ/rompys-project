<?php

namespace Frontend\FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller {

    public function indexAction() 
    {     
        $request = $this->getRequest();
        $invalid_username = $request->query->get('invalid_username'); // get a $_GET parameter
        
        return $this->container->get('templating')->renderResponse('FrontendFrontOfficeBundle:Home:home.html.twig', array(
            'invalid_username' => $invalid_username
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
