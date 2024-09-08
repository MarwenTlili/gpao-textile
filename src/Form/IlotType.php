<?php

namespace App\Form;

use App\Entity\Employe;
use App\Entity\Ilot;
use App\Entity\Machine;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IlotType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('machines', CollectionType::class, [
                'entry_type' => MachineType::class,
                'entry_options' => [
                    'attr' => ['class' => 'nom'],
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ilot::class,
        ]);
    }
}
