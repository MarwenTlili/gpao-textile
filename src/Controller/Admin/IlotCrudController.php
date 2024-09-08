<?php

namespace App\Controller\Admin;

use App\Entity\Ilot;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Filter\Type\EntityFilterType;

class IlotCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Ilot::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
            // AssociationField::new('machines')->setFormTypeOptions([
            //     'by_reference' => false,
            // ]),
            // AssociationField::new('planningHebdomadaires'),
        ];
    }
    
}
    