<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends Fixture{
    // public const ARTICLE1 = "ARTICLE1";
    // public const ARTICLE2 = "ARTICLE2";
    // public const ARTICLE3 = "ARTICLE3";
    // public const ARTICLE4 = "ARTICLE4";
    // public const ARTICLE5 = "ARTICLE5";

    public function load(ObjectManager $objectManager)
    {
        $article1 = new Article();
        $article1->setDesignation("designation1")
            ->setModele("modele1")
            ->setComposition("composition1")
        ;

        $article2 = new Article();
        $article2->setDesignation("designation2")
            ->setModele("modele2")
            ->setComposition("composition2")
        ;

        $article3 = new Article();
        $article3->setDesignation("designation3")
            ->setModele("modele3")
            ->setComposition("composition3")
        ;

        $article4 = new Article();
        $article4->setDesignation("designation4")
            ->setModele("modele4")
            ->setComposition("composition4")
        ;

        $article5 = new Article();
        $article5->setDesignation("designation5")
            ->setModele("modele5")
            ->setComposition("composition5")
        ;

        $objectManager->persist($article1);
        $objectManager->persist($article2);
        $objectManager->persist($article3);
        $objectManager->persist($article4);
        $objectManager->persist($article5);
        
        $objectManager->flush();

        // $this->addReference($this::ARTICLE1, $article1);
        // $this->addReference($this::ARTICLE2, $article2);
        // $this->addReference($this::ARTICLE3, $article3);
        // $this->addReference($this::ARTICLE4, $article4);
        // $this->addReference($this::ARTICLE5, $article5);

    }
}