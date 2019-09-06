<?php

namespace App\Repository;

use App\Entity\Langprog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Langprog|null find($id, $lockMode = null, $lockVersion = null)
 * @method Langprog|null findOneBy(array $criteria, array $orderBy = null)
 * @method Langprog[]    findAll()
 * @method Langprog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LangprogRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Langprog::class);
    }

    // /**
    //  * @return Langprog[] Returns an array of Langprog objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Langprog
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
