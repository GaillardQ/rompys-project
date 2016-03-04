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
        $p2->setValue("Aventure");
        $manager->persist($p2);

        $p3 = new GameType();
        $p3->setId(3);
        $p3->setValue("Cartes");
        $manager->persist($p3);

        $p4 = new GameType();
        $p4->setId(4);
        $p4->setValue("Casino");
        $manager->persist($p4);

        $p5 = new GameType();
        $p5->setId(5);
        $p5->setValue("Combat");
        $manager->persist($p5);

        $p6 = new GameType();
        $p6->setId(6);
        $p6->setValue("Courses");
        $manager->persist($p6);

        $p7 = new GameType();
        $p7->setId(7);
        $p7->setValue("Enigmes");
        $manager->persist($p7);

        $p8 = new GameType();
        $p8->setId(8);
        $p8->setValue("Jeu de rôle");
        $manager->persist($p8);

        $p9 = new GameType();
        $p9->setId(9);
        $p9->setValue("Labyrinthe");
        $manager->persist($p9);

        $p10 = new GameType();
        $p10->setId(10);
        $p10->setValue("Plateforme");
        $manager->persist($p10);

        $p11 = new GameType();
        $p11->setId(11);
        $p11->setValue("Puzzle");
        $manager->persist($p11);

        $p12 = new GameType();
        $p12->setId(12);
        $p12->setValue("Rythme");
        $manager->persist($p12);

        $p13 = new GameType();
        $p13->setId(13);
        $p13->setValue("Simulation");
        $manager->persist($p13);

        $p14 = new GameType();
        $p14->setId(14);
        $p14->setValue("Sport");
        $manager->persist($p14);

        $p15 = new GameType();
        $p15->setId(15);
        $p15->setValue("Stratégie");
        $manager->persist($p15);

        $p16 = new GameType();
        $p16->setId(16);
        $p16->setValue("Tir");
        $manager->persist($p16);
        
        $manager->flush();
    }
}
