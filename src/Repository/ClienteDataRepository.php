<?php

namespace App\Repository;

use App\Entity\ClienteData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ClienteData|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClienteData|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClienteData[]    findAll()
 * @method ClienteData[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClienteDataRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClienteData::class);
    }

    // /**
    //  * @return ClienteData[] Returns an array of ClienteData objects
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
    public function findOneBySomeField($value): ?ClienteData
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
