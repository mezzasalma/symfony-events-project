<?php

namespace App\Repository;

use App\Entity\Collective;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Collective|null find($id, $lockMode = null, $lockVersion = null)
 * @method Collective|null findOneBy(array $criteria, array $orderBy = null)
 * @method Collective[]    findAll()
 * @method Collective[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CollectiveRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Collective::class);
    }

    // /**
    //  * @return Collective[] Returns an array of Collective objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Collective
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
