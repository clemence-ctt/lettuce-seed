<?php

namespace App\Controller\Openspace;

use App\Entity\User;
use App\Controller\CoreController;
use App\Controller\SecurityController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class IndexController extends CoreController
{
    /**
     * @Route("/", name="home")
     */
    public function index(SecurityController $secu): Response
    {    
        $lastCreatedUsers = $this->getUserRepository()->findLastCreatedUsers(3);
        $lastCreatedPictures = $this->getPictureRepository()->findLastUploadedPictures(5);
        
        
        return $this->render('openspace/index.html.twig', [
            'lastCreatedUsers' => $lastCreatedUsers,
            'lastCreatedPictures' => $lastCreatedPictures,
            'user' => $this->getUser(),
        ]);
    }
}

