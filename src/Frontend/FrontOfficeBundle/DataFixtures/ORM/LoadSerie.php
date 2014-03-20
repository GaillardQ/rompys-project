<?php

namespace Frontend\FrontOfficeBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Frontend\FrontOfficeBundle\Entity\Series;

class LoadSeries implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $p1 = new Series();
        $p1->setId(1);
        $p1->setValue("Super Mario Bros");
        $manager->persist($p1);
        
        $p2 = new Series();
        $p2->setId(2);
        $p2->setValue("Pro Evolution Soccer");
        $manager->persist($p2);
        
        $p3 = new Series();
        $p3->setId(3);
        $p3->setValue("Fifa");
        $manager->persist($p3);
        
        $p4 = new Series();
        $p4->setId(4);
        $p4->setValue("Call Of Duty");
        $manager->persist($p4);
        
        $manager->flush();
    }
}
