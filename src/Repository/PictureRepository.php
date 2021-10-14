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

    // for picture index page
    // NOTICE ORDER PICS Use the sql one
    
    public function orderPicsByDateSQL(int $plantId) 
    {  
        $conn = $this->getEntityManager()
            ->getConnection
            ();
        $sql = "SELECT * FROM picture 
            INNER JOIN picture_plant ON picture.id = picture_plant.picture_id 
            WHERE plant_id = :id
            ORDER BY date DESC";
        $query = $conn->prepare($sql);
        $query->execute(array(':id' => $plantId));
        return $query->fetchAll();
    }
    
    public function orderPicsByDate(int $plantId)  
    {
        $qb = $this->createQueryBuilder('p');
        $qb->select('p.name', 'p.date', 'p.file', 'p.id')
            ->from('Picture', 'p')
            // BUG DQL can't make it work :
            ->innerJoin('plant.id', 'plant', 'WITH', 'p.plant = plant.id')
            ->where('p.id = ?1')
            ->orderBy('p.date', 'DESC')
            ->setParameter(1, $plantId);
        
        return $qb->getQuery()
            ->getResult();
    }

    // for the index page
    public function findLastUploadedPictures(int $limit)
    {
        return $this->createQueryBuilder('picture')
        ->orderBy('picture.created_at', 'DESC')
        ->setMaxResults($limit)
        ->getQuery()
        ->getResult();
    }

    //=====================================================================================

    // unused
    // modify it with placeholders
    public function findLastPictures(int $plantId, int $nbPics)
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'SELECT name, date, file FROM picture 
            INNER JOIN picture_plant ON picture.id = picture_plant.picture_id 
            WHERE plant_id =' . $plantId .
            'ORDER BY date DESC
            LIMIT' . (int) $nbPics
        );
        //return $query->setMaxResults($limit)->getResult();
        return $query->getResult();
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
