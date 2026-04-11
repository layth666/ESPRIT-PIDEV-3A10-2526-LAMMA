<?php
namespace App\Service;
use App\Repository\MenuRepository;
use Doctrine\ORM\EntityManagerInterface;
class MenuService extends GenericService {
    private MenuRepository $repo;
    public function __construct(EntityManagerInterface $em, MenuRepository $repo) { parent::__construct($em); $this->repo = $repo; }
    public function findAll(): array { return $this->repo->findAll(); }
    public function find(int $id) { return $this->repo->find($id); }
}
