<?php

namespace App\Repository;

use App\Entity\Projetrealiser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Projetrealiser|null find($id, $lockMode = null, $lockVersion = null)
 * @method Projetrealiser|null findOneBy(array $criteria, array $orderBy = null)
 * @method Projetrealiser[]    findAll()
 * @method Projetrealiser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjetrealiserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Projetrealiser::class);
    }

    // /**
    //  * @return Projetrealiser[] Returns an array of Projetrealiser objects
    //  */
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
    public function findOneBySomeField($value): ?Projetrealiser
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
