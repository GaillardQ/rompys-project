<?php

namespace Frontend\FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Frontend\FrontOfficeBundle\Entity\GameCatalog;
use Frontend\FrontOfficeBundle\Form\Type\GameCatalogFormType;

class ProfileController extends Controller {

    public function indexAction() 
    {
        $token_user = $this->container->get('security.context')->getToken()->getUser();
        $catalog = array();
        
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
        $game = new GameCatalog();
        
        $form = $this->createForm(new GameCatalogFormType(), $game);

        if ('POST' === $request->getMethod()) {
            $form->bind($request);

            if ($form->isValid()) {
                return $this->container->get('templating')->renderResponse('FrontendFrontOfficeBundle:Profile:add_game.html.twig', array(
                    'form' => $form->createView(),
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

