<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Ingredient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string", length: 255)]
    private string $nom;

    #[ORM\Column(type: "string", length: 50)]
    private string $categorie;

    #[ORM\Column(type: "decimal", precision: 10, scale: 2)]
    private string $prixSupplement;

    #[ORM\Column(type: "integer", nullable: true)]
    private ?int $calories = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $iconUrl = null;

    #[ORM\Column(type: "integer")]
    private int $stockQuantite = 0;

    #[ORM\Column(type: "integer")]
    private int $stockSeuilAlerte = 0;

    #[ORM\Column(type: "boolean")]
    private bool $actif = true;

    // ================= ENUM (équivalent Java)
    public const CATEGORIE_BASE = 'BASE';
    public const CATEGORIE_PROTEINE = 'PROTEINE';
    public const CATEGORIE_LEGUME = 'LEGUME';
    public const CATEGORIE_SAUCE = 'SAUCE';
    public const CATEGORIE_TOPPING = 'TOPPING';
    public const CATEGORIE_EXTRA = 'EXTRA';

    public const CATEGORIES = [
        self::CATEGORIE_BASE,
        self::CATEGORIE_PROTEINE,
        self::CATEGORIE_LEGUME,
        self::CATEGORIE_SAUCE,
        self::CATEGORIE_TOPPING,
        self::CATEGORIE_EXTRA,
    ];

    // ================= CONSTRUCTEUR

    public function __construct()
    {
        $this->actif = true;
        $this->stockQuantite = 0;
        $this->stockSeuilAlerte = 0;
    }

    public function initialiser(
        string $nom,
        string $categorie,
        string $prixSupplement,
        ?int $calories
    ): void {
        $this->nom = $nom;
        $this->categorie = $categorie;
        $this->prixSupplement = $prixSupplement;
        $this->calories = $calories;
    }

    // ================= LOGIQUE MÉTIER

    public function estEnRupture(): bool
    {
        return $this->stockQuantite <= 0;
    }

    public function estSousSeuil(): bool
    {
        return $this->stockQuantite <= $this->stockSeuilAlerte;
    }

    // ================= GETTERS / SETTERS

    public function getId(): int
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom)
    {
        $this->nom = $nom;
    }

    public function getCategorie(): string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie)
    {
        $this->categorie = $categorie;
    }

    public function getPrixSupplement(): string
    {
        return $this->prixSupplement;
    }

    public function setPrixSupplement(string $prixSupplement)
    {
        $this->prixSupplement = $prixSupplement;
    }

    public function getCalories(): ?int
    {
        return $this->calories;
    }

    public function setCalories(?int $calories)
    {
        $this->calories = $calories;
    }

    public function getIconUrl(): ?string
    {
        return $this->iconUrl;
    }

    public function setIconUrl(?string $iconUrl)
    {
        $this->iconUrl = $iconUrl;
    }

    public function getStockQuantite(): int
    {
        return $this->stockQuantite;
    }

    public function setStockQuantite(int $stockQuantite)
    {
        $this->stockQuantite = $stockQuantite;
    }

    public function getStockSeuilAlerte(): int
    {
        return $this->stockSeuilAlerte;
    }

    public function setStockSeuilAlerte(int $stockSeuilAlerte)
    {
        $this->stockSeuilAlerte = $stockSeuilAlerte;
    }

    public function isActif(): bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif)
    {
        $this->actif = $actif;
    }

    // ================= EQUIVALENT equals()

    public function equals(?Ingredient $other): bool
    {
        if ($other === null) return false;

        if ($this->id !== null && $other->getId() !== null) {
            return $this->id === $other->getId();
        }

        return $this->nom === $other->getNom();
    }

    // ================= toString()

    public function __toString(): string
    {
        return $this->nom . " (+" . $this->prixSupplement . " €)";
    }
}