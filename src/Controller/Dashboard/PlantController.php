<?php

namespace App\Controller\Dashboard;

use App\Entity\User;
use App\Entity\Plant;
use App\Form\PlantType;
use App\Repository\PlantRepository;
use App\Repository\PictureRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
//LATER PLANTCONTROLLER 2- changer l'id de la plante par son nom 
// TODO PLANTCONTROLLER flash

/**
 * @Route("/me/plants")
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
        //REMINDER toArray dd($userPlants->toArray());

        return $this->render 
        ('dashboard/plant/index.html.twig' , [
            'plants' => $userPlants,
        ]);
    }

    /**
     * @Route("/new", name="dashboard_plant_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $plant = new Plant();
        $form = $this->createForm(PlantType::class, $plant);
        $form->handleRequest($request);

        // sends back to login page if an anonymous user tries to create a plant
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        // get the connected user Entity
        $user = $this->getUser();

        if ($form->isSubmitted() && $form->isValid()) {
            // setting createdAt to current datetime and the user to current user
            $plant->setCreatedAt();
            $plant->setUser($user);
            // load and flush
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($plant);
            $entityManager->flush();
            // redirects to the created plant
            $id = $plant->getId();
            return $this->redirectToRoute('dashboard_plants_show', ['id' => $id] , Response::HTTP_SEE_OTHER);
        }
    
        return $this->renderForm('dashboard/plant/new.html.twig', [
            'plant' => $plant,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/set-cover/{plantId}/{pictureId}", name="dashboard_plant_setcover", methods={"GET"})
     */
    public function setCover(int $plantId, int $pictureId, PlantRepository $plantRepository, PictureRepository $pictureRepository)
    {

        $plant = $plantRepository->find($plantId);
        $picture = $pictureRepository->find($pictureId);

        $plant->setCover($picture);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($plant);
        $this->getDoctrine()->getManager()->flush();

        
        
        return $this->json([
            'message' => 'success'
        ]);
        // $plants = $plantRepository->findAll();
        // return $this->json($plants, 200, [], ['groups' => 'plant_cover']);
    }

    /**
     * @Route("/{id}", name="dashboard_plant_show", methods={"GET"})
     */
    public function show(Plant $plant): Response
    { 
        return $this->render('dashboard/plant/show.html.twig', [
            'plant' => $plant,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="dashboard_plant_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Plant $plant): Response
    {
        $form = $this->createForm(PlantType::class, $plant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $plant->setUpdatedAt();
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('plant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dashboard/plant/edit.html.twig', [
            'plant' => $plant,
            'form' => $form,
        ]);
    }

    
    /**
     * @Route("/{id}", name="dashboard_plant_delete", methods={"POST"})
     */
    public function delete(Request $request, Plant $plant): Response
    {
        if ($this->isCsrfTokenValid('delete'.$plant->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($plant);
            $entityManager->flush();
        }

        return $this->redirectToRoute('dashboard_plants', [], Response::HTTP_SEE_OTHER);
    }
    

}