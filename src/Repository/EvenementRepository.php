<<<<<<< HEAD
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
=======
namespace App\Repository;

use App\Entity\Evenement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Evenement>
 */
class EvenementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Evenement::class);
>>>>>>> feryelPI
    }

    /**
     * Sauvegarde un événement
     */
    public function save(Evenement $entity, bool $flush = true): void
    {
<<<<<<< HEAD
        $this->em->persist($entity);
        if ($flush) {
            $this->em->flush();
=======
        $this->getEntityManager()->persist($entity);
        if ($flush) {
            $this->getEntityManager()->flush();
>>>>>>> feryelPI
        }
    }

    /**
     * Supprime un événement
     */
    public function remove(Evenement $entity, bool $flush = true): void
    {
<<<<<<< HEAD
        $this->em->remove($entity);
        if ($flush) {
            $this->em->flush();
        }
    }
}
=======
        $this->getEntityManager()->remove($entity);
        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
>>>>>>> feryelPI
