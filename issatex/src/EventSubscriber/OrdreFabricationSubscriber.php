<?php

namespace App\EventSubscriber;

use App\Entity\OrdreFabrication;
use App\Entity\User;
use App\Repository\OrdreFabricationTailleRepository;
use App\Repository\TailleRepository;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;

class OrdreFabricationSubscriber implements EventSubscriberInterface{
    private $hub;
    private $ordreFabricationTailleRepository;
    private $tailleRepository;

    public function __construct(HubInterface $hub, OrdreFabricationTailleRepository $ordreFabricationTailleRepository, TailleRepository $tailleRepository)
    {
        $this->hub = $hub;
        $this->ordreFabricationTailleRepository = $ordreFabricationTailleRepository;
        $this->tailleRepository = $tailleRepository;
    }

    public function getSubscribedEvents(): array{
        return [
            Events::preUpdate
        ];
    }

    function preUpdate(PreUpdateEventArgs $args){
        $entity = $args->getObject();

        // perhaps you only want to act on some "Product" entity
        if ($entity instanceof OrdreFabrication) {
            if ($args->hasChangedField('lancer')) {
                // $changes = $args->getEntityChangeSet();
                $new = (int)$args->getNewValue('lancer');
                $old = (int)$args->getOldValue('lancer');

                if ($new == 1) {
                    $this->notifyClient_of_lancer($entity->getClient()->getUser(), $entity);
                }elseif ($new == 0) {
                    $this->notifyClient_of_larguer($entity->getClient()->getUser(), $entity);
                }
            }
        }
    }

    public function notifyClient_of_lancer(User $user, OrdreFabrication $ordreFabrication){
        // $ordreFabricationTailles = [];
        // foreach ($ordreFabrication->getOrdreFabricationTailles() as $key => $value) {
        //     $taille = $value->getTaille()->getNom();
        //     $quantite = $value->getQuantite();
        //     array_push($ordreFabricationTailles, [$taille => $quantite]);
        // }
        // dd($ordreFabricationTailles);

        $topic = "http://issatex.com/of/lancer/{$user->getId()}";
        $update = new Update(
            $topic,
            json_encode(['ordre_fabrication' => [
                'id' => $ordreFabrication->getId(),
                'lancer' => $ordreFabrication->getLancer(),
                // 'client' => $ordreFabrication->getClient()->getNom(),
                // 'article' => $ordreFabrication->getArticle()->getDesignation(),
                // 'createdAt' => $ordreFabrication->getCreatedAt(),
                // 'qteTotal' => $ordreFabrication->getQteTotal(),
                // 'montant' => $ordreFabrication->getMontant(),
                // 'urgent' => $ordreFabrication->getUrgent(),
                // 'ordreFabricationTailles' => $ordreFabricationTailles,
                // 'date_lancement' => new DateTime('now')
            ]])
        );

        
        // dd($ordreFabrication->getOrdreFabricationTailles());

        $this->hub->publish($update);

        return new Response('OF Lancer!');

    }

    public function notifyClient_of_larguer(User $user, OrdreFabrication $ordreFabrication)
    {
        $topic = "http://issatex.com/of/larguer/{$user->getId()}";
        $update = new Update(
            $topic,
            json_encode(['ordre_fabrication' => [
                'id' => $ordreFabrication->getId(),
                'lancer' => false
            ]])
        );

        $this->hub->publish($update);

        return new Response('OF larguer!');
    }
}