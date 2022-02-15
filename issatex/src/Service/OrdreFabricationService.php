<?php

namespace App\Service;

use App\Config\QualiteEnum;
use App\Config\TailleEnum;
// use App\Entity\Qualite;
use App\Entity\OrdreFabrication;
use App\Entity\Taille;
use Doctrine\ORM\EntityManagerInterface;
// use Proxies\__CG__\App\Entity\Quantite;

class OrdreFabricationService {
    private $ordreFabrication;
    // private $entityManager;
    private $l;
    private $m;
    private $xl;
    private $lQualite1;
    private $lQualite2;
    private $mQualite1;
    private $mQualite2;
    private $xlQualite1;
    private $xlQualite2;

    public function __construct(){
        // $this->ordreFabrication = $ordreFabrication;
        // $this->entityManager = $entityManager;
        // $this->lQualite1 = new Qualite();
        // $this->lQualite2 = new Qualite();
        // $this->mQualite1 = new Qualite();
        // $this->mQualite2 = new Qualite();
        // $this->xlQualite1 = new Qualite();
        // $this->xlQualite2 = new Qualite();
        $this->l = new Taille();
        $this->m = new Taille();
        $this->xl = new Taille();
    }

    public function initOrdreFabrication(OrdreFabrication $ordreFabrication){
        $this->ordreFabrication = $ordreFabrication;

        $this->l->setNom(TailleEnum::L);
        $this->m->setNom(TailleEnum::M);
        $this->xl->setNom(TailleEnum::XL);

        $this->lQualite1->setNom(QualiteEnum::PREMIERE_CHOIX);
        $this->lQualite1->setQuantite(0);

        $this->lQualite2->setNom(QualiteEnum::DEUXIEME_CHOIX);
        $this->lQualite2->setQuantite(0);

        $this->mQualite1->setNom(QualiteEnum::PREMIERE_CHOIX);
        $this->mQualite1->setQuantite(0);

        $this->mQualite2->setNom(QualiteEnum::DEUXIEME_CHOIX);
        $this->mQualite2->setQuantite(0);

        $this->xlQualite1->setNom(QualiteEnum::PREMIERE_CHOIX);
        $this->xlQualite1->setQuantite(0);

        $this->xlQualite2->setNom(QualiteEnum::DEUXIEME_CHOIX);
        $this->xlQualite2->setQuantite(0);


        // $this->l->addQualite($this->lQualite1);
        // $this->l->addQualite($this->lQualite2);
        // $this->m->addQualite($this->mQualite1);
        // $this->m->addQualite($this->mQualite2);
        // $this->xl->addQualite($this->xlQualite1);
        // $this->xl->addQualite($this->xlQualite2);
        
        // $this->ordreFabrication->addTaille($this->l);
        // $this->ordreFabrication->addTaille($this->m);
        // $this->ordreFabrication->addTaille($this->xl);
        // return $this->ordreFabrication;
    }

    // public function verifyQuantite(){
    //     $sommeQantiteTotal = 0;
    //     if ($this->lQualite1->getQuantite()) {
    //         // $this->entityManager->persist($this->lQualite1);
    //         $sommeQantiteTotal += $this->lQualite1->getQuantite();
    //     }else{
    //         $this->l->removeQualite($this->lQualite1);
    //     }
    //     if ($this->lQualite2->getQuantite()) {
    //         // $this->entityManager->persist($this->lQualite2);
    //         $sommeQantiteTotal += $this->lQualite2->getQuantite();
    //     }else{
    //         $this->l->removeQualite($this->lQualite2);
    //     }
    //     if (!$this->lQualite1->getQuantite() && !$this->lQualite2->getQuantite()) {
    //         $this->ordreFabrication->removeTaille($this->l);
    //         dump('L removed');
    //     }


    //     if ($this->mQualite1->getQuantite()) {
    //         // $this->entityManager->persist($this->mQualite1);
    //         $sommeQantiteTotal += $this->mQualite1->getQuantite();
    //     }else{
    //         $this->m->removeQualite($this->mQualite1);
    //     }
    //     if ($this->mQualite2->getQuantite()) {
    //         // $this->entityManager->persist($this->mQualite2);
    //         $sommeQantiteTotal += $this->mQualite2->getQuantite();
    //     }else{
    //         $this->m->removeQualite($this->mQualite2);
    //     }
    //     if (!$this->mQualite1->getQuantite() && !$this->mQualite2->getQuantite()) {
    //         $this->ordreFabrication->removeTaille($this->m);
    //         dump('M removed');
    //     }


    //     if ($this->xlQualite1->getQuantite()) {
    //         // $this->entityManager->persist($this->xlQualite1);
    //         $sommeQantiteTotal += $this->xlQualite1->getQuantite();
    //     }else{
    //         $this->xl->removeQualite($this->xlQualite1);
    //     }
    //     if ($this->xlQualite2->getQuantite()) {
    //         // $this->entityManager->persist($this->xlQualite2);
    //         $sommeQantiteTotal += $this->xlQualite2->getQuantite();
    //     }else{
    //         $this->xl->removeQualite($this->xlQualite2);
    //     }
    //     if (!$this->xlQualite1->getQuantite() && !$this->xlQualite2->getQuantite()) {
    //         $this->ordreFabrication->removeTaille($this->xl);
    //         dump('XL removed');
    //     }
    // }

}