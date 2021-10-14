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
        $this->encoder = $encoder;
    }
    
    public function load(ObjectManager $em)
    {

        // adding User
        $user = new User();
        $user->setEmail('admin@admin.com');
        $user->setPassword($this->encoder->hashPassword($user, 'admin'));
        // hash pwd admin: $2y$13$93tWCzD0lD4MWn0Vu.zU4OOElsskLh3NzvP1bPT9QgNgaG4q90st2
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

        // adding plants and images
        foreach($vegetables as $vegetable) {
            // creating and returning plant
            $plant = $this->createPlant($vegetable, $user, $em);
            // creating 1 image for each plant created
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

        $em->persist($picture);
        // no $em->flush(); cause it's in the prev method
    }

    protected function createPlant($plantName, $user, $em)
    {
        $now = \DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
        $plant = new Plant();
        $plant->setName($plantName);
        $plant->setUser($user);
        $plant->setCreatedAt($now);
        $em->persist($plant);
        // no $em->flush(); cause it's in the prev method
        return $plant;
    }
};  