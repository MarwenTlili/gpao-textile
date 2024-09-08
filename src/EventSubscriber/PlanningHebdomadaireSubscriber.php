<?php

namespace App\EventSubscriber;

use App\Entity\PlanningHebdomadaire;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\AfterEntityDeletedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\AfterEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class PlanningHebdomadaireSubscriber implements EventSubscriberInterface{
    private EntityManagerInterface $entityManager;
    
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public static function getSubscribedEvents()
    {
        return [
            AfterEntityPersistedEvent::class => ['setOrdreFabricationLancer'],
            AfterEntityDeletedEvent::class => ['setOrdreFabricationNonLancer']
        ];
    }

    public function setOrdreFabricationLancer(AfterEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (!($entity instanceof PlanningHebdomadaire)) {
            return;
        }

        $entity->getOrdreFabrication()->setLancer(true);
        $this->entityManager->persist($entity->getOrdreFabrication());
        $this->entityManager->flush();
    }

    public function setOrdreFabricationNonLancer(AfterEntityDeletedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (!($entity instanceof PlanningHebdomadaire)) {
            return;
        }

        $entity->getOrdreFabrication()->setLancer(false);
        $this->entityManager->persist($entity->getOrdreFabrication());
        $this->entityManager->flush();
    }
}