<?php

namespace App\Repository;

use App\Entity\KickVote;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method KickVote|null find($id, $lockMode = null, $lockVersion = null)
 * @method KickVote|null findOneBy(array $criteria, array $orderBy = null)
 * @method KickVote[]    findAll()
 * @method KickVote[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KickVoteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, KickVote::class);
    }

    // /**
    //  * @return KickVote[] Returns an array of KickVote objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('k.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?KickVote
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
