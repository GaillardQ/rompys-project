<?php

namespace Frontend\FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AboutController extends Controller {

    public function aboutAction() 
    {         
        return $this->container->get('templating')->renderResponse('FrontendFrontOfficeBundle:About:about.html.twig', array());
    }

}