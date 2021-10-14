<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('username')

            // REMINDER FORMS : pwd & event listener PRE_SET_DATA 
            ->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event) {
                $user = $event->getData();
                $builder = $event->getForm();
    
                // if the user has an id, he's in the database
                // if he exists, we need to unmap the field so it gets processed in da controller
                if ($user->getId() !== null) {
                    $builder
                        ->add('avatar', FileType::class, [
                            'label' => "Upload your avatar",
                            'required' => true,
                            //↓ avoids this error : The form's view data is expected to be a "Symfony\Component\HttpFoundation\File\File", but it is a "string". You can avoid this error by setting the "data_class" option to null or by adding a view transformer that transforms "string" to an instance of "Symfony\Component\HttpFoundation\File\File".
                            // 'data_class' => null,
                            'mapped' => false
                        ])
            
                        ->add('oldPassword', PasswordType::class, [
                            'empty_data' => '',
                            'mapped' => false,
                            'attr' => ['placeholder' => 'Leave empty if unmodified.'],
                            'label' => 'Current Password',
                        ])
                        ->add('password', RepeatedType::class, [
                            'type' => PasswordType::class,
                            'empty_data' => '',
                            'mapped' => false,
                            'first_options'  => [
                                'label' => 'New Password',
                                'attr' => ['placeholder' => 'Leave empty if unmodified.']
                            ],
                            'second_options' => [
                                'label' => 'Repeat Password',
                                'attr' => ['placeholder' => 'Leave empty if unmodified.']
                            ],
                            //NOTICE USERTYPE "the value is not valid" si les passwords don't match // WHERE DOES IT COME FROM???? (overrides default error messages of repeated AND password type !?)
                            'invalid_message' => "The passwords don't match."
                        ]);
                } else {
                    $builder
                        ->add('password', PasswordType::class, [
                        'empty_data' => '',
                        ]);
                        // ->add('avatar', FileType::class, [
                        //     'label' => "Upload your avatar",
                        //     'required' => true,
                        //     //↓ avoids this error : The form's view data is expected to be a "Symfony\Component\HttpFoundation\File\File", but it is a "string". You can avoid this error by setting the "data_class" option to null or by adding a view transformer that transforms "string" to an instance of "Symfony\Component\HttpFoundation\File\File".
                        //     'data_class' => null,
                        //     //'mapped' => false
                        // ]);
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
