<?php

namespace Frontend\FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CatalogController extends Controller {

    public function catalogAction() 
    {    
        $catalog  =  $this->get('Doctrine')
                            ->getRepository('FrontendFrontOfficeBundle:GameCatalog')
                            ->getAllGamesForSell();
                            
        $last_adds = $this->get('Doctrine')
                            ->getRepository('FrontendFrontOfficeBundle:GameCatalog')
                            ->getLastAdds();
                  
        return $this->container->get('templating')->renderResponse('FrontendFrontOfficeBundle:Catalog:catalog.html.twig', array(
            "catalog" => $catalog,
            "last_adds" => $last_adds
        ));
    }

}
