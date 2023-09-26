<?php

namespace App\Form;


use App\Entity\User;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fullName', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlenght' => '50', 
                ],
                'label' =>'Name / First Name',
                'label attr' => [
                'class' => 'form-label',
                ]
            ])
            ->add('nickName', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlenght' => '50', 
                ],
                'label' =>'Nickname (not required)',
                'label attr' => [
                'class' => 'form-label',
                ]
            ])

            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control', 
                    'minlenght' => '2',
                    'maxlenght' => '180',  
                ],
                'label' =>'Email Adress',
                'label attr' => [
                'class' => 'form-label',
                ]
            ])

            ->add('password', RepeatedType::class,[
                'type' => PasswordType::class,
                'first_option' => [
                    'label' => 'password',
                ],
                'second_option' => [
                    'label'=> 'confirmation password'
                ],
                'invalid_message' => 'The passwords does not match.'
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary',
                ]
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
