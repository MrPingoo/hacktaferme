<?php

namespace App\Repository;

use App\Entity\ParcelleCulture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ParcelleCulture|null find($id, $lockMode = null, $lockVersion = null)
 * @method ParcelleCulture|null findOneBy(array $criteria, array $orderBy = null)
 * @method ParcelleCulture[]    findAll()
 * @method ParcelleCulture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParcelleCultureRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ParcelleCulture::class);
    }

//    /**
//     * @return ParcelleCulture[] Returns an array of ParcelleCulture objects
//     */
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
    public function findOneBySomeField($value): ?ParcelleCulture
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
