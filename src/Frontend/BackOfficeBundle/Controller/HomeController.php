<?php

namespace Frontend\BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function indexAction()
    {
        $allGames = $this->get('doctrine')->getManager()->getRepository('FrontendFrontOfficeBundle:Game')->findAll();
        $nbGames = count($allGames);
        
        $allUsers = $this->get('doctrine')->getManager()->getRepository('FrontendFrontOfficeBundle:User')->findAll();
        $nbUsers = count($allUsers);
        
        $gamesByUsers = round($nbGames / $nbUsers, 2);
        
        return $this->render('FrontendBackOfficeBundle:Home:index.html.twig', array(
            "nb_games" => $nbGames,
            "nb_users" => $nbUsers,
            "games_by_users" => $gamesByUsers
        ));
    }
}
