<?php

namespace App\Repository;

use App\Entity\Drena;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Drena|null find($id, $lockMode = null, $lockVersion = null)
 * @method Drena|null findOneBy(array $criteria, array $orderBy = null)
 * @method Drena[]    findAll()
 * @method Drena[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DrenaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Drena::class);
    }

    // /**
    //  * @return Drena[] Returns an array of Drena objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Drena
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
