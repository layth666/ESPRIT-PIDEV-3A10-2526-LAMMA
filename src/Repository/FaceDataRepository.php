<?php

namespace App\Repository;

use App\Entity\FaceData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FaceData>
 *
 * @method FaceData|null find($id, $lockMode = null, $lockVersion = null)
 * @method FaceData|null findOneBy(array $criteria, array $orderBy = null)
 * @method FaceData[]    findAll()
 * @method FaceData[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FaceDataRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FaceData::class);
    }

    public function save(FaceData $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(FaceData $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
