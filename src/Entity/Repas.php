<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTimeInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ORM\Table(name: "repas")]
class Repas
{
    public const TYPES_PLAT = ['VIANDE', 'POISSON', 'VEGETARIEN', 'VEGETALIEN', 'AUTRE'];
    public const CATEGORIES = ['ENTREE', 'PLAT_PRINCIPAL', 'DESSERT', 'BOISSON', 'ACCOMPAGNEMENT'];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\Column(type: "integer", nullable: true)]
    private ?int $restaurantId = null;

    #[ORM\Column(type: "string", length: 100, nullable: true)]
    private ?string $restaurantNom = null;

    #[ORM\Column(type: "integer", nullable: true)]
    private ?int $menuId = null;

    #[ORM\Column(type: "string", length: 100, nullable: true)]
    private ?string $menuNom = null;

    #[ORM\Column(type: "string", length: 120)]
    #[Assert\NotBlank(message: "Le nom du plat est obligatoire.")]
    private ?string $nom = null;

    #[ORM\Column(type: "text", nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: "decimal", precision: 10, scale: 2)]
    #[Assert\NotBlank(message: "Le prix est obligatoire.")]
    #[Assert\Positive(message: "Le prix doit être supérieur à zéro.")]
    private ?string $prix = null;

    #[ORM\Column(type: "string", length: 50)]
    #[Assert\NotBlank(message: "La catégorie est obligatoire.")]
    private ?string $categorie = null;

    #[ORM\Column(type: "string", length: 50)]
    #[Assert\NotBlank(message: "Le type de plat est obligatoire.")]
    private ?string $typePlat = null;

    #[ORM\Column(type: "integer")]
    #[Assert\NotBlank(message: "Le temps de préparation est obligatoire.")]
    #[Assert\Positive(message: "Le temps doit être positif.")]
    private ?int $tempsPreparation = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $imageUrl = null;

    #[ORM\Column(type: "json", nullable: true)]
    private ?array $ingredients = [];

    #[ORM\Column(type: "boolean")]
    private bool $disponible = true;

    #[ORM\Column(type: "datetime_immutable")]
    private ?DateTimeInterface $createdAt = null;

    #[ORM\Column(type: "datetime_immutable")]
    private ?DateTimeInterface $updatedAt = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
    }

    // ---------------- GETTERS / SETTERS ----------------

    public function getId(): ?int { return $this->id; }
    public function getRestaurantId(): ?int { return $this->restaurantId; }
    public function setRestaurantId(int $restaurantId): self { $this->restaurantId = $restaurantId; return $this; }

    public function getRestaurantNom(): ?string { return $this->restaurantNom; }
    public function setRestaurantNom(?string $restaurantNom): self { $this->restaurantNom = $restaurantNom; return $this; }

    public function getMenuId(): ?int { return $this->menuId; }
    public function setMenuId(int $menuId): self { $this->menuId = $menuId; return $this; }

    public function getMenuNom(): ?string { return $this->menuNom; }
    public function setMenuNom(?string $menuNom): self { $this->menuNom = $menuNom; return $this; }

    public function getNom(): ?string { return $this->nom; }
    public function setNom(string $nom): self { $this->nom = $nom; return $this; }

    public function getDescription(): ?string { return $this->description; }
    public function setDescription(string $description): self { $this->description = $description; return $this; }

    public function getPrix(): ?float { return $this->prix; }
    public function setPrix(float $prix): self { $this->prix = $prix; return $this; }

    public function getCategorie(): ?string { return $this->categorie; }
    public function setCategorie(string $categorie): self { $this->categorie = $categorie; return $this; }

    public function getTypePlat(): ?string { return $this->typePlat; }
    public function setTypePlat(string $typePlat): self { $this->typePlat = $typePlat; return $this; }

    public function getTempsPreparation(): ?int { return $this->tempsPreparation; }
    public function setTempsPreparation(int $tempsPreparation): self { $this->tempsPreparation = $tempsPreparation; return $this; }

    public function getImageUrl(): ?string { return $this->imageUrl; }
    public function setImageUrl(?string $imageUrl): self { $this->imageUrl = $imageUrl; return $this; }

    public function getIngredients(): ?array { return $this->ingredients; }
    public function setIngredients(?array $ingredients): self { $this->ingredients = $ingredients; return $this; }

    public function isDisponible(): bool { return $this->disponible; }
    public function setDisponible(bool $disponible): self { $this->disponible = $disponible; return $this; }

    public function getCreatedAt(): ?DateTimeInterface { return $this->createdAt; }
    public function setCreatedAt(DateTimeInterface $createdAt): self { $this->createdAt = $createdAt; return $this; }

    public function getUpdatedAt(): ?DateTimeInterface { return $this->updatedAt; }
    public function setUpdatedAt(DateTimeInterface $updatedAt): self { $this->updatedAt = $updatedAt; return $this; }

    // ---------------- MÉTHODE UTILE ----------------
    public function preUpdate(): void
    {
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function __toString(): string
    {
        return $this->nom . ($this->prix !== null ? ' (' . $this->prix . ' €)' : '');
    }
}