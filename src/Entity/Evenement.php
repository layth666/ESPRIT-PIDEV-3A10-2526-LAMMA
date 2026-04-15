<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
<<<<<<< HEAD

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
=======
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\ReservationMaquillage;
use App\Entity\Equipment;
use App\Entity\Programme;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity]
#[Vich\Uploadable]
class Evenement
{
    public function __construct()
    {
        $this->equipments = new ArrayCollection();
        $this->programmes = new ArrayCollection();
        $this->reservationMaquillages = new ArrayCollection();
        $this->nb_vues = 0;
        $this->propose_makeup = false;
    }

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id_event = null;

    #[ORM\Column(type: "string", length: 255)]
    #[Assert\NotBlank]
    private ?string $titre = null;

    #[ORM\Column(type: "text")]
    #[Assert\NotBlank]
    private ?string $description = null;

    #[ORM\Column(type: "string", length: 100)]
    private ?string $type = null;

    #[ORM\Column(type: "date")]
    private ?\DateTimeInterface $date_debut = null;

    #[ORM\Column(type: "date")]
    private ?\DateTimeInterface $date_fin = null;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $lieu = null;

    #[ORM\Column(nullable: true)]
    private ?string $image = null;

    #[Vich\UploadableField(mapping: 'evenements', fileNameProperty: 'image')]
    private ?File $imageFile = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(nullable: true)]
    private ?string $spotify_url = null;

    #[ORM\Column]
    private ?int $nb_vues = 0;

    #[ORM\Column(nullable: true)]
    private ?bool $propose_makeup = false;

    #[ORM\OneToMany(mappedBy: "event_id", targetEntity: Equipment::class)]
    private Collection $equipments;

    #[ORM\OneToMany(mappedBy: "event_id", targetEntity: Programme::class)]
    private Collection $programmes;

    #[ORM\OneToMany(mappedBy: "event", targetEntity: ReservationMaquillage::class)]
    private Collection $reservationMaquillages;

    // ===== GETTERS / SETTERS =====

    public function getId_event(): ?int
    {
        return $this->id_event;
    }

    public function getTitre(): ?string
>>>>>>> feryelPI
    {
        return $this->titre;
    }

<<<<<<< HEAD
    public function setTitre(string $titre)
=======
    public function setTitre($titre)
>>>>>>> feryelPI
    {
        $this->titre = $titre;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

<<<<<<< HEAD
    public function setDescription(?string $description)
=======
    public function setDescription($description)
>>>>>>> feryelPI
    {
        $this->description = $description;
    }

<<<<<<< HEAD
    public function getType(): string
=======
    public function getType(): ?string
>>>>>>> feryelPI
    {
        return $this->type;
    }

<<<<<<< HEAD
    public function setType(string $type)
=======
    public function setType($type)
>>>>>>> feryelPI
    {
        $this->type = $type;
    }

<<<<<<< HEAD
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
=======
    public function getDate_debut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDate_debut($date)
    {
        $this->date_debut = $date;
    }

    public function getDate_fin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDate_fin($date)
    {
        $this->date_fin = $date;
    }

    public function getLieu(): ?string
>>>>>>> feryelPI
    {
        return $this->lieu;
    }

<<<<<<< HEAD
    public function setLieu(string $lieu)
=======
    public function setLieu($lieu)
>>>>>>> feryelPI
    {
        $this->lieu = $lieu;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

<<<<<<< HEAD
    public function setImage(?string $image)
=======
    public function setImage($image)
>>>>>>> feryelPI
    {
        $this->image = $image;
    }

<<<<<<< HEAD
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
=======
    public function setImageFile(?File $file = null): void
    {
        $this->imageFile = $file;
        if ($file) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getSpotify_url(): ?string
    {
        return $this->spotify_url;
    }

    public function setSpotify_url($url)
    {
        $this->spotify_url = $url;
    }

    public function getNb_vues(): ?int
    {
        return $this->nb_vues;
    }

    public function setNb_vues($nb)
    {
        $this->nb_vues = $nb;
    }

    public function isProposeMakeup(): ?bool
    {
        return $this->propose_makeup;
    }

    public function setProposeMakeup(?bool $val)
    {
        $this->propose_makeup = $val;
>>>>>>> feryelPI
    }
}