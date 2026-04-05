<?php
namespace App\Service;
use App\Repository\MealTicketRepository;
use Doctrine\ORM\EntityManagerInterface;
class MealTicketService extends GenericService {
    private MealTicketRepository $repo;
    public function __construct(EntityManagerInterface $em, MealTicketRepository $repo) { parent::__construct($em); $this->repo = $repo; }
    public function findAll(): array { return $this->repo->findAll(); }
    public function find(int $id) { return $this->repo->find($id); }
}
