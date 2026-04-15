<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


use App\Entity\Evenement;

#[ORM\Entity]
class Programme
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id_prog = null;

    #[ORM\ManyToOne(targetEntity: Evenement::class, inversedBy: "programmes")]
    #[ORM\JoinColumn(name: 'event_id', referencedColumnName: 'id_event', onDelete: 'CASCADE')]
    #[Assert\NotNull(message: "Le programme doit être rattaché à un événement.")]
    private ?Evenement $event_id = null;

    #[ORM\Column(type: "string", length: 255)]
    #[Assert\NotBlank(message: "Le titre du programme est obligatoire.")]
    #[Assert\Length(min: 3, minMessage: "Le titre doit comporter au moins {{ limit }} caractères.")]
    private ?string $titre = null;

    #[ORM\Column(type: "datetime")]
    #[Assert\NotBlank(message: "La date de début est obligatoire.")]
    private ?\DateTimeInterface $date_debut = null;

    #[ORM\Column(type: "datetime")]
    #[Assert\NotBlank(message: "La date de fin est obligatoire.")]
    #[Assert\GreaterThanOrEqual(propertyPath: "date_debut", message: "La date de fin doit être ultérieure ou égale à la date de début.")]
    private ?\DateTimeInterface $date_fin = null;


    public function getId_prog()
    {
        return $this->id_prog;
    }

    public function getIdProg()
    {
        return $this->id_prog;
    }

    public function setId_prog($id_prog)
    {
        $this->id_prog = $id_prog;
    }

    public function setIdProg($id_prog)
    {
        $this->id_prog = $id_prog;
    }

    public function getEvent_id()
    {
        return $this->event_id;
    }

    public function getEventId()
    {
        return $this->event_id;
    }

    public function setEvent_id($event_id)
    {
        $this->event_id = $event_id;
    }

    public function setEventId($event_id)
    {
        $this->event_id = $event_id;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function setTitre($titre)
    {
        $this->titre = $titre;
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
}
