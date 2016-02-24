<?php

namespace Frontend\FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LastAddsController extends Controller {

    public function indexAction() 
    {       
        $games = $this->getDoctrine()
            ->getRepository('FrontendFrontOfficeBundle:Game')
            ->getLastAdds(20);
            
        return $this->container->get('templating')->renderResponse('FrontendFrontOfficeBundle:LastAdds:index.html.twig', array('games' => $games));
    }

}