<?php

namespace App\Repository;

use App\Entity\Equipement;
use App\Entity\EquipementVue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EquipementVue>
 */
class EquipementVueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EquipementVue::class);
    }

    public function countForEquipement(Equipement $equipement): int
    {
        return (int) $this->createQueryBuilder('v')
            ->select('COUNT(v.id)')
            ->andWhere('v.equipement = :e')
            ->setParameter('e', $equipement)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function findOneByEquipementAndUser(Equipement $equipement, string $userId): ?EquipementVue
    {
        return $this->findOneBy(['equipement' => $equipement, 'userId' => $userId]);
    }
}
