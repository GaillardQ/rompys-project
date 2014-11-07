<?php

namespace Frontend\FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LegalsController extends Controller {

    public function legalsAction() 
    {         
        return $this->container->get('templating')->renderResponse('FrontendFrontOfficeBundle:Legals:legals.html.twig', array());
    }

}