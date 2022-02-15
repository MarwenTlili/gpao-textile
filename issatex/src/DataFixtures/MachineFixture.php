<?php
namespace App\DataFixtures;

use App\Entity\Machine;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MachineFixture extends Fixture{
    // public const MACHINE1 = "MACHINE1";
    // public const MACHINE2 = "MACHINE2";
    // public const MACHINE3 = "MACHINE3";
    // public const MACHINE4 = "MACHINE4";
    // public const MACHINE5 = "MACHINE5";

    public function load(ObjectManager $objectManager)
    {
        $machine1 = new Machine();
        $machine1->setNom("machine1")
            ->setType("type1")
            ->setMarque("marque1")
        ;

        $machine2 = new Machine();
        $machine2->setNom("machine2")
            ->setType("type2")
            ->setMarque("marque2")
        ;

        $machine3 = new Machine();
        $machine3->setNom("machine3")
            ->setType("type3")
            ->setMarque("marque3")
        ;

        $machine4 = new Machine();
        $machine4->setNom("machine4")
            ->setType("type4")
            ->setMarque("marque4")
        ;

        $machine5 = new Machine();
        $machine5->setNom("machine5")
            ->setType("type5")
            ->setMarque("marque5")
        ;

        $objectManager->persist($machine1);
        $objectManager->persist($machine2);
        $objectManager->persist($machine3);
        $objectManager->persist($machine4);
        $objectManager->persist($machine5);

        $objectManager->flush();

        // $this->addReference($this::MACHINE1, $machine1);
        // $this->addReference($this::MACHINE2, $machine2);
        // $this->addReference($this::MACHINE3, $machine3);
        // $this->addReference($this::MACHINE4, $machine4);
        // $this->addReference($this::MACHINE5, $machine5);
    }
}