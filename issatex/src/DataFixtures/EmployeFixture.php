<?php
namespace App\DataFixtures;

use App\Entity\Employe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EmployeFixture extends Fixture{
    // public const EMPLOYE1 = "EMPLOYE1";
    // public const EMPLOYE2 = "EMPLOYE2";
    // public const EMPLOYE3 = "EMPLOYE3";
    // public const EMPLOYE4 = "EMPLOYE4";
    // public const EMPLOYE5 = "EMPLOYE5";

    public function load(ObjectManager $objectManager)
    {
        $employe1 = new Employe();
        $employe1->setNom("nom1")
            ->setPrenom("prenom1")
            ->setCategorie("categorie1")
            ->setMatricule("MAT1")
            ->setDateRecrutement(new \DateTime("now"))
        ;

        $employe2 = new Employe();
        $employe2->setNom("nom2")
            ->setPrenom("prenom2")
            ->setCategorie("categorie2")
            ->setMatricule("MAT2")
            ->setDateRecrutement(new \DateTime("now"))
        ;

        $employe3 = new Employe();
        $employe3->setNom("nom3")
            ->setPrenom("prenom3")
            ->setCategorie("categorie3")
            ->setMatricule("MAT3")
            ->setDateRecrutement(new \DateTime("now"))
        ;

        $employe4 = new Employe();
        $employe4->setNom("nom4")
            ->setPrenom("prenom4")
            ->setCategorie("categorie4")
            ->setMatricule("MAT4")
            ->setDateRecrutement(new \DateTime("now"))
        ;

        $employe5 = new Employe();
        $employe5->setNom("nom5")
            ->setPrenom("prenom5")
            ->setCategorie("categorie5")
            ->setMatricule("MAT5")
            ->setDateRecrutement(new \DateTime("now"))
        ;

        $objectManager->persist($employe1);
        $objectManager->persist($employe2);
        $objectManager->persist($employe3);
        $objectManager->persist($employe4);
        $objectManager->persist($employe5);

        $objectManager->flush();

        // $this->addReference($this::EMPLOYE1, $employe1);
        // $this->addReference($this::EMPLOYE2, $employe2);
        // $this->addReference($this::EMPLOYE3, $employe3);
        // $this->addReference($this::EMPLOYE4, $employe4);
        // $this->addReference($this::EMPLOYE5, $employe5);
        
    }
}