<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class RegisterUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('email', EmailType::class,[
                'label' => 'Votre adresse email',
                'attr' => [
                    'placeholder' => 'Entrez votre adresse email'
                ]
            ])

        ->add('plainPassword', RepeatedType::class, [
            'type' => PasswordType::class,

            //Définition de contraintes sur le nombre caractères minimun et maximum que doit prendre le champ renseigné
            'constraints' => [
                new Length([
                    'min' => 4,
                    'max' => 20,
                ])
            ],   //fin
            'first_options'  => [
                'label' => 'Votre mot de passe',
                'attr' => [
                    'placeholder' => 'Entrez votre mot de passe'
                ],
                'hash_property_path' => 'password'],

            'second_options' => [
                'label' => 'Confirmez votre mot de passe',
                'attr' => [
                    'placeholder' => 'Confirmez votre mot de passe'
                ]
                ],
            'mapped' => false,  //Pour éviter à symfony de faire le lien entre l'entité et le champ qu'on lui donne
        ])


            ->add('firstname', TextType::class, [
                'label' => 'Votre prénom',

                //Définition de contraintes sur le nombre caractères minimun et maximum que doit prendre le champ renseigné
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'max' => 30,
                    ])
                ],  //fin
                'attr' => [
                    'placeholder' => 'Entrez votre mot de prénom'
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Votre nom',

                //Définition de contraintes sur le nombre caractères minimun et maximum que doit prendre le champ renseigné
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'max' => 30,
                    ])
                ],  //fin
                'attr' => [
                    'placeholder' => 'Entrez votre nom'
                ]
            ])

            ->add('submit', SubmitType::class, [
                'label' => 'Valider',
                'attr' => [
                    'class' => 'btn btn-success'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            //Definition de contrainte UniqueEntity, pour éviter qu'une
            //s'inscrive 2 ou plusieurs fois avec la même adresse mail
         'constraints' => [
             new UniqueEntity([
                 'entityClass' => User::class,
                 'fields' => 'email',
             ])
         ], //fin

            'data_class' => User::class,
        ]);
    }
}
