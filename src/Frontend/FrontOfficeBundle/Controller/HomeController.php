<?php

namespace Frontend\FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller {

    public function indexAction() 
    {    
        /*$w1 = "Assassin's Creed";
        $w2 = "Assassins  Creed";
        similar_text ( $w1, $w2, $percent );
        echo "$w1 / $w2 => $percent %<br />";
        
        $w1 = "Colni mcrea";
        $w2 = "Colin Macrae";
        similar_text ( $w1, $w2, $percent );
        echo "$w1 / $w2 => $percent %<br />";
        
        $w1 = "Rise of tomb raider";
        $w2 = "Rise of tomb raider";
        similar_text ( $w1, $w2, $percent );
        echo "$w1 / $w2 => $percent %<br />";*/
        
        $request = $this->getRequest();
        $invalid_username = $request->query->get('invalid_username'); // get a $_GET parameter
        
        $token_user = $this->container->get('security.context')->getToken()->getUser();
        
        $games = array();
        
        if($token_user != "anon.")
        {
            $user_id = $token_user->getId();
            
            $games = $this->getDoctrine()
            ->getRepository('FrontendFrontOfficeBundle:Game')
            ->getAllGamesForSellByAnUser($user_id);
            
        }
        
        return $this->container->get('templating')->renderResponse('FrontendFrontOfficeBundle:Home:home.html.twig', array(
            'invalid_username' => $invalid_username,
            'user' => $token_user,
            'games' => $games
        ));
    }
    
    public function ProfileSummaryAction()
    {
        $user = null;
        $token_user = $this->container->get('security.context')->getToken()->getUser();
        if($token_user != null)
        {
            $user = $token_user;
        }
        
        return $this->container->get('templating')->renderResponse('FrontendFrontOfficeBundle:Home:profile_summary.html.twig', array(
            'user' => $user
        ));
    }

}
