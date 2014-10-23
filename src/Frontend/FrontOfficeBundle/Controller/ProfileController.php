<?php

namespace Frontend\FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Frontend\FrontOfficeBundle\Entity\GameCatalog;
use Frontend\FrontOfficeBundle\Entity\Game;
use Frontend\FrontOfficeBundle\Entity\Seller;
use Frontend\FrontOfficeBundle\Form\Type\GameCatalogFormType;

class ProfileController extends Controller {
    
    public function indexAction() 
    {
        $token_user = $this->container->get('security.context')->getToken()->getUser();
        $catalog  =  $this->get('Doctrine')
                            ->getRepository('FrontendFrontOfficeBundle:GameCatalog')
                            ->getAllGamesForSellByAnUser($token_user->getId());
       
        return $this->container->get('templating')->renderResponse('FrontendFrontOfficeBundle:Profile:index.html.twig', 
                array(
                    "user" => $token_user,
                    "catalog" => $catalog
                ));
    }
    
    public function updateAction()
    {
        $token_user = $this->container->get('security.context')->getToken()->getUser();
        
        return $this->container->get('templating')->renderResponse('FrontendFrontOfficeBundle:Profile:index.html.twig', 
                array(
                    "user" => $token_user
                ));
    }
    
    public function addGameAction(Request $request)
    {
        $token_user = $this->container->get('security.context')->getToken()->getUser();
        
        
        
        $gameCatalog = new GameCatalog();
        
        $form = $this->createForm(new GameCatalogFormType(), $gameCatalog);
        
        if ('POST' === $request->getMethod()) {
            $form->bind($request);
            
            if ($form->isValid()) {
                $em = $this->container->get('Doctrine')->getManager();
                
                $game_id = $gameCatalog->getGame()->getId();
                $game =  $this->get('Doctrine')
                            ->getRepository('FrontendFrontOfficeBundle:Game')
                            ->find($game_id);
                $gameCatalog->setGame($game);
                
                $seller =  $this->get('Doctrine')
                            ->getRepository('FrontendFrontOfficeBundle:Seller')
                            ->findOneBy(array("user" => $token_user->getId()));
                            
                if($seller == null)
                {
                    $seller = new Seller();
                    $seller->setUser($token_user);
                    $em->persist($seller);
                }
                
                $gameCatalog->setSeller($seller);
                
                $em->persist($gameCatalog);
                $em->flush();
                
                $gameCatalog = new GameCatalog();   
                $form = $this->createForm(new GameCatalogFormType(), $gameCatalog);
                
                return $this->container->get('templating')->renderResponse('FrontendFrontOfficeBundle:Profile:add_game.html.twig', array(
                    'form' => $form->createView(),
                    "user" => $token_user,
                    'add' => true
                ));
            }
        }
        return $this->container->get('templating')->renderResponse('FrontendFrontOfficeBundle:Profile:add_game.html.twig', array(
            "user" => $token_user,
            'form' => $form->createView()
        ));
    }
}

