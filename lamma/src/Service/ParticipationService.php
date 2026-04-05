<?php
namespace App\Service;
use App\Repository\ParticipationRepository;
use Doctrine\ORM\EntityManagerInterface;
class ParticipationService extends GenericService {
    private ParticipationRepository $repo;
    public function __construct(EntityManagerInterface $em, ParticipationRepository $repo) { parent::__construct($em); $this->repo = $repo; }
    public function findAll(): array { return $this->repo->findAll(); }
    public function find(int $id) { return $this->repo->find($id); }
    public function create($entity) {
        $this->enrichirTarification($entity);
        return parent::create($entity);
    }
    private function enrichirTarification($p) {
        if (!$p->getNbAdultes()) $p->setNbAdultes(1);
        $p->setTotalParticipants($p->getNbAdultes() + ($p->getNbEnfants() ?? 0));
        $montant = ($p->getNbAdultes() * 25.00) + (($p->getNbEnfants() ?? 0) * 15.00);
        if ($p->getMealOption() === 'EXTRA') $montant += 10;
        $p->setMontantCalcule($montant);
        if (!$p->getDevise()) $p->setDevise('EUR');
        if (!$p->getDateInscription()) $p->setDateInscription(new \DateTime());
        if (!$p->getStatut()) $p->setStatut('EN_ATTENTE');
    }
}
