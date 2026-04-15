<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTimeInterface;

#[ORM\Entity]
#[ORM\Table(name: "promo_code")]
class CodePromo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 50, unique: true)]
    private ?string $code = null;

    #[ORM\Column(type: "integer")]
    private int $discountPercentage = 0;

    #[ORM\Column(type: "date", nullable: true)]
    private ?DateTimeInterface $expirationDate = null;

    #[ORM\Column(type: "boolean")]
    private bool $active = true;

    #[ORM\Column(type: "integer")]
    private int $usageLimit = 0;

    #[ORM\Column(type: "integer")]
    private int $currentUsage = 0;

    // ---------------- GETTERS / SETTERS ----------------

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;
        return $this;
    }

    public function getDiscountPercentage(): int
    {
        return $this->discountPercentage;
    }

    public function setDiscountPercentage(int $discountPercentage): self
    {
        $this->discountPercentage = $discountPercentage;
        return $this;
    }

    public function getExpirationDate(): ?DateTimeInterface
    {
        return $this->expirationDate;
    }

    public function setExpirationDate(?DateTimeInterface $expirationDate): self
    {
        $this->expirationDate = $expirationDate;
        return $this;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;
        return $this;
    }

    public function getUsageLimit(): int
    {
        return $this->usageLimit;
    }

    public function setUsageLimit(int $usageLimit): self
    {
        $this->usageLimit = $usageLimit;
        return $this;
    }

    public function getCurrentUsage(): int
    {
        return $this->currentUsage;
    }

    public function setCurrentUsage(int $currentUsage): self
    {
        $this->currentUsage = $currentUsage;
        return $this;
    }

    // ---------------- MÉTHODES MÉTIER ----------------

    public function isExpired(): bool
    {
        return $this->expirationDate !== null && $this->expirationDate < new \DateTimeImmutable('today');
    }

    public function isLimitReached(): bool
    {
        return $this->usageLimit > 0 && $this->currentUsage >= $this->usageLimit;
    }

    public function canBeUsed(): bool
    {
        $withinLimit = $this->usageLimit <= 0 || $this->currentUsage < $this->usageLimit;
        return $this->active && !$this->isExpired() && $withinLimit;
    }

    /**
     * Incrémente le compteur d'utilisation si possible
     */
    public function use(): bool
    {
        if ($this->canBeUsed()) {
            $this->currentUsage++;
            return true;
        }
        return false;
    }
}