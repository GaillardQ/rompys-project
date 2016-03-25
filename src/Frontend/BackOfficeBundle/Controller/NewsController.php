<?php

namespace Frontend\BackOfficeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Frontend\FrontOfficeBundle\Entity\News;
use Frontend\FrontOfficeBundle\Form\Type\NewsFormType;

/**
 * News controller.
 */
class NewsController extends Controller
{
    public function indexAction()
    {
        $allNews = $this->getDoctrine()->getRepository("FrontendFrontOfficeBundle:News")->findBy([], ['dateStart' => 'DESC']);
        
        $salt = $this->container->getParameter('secret');
        
        foreach($allNews as $k=>$v)
        {
            $hash = md5($allNews[$k]->getId()."_".$salt);
            $allNews[$k]->setHash($hash);
            $start = $v->getDateStart();
            $end = $v->getDateEnd();
            
            $now = new \DateTime();
            
            if($start <= $now && $now < $end)
            {
                $allNews[$k]->setDisplayed(true);
            }
            else
            {
                $allNews[$k]->setDisplayed(false);
            }
        }
        
        return $this->render('FrontendBackOfficeBundle:News:index.html.twig', array(
            "news" => $allNews
        ));
    }
    
    public function createAction(Request $request)
    {
        $p = new News();
        $form = $this->createForm(new NewsFormType(), $p);
        
        if ('POST' === $request->getMethod()) {
            $form->bind($request);
            
            if ($form->isValid()) {
                $em = $this->container->get('Doctrine')->getManager();
                
                $em->persist($p);
                $em->flush();
                
                return $this->redirectToRoute("frontend_back_office_news");
            }
        }
        
        return $this->container->get('templating')->renderResponse('FrontendBackOfficeBundle:News:add.html.twig', array(
            'form' => $form->createView()
        ));
    }
    
    public function updateAction(Request $request, $id, $hash)
    {
        $ar_p = $this->getDoctrine()->getRepository("FrontendFrontOfficeBundle:News")->findBy(array(
            "id"    => $id
        ));
        
        $salt = $this->container->getParameter('secret');
        if($hash != md5($id."_".$salt) || count($ar_p) <= 0)
        {
            throw new NotFoundResourceException;
        }
        
        $p = $ar_p[0];
        
        $form = $this->createForm(new NewsFormType(), $p);
        
        if ('POST' === $request->getMethod()) {
            $form->bind($request);
            
            if ($form->isValid()) {
                $em = $this->container->get('Doctrine')->getManager();
                
                $em->persist($p);
                $em->flush();
                
                return $this->redirectToRoute("frontend_back_office_news");
            }
        }
        
        return $this->container->get('templating')->renderResponse('FrontendBackOfficeBundle:News:update.html.twig', array(
            'form' => $form->createView()
        ));
    }
    
    public function deleteAction($id, $hash)
    {
        $ar_p = $this->getDoctrine()->getRepository("FrontendFrontOfficeBundle:News")->findBy(
            array(
                "id"    => $id
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
        
        return $this->redirectToRoute("frontend_back_office_news");
    }
}
