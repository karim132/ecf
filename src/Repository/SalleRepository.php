<?php

namespace App\Repository;

use App\Entity\Salle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Salle>
 *
 * @method Salle|null find($id, $lockMode = null, $lockVersion = null)
 * @method Salle|null findOneBy(array $criteria, array $orderBy = null)
 * @method Salle[]    findAll()
 * @method Salle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SalleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Salle::class);
    }

    public function save(Salle $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Salle $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    // public function findAllWithData() : array
    // {
    //   return $this->createQueryBuilder('s')
    //    ->leftJoin('s.ergonomie' ,'e')
    //    ->leftJoin('s.materiel' ,'m')
    //    ->leftJoin('s.logiciel' ,'l')
    //    ->addSelect('e')
    //    ->addSelect('m')
    //    ->addSelect('l')
    //    ->getQuery()
    //    ->getResult();
    // }

    // public function findOneByIdJoinedToCategory(int $id) : array
    // {
    //   $query= $this->getEntityManager()->createQueryBuilder()
    //   ->select('s', 'e')
    //   ->from('App\Entity\Salle','s')
    //   ->join('s.ergonomie' ,'e')
    //   ->where("s.id ='$id'");

    //   dd($query)
      
    // //   ->getQuery()
    // //   ->getResult();
    // ;}

    /**
    * @return Salle[] Returns an array of Vehicule objects
     */
     public function findAllWithData() : array
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
        'SELECT s, e, m, l
        FROM App\Entity\Salle s
         INNER JOIN s.ergonomie e
         INNER JOIN s.materiel m
         INNER JOIN s.logiciel l'
    );

    return $query->getResult();
     
    }


//    /**
//     * @return Salle[] Returns an array of Salle objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($id): ?Salle
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('s.id', $id)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
