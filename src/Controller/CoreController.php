<?php

namespace App\Controller;

use App\Entity\Picture;
use App\Entity\Plant;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;

class CoreController extends AbstractController
{


    public function deleteFile($file, $log = 'activity.log')
    {
        //DOC REMOVING FILES from uploads/pictures directory  https://symfony.com/doc/current/components/filesystem.html
        $filesystem = new Filesystem();
        $filesystem->remove(['', $file, $log]);
    }

    public function generatePictureFileName($pictureFile)
    {
        return base64_encode(uniqid()).'.'.$pictureFile->guessExtension();
    }



    public function em()
    {
        return $this->getDoctrine()->getManager();
    }


    public function getRepository($name)
    {
        return $this->getDoctrine()->getRepository($name);
    }


    protected function getPlantById($plantId)
    {
        return $this->getPlantRepository()->find($plantId);
    }

    protected function getPictureById($pictureId)
    {
        return $this->getPictureRepository()->find($pictureId);
    }


    protected function getPlantRepository()
    {
        return $this->getRepository(Plant::class);
    }

    protected function getPictureRepository()
    {
        return $this->getRepository(Picture::class);
    }

    protected function persist($entity)
    {
        $this->em()->persist($entity);
        $this->flush();
        return $entity;
    }

    protected function remove($entity)
    {
        $this->em()->remove($entity);
        $this->flush();
    }


    private function flush()
    {
        $this->em()->flush();
    }
}
