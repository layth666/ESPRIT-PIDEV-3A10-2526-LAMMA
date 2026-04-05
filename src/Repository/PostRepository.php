<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Post>
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    // Add this method for search and sorting
    public function findBySearchAndSort(?string $search = null, string $sort = 'latest'): array
    {
        $qb = $this->createQueryBuilder('p')
            ->leftJoin('p.comments', 'c')
            ->groupBy('p.id');

        // Search by title
        if ($search && !empty(trim($search))) {
            $qb->andWhere('p.title LIKE :search')
               ->setParameter('search', '%' . $search . '%');
        }

        // Apply sorting
        switch ($sort) {
            case 'most_commented':
                $qb->orderBy('COUNT(c.id)', 'DESC');
                break;
            case 'oldest':
                $qb->orderBy('p.createdAt', 'ASC');
                break;
            case 'latest':
            default:
                $qb->orderBy('p.createdAt', 'DESC');
                break;
        }

        return $qb->getQuery()->getResult();
    }
}