<?php

namespace App\Controller\Admin;

use App\Entity\PlanningHebdomadaire;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class PlanningHebdomadaireCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PlanningHebdomadaire::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            DateField::new('startAt'),
            DateField::new('endAt'),
            AssociationField::new('ilot'),
            AssociationField::new('ordreFabrication')->hideWhenUpdating()
                ->setFormTypeOptions([
                    'by_reference' => false,
                ])
                ->setQueryBuilder(function($queryBuilder){
                    $queryBuilder->andWhere('entity.lancer = 0');
                }),
            TextEditorField::new('observation'),
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
