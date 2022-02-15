<?php

namespace App\Controller\Admin;

use App\Entity\ProductionJournalier;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class ProductionJournalierCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProductionJournalier::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            DateField::new('dateDuJour'),
            AssociationField::new('ilot'),
            AssociationField::new('tailleProd'),
        ];
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
