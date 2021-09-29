<?php

namespace App\Controller\Dashboard;

use DateTime;
use App\Controller\CoreController;
use App\Entity\Picture;
use App\Form\PictureType;
use App\Repository\PlantRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/me/plants/{plantId}/photos")
 */
class PictureController extends CoreController
{
    /**
     * @Route("/", name="dashboard_plant_pictures", methods={"GET"})
     */
    public function index(int $plantId, PlantRepository $plantRepository): Response
    {
        $currentPlant = $plantRepository->find($plantId);
        $pictures = $currentPlant->getPictures();

        return $this->render('dashboard/picture/index.html.twig', [
            'pictures' => $pictures,
            'currentPlant' => $currentPlant,
            'user' => $this->getUser(),
        ]);
    }

    /**
     * @Route("/new", name="dashboard_picture_new", methods={"GET","POST"})
     */
    public function new(Request $request, int $plantId): Response
    {
        $picture = new Picture();
        $plant = $this->getPlantById($plantId);
        $picture->setDate(DateTime::createFromFormat('Y-m-d', date('Y-m-d')));
        $picture->addPlant($plant);

        $form = $this->createForm(PictureType::class, $picture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->savePicture($form, $picture);
            return $this->redirectAfterPersist($request, $picture);
        
        } else if ($form->isSubmitted() && !($form->isValid())) {
            $this->addFailFlash();
        }

        return $this->renderForm('dashboard/picture/new.html.twig', [
            'picture' => $picture,
            'form' => $form,
            'user' => $this->getUser(),
        ]);
    }


    /**
     * @Route("/{id}", name="dashboard_picture_show", methods={"GET"})
     */
    public function show(int $plantId, Picture $picture): Response
    {
        $currentPlant = $this->getPlantById($plantId);
    
        return $this->render('dashboard/picture/show.html.twig', [
            'picture' => $picture,
            'currentPlant' => $currentPlant,
            'user' => $this->getUser(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="dashboard_picture_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, int $plantId, Picture $picture): Response
    {
        $oldPictureFile = $picture->getFile();

        $picture->setFile(
            new File($this->getParameter('pictures_directory').'/'.$picture->getFile())
            //JK new File($picture->getFile())
        );

        //JK dd($picture->getPlants()->toArray());
        $form = $this->createForm(PictureType::class, $picture);
        $form->handleRequest($request);

        $currentPlant = $this->getPlantById($plantId);

        if ($form->isSubmitted() && $form->isValid()) {
            // validation : if no plant is chosen, stay on the form
            if($form->get('plants')->getData()->count() === 0) {
                $this->addFlash('fail', 'You must choose at least one plant.');
                return $this->renderForm('dashboard/picture/edit.html.twig', [
                    'picture' => $picture,
                    'form' => $form,
                    'currentPlant' => $currentPlant,
                    'oldPictureFile' => $oldPictureFile,
                    'user' => $this->getUser(),
                ]);
            } else {
                //JK dd($form->get('plants')->getData());
                $this->updatePicture($form, $picture, $oldPictureFile);
                return $this->redirectAfterPersist($request, $picture);
            }
        } else if ($form->isSubmitted() && !($form->isValid())) {
            $this->addFailFlash();
        }

        return $this->renderForm('dashboard/picture/edit.html.twig', [
            'picture' => $picture,
            'form' => $form,
            'currentPlant' => $currentPlant,
            'oldPictureFile' => $oldPictureFile,
            'user' => $this->getUser(),
        ]);
    }

    /**
     * @Route("/{id}", name="dashboard_picture_delete", methods={"POST"})
     */
    public function delete(Request $request, Picture $picture): Response
    {
        $filePath = $this->getParameter('pictures_directory').'/'.$picture->getFile();
        if ($this->isCsrfTokenValid('delete'.$picture->getId(), $request->request->get('_token'))) {
            $this->remove($picture);
            $this->deleteFile($filePath);
        }

        $routeParameters = $request->attributes->get('_route_params');
        return $this->redirectToRoute('dashboard_plant_pictures', ['plantId' => $routeParameters['plantId']], Response::HTTP_SEE_OTHER);
    }


    // UTILS METHODS ============================================================

    protected function savePicture($form, $picture)
    {
        // setting createdAt to current datetime and the user to current user
        $picture->setCreatedAt();

        // STEP UPLOAD controller image
        // DOC UPLOAD https://symfony.com/doc/current/controller/upload_file.html

        $pictureFile = $form->get('file')->getData();
        // On génère un nom de fichier unique en devinant l'extension MIME avant de sauvegarder
        $fileName = base64_encode(uniqid()).'.'.$pictureFile->guessExtension();
        // Déplacement du fichier dans un répertoire de notre projet
        $pictureFile->move($this->getParameter('pictures_directory'), $fileName);
        // Met à jour le nom de l'image finale dans notre Post
        $picture->setFile($fileName);
        // flush and flash
        $this->persist($picture);
        $this->addSuccessFlash('picture', 'created');
    }

    protected function updatePicture($form, $picture, $oldPictureFile)
    {
        // set updated_at
        $picture->setUpdatedAt();
        // upload picture : if the form's 'file' field is modified, save the picture
        if(!empty($form->get('file')->getData())) {
            $pictureFile = $form->get('file')->getData();
            $fileName = $this->generatePictureFileName($pictureFile);
            $pictureFile->move($this->getParameter('pictures_directory'), $fileName);
            $picture->setFile($fileName);
            //delete the old image
            $this->deleteFile($this->getParameter('pictures_directory').'/'.$oldPictureFile);
        }
        // if it's empty, set to the previous picture name
        else {
            $picture->setFile($oldPictureFile);
        }
        // flush and flash 
        $this->em()->flush();
        $this->addSuccessFlash('picture', 'modified');
    }

    protected function redirectAfterPersist($request, $picture)
    {
        // redirection : if the current plant is still in the picture infos, redirects to the picture
        $routeParameters = $request->attributes->get('_route_params');
        $id = $picture->getId();
        $plantArray = $picture->getPlants()->toArray();
        $plantIds = [];
        foreach ($plantArray as $plant) {
            $plantIds[] = $plant->getId();
            
        };
        if (in_array($routeParameters['plantId'], $plantIds)) {
            return $this->redirectToRoute('dashboard_picture_show', ['plantId' => $routeParameters['plantId'], 'id' => $id], Response::HTTP_SEE_OTHER);
        } else {
            // if the plant has been removed, redirects to the plant's photos' list
            // return $this->redirectToRoute('dashboard_plant_pictures', ['plantId' => $routeParameters['plantId']], Response::HTTP_SEE_OTHER);
            
            // TIPS reset($array) ; return first element of array
            // or to the pictures, but through another plant id
            $plantId = reset($plantArray)->getId();

            return $this->redirectToRoute('dashboard_picture_show', ['plantId' => $plantId, 'id' => $id], Response::HTTP_SEE_OTHER);
        }
    }

}
