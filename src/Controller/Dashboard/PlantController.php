<?php

namespace App\Controller\Dashboard;

use App\Entity\User;
use App\Entity\Plant;
use App\Form\PlantType;
use App\Repository\PlantRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/me/plant")
 */
class PlantController extends AbstractController
{
    /**
     * @Route("/", name="dashboard_plants", methods={"GET"})
     */
    public function index(): Response
    {
        $user = $this->getUser();
        $userPlants = $user->getPlants();
        // JK dd($userPlants->toArray());

        return $this->render 
        ('dashboard/plant/index.html.twig' , [
            'plants' => $userPlants,
        ]);
    }
}