<?php

namespace Frontend\FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;

use Frontend\FrontOfficeBundle\Entity\GameCatalog;
use Frontend\FrontOfficeBundle\Entity\Game;
use Frontend\FrontOfficeBundle\Entity\Seller;
use Frontend\FrontOfficeBundle\Form\Type\GameCatalogFormType;

class ProfileController extends Controller {
    
    public function indexAction() 
    {
        $token = $this->container->get('security.context')->getToken();
        $token_user = $token->getUser();
        
        $games = $this->getDoctrine()
        ->getRepository('FrontendFrontOfficeBundle:GameCatalog')
        ->getSellerGames($token_user->getId());
       
        return $this->container->get('templating')->renderResponse('FrontendFrontOfficeBundle:Profile:index.html.twig', 
                array(
                    "user" => $token_user,
                    "token" => $token,
                    "games" => $games
                ));
    }
    
    public function updateAction(Request $request)
    {
        
        $user = $this->container->get('security.context')->getToken()->getUser();
        

        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->container->get('event_dispatcher');

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->container->get('fos_user.profile.form.factory');

        $form = $formFactory->createForm();
        $form->setData($user);

        if ('POST' === $request->getMethod()) {
            $form->bind($request);

            if ($form->isValid()) {
                /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
                $userManager = $this->container->get('fos_user.user_manager');

                $event = new FormEvent($form, $request);
                $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_SUCCESS, $event);

                $userManager->updateUser($user);

                if (null === $response = $event->getResponse()) {
                    $url = $this->container->get('router')->generate('fos_user_profile_show');
                    $response = new RedirectResponse($url);
                }

                $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

                return $response;
            }
        }

        return $this->container->get('templating')->renderResponse(
            'FrontendFrontOfficeBundle:Profile:edit.html.'.$this->container->getParameter('fos_user.template.engine'),
            array('form' => $form->createView())
        );
    }
    
    public function catalogAction()
    {
        $token_user = $this->container->get('security.context')->getToken()->getUser();
        $catalog  =  $this->get('Doctrine')
                            ->getRepository('FrontendFrontOfficeBundle:GameCatalog')
                            ->getAllGamesForSellByAnUser($token_user->getId());
       
        return $this->container->get('templating')->renderResponse('FrontendFrontOfficeBundle:Profile:catalog.html.twig', 
                array(
                    "user" => $token_user,
                    "catalog" => $catalog
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
                $gameCatalog->setAddedAt(new  \DateTime());
                
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

