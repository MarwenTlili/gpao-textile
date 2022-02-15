<?php

namespace App\Form;

use App\Entity\EmployePresence;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmployePresenceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('heureDebut', TimeType::class, [
                // 'input'  => 'datetime',
                // 'widget' => 'choice',

                'widget' => 'single_text',
                'input' => 'datetime_immutable',
            ])
            ->add('heureFin', TimeType::class, [
                'widget' => 'single_text',
                'input' => 'datetime_immutable',
            ])
            ->add('employe')
            ->add('presence', PresenceType::class, [
                'label' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EmployePresence::class,
        ]);
    }
}
