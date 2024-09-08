<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\OrdreFabrication;
use App\Entity\OrdreFabricationTaille;
use App\Entity\Taille;
use App\Form\OrdreFabricationType;
use App\Repository\OrdreFabricationRepository;
use App\Service\DocumentTechniqueUploader;
use App\Service\OrdreFabricationService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * @Route("/ordre-fabrication")
 */
class OrdreFabricationController extends AbstractController
{
    // private $ordreFabricationService;

    public function __constract()
    {
        // $this->ordreFabricationService = new OrdreFabricationService();
    }

    /**
     * @Route("/", name="ordre_fabrication_index", methods={"GET"})
     */
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_CLIENT');

        /** @var \App\Entity\User $user */
        $user = $this->getUser();

        if ($this->isGranted('ROLE_CLIENT')) {
            $ordres = $user->getClient()->getOrdreFabrications();
        }

        return $this->render('ordre_fabrication/index.html.twig', [
            'ordre_fabrications' => $ordres
        ]);
    }

    /**
     * @Route("/new", name="ordre_fabrication_new", methods={"GET", "POST"})
     */
    public function new(Request $request, OrdreFabricationRepository $ordreFabricationRepository, EntityManagerInterface $entityManager, DocumentTechniqueUploader $documentTechniqueUploader): Response
    {
        $this->denyAccessUnlessGranted('ROLE_CLIENT');

        /** @var \App\Entity\User $user */
        $user = $this->getUser();

        /** @var \App\Entity\OrdreFabrication $ordreFabrication */
        $ordreFabrication = new OrdreFabrication();
        
        $l = new Taille();
        $l->setNom('L');
        
        $m = new Taille();
        $m->setNom('M');
        
        $xl = new Taille();
        $xl->setNom('XL');

        $entityManager->persist($l);
        $entityManager->persist($m);
        $entityManager->persist($xl);

        /** @var \App\Entity\OrdreFabricationTaille $ordreFabricationTailleL */
        $ordreFabricationTailleL = new OrdreFabricationTaille();
        $ordreFabricationTailleL->setTaille($l);
        // $ordreFabricationTailleL->setQuantite(0);
        $entityManager->persist($ordreFabricationTailleL);

        /** @var \App\Entity\OrdreFabricationTaille $ordreFabricationTailleM */
        $ordreFabricationTailleM = new OrdreFabricationTaille();
        $ordreFabricationTailleM->setTaille($m);
        // $ordreFabricationTailleM->setQuantite(10);

        /** @var \App\Entity\OrdreFabricationTaille $ordreFabricationTailleXL */
        $ordreFabricationTailleXL = new OrdreFabricationTaille();
        $ordreFabricationTailleXL->setTaille($xl);
        // $ordreFabricationTailleXL->setQuantite(10);

        $ordreFabrication->addOrdreFabricationTaille($ordreFabricationTailleL);
        $ordreFabrication->addOrdreFabricationTaille($ordreFabricationTailleM);
        $ordreFabrication->addOrdreFabricationTaille($ordreFabricationTailleXL);

        $entityManager->persist($ordreFabrication);

        // $ordreFabrication->setPrixUnitaire(10);
        // $ordreFabrication->setTempsUnitaire(300);

        $form = $this->createForm(OrdreFabricationType::class, $ordreFabrication);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /**
             * verifier si le client veut créer un nouveau article ou sélectionner depuit une list existant
             */
            /** @var \App\Entity\Article $article */
            $article = new Article();
            if (!$form['nouveauArticle']->getData()) {
                $article = $form->getData()->getArticle();
                /**
                 * check if selected article already exist
                 */
                if ($ordreFabricationRepository->findOneBy(['article' => $article, 'client' => $user->getClient()])) {
                    $this->addFlash(
                       'error',
                       "Vous avez déjà lancer un Ordre de Fabrication pour cette article '$article'!"
                    );
                    return $this->redirectToRoute('ordre_fabrication_new');
                }
            }else{
                $article = $form['articleNew']->getData();
            }

            /**
             * quantites validation
             */
            if ($ordreFabrication->getOrdreFabricationTailles()[0]->getQuantite() == 0
                && $ordreFabrication->getOrdreFabricationTailles()[1]->getQuantite() == 0
                && $ordreFabrication->getOrdreFabricationTailles()[2]->getQuantite() == 0
            ) {
                $this->addFlash(
                   'error',
                   'vous devez entrer au moin une quantite!'
                );
                return $this->redirectToRoute('ordre_fabrication_new');
            }
            
            /**
             * File upload handle
             */
            /** @var UploadedFile $brochureFile */
            $brochureFile = $form->get('documentTechnique')->getData();
            if ($brochureFile) {
                $brochureFileName = $documentTechniqueUploader->upload($brochureFile);
                $ordreFabrication->setDocumentTechnique($brochureFileName);
            }
            
            $ordreFabrication->setQteTotal(
                $ordreFabrication->getOrdreFabricationTailles()[0]->getQuantite() + 
                $ordreFabrication->getOrdreFabricationTailles()[1]->getQuantite() +
                $ordreFabrication->getOrdreFabricationTailles()[2]->getQuantite()
            );

            $article->addOrdreFabrication($ordreFabrication);
            $ordreFabrication->setCreatedAt(new \DateTime('now'));
            $ordreFabrication->setArticle($article);
            $ordreFabrication->setMontant(
                $ordreFabrication->getPrixUnitaire() * $ordreFabrication->getQteTotal()
            );
            $ordreFabrication->setUrgent($form->get('urgent')->getData());
            $ordreFabrication->setLancer(false);
            $ordreFabrication->setRefuser(false);
            $ordreFabrication->setClient($user->getClient());

            $entityManager->persist($article);
            $entityManager->persist($ordreFabrication);

            $entityManager->flush();

            $this->addFlash(
               'success',
               "Nouveau Ordre de fabrication '{$ordreFabrication->__toString()}' à éte créer."
            );

            return $this->redirectToRoute('client_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ordre_fabrication/new.html.twig', [
            'ordre_fabrication' => $ordreFabrication,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="ordre_fabrication_show", methods={"GET"})
     */
    public function show(Request $request, OrdreFabrication $ordreFabrication): Response
    {
        $this->denyAccessUnlessGranted('ROLE_CLIENT');

        if ($request->isXmlHttpRequest()) {
            dump("ordre_fabrication_show: ajax call ");

            $ordreFabricationTailles = [];
            foreach ($ordreFabrication->getOrdreFabricationTailles() as $key => $value) {
                $taille = $value->getTaille()->getNom();
                $quantite = $value->getQuantite();
                array_push($ordreFabricationTailles, [$taille => $quantite]);
            }

            return $this->json([
                'id' => $ordreFabrication->getId(),
                'client' => $ordreFabrication->getClient()->getNom(),
                'article' => $ordreFabrication->getArticle()->getDesignation(),
                'createdAt' => $ordreFabrication->getCreatedAt(),
                'qteTotal' => $ordreFabrication->getQteTotal(),
                'montant' => $ordreFabrication->getMontant(),
                'lancer' => $ordreFabrication->getLancer(),
                'urgent' => $ordreFabrication->getUrgent(),
                'ordreFabricationTailles' => $ordreFabricationTailles,
                'date_lancement' => new \DateTime('now')
            ]);

            // return new JsonResponse([
            //     'ordreFabrication' => $ordreFabrication
            // ]);
        }

        return $this->render('ordre_fabrication/show.html.twig', [
            'ordre_fabrication' => $ordreFabrication,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ordre_fabrication_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, OrdreFabrication $ordreFabrication, EntityManagerInterface $entityManager, DocumentTechniqueUploader $documentTechniqueUploader): Response
    {
        $this->denyAccessUnlessGranted('ROLE_CLIENT');

        $form = $this->createForm(OrdreFabricationType::class, $ordreFabrication);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dd($ordreFabrication);
            /**
             * quantites validation
             */
            if ($ordreFabrication->getOrdreFabricationTailles()[0]->getQuantite() == 0
                && $ordreFabrication->getOrdreFabricationTailles()[1]->getQuantite() == 0
                && $ordreFabrication->getOrdreFabricationTailles()[2]->getQuantite() == 0
            ) {
                $this->addFlash(
                   'error',
                   'vous devez entrer au moin une quantite!'
                );
                return $this->redirectToRoute('ordre_fabrication_edit', [
                    'id' => $ordreFabrication->getId()
                ]);
            }

            $quantiteTotal = $ordreFabrication->getOrdreFabricationTailles()[0]->getQuantite() + 
            $ordreFabrication->getOrdreFabricationTailles()[1]->getQuantite() +
            $ordreFabrication->getOrdreFabricationTailles()[2]->getQuantite();

            $ordreFabrication->setQteTotal($quantiteTotal);
            $ordreFabrication->setMontant(
                $ordreFabrication->getPrixUnitaire() * $quantiteTotal
            );
            if ($form->get('documentTechnique')->getData()) {
                /**
                 * File upload handle
                 */
                /** @var UploadedFile $brochureFile */
                $brochureFile = $form->get('documentTechnique')->getData();
                if ($brochureFile) {
                    $brochureFileName = $documentTechniqueUploader->upload($brochureFile);
                    $ordreFabrication->setDocumentTechnique($brochureFileName);
                }
            }
            
            $entityManager->flush();

            $this->addFlash(
               'success',
               "Ordre de fabrication {$ordreFabrication->__toString()} à éte modifier."
            );

            return $this->redirectToRoute('client_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ordre_fabrication/edit.html.twig', [
            'ordre_fabrication' => $ordreFabrication,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="ordre_fabrication_delete", methods={"POST"})
     */
    public function delete(Request $request, OrdreFabrication $ordreFabrication, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_CLIENT');

        if ($this->isCsrfTokenValid('delete'.$ordreFabrication->getId(), $request->request->get('_token'))) {
            $entityManager->remove($ordreFabrication);
            $entityManager->flush();
        }

        return $this->redirectToRoute('client_index', [], Response::HTTP_SEE_OTHER);
    }
}
