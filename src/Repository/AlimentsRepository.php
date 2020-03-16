<?php

namespace App\Repository;

use App\Entity\Aliments;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Aliments|null find($id, $lockMode = null, $lockVersion = null)
 * @method Aliments|null findOneBy(array $criteria, array $orderBy = null)
 * @method Aliments[]    findAll()
 * @method Aliments[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlimentsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Aliments::class);
    }


    public function findAliByProperties($propertie,$signe,$calorie){

        return $this->createQueryBuilder('a')
            ->andWhere('a.'.$propertie. ' ' . $signe.' :val')
            ->setParameter('val', $calorie)

            ->getQuery()
            ->getResult()
        ;

    }

    // /**
    //  * @return Aliments[] Returns an array of Aliments objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Aliments
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
