<?php

namespace App\Controller\Dashboard;

use App\Entity\User;
use App\Entity\Plant;
use App\Form\UserType;
use App\Entity\Picture;
use App\Form\PlantType;
use App\Form\PictureType;
use App\Repository\UserRepository;
use App\Repository\PlantRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


/**
 * @Route("/me")
 * Routes for the logged user's own profile
 */
class DashboardController extends AbstractController
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
     * @Route("/profile/edit", name="dashboard_profile_edit", methods={"GET","POST"})
     */
    public function editProfile(Request $request, UserPasswordHasherInterface $encoder): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setUpdatedAt();

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
                        $this->addFlash('warning', 'Your old password is incorrect.');
                    } else {
                        $this->addFlash('warning', 'Your must enter your old password.');
                    }
                    // and go back to edition
                    return $this->redirectToRoute('dashboard_profile_edit', [], Response::HTTP_SEE_OTHER);
                };
            }
            
            // Fantastic ! 
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'success',
                'Your profile has been modified'
            );

            return $this->redirectToRoute('dashboard_profile', [], Response::HTTP_SEE_OTHER);

        }

        return $this->renderForm('dashboard/profile-edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }
}
