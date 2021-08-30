<?php

namespace App\Form;

use App\Entity\Picture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PictureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ])
            ->add('file', FileType::class, [
                'required' => true,
                //↓ avoids this error : The form's view data is expected to be a "Symfony\Component\HttpFoundation\File\File", but it is a "string". You can avoid this error by setting the "data_class" option to null or by adding a view transformer that transforms "string" to an instance of "Symfony\Component\HttpFoundation\File\File".
                'mapped' => false, 
                // 'constraints' => [
                //     new File([
                //         'maxSize' => '1024k',
                //         'mimeTypes' => [
                //             'image/jpg',
                //         ],
                //         'mimeTypesMessage' => 'Please upload a valid JPG image.',
                //     ])
                // ],
            ])
            ->add('plants', null, [
                'label' => 'Which plant is it ?',
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'required' => true
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
