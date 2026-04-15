<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
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
    {
        return $this->titre;
    }

    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

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
    {
        return $this->lieu;
    }

    public function setLieu($lieu)
    {
        $this->lieu = $lieu;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

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
    }
}