<?php

namespace App\Entity;

use App\Repository\EventSponsorRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EventSponsorRepository::class)]
#[ORM\Table(name: 'eventsponsor')]
class EventSponsor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    #[Assert\NotBlank(message: "Le niveau est obligatoire")]
    #[Assert\Choice(
        choices: ['GOLD', 'SILVER', 'BRONZE', 'PARTENAIRE'],
        message: "Le niveau choisi n'est pas valide"
    )]
    private ?string $niveau = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    #[Assert\NotBlank(message: "Le montant est obligatoire")]
    #[Assert\Positive(message: "Le montant doit être supérieur à 0")]
    #[Assert\LessThanOrEqual(value: 999999.99, message: "Le montant est trop élevé")]
    private ?string $montant = null;

    #[ORM\Column]
    private ?\DateTime $dateAssociation = null;

    #[ORM\ManyToOne(inversedBy: 'eventSponsors')]
    #[ORM\JoinColumn(name: 'event_id', referencedColumnName: 'id_event', nullable: false)]
    #[Assert\NotNull(message: "L'événement est obligatoire")]
    private ?Evenement $event = null;

    #[ORM\ManyToOne(inversedBy: 'eventSponsors')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotNull(message: "Le sponsor est obligatoire")]
    private ?Sponsor $sponsor = null;

    public function __construct()
    {
        $this->dateAssociation = new \DateTime();
    }

    public function getId(): ?int { return $this->id; }

    public function getNiveau(): ?string { return $this->niveau; }
    public function setNiveau(string $niveau): static { $this->niveau = $niveau; return $this; }

    public function getMontant(): ?string { return $this->montant; }
    public function setMontant(string $montant): static { $this->montant = $montant; return $this; }

    public function getDateAssociation(): ?\DateTime { return $this->dateAssociation; }
    public function setDateAssociation(\DateTime $dateAssociation): static { $this->dateAssociation = $dateAssociation; return $this; }

    public function getEvent(): ?Evenement { return $this->event; }
    public function setEvent(?Evenement $event): static { $this->event = $event; return $this; }

    public function getSponsor(): ?Sponsor { return $this->sponsor; }
    public function setSponsor(?Sponsor $sponsor): static { $this->sponsor = $sponsor; return $this; }
}
