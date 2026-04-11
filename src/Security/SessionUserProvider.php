<?php

namespace App\Security;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class SessionUserProvider implements UserProviderInterface
{
    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        if ($identifier === 'admin_user') {
            return new SessionUser(2, $identifier, ['ROLE_ADMIN', 'ROLE_USER']);
        }
        
        return new SessionUser(1, 'standard_user', ['ROLE_USER']);
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        return $user;
    }

    public function supportsClass(string $class): bool
    {
        return SessionUser::class === $class || is_subclass_of($class, SessionUser::class);
    }
}
