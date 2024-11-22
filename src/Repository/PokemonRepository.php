<?php

namespace App\Repository;

use App\Entity\Element;
use App\Entity\Pokemon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class PokemonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pokemon::class);
    }

    public function searchByName(string $value): array
    {
        return $this->createQueryBuilder('p')
            ->where('LOWER(p.name) LIKE LOWER(:val)')
            ->setParameter('val', '%' . $value . '%')
            ->orderBy('p.name', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function searchBySpecificite(string $value): array
    {
        return $this->createQueryBuilder('p')
            ->join('p.element', 'e')
            ->where('LOWER(e.specificite) LIKE LOWER(:val)')
            ->setParameter('val', '%' . $value . '%')
            ->orderBy('p.name', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
