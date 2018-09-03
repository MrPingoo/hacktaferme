<?php

namespace App\Repository;

use App\Entity\WorkParcelle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method WorkParcelle|null find($id, $lockMode = null, $lockVersion = null)
 * @method WorkParcelle|null findOneBy(array $criteria, array $orderBy = null)
 * @method WorkParcelle[]    findAll()
 * @method WorkParcelle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WorkParcelleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, WorkParcelle::class);
    }

//    /**
//     * @return WorkParcelle[] Returns an array of WorkParcelle objects
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
    public function findOneBySomeField($value): ?WorkParcelle
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
