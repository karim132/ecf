<?php

namespace App\Repository;

use App\Entity\Reservation;
use App\Entity\Salle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Reservation>
 *
 * @method Reservation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reservation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reservation[]    findAll()
 * @method Reservation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reservation::class);
    }

    public function save(Reservation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Reservation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    // public function findOneByIdJoinedToCategory() : array
    // {
    //   return $this->createQueryBuilder('r')
    //   ->leftJoin('r.modele' ,'m')
    //   ->leftJoin('m.marque' ,'ma')
    //   ->leftJoin('v.options' ,'o')
    //   ->leftJoin('v.agence', 'a')
    //   ->leftJoin('m.type', 't')
    //   ->addSelect('m')
    //   ->addSelect('ma')
    //   ->addSelect('o')
    //   ->addSelect('a')
    //   ->addSelect('t')
    //   ->getQuery()
    //   ->getResult();
    // }





    // public function findOneByIdJoinedToCategory(int $salleResa) : ?Salle
    // {
    //     $entityManager = $this->getEntityManager();
    //     $query = $entityManager->createQuery(
    //     'SELECT s, e
    //     FROM App\Entity\Salle s
    //     INNER JOIN s.ergonomie e
    //     WHERE s.id = :id'
    // )->setParameter('id', $salleResa);

    // return $query->getOneOrNullResult();
     
    // }


//    /**
//     * @return Reservation[] Returns an array of Reservation objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Reservation
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
