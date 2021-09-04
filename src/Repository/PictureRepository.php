<?php

namespace App\Repository;

use App\Entity\Picture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Picture|null find($id, $lockMode = null, $lockVersion = null)
 * @method Picture|null findOneBy(array $criteria, array $orderBy = null)
 * @method Picture[]    findAll()
 * @method Picture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PictureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Picture::class);
    }


    // for the dashboard's plant list 
    public function findLastThreePictures(int $plantId)
    {
        return $this->createQueryBuilder('picture')
            ->andWhere('picture.plant = :val')
            ->setParameter('val', $plantId)
            ->orderBy('picture.date', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();
    }

    // SLQ : (testé et ça marche) remplacer plant_id
    //     SELECT name, date, file FROM picture 
    //     INNER JOIN picture_plant ON picture.id = picture_plant.picture_id 
    //     WHERE plant_id = 482 
    //     ORDER BY date DESC
    //     LIMIT 3

    // for the index page
    public function findLastCreatedPictures(int $limit)
    {
        return $this->createQueryBuilder('picture')
        ->orderBy('picture.created_at', 'DESC')
        ->setMaxResults($limit)
        ->getQuery()
        ->getResult();
    }


    // /**
    //  * @return Picture[] Returns an array of Picture objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
    
    /*
    public function findOneBySomeField($value): ?Picture
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
