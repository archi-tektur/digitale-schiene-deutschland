<?php

namespace App\Repository\RollingStock;

use App\Entity\RollingStock\Producer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Producer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Producer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Producer[]    findAll()
 * @method Producer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProducerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Producer::class);
    }

    // /**
    //  * @return Producer[] Returns an array of Producer objects
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
    public function findOneBySomeField($value): ?Producer
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
