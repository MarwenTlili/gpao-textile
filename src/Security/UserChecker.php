<?php
namespace App\Security;

use App\Entity\User as AppUser;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAccountStatusException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserChecker implements UserCheckerInterface{
    public function checkPreAuth(UserInterface $user): void{
        if (!$user instanceof AppUser) {
            return;
        }
    }

    public function checkPostAuth(UserInterface $user): void{
        if (!$user instanceof AppUser) {
            return;
        }

        if (!$user->isVerified() && in_array('ROLE_CLIENT', $user->getRoles()) ) {
            throw new CustomUserMessageAccountStatusException('Vérifier votre E-mail avant de connécter!');
        }

        if ($user->getClient()) {
            if (!$user->getClient()->getValider() && in_array('ROLE_CLIENT', $user->getRoles())) {
                // the message passed to this exception is meant to be displayed to the user
                throw new CustomUserMessageAccountStatusException('Votre compte n\'est pas encore valider par le gérant de l\'Issatex!');
            }
        }
    }
}