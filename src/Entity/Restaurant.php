<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTimeInterface;

#[ORM\Entity]
#[ORM\Table(name: "restaurant")]
class Restaurant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 100)]
    private ?string $nom = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $adresse = null;

    #[ORM\Column(type: "string", length: 20, nullable: true)]
    private ?string $telephone = null;

    #[ORM\Column(type: "string", length: 100, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(type: "text", nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $imageUrl = null;

    #[ORM\Column(type: "datetime")]
    private ?DateTimeInterface $dateCreation = null;

    #[ORM\Column(type: "boolean")]
    private bool $actif = true;

    #[ORM\Column(type: "float", nullable: true)]
    private ?float $latitude = null;

    #[ORM\Column(type: "float", nullable: true)]
    private ?float $longitude = null;

    #[ORM\Column(type: "float")]
    private float $rating = 0.0;

    #[ORM\Column(type: "boolean")]
    private bool $isOpen = true;

    #[ORM\Column(type: "integer")]
    private int $nombrePlaces = 50;

    public function __construct()
    {
        $this->dateCreation = new \DateTime();
    }

    // ---------------- GETTERS / SETTERS ----------------

    public function getId(): ?int { return $this->id; }
    public function getNom(): ?string { return $this->nom; }
    public function setNom(string $nom): self { $this->nom = $nom; return $this; }

    public function getAdresse(): ?string { return $this->adresse; }
    public function setAdresse(?string $adresse): self { $this->adresse = $adresse; return $this; }

    public function getTelephone(): ?string { return $this->telephone; }
    public function setTelephone(?string $telephone): self { $this->telephone = $telephone; return $this; }

    public function getEmail(): ?string { return $this->email; }
    public function setEmail(?string $email): self { $this->email = $email; return $this; }

    public function getDescription(): ?string { return $this->description; }
    public function setDescription(?string $description): self { $this->description = $description; return $this; }

    public function getImageUrl(): ?string { return $this->imageUrl; }
    public function setImageUrl(?string $imageUrl): self { $this->imageUrl = $imageUrl; return $this; }

    public function getDateCreation(): ?DateTimeInterface { return $this->dateCreation; }
    public function setDateCreation(DateTimeInterface $dateCreation): self { $this->dateCreation = $dateCreation; return $this; }

    public function isActif(): bool { return $this->actif; }
    public function setActif(bool $actif): self { $this->actif = $actif; return $this; }

    public function getLatitude(): ?float { return $this->latitude; }
    public function setLatitude(?float $latitude): self { $this->latitude = $latitude; return $this; }

    public function getLongitude(): ?float { return $this->longitude; }
    public function setLongitude(?float $longitude): self { $this->longitude = $longitude; return $this; }

    public function getRating(): float { return $this->rating; }
    public function setRating(float $rating): self { $this->rating = $rating; return $this; }

    public function isOpen(): bool { return $this->isOpen; }
    public function setIsOpen(bool $isOpen): self { $this->isOpen = $isOpen; return $this; }

    public function getNombrePlaces(): int { return $this->nombrePlaces; }
    public function setNombrePlaces(int $nombrePlaces): self { $this->nombrePlaces = $nombrePlaces; return $this; }

    public function __toString(): string
    {
        return $this->nom ?? '';
    }
}