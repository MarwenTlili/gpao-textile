<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
use SymfonyCasts\Bundle\VerifyEmail\VerifyEmailHelperInterface;

class RegistrationController extends AbstractController
{
    private $verifyEmailHelper;
    private $mailer;

    public function __construct(VerifyEmailHelperInterface $helper, MailerInterface $mailer)
    {
        $this->verifyEmailHelper = $helper;
        $this->mailer = $mailer;
    }

    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setRoles(["ROLE_CLIENT"]);
            // encode the plain password
            $user->setPassword(
            $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $entityManager->persist($user);
            $entityManager->flush();

            $signatureComponents = $this->verifyEmailHelper->generateSignature(
                'app_verify_email',
                $user->getId(),
                $user->getEmail(),
                ['id' => $user->getId()] // add the user's id as an extra query param
            );
            $email = new TemplatedEmail();
            $email->from('issatex@isetso.com');
            $email->to($user->getEmail());
            $email->htmlTemplate('registration/confirmation_email.html.twig');
            $email->context(['signedUrl' => $signatureComponents->getSignedUrl()]);
            
            $this->mailer->send($email);

            // do anything else you need here, like send an email
            $this->addFlash('warning', 'Un lien de vérification à êté envoyer vers votre E-mail');
            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/verify/email", name="app_verify_email")
     */
    public function verifyUserEmail(Request $request, UserRepository $userRepository, EntityManagerInterface $entityManagerInterface): Response
    {
        $id = $request->get('id'); // retrieve the user id from the url

       // Verify the user id exists and is not null
       if (null === $id) {
           return $this->redirectToRoute('app_home');
       }

       $user = $userRepository->find($id);

       // Ensure the user exists in persistence
       if (null === $user) {
           return $this->redirectToRoute('app_home');
       }

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            $this->verifyEmailHelper->validateEmailConfirmation($request->getUri(), $user->getId(), $user->getEmail());
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $exception->getReason());

            return $this->redirectToRoute('app_register');
        }

        if (!$user->isVerified()) {
            $client = new Client();
            $client->setNom($user->getUsername());
            $client->setValider(false);
            $client->setPrivilegier(false);
            $client->setUser($user);
            $user->setIsVerified(true);

            $entityManagerInterface->persist($user);
            $entityManagerInterface->persist($client);
            $entityManagerInterface->flush();
            $this->addFlash('success', 'Votre E-mail à ête vérifier.');
        }else {
            $this->addFlash('warning', 'Votre E-mail ête déjà vérifier!');
        }

        // @TODO Change the redirect on success and handle or remove the flash message in your templates
        return $this->redirectToRoute('app_login');
    }
}
