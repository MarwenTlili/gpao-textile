<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\OrdreFabrication;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class OrdreFabricationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('article', EntityType::class, [
                'class' => Article::class,
                'choice_label' => 'modele',
                'row_attr' => ['id' => 'article_select']
            ])
            ->add('documentTechnique', FileType::class, [
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid PDF document max size 1024K!',
                    ])
                ],
            ])
            ->add('tempsUnitaire', IntegerType::class, [
                'required' => false
            ])
            ->add('prixUnitaire', MoneyType::class, [
                'divisor' => 1,
                'currency' => 'TND',
                'required' => false
            ])
            ->add('montant', MoneyType::class, [
                'divisor' => 1,
                'currency' => 'TND',
                'disabled' => true
            ])
            ->add('observation')
            
            ->add('nouveauArticle', CheckboxType::class,[
                'mapped' => false,
                'required' => false,
            ])

            ->add('articleNew', ArticleType::class, [
                'mapped' => false,
                'required' => false,
                'label' => false,
                'row_attr' => ['id' => 'article_new', "style" => "display: none;"]
            ])
            ->add('ordreFabricationTailles', CollectionType::class, [
                'entry_type' => OrdreFabricationTailleType::class,
                'allow_add' => true,
                
            ])
            ->add('urgent')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => OrdreFabrication::class,
        ]);
    }
}
