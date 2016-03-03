<?php

namespace Frontend\FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends Controller {

    public function gameAction(Request $request, $seller, $game)
    {         
        $data = $this->getDoctrine()->getRepository("FrontendFrontOfficeBundle:Game")->checkIfUserSellGame($seller, $game);
        if($data === null)
        {
            return new Response("", 400);
        }
        
        $error = null;
        $m = null;
        $isSent = false;
        
        if ('POST' === $request->getMethod()) {
            $r = $request->request;
            if($r != null)
            {
                $m = $r->get('message');
                if($m !== null && $m != "")
                {
                    // On envoie le mail
                    $translator = $this->get('translator');
                    $domain = 'templatesTranslations';
                    
                    $subject = $translator->trans('contact.game.subject', array(
                        "%pseudo%"      => $data["username"],
                        "%game%"        => $data["game"],
                        "%plateform%"   => $data["plateform"]
                    ), $domain);
                    
                    $content = $this->container
                                    ->get('templating')
                                    ->render('FrontendFrontOfficeBundle:Contact:mail_contact_game.html.twig', 
                                        array(
                                            'message'   => $m,
                                            'pseudo'    => "Toto",
                                            'email'     => "toto@gmail.com",
                                        )
                                    );
                    /*$transport = \Swift_SmtpTransport::newInstance('smtp-mail.outlook.com', 587, 'tls')
                                        ->setUsername('rompys-project@outlook.fr')
                                        ->setPassword('Rompys--Project');
                    $mailer = \Swift_Mailer::newInstance($transport);*/
                    
                    $message = \Swift_Message::newInstance()
                        ->setSubject($subject)
                        ->setFrom(/*$user->getEmail()*/"dieu@paradis.net")
                        ->setTo($data["email"])
                        ->setBody(nl2br($content), 'text/html');
                    $this->container->get('mailer')->send($message);
                    //$mailer->send($message);
                    
                    $isSent = true;
                    return $this->container->get('templating')->renderResponse('FrontendFrontOfficeBundle:Contact:game.html.twig', array(
                        "data"      => $data,
                        "error"     => $error,
                        "message"   => $m,
                        "sent"      => $isSent,
                        "seller"    => $seller,
                        "game"      => $game
                    ));
                }
            }
            $error = true;
        }
        
        return $this->container->get('templating')->renderResponse('FrontendFrontOfficeBundle:Contact:game.html.twig', array(
            "data"      => $data,
            "error"     => $error,
            "message"   => $m,
            "sent"      => $isSent,
            "seller"    => $seller,
            "game"      => $game
        ));
    }

}