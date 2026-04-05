<?php

namespace App\Entity;

use App\Repository\SponsorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: SponsorRepository::class)]
#[ORM\Table(name: 'sponsor')]
#[UniqueEntity(fields: ['email'], message: "Cet email est déjà utilisé par un autre sponsor")]
class Sponsor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank(message: "Le nom est obligatoire")]
    #[Assert\Length(
        min: 2,
        max: 100,
        minMessage: "Le nom doit avoir au moins {{ limit }} caractères",
        maxMessage: "Le nom ne peut pas dépasser {{ limit }} caractères"
    )]
    private ?string $nom = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $telephone = null;

    #[ORM\Column(length: 150)]
    #[Assert\NotBlank(message: "L'email est obligatoire")]
    #[Assert\Email(message: "L'email '{{ value }}' n'est pas valide")]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $logo = null;

    #[ORM\Column]
    private ?\DateTime $dateCreation = null;

    #[ORM\Column]
    #[Assert\NotNull(message: "Le statut est obligatoire")]
    private ?bool $statut = null;

    #[ORM\OneToMany(targetEntity: EventSponsor::class, mappedBy: 'sponsor')]
    private Collection $eventSponsors;

    public function __construct()
    {
        $this->eventSponsors = new ArrayCollection();
        $this->dateCreation = new \DateTime();
    }

    public function getId(): ?int { return $this->id; }

    public function getNom(): ?string { return $this->nom; }
    public function setNom(string $nom): static { $this->nom = $nom; return $this; }

    public function getTelephone(): ?string { return $this->telephone; }
    public function setTelephone(?string $telephone): static { $this->telephone = $telephone; return $this; }

    public function getEmail(): ?string { return $this->email; }
    public function setEmail(string $email): static { $this->email = $email; return $this; }

    public function getLogo(): ?string { return $this->logo; }
    public function setLogo(?string $logo): static { $this->logo = $logo; return $this; }

    public function getDateCreation(): ?\DateTime { return $this->dateCreation; }
    public function setDateCreation(\DateTime $dateCreation): static { $this->dateCreation = $dateCreation; return $this; }

    public function isStatut(): ?bool { return $this->statut; }
    public function setStatut(bool $statut): static { $this->statut = $statut; return $this; }

    public function getEventSponsors(): Collection { return $this->eventSponsors; }

    public function addEventSponsor(EventSponsor $eventSponsor): static
    {
        if (!$this->eventSponsors->contains($eventSponsor)) {
            $this->eventSponsors->add($eventSponsor);
            $eventSponsor->setSponsor($this);
        }
        return $this;
    }

    public function removeEventSponsor(EventSponsor $eventSponsor): static
    {
        if ($this->eventSponsors->removeElement($eventSponsor)) {
            if ($eventSponsor->getSponsor() === $this) {
                $eventSponsor->setSponsor(null);
            }
        }
        return $this;
    }
}