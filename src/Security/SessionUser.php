<?php

namespace App\Security;

use Symfony\Component\Security\Core\User\UserInterface;

class SessionUser implements UserInterface
{
    private int $id;
    private string $identifier;
    private array $roles;

    public function __construct(int $id, string $identifier, array $roles)
    {
        $this->id = $id;
        $this->identifier = $identifier;
        $this->roles = $roles;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserIdentifier(): string
    {
        return $this->identifier;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function eraseCredentials(): void
    {
    }
}
