<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use App\Repository\OrdreFabricationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/client")
 */
class ClientController extends AbstractController
{
    /**
     * @Route("/", name="client_index", methods={"GET"})
     */
    public function index(Request $request, EntityManagerInterface $entityManager, OrdreFabricationRepository $ordreFabricationRepository, PaginatorInterface $paginator): Response
    {
        $this->denyAccessUnlessGranted('ROLE_CLIENT');

        /** @var \App\Entity\User $user */
        $user = $this->getUser();

        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        $ordres = $paginator->paginate(
            $ordreFabricationRepository->findBy([
                'client' => $user->getClient()
            ]), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );

        return $this->render('client/index.html.twig', [
            'ordres' => $ordres
        ]);
    }

    // /**
    //  * @Route("/new", name="client_new", methods={"GET", "POST"})
    //  */
    // public function new(Request $request, EntityManagerInterface $entityManager): Response
    // {
    //     /** @var \App\Entity\User $user */
    //     $user = $this->getUser();

    //     $client = new Client();
    //     $client->setPrivilegier(false);
    //     $client->setUser($user);

    //     $form = $this->createForm(ClientType::class, $client);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $entityManager->persist($client);
    //         $entityManager->flush();

    //         return $this->redirectToRoute('client_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->renderForm('client/new.html.twig', [
    //         'client' => $client,
    //         'form' => $form,
    //     ]);
    // }

    // /**
    //  * @Route("/{id}", name="client_show", methods={"GET"})
    //  */
    // public function show(Client $client): Response
    // {
    //     return $this->render('client/show.html.twig', [
    //         'client' => $client,
    //     ]);
    // }

    // /**
    //  * @Route("/{id}/edit", name="client_edit", methods={"GET", "POST"})
    //  */
    // public function edit(Request $request, Client $client, EntityManagerInterface $entityManager): Response
    // {
    //     $form = $this->createForm(ClientType::class, $client);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $entityManager->flush();

    //         // return $this->redirectToRoute('client_index', [], Response::HTTP_SEE_OTHER);
    //         $this->addFlash(
    //            'success',
    //            'Profile modifier'
    //         );
    //     }

    //     return $this->renderForm('client/edit.html.twig', [
    //         'client' => $client,
    //         'form' => $form,
    //     ]);
    // }

    // /**
    //  * @Route("/{id}", name="client_delete", methods={"POST"})
    //  */
    // public function delete(Request $request, Client $client, EntityManagerInterface $entityManager): Response
    // {
    //     if ($this->isCsrfTokenValid('delete'.$client->getId(), $request->request->get('_token'))) {
    //         $entityManager->remove($client);
    //         $entityManager->flush();
    //     }

    //     return $this->redirectToRoute('client_index', [], Response::HTTP_SEE_OTHER);
    // }

    // /**
    //  * @Route("/mercure/publish", name="publish")
    //  */
    // public function publishAction(HubInterface $hub): Response
    // {
    //     $update = new Update(
    //         'https://example.com/books/1',
    //         json_encode(['status' => 'OutOfStock']),
    //         false
    //     );

    //     $hub->publish($update);

    //     return new Response('published!');
    // }
}
