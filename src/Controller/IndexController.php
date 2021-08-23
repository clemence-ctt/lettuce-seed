<?php

namespace App\Controller;

use App\Controller\SecurityController;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(SecurityController $secu): Response
    {    
        return $this->render('public/index.html.twig');
    }
}
