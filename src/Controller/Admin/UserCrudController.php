<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\RoleType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserCrudController extends AbstractCrudController
{
    /**
     * @var UserPasswordHasherInterface
     */
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher) {
        $this->passwordHasher = $passwordHasher;
    }

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            EmailField::new('email'),
            TextField::new('username'),

            ChoiceField::new('roles')
                ->setChoices(fn () => [
                    // 'Client' => 'ROLE_CLIENT',
                    'Sécretaire' => 'ROLE_SECRETAIRE',
                    'magasinier' => 'ROLE_MAGASINIER',
                    'Gérant' => 'ROLE_GERANT',
                ])
                ->setFormType(RoleType::class)
                ->allowMultipleChoices(false)
                ->renderExpanded(true)
            ,

            Field::new('plainPassword', 'password')->onlyOnForms()
                ->setFormType(RepeatedType::class)
                ->setFormTypeOptions([
                    'type' => PasswordType::class,
                    'first_options' => ['label' => 'password'],
                    'second_options' => ['label' => 'Repeat password'],
                ])
                ->setRequired(true)

            /**
             * form multiple roles
             */
            // ChoiceField::new('roles')
            //     ->setChoices(fn () => [
            //         'Client' => 'ROLE_CLIENT',
            //         'Sécretaire' => 'ROLE_SECRETAIRE',
            //         'magasinier' => 'ROLE_MAGASINIER',
            //         'Gérant' => 'ROLE_GERANT',
            //     ])
            //     ->allowMultipleChoices()

        ];
    }

    // /**
    //  * @required
    //  */
    // public function setEncoder(UserPasswordHasherInterface $passwordHasher): void
    // {
    //     $this->passwordHasher = $passwordHasher;
    // }

    // protected function addEncodePasswordEventListener(FormBuilderInterface $formBuilder)
    // {
    //     $formBuilder->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) {
    //         /** @var User $user */
    //         $user = $event->getData();
    //         dump($user);
    //         if ($user->getPlainPassword()) {
    //             $user->setPassword($this->passwordHasher->hashPassword($user, $user->getPlainPassword()));
    //         }
    //     });
    // }
}
