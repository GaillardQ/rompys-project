<?php

namespace Frontend\BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PlateformeController extends Controller
{
    public function indexAction()
    {
        return $this->render('FrontendBackOfficeBundle:Plateforme:index.html.twig', array());
    }
}
