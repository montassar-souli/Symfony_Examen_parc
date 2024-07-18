<?php

namespace App\Repository;

use App\Entity\Parc;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Parc>
 *
 * @method Parc|null find($id, $lockMode = null, $lockVersion = null)
 * @method Parc|null findOneBy(array $criteria, array $orderBy = null)
 * @method Parc[]    findAll()
 * @method Parc[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParcRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Parc::class);
    }

//    /**
//     * @return Parc[] Returns an array of Parc objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Parc
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
