<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class RegisterType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder
            ->add('firstName', TextType::class, [
                'label' => 'Votre prénom',
                'constraints' => new Length(
                    min: 2,
                    max: 50,
                    minMessage: 'Votre prénom doit avoir au minimum {{ limit }} caractères',
                    maxMessage: 'Votre prénom doit avoir au maximum {{ limit }} caractères',
                ),
                'attr' => [
                    'placeholder' => 'Prénom',
                ],
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Votre nom',
                'constraints' => new Length(
                    min: 2,
                    max: 50,
                    minMessage: 'Votre nom doit avoir au minimum {{ limit }} caractères',
                    maxMessage: 'Votre nom doit avoir au maximum {{ limit }} caractères',
                ),
                'attr' => [
                    'placeholder' => 'Nom',
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Votre email',
                'attr' => [
                    'placeholder' => 'Email',
                ],
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'constraints' => new Length(
                    min: 8,
                    minMessage: 'Votre mot de passe doit avoir au minimum {{ limit }} caractères',
                ),
                'invalid_message' => 'Le mot de passe et la confirmation doivent être identiques !',
                'required' => true,
                'first_options' => ['label' => 'Votre mot de passe',
                    'attr' => ['placeholder' => "Mot de passe"]
                    ],
                'second_options' => [
                    'label' => 'Confirmation du mot de passe',
                    'attr' => ['placeholder' => "Confirmation du mot de passe"]
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'S\'inscrire',
                'attr' => [
                    'placeholder' => 'Prénom',
                ],
            ]);

    }

    public function configureOptions(OptionsResolver $resolver): void {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
