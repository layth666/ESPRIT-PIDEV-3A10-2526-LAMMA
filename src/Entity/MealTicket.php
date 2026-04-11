<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class MealTicket
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "integer")]
    private int $participationId;

    #[ORM\Column(type: "integer")]
    private int $userId;

    #[ORM\Column(type: "string", length: 255)]
    private string $qrCode;

    #[ORM\Column(type: "datetime")]
    private \DateTimeInterface $timeSlot;

    #[ORM\Column(type: "boolean")]
    private bool $used = false;

    #[ORM\Column(type: "datetime", nullable: true)]
    private ?\DateTimeInterface $usedAt = null;

    // ================= CONSTRUCTEUR

    public function __construct()
    {
        $this->used = false;
    }

    public function initialiser(
        int $participationId,
        int $userId,
        string $qrCode,
        \DateTimeInterface $timeSlot
    ): void {
        $this->participationId = $participationId;
        $this->userId = $userId;
        $this->qrCode = $qrCode;
        $this->timeSlot = $timeSlot;
        $this->used = false;
    }

    // ================= LOGIQUE MÉTIER

    public function utiliser(): void
    {
        $this->used = true;
        $this->usedAt = new \DateTime();
    }

    public function estUtilise(): bool
    {
        return $this->used;
    }

    public function estValide(): bool
    {
        return !$this->used && $this->timeSlot >= new \DateTime();
    }

    // ================= GETTERS / SETTERS

    public function getId(): int
    {
        return $this->id;
    }

    public function getParticipationId(): int
    {
        return $this->participationId;
    }

    public function setParticipationId(int $participationId)
    {
        $this->participationId = $participationId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId)
    {
        $this->userId = $userId;
    }

    public function getQrCode(): string
    {
        return $this->qrCode;
    }

    public function setQrCode(string $qrCode)
    {
        $this->qrCode = $qrCode;
    }

    public function getTimeSlot(): \DateTimeInterface
    {
        return $this->timeSlot;
    }

    public function setTimeSlot(\DateTimeInterface $timeSlot)
    {
        $this->timeSlot = $timeSlot;
    }

    public function isUsed(): bool
    {
        return $this->used;
    }

    public function setUsed(bool $used)
    {
        $this->used = $used;
    }

    public function getUsedAt(): ?\DateTimeInterface
    {
        return $this->usedAt;
    }

    public function setUsedAt(?\DateTimeInterface $usedAt)
    {
        $this->usedAt = $usedAt;
    }

    public function __toString(): string
    {
        return sprintf(
            "MealTicket{id=%d, userId=%d, used=%s, timeSlot=%s}",
            $this->id,
            $this->userId,
            $this->used ? 'true' : 'false',
            $this->timeSlot->format('Y-m-d H:i')
        );
    }
}