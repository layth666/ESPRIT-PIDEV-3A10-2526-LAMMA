<?php
namespace App\Repository;

use App\Entity\ProgrammeRecommande;
use Doctrine\ORM\EntityManagerInterface;

class ProgrammeRecommandeRepository
{
    private EntityManagerInterface $em;
    private string $entityClass = ProgrammeRecommande::class;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Retourne un programme recommandé par son ID
     */
    public function find(int $id): ?ProgrammeRecommande
    {
        return $this->em->getRepository($this->entityClass)->find($id);
    }

    /**
     * Retourne tous les programmes recommandés
     *
     * @return ProgrammeRecommande[]
     */
    public function findAll(): array
    {
        return $this->em->getRepository($this->entityClass)->findAll();
    }

    /**
     * Sauvegarde un programme recommandé
     */
    public function save(ProgrammeRecommande $entity, bool $flush = true): void
    {
        $this->em->persist($entity);
        if ($flush) {
            $this->em->flush();
        }
    }

    /**
     * Supprime un programme recommandé
     */
    public function remove(ProgrammeRecommande $entity, bool $flush = true): void
    {
        $this->em->remove($entity);
        if ($flush) {
            $this->em->flush();
        }
    }

    /**
     * Retourne des programmes recommandés selon des critères
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null): array
    {
        return $this->em->getRepository($this->entityClass)->findBy($criteria, $orderBy, $limit, $offset);
    }

    public function findByParticipationId(int $participationId): array
    {
        return $this->findBy(['participationId' => $participationId]);
    }

    public function findProgrammesEnCours(): array
    {
        $now = new \DateTime();
        return $this->em->createQuery('SELECT p FROM App\Entity\ProgrammeRecommande p WHERE p.heureDebut <= :now AND p.heureFin >= :now')
            ->setParameter('now', $now)
            ->getResult();
    }

    public function findProgrammesAVenir(): array
    {
        $now = new \DateTime();
        return $this->em->createQuery('SELECT p FROM App\Entity\ProgrammeRecommande p WHERE p.heureDebut > :now')
            ->setParameter('now', $now)
            ->getResult();
    }

    public function findProgrammesTermines(): array
    {
        $now = new \DateTime();
        return $this->em->createQuery('SELECT p FROM App\Entity\ProgrammeRecommande p WHERE p.heureFin < :now')
            ->setParameter('now', $now)
            ->getResult();
    }

    public function searchByTitreOrEvent(?string $titre, ?int $eventId): array
    {
        $qb = $this->em->createQueryBuilder()
            ->select('p')
            ->from($this->entityClass, 'p');

        if ($titre) {
            $qb->andWhere('p.activite LIKE :titre')->setParameter('titre', '%'.$titre.'%');
        }
        if ($eventId) {
            $qb->andWhere('p.participationId = :eventId')->setParameter('eventId', $eventId);
        }

        return $qb->getQuery()->getResult();
    }

    public function findByDateBetween(\DateTime $debut, \DateTime $fin): array
    {
        return $this->em->createQuery('SELECT p FROM App\Entity\ProgrammeRecommande p WHERE p.heureDebut >= :debut AND p.heureFin <= :fin')
            ->setParameter('debut', $debut)
            ->setParameter('fin', $fin)
            ->getResult();
    }
}