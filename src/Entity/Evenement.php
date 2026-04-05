<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\Collection;
use App\Entity\Reservation_maquillage;

#[ORM\Entity]
class Evenement
{

    public function __construct()
    {
        $this->equipments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->programmes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->reservation_maquillages = new \Doctrine\Common\Collections\ArrayCollection();
    }

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id_event = null;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $titre = null;

    #[ORM\Column(type: "text")]
    private ?string $description = null;

    #[ORM\Column(type: "string", length: 100)]
    private ?string $type = null;

    #[ORM\Column(type: "date")]
    private ?\DateTimeInterface $date_debut = null;

    #[ORM\Column(type: "date")]
    private ?\DateTimeInterface $date_fin = null;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $lieu = null;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $image = null;

    #[ORM\Column(type: "string", length: 500)]
    private ?string $spotify_url = null;

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

    #[ORM\OneToMany(mappedBy: "event_id", targetEntity: Reservation_maquillage::class)]
    private Collection $reservation_maquillages;

    public function getReservationMaquillages(): Collection
    {
        return $this->reservation_maquillages;
    }

    public function addReservationMaquillage(Reservation_maquillage $reservationMaquillage): self
    {
        if (!$this->reservation_maquillages->contains($reservationMaquillage)) {
            $this->reservation_maquillages[] = $reservationMaquillage;
            $reservationMaquillage->setEvent_id($this);
        }

        return $this;
    }

    public function removeReservationMaquillage(Reservation_maquillage $reservationMaquillage): self
    {
        if ($this->reservation_maquillages->removeElement($reservationMaquillage)) {
            if ($reservationMaquillage->getEvent_id() === $this) {
                $reservationMaquillage->setEvent_id(null);
            }
        }

        return $this;
    }
}
