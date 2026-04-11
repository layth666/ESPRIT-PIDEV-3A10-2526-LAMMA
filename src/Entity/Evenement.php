<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Evenement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $idEvent;

    #[ORM\Column(type: "string", length: 255)]
    private string $titre;

    #[ORM\Column(type: "text", nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: "string", length: 100)]
    private string $type;

    #[ORM\Column(type: "datetime", nullable: true)]
    private ?\DateTimeInterface $dateDebut = null;

    #[ORM\Column(type: "datetime", nullable: true)]
    private ?\DateTimeInterface $dateFin = null;

    #[ORM\Column(type: "string", length: 255)]
    private string $lieu;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $spotifyUrl = null;

    #[ORM\Column(type: "integer")]
    private int $nbVues = 0;

    // ================= CONSTRUCTEUR

    public function __construct()
    {
        $this->nbVues = 0;
    }

    public function initialiser(
        string $titre,
        string $description,
        string $type,
        ?\DateTimeInterface $dateDebut,
        ?\DateTimeInterface $dateFin,
        string $lieu,
        ?string $image,
        ?string $spotifyUrl
    ): void {
        $this->titre = $titre;
        $this->description = $description;
        $this->type = $type;
        $this->dateDebut = $dateDebut;
        $this->dateFin = $dateFin;
        $this->lieu = $lieu;
        $this->image = $image;
        $this->spotifyUrl = $spotifyUrl;
    }

    // ================= MÉTHODES UTILES

    public function incrementerVues(): void
    {
        $this->nbVues++;
    }

    public function estEnCours(): bool
    {
        $now = new \DateTime();

        return $this->dateDebut <= $now &&
            ($this->dateFin === null || $this->dateFin >= $now);
    }

    public function estTermine(): bool
    {
        if (!$this->dateFin) return false;

        return $this->dateFin < new \DateTime();
    }

    // ================= GETTERS / SETTERS

    public function getIdEvent(): int
    {
        return $this->idEvent;
    }

    public function getId(): int
    {
        return $this->idEvent;
    }

    public function getTitre(): string
    {
        return $this->titre;
    }

    public function setTitre(string $titre)
    {
        $this->titre = $titre;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description)
    {
        $this->description = $description;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type)
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

    public function getLieu(): string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu)
    {
        $this->lieu = $lieu;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image)
    {
        $this->image = $image;
    }

    public function getSpotifyUrl(): ?string
    {
        return $this->spotifyUrl;
    }

    public function setSpotifyUrl(?string $spotifyUrl)
    {
        $this->spotifyUrl = $spotifyUrl;
    }

    public function getNbVues(): int
    {
        return $this->nbVues;
    }

    public function setNbVues(int $nbVues)
    {
        $this->nbVues = $nbVues;
    }

    public function __toString(): string
    {
        return sprintf(
            "Evenement{id=%d, titre=%s, type=%s, dateDebut=%s, lieu=%s, vues=%d}",
            $this->idEvent,
            $this->titre,
            $this->type,
            $this->dateDebut->format('Y-m-d H:i'),
            $this->lieu,
            $this->nbVues
        );
    }
}