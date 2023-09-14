<?php

namespace App\Form;


use app\Entity\Ingredient;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use symfony\component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;


class IngredientType extends AbstractType
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
            ->add('price', MoneyType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],

                'label' => 'Price :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary mt-4',
                ],
                'label' => 'Add ingredient! '
                
            ]);
    }

}
