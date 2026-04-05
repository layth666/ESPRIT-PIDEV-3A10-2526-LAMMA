<?php
namespace App\Service;
use App\Repository\RestaurationRepository;
use Doctrine\ORM\EntityManagerInterface;
class RestaurationService extends GenericService {
    private RestaurationRepository $repo;
    public function __construct(EntityManagerInterface $em, RestaurationRepository $repo) { parent::__construct($em); $this->repo = $repo; }
    public function findAll(): array { return $this->repo->findAll(); }
    public function find(int $id) { return $this->repo->find($id); }
}
