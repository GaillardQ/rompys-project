<?php

namespace Frontend\FrontOfficeBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Frontend\FrontOfficeBundle\Entity\Editor;

class LoadEditor implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $p1 = new Editor();
        $p1->setId(1);
        $p1->setValue("Activision");
        $manager->persist($p1);
        
        $p2 = new Editor();
        $p2->setId(2);
        $p2->setValue("Atari");
        $manager->persist($p2);
        
        $p3 = new Editor();
        $p3->setId(3);
        $p3->setValue("Konami");
        $manager->persist($p3);
        
        $p4 = new Editor();
        $p4->setId(4);
        $p4->setValue("Ubisoft");
        $manager->persist($p4);
        
        $manager->flush();
    }
}
