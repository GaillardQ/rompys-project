<?php

namespace Frontend\FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Frontend\FrontOfficeBundle\Entity\News;

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
        
        $ar_news = $this->getDoctrine()->getRepository("FrontendFrontOfficeBundle:News")->findDisplayedNews(new \Datetime());
        if(count($ar_news) > 0)
        {
            $news = $ar_news[0];
        }
        else
        {
            $news = $this->getDefaultNews();
        }
        
        return $this->container->get('templating')->renderResponse('FrontendFrontOfficeBundle:Home:home.html.twig', array(
            'invalid_username' => $invalid_username,
            'user'  => $token_user,
            'games' => $games,
            'news'  => $news
        ));
    }
    
    private function getDefaultNews()
    {
        $news = new News();
        
        $data = $this->getDoctrine()->getRepository("FrontendFrontOfficeBundle:DailyStats")->findYesterday();
        
        $users = 0;
        $games = 0;
        if(count($data) > 0)
        {
            $d = $data[0];
            $users = $d->getNbUsers();
            $games = $d->getNbGames();
            
            $newsTitle = $this->get('translator')->trans('home.news.data.title', array(), 'templatesTranslations');
            $transUsers = $this->get('translator')->transChoice('home.news.data.content_users', $users, array('%nb_users%' => $users), 'templatesTranslations');
            $transGames = $this->get('translator')->transChoice('home.news.data.content_games', $games, array('%nb_games%' => $games), 'templatesTranslations');

            $newsContent = "<br />".$transUsers."<br />".$transGames;
        }
        else
        {
            $newsTitle      = $this->get('translator')->trans('home.news.default.title', array(), 'templatesTranslations');
            $newsContent    = $this->get('translator')->trans('home.news.default.content', array(), 'templatesTranslations');
        }
        
        
        
        $news->setContent($newsContent);
        $news->setTitle($newsTitle);

        return $news;
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
