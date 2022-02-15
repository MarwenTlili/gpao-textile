<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $hashedPassword;
    public const USER1_GERANT = "USER1_GERANT";
    public const USER2_CLIENT = "USER2_CLIENT";
    public const USER3_CLIENT = "USER3_CLIENT";
    public const USER4_CLIENT = "USER4_CLIENT";
    public const USER5_SECRETAIRE = "USER5_SECRETAIRE";

    public function __construct(UserPasswordHasherInterface $hashedPassword)
    {
        $this->hashedPassword = $hashedPassword;
    }

    public function load(ObjectManager $manager): void
    {
        $user1_gerant = new User();
        $user1_gerant->setEmail('gerant@gmail.com')
            ->setUsername('gerant')
            ->setRoles(['ROLE_GERANT'])
            ->setPlainPassword('gerant')
            ->setIsVerified(true)
            // ->setIsEnabled(true)
            ->setPassword($this->hashedPassword->hashPassword($user1_gerant, $user1_gerant->getPlainPassword()))
        ;

        $user2_client = new User();
        $user2_client->setEmail('client1@gmail.com')
            ->setUsername('client1')
            ->setRoles(['ROLE_CLIENT'])
            ->setPlainPassword('client1')
            ->setIsVerified(true)
            // ->setIsEnabled(true)
            ->setPassword($this->hashedPassword->hashPassword($user2_client, $user2_client->getPlainPassword()))
        ;

        $user3_client = new User();
        $user3_client->setEmail('client2@gmail.com')
            ->setUsername('client2')
            ->setRoles(['ROLE_CLIENT'])
            ->setPlainPassword('client2')
            ->setIsVerified(false)
            // ->setIsEnabled(false)
            ->setPassword($this->hashedPassword->hashPassword($user3_client, $user3_client->getPlainPassword()))
        ;

        $user4_client = new User();
        $user4_client->setEmail('client3@gmail.com')
            ->setUsername('client3')
            ->setRoles(['ROLE_CLIENT'])
            ->setPlainPassword('client3')
            ->setIsVerified(false)
            // ->setIsEnabled(false)
            ->setPassword($this->hashedPassword->hashPassword($user4_client, $user4_client->getPlainPassword()))
        ;

        $user5_secretaire = new User();
        $user5_secretaire->setEmail('secretaire@gmail.com')
            ->setUsername('secretaire')
            ->setRoles(['ROLE_SECRETAIRE'])
            ->setPlainPassword('secretaire')
            ->setIsVerified(false)
            // ->setIsEnabled(false)
            ->setPassword($this->hashedPassword->hashPassword($user5_secretaire, $user5_secretaire->getPlainPassword()))
        ;

        $manager->persist($user1_gerant);
        $manager->persist($user2_client);
        $manager->persist($user3_client);
        $manager->persist($user4_client);
        $manager->persist($user5_secretaire);
        $manager->flush();

        $this->addReference(self::USER1_GERANT, $user1_gerant);
        $this->addReference(self::USER2_CLIENT, $user2_client);
        $this->addReference(self::USER3_CLIENT, $user3_client);
        $this->addReference(self::USER4_CLIENT, $user4_client);
        $this->addReference(self::USER5_SECRETAIRE, $user5_secretaire);
    }
}
