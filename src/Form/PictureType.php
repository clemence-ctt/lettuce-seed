<?php

namespace App\Form;

use App\Entity\Picture;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
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
            ->add('plants', null, [
                'label' => 'Which plant is it ?',
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'required' => true,
            ]) 

            // launching this part when datas are set in the form
            ->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event) {
                // getting User entity
                $picture = $event->getData();
                // getting builder to carry on the form building :clap:
                $builder = $event->getForm();         
            
                // BUG (IT WORKS THOUGH) in FORM : WHY the 'mapped' field in one case and 'data_class' on the other ? 
                if ($picture->getId() !== null) {
                    $builder
                        ->add('file', FileType::class, [
                            'label' => "Select a file",
                            'required' => true,
                            //↓ avoids this error : The form's view data is expected to be a "Symfony\Component\HttpFoundation\File\File", but it is a "string". You can avoid this error by setting the "data_class" option to null or by adding a view transformer that transforms "string" to an instance of "Symfony\Component\HttpFoundation\File\File".
                            // 'data_class' => null,
                            'mapped' => false
                        ]); 
                } else {
                    $builder
                        ->add('file', FileType::class, [
                            'label' => "Select a file",
                            'required' => true,
                            //↓ avoids this error : The form's view data is expected to be a "Symfony\Component\HttpFoundation\File\File", but it is a "string". You can avoid this error by setting the "data_class" option to null or by adding a view transformer that transforms "string" to an instance of "Symfony\Component\HttpFoundation\File\File".
                            'data_class' => null,
                            //'mapped' => false
                        ]); 
                }
            });
            // TIPS custom fields on entity, see src/Entity/Picture.php ; $tutu property (around line 76)
            // ->add('tutus', ChoiceType::class, [
            //     'label' => 'tututu',
            //     'choices' => [
            //         'titi' => 'titil',
            //         'toto' => 'totol',
            //     ]
            // ])
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Picture::class,
            //REMINDER FORMS : novalidate 
            'attr' => [
                'novalidate' => 'novalidate'
            ]
        ]);
    }
}
