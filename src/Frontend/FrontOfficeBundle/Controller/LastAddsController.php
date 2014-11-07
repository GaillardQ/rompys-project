<?php

namespace Frontend\FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LastAddsController extends Controller {

    public function lastAddsAction() 
    {         
        return $this->container->get('templating')->renderResponse('FrontendFrontOfficeBundle:LastAdds:last_adds.html.twig', array());
    }

}