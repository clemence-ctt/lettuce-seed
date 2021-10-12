<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Plant;
use App\Entity\Picture;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CoreController extends AbstractController
{

//==PICTURE RELATED==//
    public function deleteFile($file, $log = 'activity.log')
    {
        //DOC REMOVING FILES from directory  https://symfony.com/doc/current/components/filesystem.html
        $filesystem = new Filesystem();
        $filesystem->remove(['', $file, $log]);
    }

    public function generatePictureFileName($pictureFile)
    {
        return base64_encode(uniqid()).'.'.$pictureFile->guessExtension();
    }


//==SYMFONY MANAGER & REPO==//
    public function em()
    {
        return $this->getDoctrine()->getManager();
    }

    public function getRepository($name)
    {
        return $this->getDoctrine()->getRepository($name);
    }

//==GET BY ID==//
    protected function getPlantById($plantId)
    {
        return $this->getPlantRepository()->find($plantId);
    }

    protected function getPictureById($pictureId)
    {
        return $this->getPictureRepository()->find($pictureId);
    }

    protected function getUserById($userId)
    {
        return $this->getUserRepository()->find($userId);
    }

//==GET REPO==//
    protected function getPlantRepository()
    {
        return $this->getRepository(Plant::class);
    }

    protected function getPictureRepository()
    {
        return $this->getRepository(Picture::class);
    }

    protected function getUserRepository()
    {
        return $this->getRepository(User::class);
    }

//==ACTIONS==//
    protected function persist($entity)
    {
        $this->em()->persist($entity);
        $this->flush();
        return $entity;
    }

    private function flush()
    {
        $this->em()->flush();
    }

    protected function remove($entity)
    {
        $this->em()->remove($entity);
        $this->flush();
    }

//==FLASH==//
    protected function addSuccessFlash($name, $status) 
    {
        return $this->addFlash(
            'success',
            'Your ' . $name . ' has been ' . $status . ' !'
        );
    }

    protected function addFailFlash()
    { 
        return $this->addFlash(
            'warning',
            'Fail, try again.'
        );
    }
}
