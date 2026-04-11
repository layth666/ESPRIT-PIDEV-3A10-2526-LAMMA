<?php
namespace App\Repository;

use App\Entity\Evenement;
use Doctrine\ORM\EntityManagerInterface;

class EvenementRepository
{
    private EntityManagerInterface $em;
    private string $entityClass = Evenement::class;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Retourne tous les événements
     *
     * @return Evenement[]
     */
    public function findAll(): array
    {
        return $this->em->getRepository($this->entityClass)->findAll();
    }

    /**
     * Retourne un événement par son ID
     */
    public function find(int $id): ?Evenement
    {
        return $this->em->getRepository($this->entityClass)->find($id);
    }

    /**
     * Retourne les événements selon des critères
     */
    public function findBy(array $criteria): array
    {
        return $this->em->getRepository($this->entityClass)->findBy($criteria);
    }

    /**
     * Sauvegarde un événement
     */
    public function save(Evenement $entity, bool $flush = true): void
    {
        $this->em->persist($entity);
        if ($flush) {
            $this->em->flush();
        }
    }

    /**
     * Supprime un événement
     */
    public function remove(Evenement $entity, bool $flush = true): void
    {
        $this->em->remove($entity);
        if ($flush) {
            $this->em->flush();
        }
    }
}