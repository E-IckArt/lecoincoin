<?php

namespace App\Form;

use App\Entity\User;
use SebastianBergmann\CodeCoverage\Report\Text;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'E-mail *',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Votre email',
                    'required' => true,
                ],
                'row_attr' => [
                    'class' => 'form-floating mb-3'
                ]
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'label' => 'Mot de passe *',
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password', 'placeholder' => 'Votre mot de passe', 'class' => 'form-control',
                    'required' => true,],
                'row_attr' => [
                    'class' => 'form-floating mb-3'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci d\'entrer un mot de passe',
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Votre mot de passe doit contenir au minimum {{ limit }} caractères.',
                        // max length allowed by Symfony for security reasons
                        'max' => 16,
                        'maxMessage' => 'Votre mot de passe doit contenir au maximum {{ limit }} caractères.',
                    ]),
                ],
            ])
            ->add('avatar', FileType::class, [
                'label' => 'Avatar',
                'mapped' => false,
                'required' => false,
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom *',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Votre prénom',
                    'required' => true,
                ],
                'row_attr' => [
                    'class' => 'form-floating mb-3'
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom *',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Votre nom',
                    'required' => true,
                ],
                'row_attr' => [
                    'class' => 'form-floating mb-3'
                ]
            ])
            ->add('address', TextType::class, [
                'label' => 'Adresse *',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Votre adresse',
                    'required' => true,
                ],
                'row_attr' => [
                    'class' => 'form-floating mb-3'
                ]
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville *',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Votre ville',
                    'required' => true,
                ],
                'row_attr' => [
                    'class' => 'form-floating mb-3'
                ]
            ])
            ->add('zipcode', TextType::class, [
                'label' => 'Code Postal *',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Votre code postal',
                    'required' => true,
                ],
                'row_attr' => [
                    'class' => 'form-floating mb-3'
                ]
            ])
            ->add('RGPDConsent', CheckboxType::class, [
                'label' => 'J\'accepte que mes données personnelles soient utilisées pour la gestion de mon compte et pour la gestion de mes commandes.',
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
