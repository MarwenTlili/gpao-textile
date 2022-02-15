<?php

namespace App\Form;

use App\Entity\DateProduction;
use App\Entity\ProductionJournalier;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductionJournalierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('quantitePremiereChoix')
            ->add('quantiteDeuxiemeChoix')
            ->add('dateProduction', DateProductionType::class, [
                'label' => false
            ])

            // ->add('dateProduction', EntityType::class, [
            //     'class' => DateProduction::class,
            //     'choice_label' => 'dateDuJour',
            //     'multiple' => false,
            // ])
            
            // ->add('ilot', null, [
            //     'disabled' => true
            // ])
            // ->add('ordreFabrication', OrdreFabricationType::class, [
            //     'mapped' => false
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProductionJournalier::class,
        ]);
    }
}
