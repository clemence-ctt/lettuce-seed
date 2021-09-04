<?php

namespace App\Controller\Dashboard;


use App\Form\UserType;
use App\Controller\CoreController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * @Route("/me")
 * Routes for the logged user's own profile
 */
class DashboardController extends CoreController
{

    /**
     * @Route("/", name="dashboard_index", methods={"GET"})
     */
    public function index(): Response
    {
        // REMINDER SECURITY deny access if not logged
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return $this->render('dashboard/index.html.twig', [
            'user' => $this->getUser(),
        ]);
    }

    /**
     * @Route("/profile", name="dashboard_profile", methods={"GET"})
     */
    public function profile(): Response
    {
        // get the connected user Entity
        $user = $this->getUser();

        return $this->render('dashboard/profile.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/profile-edit", name="dashboard_profile_edit", methods={"GET","POST"})
     */
    public function profileEdit(Request $request, UserPasswordHasherInterface $encoder): Response
    {
        $user = $this->getUser();

        $oldFile = $user->getAvatar();

        if (!empty($oldFile)) {
            $user->setAvatar(
                new File($this->getParameter('avatars_directory').'/'.$user->getAvatar())
                //JK new File($picture->getFile())
            );    
        }

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setUpdatedAt();
            $this->updateAvatar($form, 'avatar', $user, $oldFile, 'avatars_directory');
            // Le nouveau password transmis non mappé sur l'entité (voir UserType)
            $newPassword = $form->get('password')->getData();

            if (!empty($newPassword)) {
                // hash the new password for future use
                $passwordHashed = $encoder->hashPassword($user, $newPassword);
                // retrieves the old password from the form
                $formOldPassword = $form->get('oldPassword')->getData();

                // checks if the entered password matches the old one in DB
                if($encoder->isPasswordValid($this->getUser(), $formOldPassword)){
                    // It works ! set pwd in the entity User before flushing it
                    $user->setPassword($passwordHashed);
                } else {
                    // if the passwords don't match, send a message
                    if(!empty($formOldPassword)) {
                        $this->addFlash('fail', 'Your old password is incorrect.');
                    } else {
                        $this->addFlash('fail', 'Your must enter your old password.');
                    }
                    // and go back to edition
                    //DOC 304 NOT_MODIFIED https://developer.mozilla.org/fr/docs/Web/HTTP/Status/304
                    return $this->redirectToRoute('dashboard_profile_edit', [], Response::HTTP_NOT_MODIFIED);
                };
            }
            
            // Fantastic ! 
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Your profile has been modified');

            return $this->redirectToRoute('dashboard_profile', [], Response::HTTP_SEE_OTHER);

        }

        return $this->renderForm('dashboard/profile-edit.html.twig', [
            'user' => $user,
            'form' => $form,
            'oldAvatarFile' => $oldFile
        ]);
    }

    /**
     * @Route("/avatar-delete", name="dashboard_avatar_delete", methods={"GET"})
     */
    public function deleteAvatar(Request $request): Response
    {
        $user = $this->getUser();

        $filePath = $this->getParameter('avatars_directory').'/'.$user->getAvatar();
        if (is_file($filePath)) {
            $this->deleteFile($filePath);
            $user->setAvatar(null);
            $this->persist($user);
        }

        $routeParameters = $request->attributes->get('_route_params');
        return $this->redirectToRoute('dashboard_profile', [], Response::HTTP_SEE_OTHER);
    }
        

//----------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------

    protected function updateAvatar($form, $formField, $entity, $oldFile, $directory)
    {
        // upload picture : if the form's 'file' field is modified, save the picture
        if(!empty($form->get($formField)->getData())) {
            $file = $form->get($formField)->getData();
            $fileName = $this->generatePictureFileName($file);
            $file->move($this->getParameter($directory), $fileName);
            $entity->setAvatar($fileName);
            //delete the old image if there was one
            if (!empty($oldFile)) {
                $this->deleteFile($this->getParameter($directory).'/'.$oldFile);
            }
        }
        // if it's empty, set to the previous picture name
        else {
            $entity->setAvatar($oldFile);
        }
        // flush and flash 
        $this->em()->flush();
        $this->addSuccessFlash('picture', 'modified');
    }

}
