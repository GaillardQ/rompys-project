<?php

namespace Frontend\BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function indexAction()
    {
        // DATA
        // Encadrés
        $allGames = $this->get('doctrine')->getManager()->getRepository('FrontendFrontOfficeBundle:Game')->findAll();
        $nbGames = count($allGames);
        
        $allUsers = $this->get('doctrine')->getManager()->getRepository('FrontendFrontOfficeBundle:User')->findAll();
        $nbUsers = count($allUsers);
        
        $yesterdayRegistration = $this->get('doctrine')->getManager()->getRepository('FrontendFrontOfficeBundle:DailyStats')->findYesterday();
        
        $gamesByUsers = round($nbGames / $nbUsers, 2);
        
        // Graphes tendances
        $usersByMonths = $this->get('doctrine')->getManager()->getRepository('FrontendFrontOfficeBundle:DailyStats')->findUsersByMonths();
        $gamesByMonths = $this->get('doctrine')->getManager()->getRepository('FrontendFrontOfficeBundle:DailyStats')->findGamesByMonths();
        var_dump($usersByMonths);
        // Graphes nouveautés
        
        // Graphes consoles
        
        return $this->render('FrontendBackOfficeBundle:Home:index.html.twig', array(
            "nb_games"                  => $nbGames,
            "nb_users"                  => $nbUsers,
            "games_by_users"            => $gamesByUsers,
            "yesterday_registration"    => $yesterdayRegistration
        ));
    }
}
