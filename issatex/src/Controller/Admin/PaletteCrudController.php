<?php

namespace App\Controller\Admin;

use App\Entity\Palette;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class PaletteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Palette::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('client'),
            AssociationField::new('ordreFabrication')
            // TextEditorField::new('description'),
        ];
    }
}
