<?php
namespace App\Repository;

use App\Entity\Menu;
use Doctrine\ORM\EntityManagerInterface;

class MenuRepository
{
    private EntityManagerInterface $em;
    private string $entityClass = Menu::class;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Retourne tous les menus
     *
     * @return Menu[]
     */
    public function findAll(): array
    {
        return $this->em->getRepository($this->entityClass)->findAll();
    }

    /**
     * Retourne des menus selon des critères
     *
     * @return Menu[]
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null): array
    {
        return $this->em->getRepository($this->entityClass)->findBy($criteria, $orderBy, $limit, $offset);
    }

    /**
     * Retourne un menu par son ID
     */
    public function find(int $id): ?Menu
    {
        return $this->em->getRepository($this->entityClass)->find($id);
    }

    /**
     * Retourne tous les menus actifs
     *
     * @return Menu[]
     */
    public function findActifs(): array
    {
        return $this->em->getRepository($this->entityClass)
            ->findBy(['actif' => true]);
    }

    /**
     * Sauvegarde un menu
     */
    public function save(Menu $entity, bool $flush = true): void
    {
        $this->em->persist($entity);
        if ($flush) {
            $this->em->flush();
        }
    }

    /**
     * Supprime un menu
     */
    public function remove(Menu $entity, bool $flush = true): void
    {
        $this->em->remove($entity);
        if ($flush) {
            $this->em->flush();
        }
    }
}