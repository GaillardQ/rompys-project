<?php

namespace Frontend\BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Frontend\FrontOfficeBundle\Entity\GameType;
use Frontend\FrontOfficeBundle\Form\Type\GametypeFormType;

class GametypeController extends Controller
{
    public function indexAction()
    {
        $allGametypes = $this->getDoctrine()->getRepository("FrontendFrontOfficeBundle:GameType")->findBy([], ['value' => 'ASC']);
        
        $salt = $this->container->getParameter('secret');
        
        foreach($allGametypes as $k=>$v)
        {
            $hash = md5($allGametypes[$k]->getId()."_".$salt);
            $allGametypes[$k]->setHash($hash);
        }
        
        return $this->render('FrontendBackOfficeBundle:Gametype:index.html.twig', array(
            "gametypes" => $allGametypes
        ));
    }
    
    public function createAction(Request $request)
    {
        $p = new GameType();
        $form = $this->createForm(new GametypeFormType(), $p);
        
        if ('POST' === $request->getMethod()) {
            $form->bind($request);
            
            if ($form->isValid()) {
                $em = $this->container->get('Doctrine')->getManager();
                
                $em->persist($p);
                $em->flush();
                
                return $this->redirectToRoute("frontend_back_office_gametypes");
            }
        }
        
        return $this->container->get('templating')->renderResponse('FrontendBackOfficeBundle:Gametype:add.html.twig', array(
            'form' => $form->createView()
        ));
    }
    
    public function updateAction(Request $request, $id, $name, $hash)
    {
        $ar_p = $this->getDoctrine()->getRepository("FrontendFrontOfficeBundle:GameType")->findBy(array(
            "id"    => $id,
            "value" => urldecode($name)
        ));
        
        $salt = $this->container->getParameter('secret');
        if($hash != md5($id."_".$salt) || count($ar_p) <= 0)
        {
            throw new NotFoundResourceException;
        }
        
        $p = $ar_p[0];
        
        $form = $this->createForm(new GametypeFormType(), $p);
        
        if ('POST' === $request->getMethod()) {
            $form->bind($request);
            
            if ($form->isValid()) {
                $em = $this->container->get('Doctrine')->getManager();
                
                $em->persist($p);
                $em->flush();
                
                return $this->redirectToRoute("frontend_back_office_gametypes");
            }
        }
        
        return $this->container->get('templating')->renderResponse('FrontendBackOfficeBundle:Gametype:update.html.twig', array(
            'form' => $form->createView()
        ));
    }
    
    public function deleteAction($id, $name, $hash)
    {
        $ar_p = $this->getDoctrine()->getRepository("FrontendFrontOfficeBundle:Plateform")->findBy(
            array(
                "id"    => $id,
                "value" => urldecode($name)
            )
        );
        
        $salt = $this->container->getParameter('secret');
        if($hash != md5($id."_".$salt) || count($ar_p) <= 0)
        {
            throw new NotFoundResourceException;
        }
        
        $p = $ar_p[0];
        
        $em = $this->getDoctrine()->getManager();
        $em->remove($p);
        $em->flush();
        
        return $this->redirectToRoute("frontend_back_office_plateformes");
    }
}
