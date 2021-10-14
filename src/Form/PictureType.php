<?php

namespace App\Form;

use App\Entity\Plant;
use App\Entity\Picture;
use App\Repository\PlantRepository;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class PictureType extends AbstractType
{
    private $entityManager;
    private $tokenStorage;

    public function __construct(EntityManagerInterface $entityManager, TokenStorageInterface $tokenStorage)
    {
        $this->entityManager = $entityManager;
        $this->tokenStorage = $tokenStorage;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ])         
            ->add('plants', EntityType::class, [
                'class' => Plant::class,
                'query_builder' => function (PlantRepository $pr) {
                    // TIPS FORM get user
                    $user = $this->tokenStorage->getToken()->getUser();

                    return $pr->createQueryBuilder('plant')
                    ->setParameter('userId', $user->getId())
                    ->where('plant.user = :userId')
                    ->orderBy('plant.name', 'ASC');

                    /* TIPS research
                    return $pr->createQueryBuilder('plant')
                    ->setParameter('name', 'a%')
                    ->where('plant.name LIKE :name')
                    ->orderBy('plant.name', 'ASC');
                    */
                },
                'label' => 'Which plant is it ?',
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'required' => true,
            ]) 
            ->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event) {
                // dd($event->getData());
                // dd($event->getData()->getPlants());
                // $user = $this->getUser();
                // $userPlants = $user->getPlants();
            })
            ->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event) {
                // On récupère l'entité 
                $picture = $event->getData();
                // On récupère le builder pour continuer le form
                $builder = $event->getForm();         
            
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
            //REMINDER FORMS : novalidate (pour ne pas avoir les messages du navig)
            'attr' => [
                'novalidate' => 'novalidate'
            ]
        ]);
    }
}
