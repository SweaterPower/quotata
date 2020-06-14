<?php

namespace App\Repository;

use App\Entity\FriendAlias;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FriendAlias|null find($id, $lockMode = null, $lockVersion = null)
 * @method FriendAlias|null findOneBy(array $criteria, array $orderBy = null)
 * @method FriendAlias[]    findAll()
 * @method FriendAlias[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FriendAliasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FriendAlias::class);
    }

    // /**
    //  * @return FriendAlias[] Returns an array of FriendAlias objects
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
    public function findOneBySomeField($value): ?FriendAlias
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
