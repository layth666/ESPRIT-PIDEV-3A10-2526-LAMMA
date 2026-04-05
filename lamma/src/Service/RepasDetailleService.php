<?php
namespace App\Service;
use App\Repository\RepasDetailleRepository;
use Doctrine\ORM\EntityManagerInterface;
class RepasDetailleService extends GenericService {
    private RepasDetailleRepository $repo;
    public function __construct(EntityManagerInterface $em, RepasDetailleRepository $repo) { parent::__construct($em); $this->repo = $repo; }
    public function findAll(): array { return $this->repo->findAll(); }
    public function find(int $id) { return $this->repo->find($id); }
}
