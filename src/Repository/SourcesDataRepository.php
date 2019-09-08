<?php

namespace App\Repository;

use App\Entity\SourcesData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method SourcesData|null find($id, $lockMode = null, $lockVersion = null)
 * @method SourcesData|null findOneBy(array $criteria, array $orderBy = null)
 * @method SourcesData[]    findAll()
 * @method SourcesData[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SourcesDataRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SourcesData::class);
    }

    // /**
    //  * @return SourcesData[] Returns an array of SourcesData objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SourcesData
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
