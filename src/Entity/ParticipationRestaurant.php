<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class ParticipationRestaurant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    // ================= LIENS

    #[ORM\Column(type: "integer")]
    private int $participantId;

    #[ORM\Column(type: "integer")]
    private int $evenementId;

    // ================= BESOIN SPECIFIQUE

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $besoinLibelle = null;

    #[ORM\Column(type: "text", nullable: true)]
    private ?string $besoinDescription = null;

    // ================= RESTRICTION ALIMENTAIRE

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $restrictionLibelle = null;

    #[ORM\Column(type: "text", nullable: true)]
    private ?string $restrictionDescription = null;

    #[ORM\Column(type: "string", length: 50, nullable: true)]
    private ?string $niveauGravite = null;

    #[ORM\Column(type: "boolean")]
    private bool $restrictionActive = true;

    // ================= CHOIX REPAS

    #[ORM\Column(type: "integer", nullable: true)]
    private ?int $menuPropositionId = null;

    #[ORM\Column(type: "datetime", nullable: true)]
    private ?\DateTimeInterface $dateChoix = null;

    #[ORM\Column(type: "date", nullable: true)]
    private ?\DateTimeInterface $dateLimiteModification = null;

    #[ORM\Column(type: "text", nullable: true)]
    private ?string $commentaire = null;

    // ================= ETAT

    #[ORM\Column(type: "boolean")]
    private bool $annule = false;

    // ================= ENUM (comme Java)

    public const GRAVITE_LEGERE = 'LEGERE';
    public const GRAVITE_MODEREE = 'MODEREE';
    public const GRAVITE_SEVERE = 'SEVERE';

    // ================= CONSTRUCTEUR

    public function __construct()
    {
        $this->restrictionActive = true;
        $this->annule = false;
    }

    // ================= LOGIQUE MÉTIER

    public function estActif(): bool
    {
        return !$this->annule;
    }

    public function aRestrictionSevere(): bool
    {
        return $this->restrictionActive &&
            $this->niveauGravite === self::GRAVITE_SEVERE;
    }

    public function peutModifierChoix(): bool
    {
        if (!$this->dateLimiteModification) return false;

        return new \DateTime() <= $this->dateLimiteModification;
    }

    public function annuler(): void
    {
        $this->annule = true;
    }

    // ================= GETTERS / SETTERS

    public function getId(): int { return $this->id; }

    public function getParticipantId(): int { return $this->participantId; }
    public function setParticipantId(int $participantId) { $this->participantId = $participantId; }

    public function getEvenementId(): int { return $this->evenementId; }
    public function setEvenementId(int $evenementId) { $this->evenementId = $evenementId; }

    public function getBesoinLibelle(): ?string { return $this->besoinLibelle; }
    public function setBesoinLibelle(?string $besoinLibelle) { $this->besoinLibelle = $besoinLibelle; }

    public function getBesoinDescription(): ?string { return $this->besoinDescription; }
    public function setBesoinDescription(?string $besoinDescription) { $this->besoinDescription = $besoinDescription; }

    public function getRestrictionLibelle(): ?string { return $this->restrictionLibelle; }
    public function setRestrictionLibelle(?string $restrictionLibelle) { $this->restrictionLibelle = $restrictionLibelle; }

    public function getRestrictionDescription(): ?string { return $this->restrictionDescription; }
    public function setRestrictionDescription(?string $restrictionDescription) { $this->restrictionDescription = $restrictionDescription; }

    public function getNiveauGravite(): ?string { return $this->niveauGravite; }
    public function setNiveauGravite(?string $niveauGravite) { $this->niveauGravite = $niveauGravite; }

    public function isRestrictionActive(): bool { return $this->restrictionActive; }
    public function setRestrictionActive(bool $restrictionActive) { $this->restrictionActive = $restrictionActive; }

    public function getMenuPropositionId(): ?int { return $this->menuPropositionId; }
    public function setMenuPropositionId(?int $menuPropositionId) { $this->menuPropositionId = $menuPropositionId; }

    public function getDateChoix(): ?\DateTimeInterface { return $this->dateChoix; }
    public function setDateChoix(?\DateTimeInterface $dateChoix) { $this->dateChoix = $dateChoix; }

    public function getDateLimiteModification(): ?\DateTimeInterface { return $this->dateLimiteModification; }
    public function setDateLimiteModification(?\DateTimeInterface $dateLimiteModification) { $this->dateLimiteModification = $dateLimiteModification; }

    public function getCommentaire(): ?string { return $this->commentaire; }
    public function setCommentaire(?string $commentaire) { $this->commentaire = $commentaire; }

    public function isAnnule(): bool { return $this->annule; }
    public function setAnnule(bool $annule) { $this->annule = $annule; }

    public function __toString(): string
    {
        return sprintf(
            "ParticipantRestauration{id=%d, participant=%d, evenement=%d, annule=%s}",
            $this->id,
            $this->participantId,
            $this->evenementId,
            $this->annule ? 'true' : 'false'
        );
    }
}