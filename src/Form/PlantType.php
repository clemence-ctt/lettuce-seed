<?php

namespace App\Form;

use App\Entity\Plant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('date')
        // LATER          ->add('pictures')
        // REMINDER FORMS : add('user') in da controller (sinon c'est une faille de sécurité (le gars peut faire F12 et changer tout seul))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Plant::class,
            'attr' => [
                'novalidate' => 'novalidate'
            ]
        ]);
    }
}
