<?php

namespace App\Entity;

use App\Repository\SponsorFeedbackRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SponsorFeedbackRepository::class)]
#[ORM\HasLifecycleCallbacks]
class SponsorFeedback
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // type: 'feedback' or 'report'
    #[ORM\Column(length: 20)]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(type: 'text')]
    private ?string $contenu = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToOne(targetEntity: Sponsor::class, inversedBy: 'feedbacks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Sponsor $sponsor = null;

    #[ORM\PrePersist]
    public function setCreatedAtValue(): void
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int { return $this->id; }

    public function getType(): ?string { return $this->type; }
    public function setType(string $type): static { $this->type = $type; return $this; }

    public function getNom(): ?string { return $this->nom; }
    public function setNom(string $nom): static { $this->nom = $nom; return $this; }

    public function getEmail(): ?string { return $this->email; }
    public function setEmail(string $email): static { $this->email = $email; return $this; }

    public function getContenu(): ?string { return $this->contenu; }
    public function setContenu(string $contenu): static { $this->contenu = $contenu; return $this; }

    public function getCreatedAt(): ?\DateTimeImmutable { return $this->createdAt; }
    public function setCreatedAt(\DateTimeImmutable $createdAt): static { $this->createdAt = $createdAt; return $this; }

    public function getSponsor(): ?Sponsor { return $this->sponsor; }
    public function setSponsor(?Sponsor $sponsor): static { $this->sponsor = $sponsor; return $this; }
}
