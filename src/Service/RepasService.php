<?php
namespace App\Service;
use App\Repository\RepasRepository;
use Doctrine\ORM\EntityManagerInterface;
class RepasService extends GenericService {
    private RepasRepository $repo;
    public function __construct(EntityManagerInterface $em, RepasRepository $repo) { parent::__construct($em); $this->repo = $repo; }
    public function findAll(): array { return $this->repo->findAll(); }
    public function find(int $id) { return $this->repo->find($id); }
}
