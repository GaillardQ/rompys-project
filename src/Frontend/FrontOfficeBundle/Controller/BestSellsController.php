<?php

namespace Frontend\FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BestSellsController extends Controller {

    public function bestSellsAction() 
    {         
        return $this->container->get('templating')->renderResponse('FrontendFrontOfficeBundle:BestSells:best_sells.html.twig', array());
    }

}