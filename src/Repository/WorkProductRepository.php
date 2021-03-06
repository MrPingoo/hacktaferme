<?php

namespace App\Repository;

use App\Entity\WorkProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method WorkProduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method WorkProduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method WorkProduct[]    findAll()
 * @method WorkProduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WorkProductRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, WorkProduct::class);
    }

//    /**
//     * @return WorkProduct[] Returns an array of WorkProduct objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?WorkProduct
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
