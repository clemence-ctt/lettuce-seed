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
class MemberController extends CoreController
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

    /**
     * @Route("/", name="members_index", methods={"GET"})
     */
    public function getAllUsers()
    {
        $usersList = $this->getUserRepository()->findAll();
        dd($usersList);
    }
    
    //♥utilité ?
    /**
     * @Route("/{userId}", name="user_show", methods={"GET"})
     */
    public function showOneUser(int $userId)
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

        // dd($plants->containsKey('2'));
        //faire correspondre les id avec les keys du tableau user/plant?
        //$plant = $plants->get('2');
        //dd($plant);
        // ou chercher 
        //$plant->getId() === $plantId;
    }

}
