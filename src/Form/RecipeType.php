<?php

namespace App\Form;

use App\Entity\Ingredient;
use App\Entity\Recipe;
use App\Repository\IngredientRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Doctrine\ORM\QueryBuilder;

class RecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '2',
                    'maxlength' => '50'
                ],

                'label' => 'Name :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
            ])

            ->add('time', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'min' => 1,
                    'max' => 1140,
                ],
                'label' => 'Time (minutes)',
                'label_attr' => [
                    'class' => 'form label mt-4'
                ]
    
            ])
            ->add('nbPoeple', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'min' => 1,
                    'max' => 50,
                ],
                'label' => 'Poeple number :',
                'label_attr' => [
                    'class' => 'form label mt-4'
                ]
            ])

            ->add('difficulty', RangeType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'min' => 1,
                    'max' => 5,
                ],
                'label' => 'Difficulty :',
                'label_attr' => [
                    'class' => 'form label mt-4'
                ]
            ])

            ->add('description', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'min' => 1,
                    'max' => 5,
                ],
                'label' => 'Description :',
                'label_attr' => [
                    'class' => 'form label mt-4'
                ]
            ])

            ->add('price', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],

                'label' => 'Price :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
            ])

            ->add('isFavorite', CheckboxType ::class, [
                'attr' => [
                    'class'=>'form-control',
                ],
                'required' => false,
                'label' => 'Favorite? :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
            ])

            ->add('ingredients', EntityType::class, [
                'class' => Ingredient::class, // Set the 'class' option here
                'query_builder' => function(IngredientRepository $r): QueryBuilder {
                    return $r->createQueryBuilder('i')
                        ->orderBy('i.name', 'ASC');   
                },

                'label'=> 'My ingredients :',
                'label_attr'=>[
                    'class'=>'form-label mt-4'
                ],

                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,              
            ])
            ->add('submit', SubmitType ::class, [
                'attr' => [
                    'class'=>'btn btn-primary mt-4',
                ],
                'label' => 'ok!',
                
            ]);
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}
