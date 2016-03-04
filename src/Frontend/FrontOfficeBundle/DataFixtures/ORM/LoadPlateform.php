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
        $p1->setValue("Commodore");
        $manager->persist($p1);

        $p2 = new Plateform();
        $p2->setId(2);
        $p2->setValue("Dreamcast");
        $manager->persist($p2);

        $p3 = new Plateform();
        $p3->setId(3);
        $p3->setValue("Game Boy");
        $manager->persist($p3);

        $p4 = new Plateform();
        $p4->setId(4);
        $p4->setValue("Game Boy Advance");
        $manager->persist($p4);

        $p5 = new Plateform();
        $p5->setId(5);
        $p5->setValue("Game Boy Advance SP");
        $manager->persist($p5);

        $p6 = new Plateform();
        $p6->setId(6);
        $p6->setValue("Game Boy Color");
        $manager->persist($p6);

        $p7 = new Plateform();
        $p7->setId(7);
        $p7->setValue("Game Cube");
        $manager->persist($p7);

        $p8 = new Plateform();
        $p8->setId(8);
        $p8->setValue("Game Gear");
        $manager->persist($p8);

        $p9 = new Plateform();
        $p9->setId(9);
        $p9->setValue("MAC");
        $manager->persist($p9);

        $p10 = new Plateform();
        $p10->setId(10);
        $p10->setValue("Master System");
        $manager->persist($p10);

        $p11 = new Plateform();
        $p11->setId(11);
        $p11->setValue("Master System II");
        $manager->persist($p11);

        $p12 = new Plateform();
        $p12->setId(12);
        $p12->setValue("Master System III");
        $manager->persist($p12);

        $p13 = new Plateform();
        $p13->setId(13);
        $p13->setValue("Mega Drive");
        $manager->persist($p13);

        $p14 = new Plateform();
        $p14->setId(14);
        $p14->setValue("Mega Drive II");
        $manager->persist($p14);

        $p15 = new Plateform();
        $p15->setId(15);
        $p15->setValue("New Nintendo 3DS");
        $manager->persist($p15);

        $p16 = new Plateform();
        $p16->setId(16);
        $p16->setValue("N-Gage");
        $manager->persist($p16);

        $p17 = new Plateform();
        $p17->setId(17);
        $p17->setValue("Nintendo 2DS");
        $manager->persist($p17);

        $p18 = new Plateform();
        $p18->setId(18);
        $p18->setValue("Nintendo 3DS");
        $manager->persist($p18);

        $p19 = new Plateform();
        $p19->setId(19);
        $p19->setValue("Nintendo 64");
        $manager->persist($p19);

        $p20 = new Plateform();
        $p20->setId(20);
        $p20->setValue("Nintendo DS");
        $manager->persist($p20);

        $p21 = new Plateform();
        $p21->setId(21);
        $p21->setValue("Nintendo Entertainment System (NES)");
        $manager->persist($p21);

        $p22 = new Plateform();
        $p22->setId(22);
        $p22->setValue("PC");
        $manager->persist($p22);

        $p23 = new Plateform();
        $p23->setId(23);
        $p23->setValue("Playstation");
        $manager->persist($p23);

        $p24 = new Plateform();
        $p24->setId(24);
        $p24->setValue("Playstation 2");
        $manager->persist($p24);

        $p25 = new Plateform();
        $p25->setId(25);
        $p25->setValue("Playstation 3");
        $manager->persist($p25);

        $p26 = new Plateform();
        $p26->setId(26);
        $p26->setValue("Playstation 4");
        $manager->persist($p26);

        $p27 = new Plateform();
        $p27->setId(27);
        $p27->setValue("Playstation Vita");
        $manager->persist($p27);

        $p28 = new Plateform();
        $p28->setId(28);
        $p28->setValue("PSP");
        $manager->persist($p28);

        $p29 = new Plateform();
        $p29->setId(29);
        $p29->setValue("Sega Neptune");
        $manager->persist($p29);

        $p30 = new Plateform();
        $p30->setId(30);
        $p30->setValue("Sega Sturn");
        $manager->persist($p30);

        $p31 = new Plateform();
        $p31->setId(31);
        $p31->setValue("SNES");
        $manager->persist($p31);

        $p32 = new Plateform();
        $p32->setId(32);
        $p32->setValue("Wii");
        $manager->persist($p32);

        $p33 = new Plateform();
        $p33->setId(33);
        $p33->setValue("Wii U");
        $manager->persist($p33);

        $p34 = new Plateform();
        $p34->setId(34);
        $p34->setValue("Xbox");
        $manager->persist($p34);

        $p35 = new Plateform();
        $p35->setId(35);
        $p35->setValue("Xbox 360");
        $manager->persist($p35);

        $p36 = new Plateform();
        $p36->setId(36);
        $p36->setValue("Xbox One");
        $manager->persist($p36);
        
        $manager->flush();
    }
}
