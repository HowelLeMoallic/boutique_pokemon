<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('avatar', FileType::class, [
                'label' => 'Image (format jpg ou png)',

                // unmapped means that this field is not associated to any entity property

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '2024k',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpeg',
                        ],
                        'mimeTypesMessage' => 'Un format jpg ou png est attendu',
                    ])
                ],
            ])
            ->add('nomPrenom', TextType::class, [
                'label' => 'Nom Prénom',
//                'constraints' => [
//                    new NotBlank([
//                        'message' => 'Entrer votre un nom et prénom valide',
//                    ]),
//                    new Length([
//                        'min' => 2,
//                        'minMessage' => 'Votre nom et prénom ne peuvent contenir pas plus de {{ limit }} caractères',
//                        // max length allowed by Symfony for security reasons
//                        'max' => 255,
//                    ]),
//                ],
//                'required' => true,
            ])
            ->add('identifiant', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrer un identifiant valide',
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Votre identifiant ne peut pas contenir plus de {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 255,
                    ]),
                ],
                'required' => true,
            ])
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrer un mail valide',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'votre adresse mail ne peut contenir plus de {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 255,
                    ]),
                ],
                'required' => true,
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter les termes',
                    ]),
                ],
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Le mot de passe ne correspond pas à sa confirmation.',
                'first_options' => [
                    'label' => 'Mot de passe :',
                    // 'help' => 'Le mot de passe doit contenir au minimum 8 caractères dont une minuscule, une majuscule, un chiffre et un caractère spécial.',
                ],
                'second_options' => [
                    'label' => 'Confirmation du mot de passe :',
                ],
                'mapped' => false,
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner un mot de passe.',
                    ]),
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
