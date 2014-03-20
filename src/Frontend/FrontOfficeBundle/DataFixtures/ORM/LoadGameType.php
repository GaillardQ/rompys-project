<?php

namespace Frontend\FrontOfficeBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Frontend\FrontOfficeBundle\Entity\GameType;

class LoadGameType implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $p1 = new GameType();
        $p1->setId(1);
        $p1->setValue("Action");
        $manager->persist($p1);
        
        $p2 = new GameType();
        $p2->setId(2);
        $p2->setValue("Arcade");
        $manager->persist($p2);
        
        $p3 = new GameType();
        $p3->setId(3);
        $p3->setValue("Aventure");
        $manager->persist($p3);
        
        $p4 = new GameType();
        $p4->setId(4);
        $p4->setValue("Sport");
        $manager->persist($p4);
        
        $manager->flush();
    }
}
