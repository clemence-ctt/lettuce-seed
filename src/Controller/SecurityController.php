<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    // STEP LOGIN check
    /**
     * @Route("/login", methods={"GET","POST"}, name="security_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // this code is just for testing purposes 
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }
        
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        
        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="security_logout")
     */
    public function logout()
    {
        // NOTICE LOGOUT pointless to implement this method ; the following code is useless
        // throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
