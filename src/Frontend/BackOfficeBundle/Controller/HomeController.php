<?php

namespace Frontend\BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function indexAction()
    {
        return $this->render('FrontendBackOfficeBundle:Home:index.html.twig', array());
    }
}
