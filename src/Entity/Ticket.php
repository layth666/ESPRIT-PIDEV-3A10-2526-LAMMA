<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "ticket")]
class Ticket
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\Column(type: "integer", nullable: true)]
    private ?int $participationId = null;

    #[ORM\Column(type: "integer", nullable: true)]
    private ?int $userId = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $qrCode = null;

    #[ORM\Column(name: "time_slot", type: "datetime", nullable: true)]
    private ?\DateTimeInterface $dateCreation = null;

    #[ORM\Column(name: "used", type: "boolean")]
    private bool $used = false;

    #[ORM\Column(name: "used_at", type: "datetime", nullable: true)]
    private ?\DateTimeInterface $usedAt = null;

    public function __construct()
    {
        $this->dateCreation = new \DateTime();
    }

    public function getId(): ?int { return $this->id; }

    public function getParticipationId(): ?int { return $this->participationId; }
    public function setParticipationId(?int $participationId): self { $this->participationId = $participationId; return $this; }

    public function getUserId(): ?int { return $this->userId; }
    public function setUserId(?int $userId): self { $this->userId = $userId; return $this; }

    public function getQrCode(): ?string { return $this->qrCode; }
    public function setQrCode(?string $qrCode): self { $this->qrCode = $qrCode; return $this; }

    public function getDateCreation(): ?\DateTimeInterface { return $this->dateCreation; }
    public function setDateCreation(?\DateTimeInterface $dateCreation): self { $this->dateCreation = $dateCreation; return $this; }

    public function isUsed(): bool { return $this->used; }
    public function setUsed(bool $used): self { $this->used = $used; return $this; }

    public function getUsedAt(): ?\DateTimeInterface { return $this->usedAt; }
    public function setUsedAt(?\DateTimeInterface $usedAt): self { $this->usedAt = $usedAt; return $this; }

    #[ORM\Column(type: "string", length: 50, nullable: true)]
    private ?string $type = null;

    #[ORM\Column(type: "integer", nullable: true)]
    private ?int $abonnementId = null;

    public function __toString(): string
    {
        return "Ticket #" . ($this->id ?? 'NEW');
    }

    public function getType(): ?string { return $this->type; }
    public function setType(?string $type): self { $this->type = $type; return $this; }

    public function getAbonnementId(): ?int { return $this->abonnementId; }
    public function setAbonnementId(?int $abonnementId): self { $this->abonnementId = $abonnementId; return $this; }

    // Navigation / UI Helpers
    public function getCodeUnique(): ?string { return $this->qrCode; }
    public function getLieu(): string { return 'QG LAMMA'; }
    public function getStatut(): string { return $this->used ? 'Utilisé' : 'Valide'; }
    public function getFormat(): string { return 'Numérique'; }
    public function getDateExpiration(): ?\DateTimeInterface { return null; }
}