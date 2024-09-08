<?php

namespace App\Controller\Admin;

use App\Entity\OrdreFabricationTaille;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class OrdreFabricationTailleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return OrdreFabricationTaille::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            IntegerField::new('quantite'),
            AssociationField::new('ordreFabrication'),
            AssociationField::new('taille')
        ];
    }
}
