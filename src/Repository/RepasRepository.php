<?php
namespace App\Repository;

use App\Entity\Repas;
use Doctrine\ORM\EntityManagerInterface;

class RepasRepository
{
    private EntityManagerInterface $em;
    private string $entityClass = Repas::class;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Trouve un repas par son ID
     */
    public function find(int $id): ?Repas
    {
        return $this->em->getRepository($this->entityClass)->find($id);
    }

    /**
     * Retourne tous les repas
     *
     * @return Repas[]
     */
    public function findAll(): array
    {
        return $this->em->getRepository($this->entityClass)->findAll();
    }

    /**
     * Retourne tous les repas disponibles
     *
     * @return Repas[]
     */
    public function findDisponibles(): array
    {
        return $this->em->getRepository($this->entityClass)->findBy(['disponible' => true]);
    }

    /**
     * Sauvegarde un repas
     */
    public function save(Repas $entity, bool $flush = true): void
    {
        $this->em->persist($entity);
        if ($flush) {
            $this->em->flush();
        }
    }

    /**
     * Supprime un repas
     */
    public function remove(Repas $entity, bool $flush = true): void
    {
        $this->em->remove($entity);
        if ($flush) {
            $this->em->flush();
        }
    }
}