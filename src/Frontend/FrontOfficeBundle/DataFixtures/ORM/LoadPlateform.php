<?php

namespace Frontend\FrontOfficeBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Frontend\FrontOfficeBundle\Entity\Plateform;

class LoadPlateform implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $p1 = new Plateform();
        $p1->setId(1);
        $p1->setValue("NES");
        $manager->persist($p1);
        
        $p2 = new Plateform();
        $p2->setId(2);
        $p2->setValue("PSOne");
        $manager->persist($p2);
        
        $p3 = new Plateform();
        $p3->setId(3);
        $p3->setValue("PS 2");
        $manager->persist($p3);
        
        $p4 = new Plateform();
        $p4->setId(4);
        $p4->setValue("PS 3");
        $manager->persist($p4);
        
        $manager->flush();
    }
}
