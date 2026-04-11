<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class Abonnement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "integer")]
    private int $userId;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $userName = null;

    #[ORM\Column(type: "integer", nullable: true)]
    private ?int $evenementId = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    #[Assert\NotBlank(message: "Le nom est obligatoire.")]
    private ?string $nom = null;

    #[ORM\Column(type: "string", length: 100, nullable: true)]
    private ?string $restrictionType = null;

    #[ORM\Column(type: "string", length: 50)]
    #[Assert\NotBlank(message: "Veuillez sélectionner un type.")]
    private ?string $type = null;

    #[ORM\Column(type: "date", nullable: true)]
    private ?\DateTimeInterface $dateDebut = null;

    #[ORM\Column(type: "date", nullable: true)]
    private ?\DateTimeInterface $dateFin = null;

    #[ORM\Column(type: "decimal", precision: 10, scale: 2)]
    #[Assert\NotBlank(message: "Le prix est obligatoire.")]
    private ?string $prix = null;

    #[ORM\Column(type: "string", length: 50)]
    private string $statut;

    #[ORM\Column(type: "json", nullable: true)]
    private ?array $avantages = [];

    #[ORM\Column(type: "boolean")]
    private bool $autoRenew = false;

    #[ORM\Column(type: "integer")]
    private int $pointsAccumules = 0;

    #[ORM\Column(type: "float")]
    private float $churnScore = 0.0;

    #[ORM\Column(type: "boolean")]
    private bool $isTemplate = false;

    #[ORM\Column(type: "integer", nullable: true)]
    private ?int $planSourceId = null;

    // ================= ENUM (comme Java)
    public const TYPE_MENSUEL = 'MENSUEL';
    public const TYPE_ANNUEL = 'ANNUEL';
    public const TYPE_PREMIUM = 'PREMIUM';
    public const TYPE_EVENT_PASS = 'EVENEMENT_PASS';

    public const STATUT_ACTIF = 'ACTIF';
    public const STATUT_EXPIRE = 'EXPIRE';
    public const STATUT_SUSPENDU = 'SUSPENDU';
    public const STATUT_ATTENTE = 'EN_ATTENTE';

    // Arrays for form choices
    public const TYPES = [
        self::TYPE_MENSUEL,
        self::TYPE_ANNUEL,
        self::TYPE_PREMIUM,
        self::TYPE_EVENT_PASS,
    ];

    public const STATUTS = [
        self::STATUT_ACTIF,
        self::STATUT_EXPIRE,
        self::STATUT_SUSPENDU,
        self::STATUT_ATTENTE,
    ];

    // ================= CONSTRUCTEUR
    public function __construct()
    {
        $this->statut = self::STATUT_ATTENTE;
        $this->pointsAccumules = 0;
        $this->churnScore = 0.0;
    }

    // ================= LOGIQUE (équivalent Java)

    public function initialiser(): void
    {
        // Calcul date fin
        switch ($this->type) {
            case self::TYPE_EVENT_PASS:
                $this->dateFin = (clone $this->dateDebut)->modify('+7 days');
                break;

            case self::TYPE_MENSUEL:
                $this->dateFin = (clone $this->dateDebut)->modify('+1 month');
                break;

            case self::TYPE_ANNUEL:
            case self::TYPE_PREMIUM:
                $this->dateFin = (clone $this->dateDebut)->modify('+1 year');
                break;
        }

        // Avantages
        $this->avantages = [
            "discounts" => ($this->type === self::TYPE_PREMIUM) ? 30 : 10,
            "prioriteWaiting" => $this->type === self::TYPE_PREMIUM,
            "accesEvenementsExclusifs" =>
                $this->type === self::TYPE_PREMIUM ||
                $this->type === self::TYPE_EVENT_PASS
        ];
    }

    public function estActif(): bool
    {
        return $this->statut === self::STATUT_ACTIF &&
            $this->dateFin !== null &&
            $this->dateFin > new \DateTime();
    }

    public function estProcheExpiration(int $jours): bool
    {
        if (!$this->dateFin) return false;

        $date = (clone $this->dateFin)->modify("-$jours days");

        return $date <= new \DateTime();
    }

    public function ajouterPoints(int $points): void
    {
        $this->pointsAccumules += $points;
    }

    public function utiliserPoints(int $points): void
    {
        if ($this->pointsAccumules >= $points) {
            $this->pointsAccumules -= $points;
        } else {
            throw new \Exception("Points insuffisants");
        }
    }

    // ================= GETTERS / SETTERS

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId)
    {
        $this->userId = $userId;
    }

    public function getUserName(): ?string
    {
        return $this->userName;
    }

    public function setUserName(?string $userName)
    {
        $this->userName = $userName;
    }

    public function getEvenementId(): ?int
    {
        return $this->evenementId;
    }

    public function setEvenementId(?int $evenementId)
    {
        $this->evenementId = $evenementId;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom)
    {
        $this->nom = $nom;
    }

    public function getRestrictionType(): ?string
    {
        return $this->restrictionType;
    }

    public function setRestrictionType(?string $restrictionType)
    {
        $this->restrictionType = $restrictionType;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type)
    {
        $this->type = $type;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(?\DateTimeInterface $dateDebut)
    {
        $this->dateDebut = $dateDebut;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(?\DateTimeInterface $dateFin)
    {
        $this->dateFin = $dateFin;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(?string $prix)
    {
        $this->prix = $prix;
    }

    public function getStatut(): string
    {
        return $this->statut;
    }

    public function setStatut(string $statut)
    {
        $this->statut = $statut;
    }

    public function getAvantages(): ?array
    {
        return $this->avantages;
    }

    public function setAvantages(?array $avantages)
    {
        $this->avantages = $avantages;
    }

    public function isAutoRenew(): bool
    {
        return $this->autoRenew;
    }

    public function setAutoRenew(bool $autoRenew)
    {
        $this->autoRenew = $autoRenew;
    }

    public function getPointsAccumules(): int
    {
        return $this->pointsAccumules;
    }

    public function setPointsAccumules(int $pointsAccumules)
    {
        $this->pointsAccumules = $pointsAccumules;
    }

    public function getChurnScore(): float
    {
        return $this->churnScore;
    }

    public function setChurnScore(float $churnScore)
    {
        $this->churnScore = $churnScore;
    }

    public function isTemplate(): bool
    {
        return $this->isTemplate;
    }

    public function setIsTemplate(bool $isTemplate): void
    {
        $this->isTemplate = $isTemplate;
    }

    public function getPlanSourceId(): ?int
    {
        return $this->planSourceId;
    }

    public function setPlanSourceId(?int $planSourceId): void
    {
        $this->planSourceId = $planSourceId;
    }

    public function __toString(): string
    {
        return sprintf(
            "Abonnement{id=%d, userId=%d, type=%s, statut=%s, prix=%s, points=%d}",
            $this->id,
            $this->userId,
            $this->type,
            $this->statut,
            $this->prix,
            $this->pointsAccumules
        );
    }
}