<?php

namespace App\Controller\Admin;

use App\Entity\Colis;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class ColisCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Colis::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            IntegerField::new(('nbrArticles')),
            AssociationField::new('Palette')
        ];
    }
}
