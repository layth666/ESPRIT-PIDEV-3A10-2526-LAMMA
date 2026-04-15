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
        $this->equipments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->programmes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->reservationMaquillages = new \Doctrine\Common\Collections\ArrayCollection();

        $this->nb_vues = 0;
        $this->propose_makeup = false;


    }

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id_event = null;

    #[ORM\Column(type: "string", length: 255)]
    #[Assert\NotBlank(message: "Le titre est obligatoire.")]
    #[Assert\Length(min: 3, minMessage: "Le titre doit contenir au moins {{ limit }} caractères.")]
    private ?string $titre = null;

    #[ORM\Column(type: "text")]
    #[Assert\NotBlank(message: "La description est obligatoire.")]
    #[Assert\Length(min: 10, minMessage: "La description doit contenir au moins {{ limit }} caractères.")]
    private ?string $description = null;

    #[ORM\Column(type: "string", length: 100)]
    #[Assert\NotBlank(message: "Le type est obligatoire.")]
    private ?string $type = null;

    #[ORM\Column(type: "date")]
    #[Assert\NotBlank(message: "La date de début est obligatoire.")]
    private ?\DateTimeInterface $date_debut = null;

    #[ORM\Column(type: "date")]
    #[Assert\NotBlank(message: "La date de fin est obligatoire.")]
    #[Assert\GreaterThanOrEqual(propertyPath: "date_debut", message: "La date de fin doit être après ou égale à la date de début.")]
    private ?\DateTimeInterface $date_fin = null;

    #[ORM\Column(type: "string", length: 255)]
    #[Assert\NotBlank(message: "Le lieu est obligatoire.")]
    private ?string $lieu = null;

    #[ORM\Column(type: "string", length: 1000, nullable: true)]
    private ?string $image = null;

    #[Vich\UploadableField(mapping: 'evenements', fileNameProperty: 'image')]
    private ?File $imageFile = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;


    #[ORM\Column(type: "string", length: 500, nullable: true)]
    private ?string $spotify_url = null;



    #[ORM\Column(type: "boolean", nullable: true, options: ["default" => false])]
    private ?bool $propose_makeup = false;

    #[ORM\Column(type: "integer")]
    private ?int $nb_vues = null;

    public function getId_event()
    {
        return $this->id_event;
    }

    public function getIdEvent()
    {
        return $this->id_event;
    }

    public function setId_event($id_event)
    {
        $this->id_event = $id_event;
    }

    public function setIdEvent($id_event)
    {
        $this->id_event = $id_event;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getDate_debut()
    {
        return $this->date_debut;
    }

    public function getDateDebut()
    {
        return $this->date_debut;
    }

    public function setDate_debut($date_debut)
    {
        $this->date_debut = $date_debut;
    }

    public function setDateDebut($date_debut)
    {
        $this->date_debut = $date_debut;
    }

    public function getDate_fin()
    {
        return $this->date_fin;
    }

    public function getDateFin()
    {
        return $this->date_fin;
    }

    public function setDate_fin($date_fin)
    {
        $this->date_fin = $date_fin;
    }

    public function setDateFin($date_fin)
    {
        $this->date_fin = $date_fin;
    }

    public function getLieu()
    {
        return $this->lieu;
    }

    public function setLieu($lieu)
    {
        $this->lieu = $lieu;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // Requis pour forcer Doctrine à mettre à jour l'entité
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function getSpotify_url()
    {
        return $this->spotify_url;
    }

    public function getSpotifyUrl()
    {
        return $this->spotify_url;
    }

    public function setSpotify_url($spotify_url)
    {
        $this->spotify_url = $spotify_url;
    }

    public function setSpotifyUrl($spotify_url)
    {
        $this->spotify_url = $spotify_url;
    }

    public function getNb_vues()
    {
        return $this->nb_vues;
    }

    public function getNbVues()
    {
        return $this->nb_vues;
    }

    public function setNb_vues($nb_vues)
    {
        $this->nb_vues = $nb_vues;
    }

    public function setNbVues($nb_vues)
    {
        $this->nb_vues = $nb_vues;
    }

    public function isProposeMakeup(): ?bool
    {
        return $this->propose_makeup;
    }

    public function setProposeMakeup(?bool $propose_makeup): self
    {
        $this->propose_makeup = $propose_makeup;

        return $this;
    }

    #[ORM\OneToMany(mappedBy: "event_id", targetEntity: Equipment::class)]
    private Collection $equipments;

        public function getEquipments(): Collection
        {
            return $this->equipments;
        }
    
        public function addEquipment(Equipment $relatedEntityVariable): self
        {
            if (!$this->equipments->contains($relatedEntityVariable)) {
                $this->equipments[] = $relatedEntityVariable;
                $relatedEntityVariable->setEvent_id($this);
            }
    
            return $this;
        }
    
        public function removeEquipment(Equipment $relatedEntityVariable): self
        {
            if ($this->equipments->removeElement($relatedEntityVariable)) {
                if ($relatedEntityVariable->getEvent_id() === $this) {
                    $relatedEntityVariable->setEvent_id(null);
                }
            }
    
            return $this;
        }

        public function getProgrammes(): Collection
        {
            return $this->programmes;
        }

        public function addProgramme(Programme $programme): self
        {
            if (!$this->programmes->contains($programme)) {
                $this->programmes[] = $programme;
                $programme->setEvent_id($this);
            }

            return $this;
        }

        public function removeProgramme(Programme $programme): self
        {
            if ($this->programmes->removeElement($programme)) {
                if ($programme->getEvent_id() === $this) {
                    $programme->setEvent_id(null);
                }
            }

            return $this;
        }

    #[ORM\OneToMany(mappedBy: "event_id", targetEntity: Programme::class)]
    private Collection $programmes;

    #[ORM\OneToMany(mappedBy: "event", targetEntity: ReservationMaquillage::class)]
    private Collection $reservationMaquillages;



    public function getReservationMaquillages(): Collection
    {
        return $this->reservationMaquillages;
    }

    public function addReservationMaquillage(ReservationMaquillage $reservationMaquillage): self
    {
        if (!$this->reservationMaquillages->contains($reservationMaquillage)) {
            $this->reservationMaquillages[] = $reservationMaquillage;
            $reservationMaquillage->setEvent($this);
        }

        return $this;
    }

    public function removeReservationMaquillage(ReservationMaquillage $reservationMaquillage): self
    {
        if ($this->reservationMaquillages->removeElement($reservationMaquillage)) {
            if ($reservationMaquillage->getEvent() === $this) {
                $reservationMaquillage->setEvent(null);
            }
        }

        return $this;
    }


}
