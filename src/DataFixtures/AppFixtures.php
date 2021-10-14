<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use ReflectionClass;
use App\Entity\Plant;
use App\Entity\Picture;
use Nelmio\Alice\Loader\NativeLoader;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

//DOC FIXTURES https://symfony.com/bundles/DoctrineFixturesBundle/current/index.html
class AppFixtures extends Fixture
{
    // Une propriété pour accueillir notre encodeur
    private $encoder;

    public function __construct(UserPasswordHasherInterface $encoder)
    {

        // var_dump($encoder);

        /*
        $reflector = new ReflectionClass($encoder);
        print_r(
            $reflector->getMethods()
        );
        */

        $this->encoder = $encoder;
    }
    
    public function load(ObjectManager $em)
    {

        // test ajout d'un User
        $user = new User();
        $user->setEmail('admin@admin.com');
        $user->setPassword($this->encoder->hashPassword($user, 'admin'));
        // admin : $2y$13$93tWCzD0lD4MWn0Vu.zU4OOElsskLh3NzvP1bPT9QgNgaG4q90st2
        $user->setRoles(['ROLE_ADMIN']);
        $user->setUsername('caca');
        $em->persist($user);

        $vegetables = [
            'Ail',
            'Artichaut',
            'Asperge',
            'Aubergine',
            'Avocat',
            'Bette',
            'Betterave',
            'Blette',
            'Brocoli',
            'Carotte',
            'Catalonia',
            'Céleri',
            'Champignon',
            'Chou-fleur',
            'Choux',
            'Citrouille',
            'Concombre',
            'Courge',
            'Courgette',
            'Cresson',
            'Crosne',
            'Dachine',
            'Daikon',
            'Échalote',
            'Endive',
            'Épinard',
            'Fenouil',
            'Fève',
            'Flageolet',
            'Giromon',
            'Haricot',
            'Igname',
            'Konbu',
            'Laitue',
            'Lentille',
            'Mâche',
            'Maïs',
            'Manioc',
            'Navet',
            'Oignon',
            'Olive',
            'Oseille',
            'Panais',
            'Patate',
            'Pâtisson',
            'Petits pois',
            'Poireau',
            'Poivron',
            'Pomme de terre',
            'Potimarron',
            'Potiron',
            'Radis',
            'Rhubarbe',
            'Roquette',
            'Rutabaga',
            'Salade',
            'Salsifi',
            'Tétragone',
            'Tomate',
            'Topinambour',
            'Vitelotte',
            'Wakame',
            'Wasabi',
        ];


        foreach($vegetables as $vegetable) {
            $plant = $this->createPlant($vegetable, $user, $em);

            print_r($plant->getId());
            echo "\n";

            $this->createImage($plant, $em);
        }

        $em->flush();
       
        return;
    }


    protected function createImage($plant, $em)
    {
        $faker = Factory::create();
        $now = \DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
        $picture = new Picture();
        $picture->setName($faker->name);
        $picture->setDescription($faker->text);
        $picture->setFile($picture->getName());
        // $picture->setIsCover(1);
        $picture->setLikeCounter(random_int(0,500));
        $picture->setDate($faker->dateTime($max = 'now', $timezone = null));
        $picture->setCreatedAt($now);

        $picture->addPlant($plant);

        // On persist
        $em->persist($picture);
        // $em->flush();
    }

    protected function createPlant($plantName, $user, $em)
    {
        $now = \DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
        $plant = new Plant();
        $plant->setName($plantName);
        $plant->setUser($user);
        $plant->setCreatedAt($now);
        $em->persist($plant);
        // $em->flush();
        return $plant;
    }

// fixtures populator ↓
// https://github.com/O-clock-Fantasy/Symfo-Eval-FAQ-O-Clock-complet/blob/master/src/DataFixtures/AppFixtures.php
// $populator = new Faker\ORM\Doctrine\Populator($generator, $manager);
// $populator->execute()
};  