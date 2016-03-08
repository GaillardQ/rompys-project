<?php

namespace Backend\WsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Frontend\FrontOfficeBundle\Entity\DailyStats;

class DailyStatsController extends Controller
{
    public function saveAction()
    {
        $allGames = $this->get('doctrine')->getManager()->getRepository('FrontendFrontOfficeBundle:Game')->findAll();
        $nbGames = count($allGames);
        
        $allUsers = $this->get('doctrine')->getManager()->getRepository('FrontendFrontOfficeBundle:User')->findAll();
        $nbUsers = count($allUsers);
                
        $date = date("d-m-Y");
        
        $data = $this->get('doctrine')->getManager()->getRepository('FrontendFrontOfficeBundle:DailyStats')->findBy(array("day" => $date));
        
        $stats = new DailyStats();
        if(count($data) > 0)
        {
            $stats = $data[0];
        }
        
        $stats->setDay($date);
        $stats->setNbGames($nbGames);
        $stats->setNbUsers($nbUsers);
        
        $em = $this->get('doctrine')->getManager();
        $em->persist($stats);
        $em->flush();
        
        $response = new Response();
        
        $response->setStatusCode(200);
        $response->headers->set("Content-Type", "application/json; charset=UTF-8");
        $response->setContent(json_encode(array(
            "users" => $nbUsers,
            "games" => $nbGames
        )));
        
        return $response;
    }
}
