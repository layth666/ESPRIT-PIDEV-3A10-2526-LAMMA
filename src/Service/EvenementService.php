<?php
namespace App\Service;
use App\Repository\EvenementRepository;
use Doctrine\ORM\EntityManagerInterface;
class EvenementService extends GenericService {
    private EvenementRepository $repo;
    public function __construct(EntityManagerInterface $em, EvenementRepository $repo) { parent::__construct($em); $this->repo = $repo; }
    public function findAll(): array { return $this->repo->findAll(); }
    public function find(int $id) { return $this->repo->find($id); }
}
