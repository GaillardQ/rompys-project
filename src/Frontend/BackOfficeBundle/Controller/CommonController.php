<?php

namespace Frontend\BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


class CommonController extends Controller {
    public function enableUserAction(Request $request, $id, $enable, $hash)
    {
        $response = new Response();
        
        $salt = $this->container->getParameter('secret');
        if($hash != md5($id."_".$salt))
        {
            $response->setStatusCode(404);
            return $response;
            
        }
        
        $em = $this->getDoctrine()->getManager();
        
        $user = $em->getRepository("FrontendFrontOfficeBundle:User")->find($id);
        
        if($enable == "true")
        {
            $user->setEnabled(1);
        }
        else
        {
            $user->setEnabled(0);
        }
        
        $em->flush();

        if($enable == "false")
        {
            $msg = $request->request->get('msg');
            
            $domain = 'templatesTranslations';
            
            $content = $this->get('translator')->trans('bo.user.mail', array(
                "%message%" => $msg
            ), $domain);

            $message = \Swift_Message::newInstance()
                            ->setSubject("[COMPTE] Suspension")
                            ->setFrom(array($this->getParameter("contact_mail") => "Rompy"))
                            ->setTo(array($user->getEmail() => $user->getUsername()))
                            ->setBody(nl2br($content), 'text/html');

            $this->container->get('mailer')->send($message);
        }
        
        $response->setStatusCode(200);
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent(json_encode(array("enable" => $enable)));
        
        return $response;
    }
}

