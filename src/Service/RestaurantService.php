<?php
namespace App\Service;
use App\Repository\RestaurantRepository;
use Doctrine\ORM\EntityManagerInterface;
class RestaurantService extends GenericService {
    private RestaurantRepository $repo;
    public function __construct(EntityManagerInterface $em, RestaurantRepository $repo) { parent::__construct($em); $this->repo = $repo; }
    public function findAll(): array { return $this->repo->findAll(); }
    public function find(int $id) { return $this->repo->find($id); }
}
