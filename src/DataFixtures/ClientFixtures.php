<?php

namespace App\DataFixtures;

use App\Entity\Client;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ClientFixtures extends Fixture implements DependentFixtureInterface{

    public function load(ObjectManager $objectManager)
    {
        $client1 = new Client();
        $client1->setNom("client1")
            ->setPrivilegier(false)
            ->setValider(false)
            ->setUser($this->getReference(UserFixtures::USER2_CLIENT))
        ;

        $client2 = new Client();
        $client2->setNom("client2")
            ->setPrivilegier(false)
            ->setValider(false)
            ->setUser($this->getReference(UserFixtures::USER3_CLIENT))
        ;

        $client3 = new Client();
        $client3->setNom("client3")
            ->setPrivilegier(false)
            ->setValider(false)
            ->setUser($this->getReference(UserFixtures::USER4_CLIENT))
        ;

        $objectManager->persist($client1);
        $objectManager->persist($client2);
        $objectManager->persist($client3);
        $objectManager->flush();

    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}