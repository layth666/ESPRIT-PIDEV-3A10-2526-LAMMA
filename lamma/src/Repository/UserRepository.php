<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

class UserRepository implements PasswordUpgraderInterface
{
    private EntityManagerInterface $em;
    private string $entityClass = User::class;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Trouve un utilisateur par son ID
     */
    public function find(int $id): ?User
    {
        return $this->em->getRepository($this->entityClass)->find($id);
    }

    /**
     * Trouve un utilisateur par ses critères
     */
    public function findOneBy(array $criteria): ?User
    {
        return $this->em->getRepository($this->entityClass)->findOneBy($criteria);
    }

    /**
     * Retourne tous les utilisateurs
     *
     * @return User[]
     */
    public function findAll(): array
    {
        return $this->em->getRepository($this->entityClass)->findAll();
    }

    /**
     * Sauvegarde un utilisateur
     */
    public function save(User $user, bool $flush = true): void
    {
        $this->em->persist($user);
        if ($flush) {
            $this->em->flush();
        }
    }

    /**
     * Supprime un utilisateur
     */
    public function remove(User $user, bool $flush = true): void
    {
        $this->em->remove($user);
        if ($flush) {
            $this->em->flush();
        }
    }

    /**
     * Mise à jour du mot de passe de l'utilisateur
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supportées.', $user::class));
        }

        $user->setPassword($newHashedPassword);
        $this->save($user);
    }
}