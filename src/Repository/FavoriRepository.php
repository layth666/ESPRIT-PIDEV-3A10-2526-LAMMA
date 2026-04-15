<?php

namespace App\Repository;

use App\Entity\Favori;
use Doctrine\ORM\EntityManagerInterface;

class FavoriRepository
{
    private EntityManagerInterface $em;
    private string $entityClass = Favori::class;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function find(int $id): ?Favori
    {
        return $this->em->getRepository($this->entityClass)->find($id);
    }

    public function findByUser(int $userId): array
    {
        return $this->em->getRepository($this->entityClass)->findBy(['userId' => $userId], ['createdAt' => 'DESC']);
    }

    public function findOneBy(array $criteria): ?Favori
    {
        return $this->em->getRepository($this->entityClass)->findOneBy($criteria);
    }

    public function remove(Favori $favori, bool $flush = true): void
    {
        $this->em->remove($favori);
        if ($flush) {
            $this->em->flush();
        }
    }

    public function save(Favori $favori, bool $flush = true): void
    {
        $this->em->persist($favori);
        if ($flush) {
            $this->em->flush();
        }
    }

    /**
     * Retourne le top 5 des restaurants favoris
     */
    public function getPopularityStats(): array
    {
        return $this->em->createQueryBuilder()
            ->select('r.nom as label, COUNT(f.id) as total')
            ->from(Favori::class, 'f')
            ->join('f.restaurant', 'r')
            ->groupBy('r.nom')
            ->orderBy('total', 'DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();
    }
}
