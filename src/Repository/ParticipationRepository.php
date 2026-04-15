<?php
namespace App\Repository;

use App\Entity\Participation;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

class ParticipationRepository
{
    private EntityManagerInterface $em;
    private string $entityClass = Participation::class;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Retourne une participation par son ID
     */
    public function find(int $id): ?Participation
    {
        return $this->em->getRepository($this->entityClass)->find($id);
    }

    /**
     * Retourne toutes les participations
     *
     * @return Participation[]
     */
    public function findAll(): array
    {
        return $this->em->getRepository($this->entityClass)->findAll();
    }

    /**
     * Retourne les participations correspondant à des critères
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null): array
    {
        return $this->em->getRepository($this->entityClass)->findBy($criteria, $orderBy, $limit, $offset);
    }

    /**
     * Retourne les participations correspondant à un statut donné
     *
     * @param string $statut
     * @return Participation[]
     */
    public function findByStatut(string $statut): array
    {
        return $this->em->getRepository($this->entityClass)
            ->findBy(['statut' => $statut]);
    }

    /**
     * Calcule le nombre de places disponibles pour un événement
     */
    public function getPlacesDisponibles(int $evenementId): int
    {
        // On récupère le nombre total de participants confirmés
        $qb = $this->createQueryBuilder('p')
            ->select('SUM(p.totalParticipants)')
            ->where('p.evenementId = :evenementId')
            ->andWhere('p.statut = :statut')
            ->setParameter('evenementId', $evenementId)
            ->setParameter('statut', Participation::STATUT_CONFIRME);

        $totalParticipations = (int) $qb->getQuery()->getSingleScalarResult();

        // Par défaut, on retourne 100 s'il n'y a pas de limite connue, ou on la récupère de l'entité Evénement
        $capaciteMax = 100; // placeholder pour la capacité max
        $placesRestantes = $capaciteMax - $totalParticipations;

        return max(0, $placesRestantes);
    }

    /**
     * Crée un QueryBuilder pour l'entité Participation
     */
    public function createQueryBuilder(string $alias): QueryBuilder
    {
        return $this->em->createQueryBuilder()
            ->select($alias)
            ->from($this->entityClass, $alias);
    }

    /**
     * Sauvegarde une participation
     */
    public function save(Participation $entity, bool $flush = true): void
    {
        $this->em->persist($entity);
        if ($flush) {
            $this->em->flush();
        }
    }

    /**
     * Supprime une participation
     */
    public function remove(Participation $entity, bool $flush = true): void
    {
        $this->em->remove($entity);
        if ($flush) {
            $this->em->flush();
        }
    }
}