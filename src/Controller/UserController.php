<?php

namespace App\Controller;

use App\Controller\CoreController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/users")
 */
class UserController extends CoreController
{
    /**
     * @Route("/", name="users_all", methods={"GET"})
     */
    public function index(): Response
    {
        $user = $this->getUser();

        $userPlants = array_reverse($user->getPlants()->toArray());
        
        return $this->render('dashboard/plant/index.html.twig' , [
            'plants' => $userPlants,
        ]);
    }
}