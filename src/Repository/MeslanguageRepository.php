<?php

namespace App\Repository;

use App\Entity\Meslanguage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Meslanguage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Meslanguage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Meslanguage[]    findAll()
 * @method Meslanguage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MeslanguageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Meslanguage::class);
    }

    /**
     * @return Meslanguage[] Returns an array of Meslanguage objects
     */
    public function findByUser($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.utilisateur = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Meslanguage[] Returns an array of Meslanguage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Meslanguage
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
