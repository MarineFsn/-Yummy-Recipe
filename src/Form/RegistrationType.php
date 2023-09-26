<?php

namespace App\Form;


use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
                'label' =>'Name / First Name:',
                'label_attr' => [
                'class' => 'form-label mt-4',
                ]
            ])
            ->add('nickName', TextType::class, [
                'attr' => [
                    'class' => 'form-control mt-4',
                    'minlenght' => '2',
                    'maxlenght' => '50', 
                ],
                'label' =>'Nickname: (not required)',
                'label_attr' => [
                'class' => 'form-label mt-4',
                ]
            ])

            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control', 
                    'minlenght' => '2',
                    'maxlenght' => '180',  
                ],
                'label' =>'Email Adress:',
                'label_attr' => [
                'class' => 'form-label mt-4',
                ]
            ])

            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'attr' => [
                        'class' => 'form-control'
                    ],
                    'label' => 'password:',
                    'label_attr' => [
                        'class' => 'form-label  mt-4'
                    ]
                ],
                'second_options' => [
                    'attr' => [
                        'class' => 'form-control'
                    ],
                    'label' => 'comfirm your password:',
                    'label_attr' => [
                        'class' => 'form-label  mt-4'
                    ]
                ],
                'invalid_message' => 'Your passwords does not match!'
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary mt-4'
                ]
            ]);
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
