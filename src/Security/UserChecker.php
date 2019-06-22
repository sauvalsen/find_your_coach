<?php
namespace App\Security;

use App\Security\Exceptions\ActiveException;
use App\Security\User as AppUser;
use Symfony\Component\Security\Core\Exception\AccountExpiredException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserChecker implements UserCheckerInterface
{
    public function checkPreAuth(UserInterface $user)
    {
        if (!$user instanceof UserInterface) {
            return;
        }

        if (!$user->getIsActive()) {
            throw new ActiveException();
        }
    }

    public function checkPostAuth(UserInterface $user)
    {

    }
}