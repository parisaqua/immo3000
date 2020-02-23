<?php

namespace App\Repository;

use Doctrine\ORM\Query;
use App\Entity\Property;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Property::class);
    }

    /**
     * Liste de tous les biens triés par date de création pour admin
     *
     * @return Property
     */
    
    
    
     /**
      * Query pour paginator dans la page d'admin des biens
      *
      * @return Query
      */
     public function findAllQuery(): Query {
        return $this->findAll()
        ->getQuery()
    ;
    }
    
    
    
    /**
     * Query pour trier tous les biens par date de création
     *
     * @return QueryBuilder
     */ 
    public function findAll(): QueryBuilder {
        return $this->createQueryBuilder('p')
        ->orderBy('p.createdAt', 'DESC')
        
    ;
    }
    
    /**
     * Liste des biens disponibles
     *
     * @return Query
     */
    public function findAllVisibleQuery(): Query {
        
        return $this->findVisibleQuery()
        ->getQuery()
    ;
    }

    /**
     * Undocumented function
     *
     * @return QueryBuilder
     */
    public function findVisibleQuery(): QueryBuilder {
        return $this->createQueryBuilder('p')
        ->andWhere('p.sold = false');
    }
    
    
    // /**
    //  * @return Property[] Returns an array of Property objects
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
    public function findOneBySomeField($value): ?Property
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
