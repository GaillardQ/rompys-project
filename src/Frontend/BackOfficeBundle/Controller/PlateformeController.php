<?php

namespace Frontend\BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

use Frontend\FrontOfficeBundle\Entity\Plateform;
use Frontend\FrontOfficeBundle\Form\Type\PlateformeFormType;

class PlateformeController extends Controller
{
    public function indexAction()
    {
        $allPlateforms = $this->getDoctrine()->getRepository("FrontendFrontOfficeBundle:Plateform")->findBy([], ['value' => 'ASC']);
        
        $salt = $this->container->getParameter('secret');
        
        foreach($allPlateforms as $k=>$v)
        {
            $hash = md5($allPlateforms[$k]->getId()."_".$salt);
            $allPlateforms[$k]->setHash($hash);
        }
        
        return $this->render('FrontendBackOfficeBundle:Plateforme:index.html.twig', array(
            "plateforms" => $allPlateforms
        ));
    }
    
    public function createAction(Request $request)
    {
        $p = new Plateform();
        $form = $this->createForm(new PlateformeFormType(), $p);
        
        if ('POST' === $request->getMethod()) {
            $form->bind($request);
            
            if ($form->isValid()) {
                $em = $this->container->get('Doctrine')->getManager();
                
                $em->persist($p);
                $em->flush();
                
                return $this->redirectToRoute("frontend_back_office_plateformes");
            }
        }
        
        return $this->container->get('templating')->renderResponse('FrontendBackOfficeBundle:Plateforme:add.html.twig', array(
            'form' => $form->createView()
        ));
    }
    
    public function updateAction(Request $request, $id, $name, $hash)
    {
        $ar_p = $this->getDoctrine()->getRepository("FrontendFrontOfficeBundle:Plateform")->findBy(array(
            "id"    => $id,
            "value" => urldecode($name)
        ));
        
        $salt = $this->container->getParameter('secret');
        if($hash != md5($id."_".$salt) || count($ar_p) <= 0)
        {
            throw new NotFoundResourceException;
        }
        
        $p = $ar_p[0];
        
        $form = $this->createForm(new PlateformeFormType(), $p);
        
        if ('POST' === $request->getMethod()) {
            $form->bind($request);
            
            if ($form->isValid()) {
                $em = $this->container->get('Doctrine')->getManager();
                
                $em->persist($p);
                $em->flush();
                
                return $this->redirectToRoute("frontend_back_office_plateformes");
            }
        }
        
        return $this->container->get('templating')->renderResponse('FrontendBackOfficeBundle:Plateforme:update.html.twig', array(
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
