<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity]
#[ORM\Table(name: "users")]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    public const ROLE_USER = 'ROLE_USER';
    public const ROLE_ADMIN = 'ROLE_ADMIN';

    public const MOTORIZE_YES = 'YES';
    public const MOTORIZE_NO = 'NO';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 100)]
    #[Assert\NotBlank]
    private ?string $name = null;

    #[ORM\Column(type: "string", length: 180, unique: true)]
    #[Assert\NotBlank]
    #[Assert\Email]
    private ?string $email = null;

    #[ORM\Column(type: "string")]
    #[Assert\NotBlank]
    private ?string $password = null;

    #[ORM\Column(type: "string", length: 20)]
    #[Assert\Choice(choices: [self::ROLE_USER, self::ROLE_ADMIN])]
    private string $role = self::ROLE_USER;

    #[ORM\Column(type: "string", length: 20, nullable: true)]
    private ?string $phone = null;

    #[ORM\Column(type: "string", length: 5)]
    #[Assert\Choice(choices: [self::MOTORIZE_YES, self::MOTORIZE_NO])]
    private string $motorized = self::MOTORIZE_NO;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(type: "integer")]
    private int $loyaltyPoints = 0;

    // ===================== GETTERS / SETTERS =====================

    public function getId(): ?int { return $this->id; }

    public function getName(): ?string { return $this->name; }
    public function setName(string $name): self { $this->name = $name; return $this; }

    public function getEmail(): ?string { return $this->email; }
    public function setEmail(string $email): self { $this->email = $email; return $this; }

    public function getPassword(): ?string { return $this->password; }
    public function setPassword(string $password): self { $this->password = $password; return $this; }

    public function getRole(): ?string { return $this->role; }
    public function setRole(string $role): self { $this->role = $role; return $this; }

    public function getPhone(): ?string { return $this->phone; }
    public function setPhone(?string $phone): self { $this->phone = $phone; return $this; }

    public function getMotorized(): ?string { return $this->motorized; }
    public function setMotorized(string $motorized): self { $this->motorized = $motorized; return $this; }

    public function getImage(): ?string { return $this->image; }
    public function setImage(?string $image): self { $this->image = $image; return $this; }

    public function getLoyaltyPoints(): int { return $this->loyaltyPoints; }
    public function setLoyaltyPoints(int $points): self { $this->loyaltyPoints = $points; return $this; }

    public function addLoyaltyPoints(int $points): self { $this->loyaltyPoints += $points; return $this; }
    public function removeLoyaltyPoints(int $points): self { $this->loyaltyPoints = max(0, $this->loyaltyPoints - $points); return $this; }

    // ===================== UserInterface =====================
    
    public function getRoles(): array
    {
        $roles = [$this->role];
        // guarantee every user at least has ROLE_USER
        if (!in_array(self::ROLE_USER, $roles)) {
            $roles[] = self::ROLE_USER;
        }

        return array_unique($roles);
    }

    public function getSalt(): ?string
    {
        return null; // bcrypt/argon2i ne nécessite pas de sel
    }

    public function eraseCredentials(): void
    {
        // effacer les données sensibles si nécessaire
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    // ===================== UTILITY =====================
    public function __toString(): string
    {
        return sprintf(
            "User #%d | Name: %s | Email: %s | Phone: %s | Role: %s | Motorized: %s | Points: %d",
            $this->id,
            $this->name,
            $this->email,
            $this->phone ?? 'N/A',
            $this->role,
            $this->motorized,
            $this->loyaltyPoints
        );
    }
}