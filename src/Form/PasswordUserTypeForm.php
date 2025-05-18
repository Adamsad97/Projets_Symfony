<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormError;


 

class PasswordUserTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        
        $builder
     
            ->add('actualpassword', PasswordType::class, [
                'label' => 'Mot de passe actuel',
                'mapped' => false,
            ])
            ->add('plainPassword', RepeatedType::class,  [
                'type' => PasswordType::class,
                'constraints' => [
                    new Length([
                        'min' => 4,
                        'max' => 30,
                    ]),
                ],
                'first_options'  =>
                    [
                        'label' => 'Votre nouveau mot de passe',
                        //'attr' =>
                          //  [
                           //     'placeholder' => 'Veuillez entrez votre mot de passe',
                           // ],
                        'hash_property_path' => 'password'
                     ],

                'second_options' =>
                    [
                        'label' => 'Confirmez votre noveau mot de passe',
                       // 'attr' =>
                           // [
                              //  'placeholder' => 'Veuillez confirmer votre mot de passe',
                            //],
                    ],
                'mapped' => false,
                ])

                
            ->add('Enregistrer', SubmitType::class,  [
                'label' => 'Mettre à jour',
                'attr' => [
                    'class' => 'btn btn-success',
                ]
            ] )
            ->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) {
                $form = $event->getForm();
                $user = $form->getConfig()->getOption('data');
                $passwordHasher = $form->getConfig()->getOptions()['passwordHasher'];
                //Iic, je récupère le mot de passe actuel saisi par l'utilisateur
                //et je le compare avec le mot de passe de l'utilisateur
                $isValid = $passwordHasher->isPasswordValid(
                    $user,
                    $form->get('actualpassword')->getData(),
                );

                //Si le mot de passe actuel saisi par l'utilisateur est est différent de celui de la base de données
                //J'affiche un message d'erreur
                if (!$isValid) {
                    $form->get('actualpassword')->addError(new FormError('Mot de passe actuel incorrect'));
                }

            });

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'passwordHasher' => null,
        ]);



    }
}
