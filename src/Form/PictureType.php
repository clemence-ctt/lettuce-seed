<?php

namespace App\Form;

use App\Entity\Picture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PictureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('date')
            ->add('file', FileType::class, [
                //JK forcer le remplissage du champs et faire un message d'erreur ou un flash quand ca marche pas  a tester avant suppression
                'required' => false,
                //↓ avoids this error : The form's view data is expected to be a "Symfony\Component\HttpFoundation\File\File", but it is a "string". You can avoid this error by setting the "data_class" option to null or by adding a view transformer that transforms "string" to an instance of "Symfony\Component\HttpFoundation\File\File".
                'mapped' => false,
            ])
            //JK possible de rajouter multiple(bool) pour ajout multiple
            //DOC https://symfony.com/doc/current/reference/forms/types/file.html
            //DOC https://symfony.com/doc/current/controller/upload_file.html
                // 'constraints' => [
                //     new File([
                //         'maxSize' => '1024k',
                //         'mimeTypes' => [
                //             'application/pdf',
                //             'application/x-pdf',
                //         ],
                //         'mimeTypesMessage' => 'Please upload a valid PDF document',
                //     ])
                // ],


            //♥ PICTURETYPE il faudra changer le iscover de facon à ce qu'une seule soit la couv... (au pire automatiquement la dernière)
            ->add('is_cover')
            
            // LATER PICTURETYPE préselectionner la plante depuis laquelle on arrive OU l'ajout de photo se fait depuis dashboard directement ?
            // TODO PICTURETYPE obliger la selection d'au moins un champs 
            ->add('plants', null, [
                'label' => 'Which plant is it ?',
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
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
            //REMINDER FORMS : novalidate (pour ne pas avoir les messages du navig)
            'attr' => [
                'novalidate' => 'novalidate'
            ]
        ]);
    }
}
