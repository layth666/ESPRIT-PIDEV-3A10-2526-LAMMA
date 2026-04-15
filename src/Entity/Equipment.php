<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use App\Entity\Evenement;

#[ORM\Entity]
class Equipment
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

        #[ORM\ManyToOne(targetEntity: Evenement::class, inversedBy: "equipments")]
    #[ORM\JoinColumn(name: 'event_id', referencedColumnName: 'id_event', onDelete: 'CASCADE')]
    private ?Evenement $event_id = null;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $libelle = null;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getEvent_id()
    {
        return $this->event_id;
    }

    public function setEvent_id($event_id)
    {
        $this->event_id = $event_id;
    }

    public function getLibelle()
    {
        return $this->libelle;
    }

    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }
}
