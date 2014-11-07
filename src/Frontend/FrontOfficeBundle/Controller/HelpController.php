<?php

namespace Frontend\FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HelpController extends Controller {

    public function helpAction() 
    {         
        return $this->container->get('templating')->renderResponse('FrontendFrontOfficeBundle:Help:help.html.twig', array());
    }

}