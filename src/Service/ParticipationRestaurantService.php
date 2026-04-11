<?php
namespace App\Service;
use App\Repository\ParticipationRestaurantRepository;
use Doctrine\ORM\EntityManagerInterface;
class ParticipationRestaurantService extends GenericService {
    private ParticipationRestaurantRepository $repo;
    public function __construct(EntityManagerInterface $em, ParticipationRestaurantRepository $repo) { parent::__construct($em); $this->repo = $repo; }
    public function findAll(): array { return $this->repo->findAll(); }
    public function find(int $id) { return $this->repo->find($id); }
}
