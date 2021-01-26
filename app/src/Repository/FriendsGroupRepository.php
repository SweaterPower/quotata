<?php

namespace App\Repository;

use App\Entity\FriendsGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FriendsGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method FriendsGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method FriendsGroup[]    findAll()
 * @method FriendsGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FriendsGroupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FriendsGroup::class);
    }

    // /**
    //  * @return FriendsGroup[] Returns an array of FriendsGroup objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FriendsGroup
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
