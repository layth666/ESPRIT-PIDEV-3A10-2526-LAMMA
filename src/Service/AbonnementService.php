<?php
namespace App\Service;
use App\Repository\AbonnementRepository;
use Doctrine\ORM\EntityManagerInterface;
class AbonnementService extends GenericService {
    private AbonnementRepository $repo;
    public function __construct(EntityManagerInterface $em, AbonnementRepository $repo) { parent::__construct($em); $this->repo = $repo; }
    public function findAll(): array { return $this->repo->findAll(); }
    public function find(int $id) { return $this->repo->find($id); }
    public function findActifs(): array { return $this->repo->findActifs(); }
}
