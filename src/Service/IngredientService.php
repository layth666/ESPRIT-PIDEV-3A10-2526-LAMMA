<?php
namespace App\Service;
use App\Repository\IngredientRepository;
use Doctrine\ORM\EntityManagerInterface;
class IngredientService extends GenericService {
    private IngredientRepository $repo;
    public function __construct(EntityManagerInterface $em, IngredientRepository $repo) { parent::__construct($em); $this->repo = $repo; }
    public function findAll(): array { return $this->repo->findAll(); }
    public function find(int $id) { return $this->repo->find($id); }
}
