<?php

namespace App\Form;

use App\Entity\PlanningHebdomadaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlanningHebdomadaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('startAt')
            ->add('endAt')
            ->add('Client')
            ->add('Ilot')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PlanningHebdomadaire::class,
        ]);
    }
}
