<?php

namespace Core\BoundedContext\User\Domain\Contracts;

use Core\BoundedContext\User\Domain\Auth;
use Core\BoundedContext\User\Domain\User;
use Core\BoundedContext\User\Domain\ValueObjects\UserEmailVO;
use Core\BoundedContext\User\Domain\ValueObjects\UserPasswordVO;
use Core\BoundedContext\User\Domain\ValueObjects\StringVO;

interface UserRepository
{
    /**
     * @param User $user
     * @return User
     */
    public function store(User $user): User;
}
