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
        $trendsByDays = $this->get('doctrine')->getManager()->getRepository('FrontendFrontOfficeBundle:DailyStats')->findTrendsByDays();
        
        // Graphes nouveautés
        $newsByDays = $this->get('doctrine')->getManager()->getRepository('FrontendFrontOfficeBundle:DailyStats')->findNewsByDays();
        
        // Graphes consoles
        $gamesByConsole = $this->get('doctrine')->getManager()->getRepository('FrontendFrontOfficeBundle:Game')->findGamesByConsoleDistribution();
        $pricesByConsole = $this->get('doctrine')->getManager()->getRepository('FrontendFrontOfficeBundle:Game')->findPricesByConsoleDistribution();
        
        return $this->render('FrontendBackOfficeBundle:Home:index.html.twig', array(
            "nb_games"                  => $nbGames,
            "nb_users"                  => $nbUsers,
            "games_by_users"            => $gamesByUsers,
            "yesterday_registration"    => $yesterdayRegistration,
            "trends_by_days"            => $trendsByDays,
            "news_by_days"              => $newsByDays,
            "games_by_console"          => $gamesByConsole,
            "prices_by_console"         => $pricesByConsole
        ));
    }
}
