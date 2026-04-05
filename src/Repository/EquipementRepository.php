<?php

namespace App\Repository;

use App\Entity\Equipement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Equipement>
 */
class EquipementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Equipement::class);
    }

    /**
     * Liste boutique : tous les équipements, plus récents en premier (comme EquipementService.afficher() Java).
     *
     * @return list<Equipement>
     */
    public function findAllOrderedByDateDesc(): array
    {
        return $this->createQueryBuilder('e')
            ->leftJoin('e.attributs', 'a')->addSelect('a')
            ->orderBy('e.dateAjout', 'DESC')
            ->addOrderBy('e.id', 'DESC')
            ->getQuery()
            ->getResult();
    }
}
