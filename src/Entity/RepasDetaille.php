<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTimeInterface;

#[ORM\Entity]
#[ORM\Table(name:"repas_detaille")]
class RepasDetaille
{
    public const TYPES_REPAS = ['PETIT_DEJEUNER','DEJEUNER','DINER','SNACK'];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type:"integer")]
    private ?int $id = null;

    #[ORM\Column(type:"string", length:120)]
    private ?string $nom = null;

    #[ORM\Column(type:"text")]
    private ?string $description = null;

    #[ORM\Column(type:"decimal", precision:10, scale:2)]
    private ?string $prix = null;

    #[ORM\Column(type:"integer", nullable:true)]
    private ?int $calories = null;

    #[ORM\Column(type:"integer", nullable:true)]
    private ?int $proteines = null;

    #[ORM\Column(type:"string", length:50, nullable:true)]
    private ?string $typeRepas = null;

    #[ORM\Column(type:"date", nullable:true)]
    private ?DateTimeInterface $date = null;

    #[ORM\Column(type:"integer", nullable:true)]
    private ?int $participantId = null;

    #[ORM\Column(type:"integer", nullable:true)]
    private ?int $evenementId = null;

    #[ORM\Column(type:"integer", nullable:true)]
    private ?int $restaurantId = null;

    #[ORM\Column(type:"integer", nullable:true)]
    private ?int $menuId = null;

    #[ORM\Column(type:"integer", nullable:true)]
    private ?int $tempsPreparation = null;

    #[ORM\Column(type:"json", nullable:true)]
    private array $ingredients = [];

    #[ORM\Column(type:"json", nullable:true)]
    private array $allergenes = [];

    #[ORM\Column(type:"boolean")]
    private bool $vegetarien = false;

    #[ORM\Column(type:"boolean")]
    private bool $vegan = false;

    #[ORM\Column(type:"boolean")]
    private bool $sansGluten = false;

    #[ORM\Column(type:"boolean")]
    private bool $halal = false;

    #[ORM\Column(type:"boolean")]
    private bool $actif = true;

    #[ORM\Column(type:"string", length:255, nullable:true)]
    private ?string $imageUrl = null;

    #[ORM\Column(type:"text", nullable:true)]
    private ?string $notes = null;

    #[ORM\Column(type:"integer")]
    private int $choixCount = 0;

    public function __construct() {
        $this->ingredients = [];
        $this->allergenes = [];
    }

    // -------- GETTERS / SETTERS --------

    public function getId(): ?int { return $this->id; }
    public function getNom(): ?string { return $this->nom; }
    public function setNom(string $nom): self { $this->nom = $nom; return $this; }

    public function getDescription(): ?string { return $this->description; }
    public function setDescription(string $desc): self { $this->description = $desc; return $this; }

    public function getPrix(): ?string { return $this->prix; }
    public function setPrix(string $prix): self { $this->prix = $prix; return $this; }

    public function getCalories(): ?int { return $this->calories; }
    public function setCalories(?int $c): self { $this->calories = $c; return $this; }

    public function getProteines(): ?int { return $this->proteines; }
    public function setProteines(?int $p): self { $this->proteines = $p; return $this; }

    public function getTypeRepas(): ?string { return $this->typeRepas; }
    public function setTypeRepas(?string $t): self { $this->typeRepas = $t; return $this; }

    public function getDate(): ?DateTimeInterface { return $this->date; }
    public function setDate(?DateTimeInterface $d): self { $this->date = $d; return $this; }

    public function getParticipantId(): ?int { return $this->participantId; }
    public function setParticipantId(?int $id): self { $this->participantId = $id; return $this; }

    public function getEvenementId(): ?int { return $this->evenementId; }
    public function setEvenementId(?int $id): self { $this->evenementId = $id; return $this; }

    public function getRestaurantId(): ?int { return $this->restaurantId; }
    public function setRestaurantId(?int $id): self { $this->restaurantId = $id; return $this; }

    public function getMenuId(): ?int { return $this->menuId; }
    public function setMenuId(?int $id): self { $this->menuId = $id; return $this; }

    public function getTempsPreparation(): ?int { return $this->tempsPreparation; }
    public function setTempsPreparation(?int $t): self { $this->tempsPreparation = $t; return $this; }

    public function getIngredients(): array { return $this->ingredients; }
    public function setIngredients(array $i): self { $this->ingredients = $i; return $this; }

    public function getAllergenes(): array { return $this->allergenes; }
    public function setAllergenes(array $a): self { $this->allergenes = $a; return $this; }

    public function isVegetarien(): bool { return $this->vegetarien; }
    public function setVegetarien(bool $b): self { $this->vegetarien = $b; return $this; }

    public function isVegan(): bool { return $this->vegan; }
    public function setVegan(bool $b): self { $this->vegan = $b; return $this; }

    public function isSansGluten(): bool { return $this->sansGluten; }
    public function setSansGluten(bool $b): self { $this->sansGluten = $b; return $this; }

    public function isHalal(): bool { return $this->halal; }
    public function setHalal(bool $b): self { $this->halal = $b; return $this; }

    public function isActif(): bool { return $this->actif; }
    public function setActif(bool $b): self { $this->actif = $b; return $this; }

    public function getImageUrl(): ?string { return $this->imageUrl; }
    public function setImageUrl(?string $s): self { $this->imageUrl = $s; return $this; }

    public function getNotes(): ?string { return $this->notes; }
    public function setNotes(?string $s): self { $this->notes = $s; return $this; }

    public function getChoixCount(): int { return $this->choixCount; }
    public function setChoixCount(int $n): self { $this->choixCount = $n; return $this; }
}