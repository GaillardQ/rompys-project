<?php

namespace Frontend\FrontOfficeBundle\Controller;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\UserEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

use Frontend\FrontOfficeBundle\Entity\User;

use FOS\UserBundle\Controller\RegistrationController as BaseController;

class RegistrationController extends BaseController
{
    public function registerAction(Request $request)
    {
        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->container->get('fos_user.registration.form.factory');
        /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
        $userManager = $this->container->get('fos_user.user_manager');
        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->container->get('event_dispatcher');

        $user = $userManager->createUser();
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, new UserEvent($user, $request));

        $form = $formFactory->createForm();
        $form->setData($user);
       

        if ('POST' === $request->getMethod()) {
            $form->bind($request);

            if ($form->isValid()) {
                
                $event = new FormEvent($form, $request);
                //$dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);
                $userManager->updateUser($user);
                
                if (null === $response = $event->getResponse()) {
                    $url = $this->container->get('router')->generate('fos_user_registration_confirmed');
                    $response = new RedirectResponse($url);
                }

                //$dispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response));
                $translator = $this->container->get('translator');
 
                $subject = $translator->trans('mail.registered.subject', array(), 'templatesTranslations');
                
                 $message = \Swift_Message::newInstance()
                        ->setSubject($subject)
                        ->setFrom($this->container->getParameter('super_admin_email'))
                        ->setTo($user->getEmail())
                        ->setBody($this->container->get('templating')->render('FrontendFrontOfficeBundle:Registration:mail_registered.html.twig', array('username' => $user->getUsername())));
                $this->container->get('mailer')->send($message);
                
                $token = new UsernamePasswordToken($user, null, 'frontend', $user->getRoles());
                $this->container->get('security.context')->setToken($token);
                $this->container->get('session')->set('_security_main',serialize($token));
                
                return $response;
            }
        }
        
        return $this->container->get('templating')->renderResponse('FOSUserBundle:Registration:register.html.'.$this->getEngine(), array(
            'form' => $form->createView(),
            'response' => false
        ));
    }
    public function confirmedAction()
    {
        return $this->container->get('templating')->renderResponse('FrontendFrontOfficeBundle:Registration:confirmed.html.'.$this->getEngine());
    }
}
