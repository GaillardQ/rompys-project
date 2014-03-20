<?php

namespace Frontend\FrontOfficeBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Frontend\FrontOfficeBundle\Entity\GameState;

class LoadGameState implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $p1 = new GameState();
        $p1->setId(1);
        $p1->setValue("Très bon état");
        $manager->persist($p1);
        
        $p2 = new GameState();
        $p2->setId(2);
        $p2->setValue("Bon état");
        $manager->persist($p2);
        
        $p3 = new GameState();
        $p3->setId(3);
        $p3->setValue("Etat d'usage");
        $manager->persist($p3);
        
        $p4 = new GameState();
        $p4->setId(4);
        $p4->setValue("Mauvais état");
        $manager->persist($p4);
        
        $manager->flush();
    }
}
