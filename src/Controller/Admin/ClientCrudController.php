<?php

namespace App\Controller\Admin;

use App\Entity\Client;
use App\Repository\SocialLinkRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ClientCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Client::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            // IntegerField::new('id'),
            TextField::new('nom'),
            TextField::new('phoneNumber')->setLabel('N° Tel'),
            EmailField::new('user.email')->setLabel('E-mail')->hideOnForm(),
            AssociationField::new('user'),
            BooleanField::new('privilegier'),
            BooleanField::new('valider'),


            // FormField::addPanel('SocialLink')->hideOnIndex(),
            // AssociationField::new('SocialLink')
            //     ->hideOnIndex(),

        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions->remove(Crud::PAGE_INDEX, Action::NEW);
    }
    
}
