<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UtilisateurFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomPrenom', TextType::class,[
                'row_attr' => ['class' => 'nomPrenom'],
                'label' => 'Nom et Prénom :',
            ])
            ->add('identifiant', TextType::class,[
                'row_attr' => ['class' => 'identifiant'],
                'label' => 'Identifiant :'
            ])
            ->add('email', EmailType::class,[
                'row_attr' => ['class' => 'email'],
                'label' => 'Email :',
            ])
            ->add('password', RepeatedType::class,[
                'type' => PasswordType::class,
                'row_attr' => ['class' => 'motDePasse'],
                'invalid_message' => 'Le mot de passe ne correspond pas',
                'required' => true,
                'first_options'  => ['label' => 'Mot de Passe :'],
                'second_options' => ['label' => 'Confirmer votre mot de passe'],
                        ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
