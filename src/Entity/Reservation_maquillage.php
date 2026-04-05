<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use App\Entity\Evenement;

#[ORM\Entity]
class Reservation_maquillage
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

        #[ORM\ManyToOne(targetEntity: Evenement::class, inversedBy: "reservation_maquillages")]
    #[ORM\JoinColumn(name: 'event_id', referencedColumnName: 'id_event', onDelete: 'CASCADE')]
    private ?Evenement $event_id = null;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $email = null;

    #[ORM\Column(type: "datetime")]
    private ?\DateTimeInterface $created_at = null;

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

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getCreated_at()
    {
        return $this->created_at;
    }

    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;
    }
}
