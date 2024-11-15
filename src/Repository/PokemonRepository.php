<?php

namespace App\Repository;

use App\Entity\Element;
use App\Entity\Pokemon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @extends ServiceEntityRepository<Pokemon>
 *
 * @method Pokemon|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pokemon|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pokemon[]    findAll()
 * @method Pokemon[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PokemonRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pokemon::class);
    }

    //    /**
    //     * @return Pokemon[] Returns an array of Pokemon objects
    //     */


       public function findOneBySomeField($value): ?Pokemon
       {
           return $this->createQueryBuilder('p')
               ->andWhere('p.exampleField = :val')
               ->setParameter('val', $value)
               ->getQuery()
               ->getOneOrNullResult()
           ;
       }
       
public function searchByName($value)
{
    return $this->createQueryBuilder('p')
        ->where('p.name LIKE :val')
        ->setParameter('val', '%' . $value . '%')
        ->getQuery()
        ->getResult();
}

public function searchBySpecificite($value)
{
    return $this->createQueryBuilder('p')
        ->join('p.element', 'e')
        ->where('e.specificite LIKE :val')
        ->setParameter('val', '%' . $value . '%')
        ->getQuery()
        ->getResult();
}
// filtres********************************************

// class 
// public function findByNameElement($name,$element)
// {
//     return $this->createQueryBuilder('p')
//         ->andWhere('p.name = :val')
//         ->andWhere('P.element = :val')
      
//         ->orderBy('p.element', 'ASC')
//         ->setMaxResults(10)
//         ->getQuery()
//         ->getResult()
//     ;
}
