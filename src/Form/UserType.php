<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('username')

            // REMINDER PRE_SET_DATA LISTENER pour le mdp
            ->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event) {
                // On récupère l'entité User
                $user = $event->getData();
                // On récupère le builder pour continuer le form
                $builder = $event->getForm();
    
                // Si notre user a un id, il existe en base
                // S'il est existant en database, on applique le mapped=false.
                if ($user->getId() !== null) {
                    $builder
                        ->add('oldPassword', PasswordType::class, [
                            'empty_data' => '',
                            'mapped' => false,
                            'attr' => ['placeholder' => 'Leave empty if unmodified.'],
                        ])
                        ->add('password', RepeatedType::class, [
                            'type' => PasswordType::class,
                            'empty_data' => '',
                            'mapped' => false,
                            'first_options'  => [
                                'label' => 'Password',
                                'attr' => ['placeholder' => 'Leave empty if unmodified.']
                            ],
                            'second_options' => [
                                'label' => 'Repeat Password',
                                'attr' => ['placeholder' => 'Leave empty if unmodified.']
                            ],
                            //NOTICE USERTYPE "the value is not valid" si les passwords don't match // corrigé mais ca vient d'ou ?! (vu que ça override les messages d'erreur par def du repeated ET du password type !?)
                            'invalid_message' => "The passwords don't match."
                        ]);
                } else {
                    $builder->add('password', PasswordType::class, [
                        'empty_data' => '',
                    ]);
                }
            });
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'attr' => [
                'novalidate' => 'novalidate'
            ]
        ]);
    }
}
