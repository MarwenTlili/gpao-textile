<?php

namespace App\Controller\Admin;

use App\Entity\OrdreFabrication;
use DateTime;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Lcobucci\JWT\Signer\None;
use Symfony\Component\Routing\RouteCollection;

class OrdreFabricationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return OrdreFabrication::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            // DateTimeField::new('createdAt')->setValue(new \DateTime('now')),
            AssociationField::new('client'),
            AssociationField::new('article'),
            IntegerField::new('qteTotal'),
            TextField::new('documentTechnique')->hideOnIndex(),
            IntegerField::new('tempsUnitaire'),
            MoneyField::new('prixUnitaire')
                ->hideOnIndex()->setCurrency('TND')
                ->setNumDecimals(3)->setStoredAsCents(false),
            MoneyField::new('montant')
                ->setCurrency('TND')->setNumDecimals(3)->setStoredAsCents(false),
            BooleanField::new('urgent'),
            // BooleanField::new('lancer')->setDisabled(),
            BooleanField::new('lancer')->setFormTypeOption('enabled','disabled'),
            BooleanField::new('refuser'),
            // AssociationField::new('Ilot'),
            TextField::new('observation')->hideOnIndex(),
        ];
    }

    public function createEntity(string $entityFqcn)
    {
        $of = new OrdreFabrication();
        $of->setCreatedAt(new \DateTime('now'));

        return $of;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions->remove(Crud::PAGE_INDEX, Action::NEW);
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
