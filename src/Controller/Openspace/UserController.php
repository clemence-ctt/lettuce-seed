<?php

namespace App\Controller\Openspace;

use App\Controller\CoreController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/users")
 */
class UserController extends CoreController
{
    /**
     * @Route("/dafuqisthisroute", name="users_all", methods={"GET"})
     */
    // public function index(): Response
    // {
    //     $user = $this->getUser();

    //     $userPlants = array_reverse($user->getPlants()->toArray());
        
    //     return $this->render('dashboard/plant/index.html.twig' , [
    //         'plants' => $userPlants,
    //     ]);
    // }

     /**
     * @Route("/", name="members_index", methods={"GET"})
     */
    public function index()
    {
        $usersList = $this->getUserRepository()->findAll();
        dd($usersList);
    }
    
    /**
     * @Route("/{userId}", name="user_show", methods={"GET"})
     */
    public function show(int $userId)
    {
        $user = $this->getUserById($userId);
        dd($user);
    }

    //https://localhost/lettuce-seed/public/member/14/plants
    /**
     * @Route("/{userId}/plants", name="user_plants", methods={"GET"})
     */
    public function showUserPlants(int $userId)
    {
        $user = $this->getUserById($userId);
        $plants = $user->getPlants();
        dump($user);
        foreach ($plants as $plant) {
            dump($plant);
        }
        exit;
    }

    //https://localhost/lettuce-seed/public/member/14/plant/482/photos
    /**
     * @Route("/{userId}/plant/{plantId}/photos", name="user_plant_pictures", methods={"GET"})
     */
    public function showUserPlantPictures(int $userId, int $plantId)
    {      
        $user = $this->getUserById($userId);
        $plants = $user->getPlants();
        dump($plants);
        
        foreach ($plants as $plant) {
        
            if ($plant->getId() === $plantId){
                $pictures = $plant->getPictures();
                dump($pictures);
        
                foreach($pictures as $picture) {
                    dump($picture);
                }
        
                exit;
            }
        }
    }

}