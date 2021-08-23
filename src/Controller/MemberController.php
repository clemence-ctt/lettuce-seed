<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * @Route("/member")
 */
class MemberController extends AbstractController
{
    /**
     * @Route("/signup", name="member_signup", methods={"GET","POST"})
     */
    public function signup(Request $request, UserPasswordHasherInterface $encoder): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        /* LATER repeated type (champs double) pour le mdp? https://github.com/O-clock-Fantasy/movie-db-gregoclock-jc-oclock/commit/e190c210ccff9e047b4079d3dae019abd31be3bd et autres verifs https://symfony.com/doc/current/reference/constraints/UserPassword.html */
        
        $form->handleRequest($request);

        /*
        if ($form->isSubmitted()) {
            if($form->isValid()) {
                echo __FILE__.':'.__LINE__; exit();
            }
            else {
                echo __FILE__.':'.__LINE__; exit();
            }
        }
        */

        if ($form->isSubmitted() && $form->isValid()) {
            // password hashed
            $user->setPassword($encoder->hashPassword($user, $user->getPassword()));
            $user->setCreatedAt();
            $user->setRoles(['ROLE_USER']);
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('member_signup_success', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('member/signup.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/signup-success", name="member_signup_success", methods={"GET"})
     */
    public function signupSuccess(Request $request, UserPasswordHasherInterface $encoder): Response
    {
        return $this->renderForm('member/signup-success.html.twig');
    }


}
