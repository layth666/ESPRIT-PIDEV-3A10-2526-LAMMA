<?php
// src/Entity/Users.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UsersRepository;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
#[ORM\Table(name: 'users')]
class Users implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer', options: ["unsigned" => true])]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 100)]
    #[Assert\NotBlank(message: "Name is required")]
    #[Assert\Length(min: 3, minMessage: "Name must be at least 3 letters", max: 100)]
    private string $name;

    #[ORM\Column(type: 'string', length: 100, unique: true)]
    #[Assert\NotBlank(message: "Email is required")]
    #[Assert\Email(message: "Email must be valid (example: test@gmail.com)")]
    private string $email;

    // No Assert on password — hashed value is stored, plain-text validation
    // is done in RegistrationFormType before the controller hashes it.
    #[ORM\Column(type: 'string', length: 255)]
    private string $password;

    // BANNED is a valid role so the ban feature works without DB schema changes
    #[ORM\Column(type: 'string', length: 50)]
    private string $role = 'USER';

    #[ORM\Column(type: "string", length: 3, nullable: true)]
    #[Assert\Choice(choices: ["YES", "NO"], message: "Motorized must be YES or NO")]
    private ?string $motorized = null;

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(type: "string", length: 20, nullable: true)]
    #[Assert\Regex(pattern: "/^[0-9]{8}$/", message: "Phone must contain exactly 8 numbers")]
    private ?string $phone = null;

    // =========================================================
    // UserInterface
    // =========================================================

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public function getRoles(): array
    {
        return match($this->role) {
            'ADMIN'  => ['ROLE_ADMIN', 'ROLE_USER'],
            'BANNED' => ['ROLE_BANNED'],
            default  => ['ROLE_USER'],
        };
    }

    public function eraseCredentials(): void {}

    // =========================================================
    // PasswordAuthenticatedUserInterface
    // =========================================================

    public function getPassword(): string
    {
        return $this->password;
    }

    // =========================================================
    // Getters & Setters
    // =========================================================

    public function getId(): ?int { return $this->id; }

    public function getName(): string { return $this->name; }
    public function setName(string $name): static { $this->name = $name; return $this; }

    public function getEmail(): string { return $this->email; }
    public function setEmail(string $email): static { $this->email = $email; return $this; }

    public function setPassword(string $password): static { $this->password = $password; return $this; }

    public function getRole(): string { return $this->role; }
    public function setRole(string $role): static { $this->role = $role; return $this; }

    public function getMotorized(): ?string { return $this->motorized; }
    public function setMotorized(?string $motorized): static { $this->motorized = $motorized; return $this; }

    public function getImage(): ?string { return $this->image; }
    public function setImage(?string $image): static { $this->image = $image; return $this; }

    public function getPhone(): ?string { return $this->phone; }
    public function setPhone(?string $phone): static { $this->phone = $phone; return $this; }
}