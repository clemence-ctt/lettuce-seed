<?php

namespace App\Controller\Dashboard;

use DateTime;
use App\Entity\Plant;
use App\Form\PlantType;
use App\Controller\CoreController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
//LATER PLANTCONTROLLER 2- changer l'id de la plante par son nom 

/**
 * @Route("/me/plants")
 */
class PlantController extends CoreController
{
    /**
     * @Route("/", name="dashboard_plants", methods={"GET"})
     */
    public function index(): Response
    {
        $user = $this->getUser();
        $userPlants = $user->getPlants();
        //REMINDER toArray dd($userPlants->toArray());

        $userPlants = array_reverse($userPlants->toArray());
        
        return $this->render('dashboard/plant/index.html.twig' , [
            'plants' => $userPlants,
        ]);
    }

    /**
     * @Route("/new", name="dashboard_plant_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $plant = new Plant();
        $plant->setDate(DateTime::createFromFormat('Y-m-d', date('Y-m-d')));
        
        $form = $this->createForm(PlantType::class, $plant);
        $form->handleRequest($request);

        // TIPS ACL denying access
        // $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        // sends back to login page if an anonymous user tries to create a plant

        // get the connected user Entity
        $user = $this->getUser();

        if ($form->isSubmitted() && $form->isValid()) {
            // setting createdAt to current datetime and the user to current user
            $plant->setCreatedAt();
            $plant->setUser($user);
            //flush and flash
            $this->persist($plant);
            $this->addSuccessFlash('plant', 'created');
            // redirects to the created plant
            $id = $plant->getId();
            return $this->redirectToRoute('dashboard_plant_show', ['id' => $id] , Response::HTTP_SEE_OTHER);
        }
    
        return $this->renderForm('dashboard/plant/new.html.twig', [
            'plant' => $plant,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/set-cover/{plantId}/{pictureId}", name="dashboard_plant_setcover", methods={"GET"})
     */
    public function setCover(int $plantId, int $pictureId)
    {

        $plant = $this->getPlantById($plantId);
        $picture = $this->getPictureById($pictureId);

        $plant->setCover($picture);
        $this->persist($plant);
                
        return $this->json([
            'message' => 'success'
        ]);
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
            //flush and flash
            $this->persist($plant);
            $this->addSuccessFlash('plant', 'modified');
            //redirection
            $id = $plant->getId();
            return $this->redirectToRoute('dashboard_plant_show', ['id' => $id], Response::HTTP_SEE_OTHER);
        
        } else if ($form->isSubmitted() && $form->isValid()) {
            //flash
            $this->addFailFlash();
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
            $this->remove($plant);
        }

        return $this->redirectToRoute('dashboard_plants', [], Response::HTTP_SEE_OTHER);
    }
    

}