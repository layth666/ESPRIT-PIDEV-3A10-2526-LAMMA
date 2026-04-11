<?php

namespace App\Repository;

use App\Entity\Abonnement;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

class AbonnementRepository
{
    private EntityManagerInterface $em;
    private string $entityClass = Abonnement::class;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Trouve un Abonnement par son ID
     */
    public function find(int $id): ?Abonnement
    {
        return $this->em->getRepository($this->entityClass)->find($id);
    }

    /**
     * Récupère les abonnements selon le statut fourni
     */
    public function findByStatut(string $statut): array
    {
        return $this->em->getRepository($this->entityClass)->findBy(['statut' => $statut]);
    }

    /**
     * Récupère tous les abonnements actifs
     */
    public function findActifs(): array
    {
        return $this->findByStatut('ACTIF');
    }

    /**
     * Crée un QueryBuilder pour l'entité Abonnement
     */
    public function createQueryBuilder(string $alias): QueryBuilder
    {
        return $this->em->createQueryBuilder()
            ->select($alias)
            ->from($this->entityClass, $alias);
    }
}