<?php

namespace Frontend\FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CatalogController extends Controller {

    public function indexAction(Request $request) 
    {    
        $search = $request->request->get('game-name');            
                  
        return $this->container->get('templating')->renderResponse('FrontendFrontOfficeBundle:Catalog:index.html.twig', array(
            "catalog" => array(),
            "last_adds" => array()
        ));
    }

}
