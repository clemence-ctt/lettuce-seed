<?php

namespace App\Form;

use App\Entity\Picture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PictureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('date')
            ->add('file')
            // TODO PICTURETYPE il faudra changer le iscover de facon à ce qu'une seule soit la couv... (au pire automatiquement la dernière)
            ->add('is_cover')
            
            // LATER PICTURETYPE préselectionner la plante depuis laquelle on arrive OU l'ajout de photo se fait depuis dashboard directement ?
            // TODO PICTURETYPE obliger la selection d'au moins un champs 
            ->add('plants', null, [
                'label' => 'Which plant is it ?',
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true
            ]) 
            
            // TIPS custom fields on entity, see src/Entity/Picture.php ; $tutu property (around line 76)
            // ->add('tutus', ChoiceType::class, [
            //     'label' => 'tututu',
            //     'choices' => [
            //         'titi' => 'titil',
            //         'toto' => 'totol',
            //     ]
            // ])
    
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Picture::class,
            //NOTICE FORM novalidate (pour ne pas avoir les messages du navig)
            'attr' => [
                'novalidate' => 'novalidate'
            ]
        ]);
    }
}
