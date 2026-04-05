<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class Menu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "integer")]
    private int $restaurantId;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $restaurantNom = null;

    #[ORM\Column(type: "string", length: 100)]
    private string $nom;

    #[ORM\Column(type: "text", nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: "decimal", precision: 10, scale: 2, nullable: true)]
    private ?string $prix = null;

    #[ORM\Column(type: "date", nullable: true)]
    private ?\DateTimeInterface $dateDebut = null;

    #[ORM\Column(type: "date", nullable: true)]
    private ?\DateTimeInterface $dateFin = null;

    #[ORM\Column(type: "boolean")]
    private bool $actif = true;

    #[ORM\Column(type: "datetime")]
    private \DateTimeInterface $createdAt;

    #[ORM\Column(type: "datetime")]
    private \DateTimeInterface $updatedAt;

    #[ORM\Column(type: "json")]
    private array $dishesIds = [];

    // ================= CONSTRUCTEUR

    public function __construct()
    {
        $this->actif = true;
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->dishesIds = [];
    }

    // ================= VALIDATION (équivalent Java)

    public function validate(): array
    {
        $errors = [];

        if (!$this->nom || trim($this->nom) === '') {
            $errors['nom'] = "Le nom du menu est obligatoire.";
        } elseif (strlen($this->nom) > 100) {
            $errors['nom'] = "Le nom ne doit pas dépasser 100 caractères.";
        }

        if (!$this->restaurantId) {
            $errors['restaurant'] = "Restaurant obligatoire.";
        }

        if ($this->prix !== null) {
            if ((float)$this->prix < 0) {
                $errors['prix'] = "Prix négatif interdit.";
            } elseif ((float)$this->prix > 999999.99) {
                $errors['prix'] = "Prix trop élevé.";
            }
        }

        if (!$this->description || trim($this->description) === '') {
            $errors['description'] = "Description obligatoire.";
        } elseif (strlen($this->description) > 500) {
            $errors['description'] = "Max 500 caractères.";
        }

        if (!$this->dateDebut || !$this->dateFin) {
            $errors['dates'] = "Dates obligatoires.";
        } elseif ($this->dateDebut > $this->dateFin) {
            $errors['dates'] = "Date début > date fin.";
        }

        return $errors;
    }

    // ================= LIFECYCLE (auto update)

    #[ORM\PreUpdate]
    public function preUpdate(): void
    {
        $this->updatedAt = new \DateTime();
    }

    // ================= LOGIQUE MÉTIER

    public function estActifMaintenant(): bool
    {
        $now = new \DateTime();

        return $this->actif &&
            $this->dateDebut <= $now &&
            $this->dateFin >= $now;
    }

    // ================= GETTERS / SETTERS

    public function getId(): int { return $this->id; }

    public function getRestaurantId(): int { return $this->restaurantId; }
    public function setRestaurantId(int $restaurantId) { $this->restaurantId = $restaurantId; }

    public function getRestaurantNom(): ?string { return $this->restaurantNom; }
    public function setRestaurantNom(?string $restaurantNom) { $this->restaurantNom = $restaurantNom; }

    public function getNom(): string { return $this->nom; }
    public function setNom(string $nom) { $this->nom = $nom; }

    public function getDescription(): string { return $this->description; }
    public function setDescription(string $description) { $this->description = $description; }

    public function getPrix(): ?string { return $this->prix; }
    public function setPrix(?string $prix) { $this->prix = $prix; }

    public function getDateDebut(): ?\DateTimeInterface { return $this->dateDebut; }
    public function setDateDebut(?\DateTimeInterface $dateDebut) { $this->dateDebut = $dateDebut; }

    public function getDateFin(): ?\DateTimeInterface { return $this->dateFin; }
    public function setDateFin(?\DateTimeInterface $dateFin) { $this->dateFin = $dateFin; }

    public function isActif(): bool { return $this->actif; }
    public function setActif(bool $actif) { $this->actif = $actif; }

    public function getCreatedAt(): \DateTimeInterface { return $this->createdAt; }
    public function setCreatedAt(\DateTimeInterface $createdAt) { $this->createdAt = $createdAt; }

    public function getUpdatedAt(): \DateTimeInterface { return $this->updatedAt; }
    public function setUpdatedAt(\DateTimeInterface $updatedAt) { $this->updatedAt = $updatedAt; }

    public function getDishesIds(): array { return $this->dishesIds; }
    public function setDishesIds(array $dishesIds) { $this->dishesIds = $dishesIds; }

    // ================= toString

    public function __toString(): string
    {
        return $this->nom . ($this->prix ? " (" . $this->prix . " €)" : "");
    }
}