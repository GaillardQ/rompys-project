<?php

namespace Frontend\BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GametypeController extends Controller
{
    public function indexAction()
    {
        return $this->render('FrontendBackOfficeBundle:Gametype:index.html.twig', array());
    }
}
