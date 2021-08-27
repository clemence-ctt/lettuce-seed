<?php

namespace App\Controller\Dashboard;

use App\Entity\Plant;
use App\Entity\Picture;
use App\Form\PictureType;
use App\Repository\PlantRepository;
use App\Repository\PictureRepository;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

//♥ les noms ? attention plant ici ; plantS dans le plantcontroller
/**
 * @Route("/me/plant/{plantId}/photos")
 */
class PictureController extends AbstractController
{
    /**
     * @Route("/", name="dashboard_plant_pictures", methods={"GET"})
     */
    public function index(int $plantId, PlantRepository $plantRepository): Response
    {
        $currentPlant = $plantRepository->find($plantId);
        //JK dd($currentPlant);
        $pictures = $currentPlant->getPictures();
        //JK dd($pictures->toArray());

        return $this->render('dashboard/picture/index.html.twig', [
            'pictures' => $pictures,
            'currentPlant' => $currentPlant
        ]);
    }

    /**
     * @Route("/new", name="dashboard_picture_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $picture = new Picture();
        $form = $this->createForm(PictureType::class, $picture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // setting createdAt to current datetime and the user to current user
            $picture->setCreatedAt();

            // STEP UPLOAD controller image
            // DOC UPLOAD https://symfony.com/doc/current/controller/upload_file.html

            $pictureFile = $form->get('file')->getData();
            // On génère un nom de fichier unique en devinant l'extension MIME avant de sauvegarder
            $fileName = md5(uniqid()).'.'.$pictureFile->guessExtension();
            // Déplacement du fichier dans un répertoire de notre projet
            $pictureFile->move($this->getParameter('pictures_directory'), $fileName);
            // Met à jour le nom de l'image finale dans notre Post
            $picture->setFile($fileName);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($picture);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Your picture has successfully been added'
            );

            //♥ ADD PICTURE éclaté au sol parce qu'on ajoute possiblement une photo qui n'a rien à voir avec la choucroute finalement... comment je retourne sur l'image ?
            $routeParameters = $request->attributes->get('_route_params');
            $id = $picture->getId();
            return $this->redirectToRoute('dashboard_picture_show', ['plantId' => $routeParameters['plantId'], 'id' => $id] , Response::HTTP_SEE_OTHER);
        
        } else if ($form->isSubmitted() && !($form->isValid())) {
            $this->addFlash(
                'warning',
                'You died ! Try again.'
            );
        }

        return $this->renderForm('dashboard/picture/new.html.twig', [
            'picture' => $picture,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="dashboard_picture_show", methods={"GET"})
     */
    public function show(int $plantId, PlantRepository $plantRepository, Picture $picture): Response
    {
        $currentPlant = $plantRepository->find($plantId);
        //TODO PICTURE ordre d'affichage / les afficher par ordre de date dans la vue
    
        return $this->render('dashboard/picture/show.html.twig', [
            'picture' => $picture,
            'currentPlant' => $currentPlant
        ]);
    }

    /**
     * @Route("/{id}/edit", name="dashboard_picture_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, int $plantId, PlantRepository $plantRepository, Picture $picture): Response
    {
        $oldPictureFile = $picture->getFile();
        // $this->getRequest()->getUriForPath('/uploads/myimage.jpg');

        $picture->setFile(
            new File($this->getParameter('pictures_directory').'/'.$picture->getFile())
            // new File($picture->getFile())
        );

        $form = $this->createForm(PictureType::class, $picture);
        $form->handleRequest($request);

        $currentPlant = $plantRepository->find($plantId);

        if ($form->isSubmitted() && $form->isValid()) {
            // set updated_at
            $picture->setUpdatedAt();
            // upload picture : if the form's 'file' field is modified, save the picture
            if(!empty($form->get('file')->getData())) {
                $pictureFile = $form->get('file')->getData();
                $fileName = md5(uniqid()).'.'.$pictureFile->guessExtension();
                $pictureFile->move($this->getParameter('pictures_directory'), $fileName);
                $picture->setFile($fileName);
            }
            // if it's empty, set to the previous picture name
            else {
                $picture->setFile($oldPictureFile);
            }

            // flush
            $this->getDoctrine()->getManager()->flush();

            // redirection
            $routeParameters = $request->attributes->get('_route_params');
            $id = $picture->getId();
            return $this->redirectToRoute('dashboard_picture_show', ['plantId' => $routeParameters['plantId'], 'id' => $id], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dashboard/picture/edit.html.twig', [
            'picture' => $picture,
            'form' => $form,
            'currentPlant' => $currentPlant,
            'oldPictureFile' => $oldPictureFile
        ]);
    }

    /**
     * @Route("/{id}", name="dashboard_picture_delete", methods={"POST"})
     */
    public function delete(Request $request, Picture $picture): Response
    {
        
        $filesystem = new Filesystem();
        $filePath = $this->getParameter('pictures_directory').'/'.$picture->getFile();
        //JK dd($filePath);

        if ($this->isCsrfTokenValid('delete'.$picture->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            //removes the file from uploads/pictures directory  https://symfony.com/doc/current/components/filesystem.html
            $filesystem->remove(['', $filePath, 'activity.log']);
            $entityManager->remove($picture);
            $entityManager->flush();
        }

        $routeParameters = $request->attributes->get('_route_params');
        return $this->redirectToRoute('dashboard_plant_pictures', ['plantId' => $routeParameters['plantId']], Response::HTTP_SEE_OTHER);
    }

}