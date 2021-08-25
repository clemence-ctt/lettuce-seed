<?php

namespace App\Repository;

use App\Entity\Plant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Plant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Plant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Plant[]    findAll()
 * @method Plant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Plant::class);
    }

    public function findBiggestId() {

        $entityManager = $this->getEntityManager();

        // php bin/console doctrine:query:sql
        // ~ 'SELECT MAX(id) FROM plant'
        // mettre ds une variable + petit et + gd
        // $picture->addPlant(rand($min, $max));

        $query = $entityManager->createQuery(
            'SELECT MAX(id) as maxId
            FROM App\Entity\Plant'
        );

        // returns an array of Product objects
        $results = $query->getResult();

        if(!empty($results)) {
        // REMINDER tableaux imbriqués 
            return $results[0]['maxId'];
        }
        else {
            return false;
        }
            //! oskour
            // => array (size=1)
            // 0 => 
            //   array (size=1)
            //     'MAX(id)' => string '127' (length=3)
    }



    // /**
    //  * @return Plant[] Returns an array of Plant objects
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
    public function findOneBySomeField($value): ?Plant
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
